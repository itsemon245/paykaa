<?php

namespace App\Http\Middleware;

use App\Models\Chat;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $adminUuid = \Illuminate\Support\Facades\Cache::rememberForever('admin-uuid', fn() => \App\Models\User::where('id', 1)->pluck('uuid'));
        return [
            ...parent::share($request),
            'settings' => Setting::first(),
            'auth' => [
                'user' => $request->user(),
            ],
            'config' => [
                'app' => config('app'),
            ],
            'ziggy' => fn() => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'error' => session()->get('error'),
            'success' => session()->get('success'),
            'csrfToken' => csrf_token(),
            'paths' => [
                'resources' => resource_path(),
                'public' => public_path(),
                'storage' => storage_path(),
                'base' => base_path(),
            ],
            'impersonating' => session('impersonating'),
            'unreadCount' => Chat::myChats()->where('is_read', false)->count(),
            'notifications' => auth()->user()?->notifications ?? [],
        ];
    }
}
