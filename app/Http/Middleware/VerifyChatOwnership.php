<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyChatOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('impersonating.old')) {
            $oldUser = User::where('uuid', session('impersonating.old'))->first();
            if ($oldUser?->isAdmin()) {
                return $next($request);
            }
        }
        $chat = $request->route('chat');
        $user = $request->user();
        if (!in_array($user->id, [$chat->sender_id, $chat->receiver_id])) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You don`t have permission to access this chat',
                ], 401);
            }
            abort(401, 'Not authorized for this chat');
        }
        return $next($request);
    }
}
