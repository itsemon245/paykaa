<?php

use Illuminate\Support\Facades\DB;


/**
 * Generates a random avatar
 * @param string|null $seed keep null to generate get `auth()->user()->avatar` if not authenticated it will generate a random avatar
 * @return string
 */
function avatar(string $seed = null): string {
    if ($seed == null && auth()->check()) {
        if(auth()->user()->avatar != null) {
            return auth()->user()->avatar;
        }else{
            $seed = Str::random(10);
            return "https://api.dicebear.com/9.x/identicon/svg?seed=$seed";
        }
        $seed = auth()->user()->name;
    }
    $seed = str($seed)->slug();
    $avatar = "https://api.dicebear.com/9.x/initials/svg?seed=$seed&radius=50&backgroundColor=1e88e5,3949ab,43a047,5e35b1,7cb342,8e24aa,d81b60,e53935,039be5,00897b,fb8c00,f4511e,ffb300&fontFamily=Helvetica&chars=1&fontWeight=600";
    return $avatar;
}

/**
 * Uses transaction to prevent any unintentional writes to database and returns back with a toast.
 *
 * @param callable $callback
 * @param string|null $urlToRedirect
 * @return Illuminate\Routing\Redirector|Illuminate\Http\RedirectResponse|Illuminate\Http\Response|Illuminate\Contracts\Routing\ResponseFactory
 */
function backWithError(callable $callback)
{
    try {
        DB::beginTransaction();
        $response = $callback();
        DB::commit();
    } catch (\Exception $th) {
        DB::rollBack();
        if (config('app.env') == 'local') {
            dd($th);
        }
        return back()->with('error', $th->getMessage());
    }
    return $response;
}
