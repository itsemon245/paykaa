<?php

use Illuminate\Support\Facades\DB;


/**
 * Generates a random avatar
 * @param string|null $seed keep null to generate get `auth()->user()->avatar` if not authenticated it will generate a random avatar
 * @return string
 */
function avatar(string $seed = null): string
{
    if (auth()->check() && auth()->user()->avatar != null) {
        return auth()->user()->avatar;
    }
    return asset("assets/images/user.svg");
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
        return $response;
    } catch (\Exception $th) {
        DB::rollBack();
        if (config('app.env') == 'local') {
            dd($th);
        }
        if (request()->expectsJson()) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ]);
        }
        return back()->with('error', $th->getMessage());
    }
}
