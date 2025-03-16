<?php

namespace App\Http\Controllers;

use App\Data\AddData;
use App\Data\AddMethodData;
use App\Models\Add;
use App\Models\AddMethod;
use App\Models\Scopes\OwnerScope;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $adUser = User::find($request->user_id);
        $ads = Add::withoutGlobalScope(OwnerScope::class)->where(function (Builder $q) use ($request) {
            if ($request->type) {
                $q->where('type', $request->type);
            }
            if ($request->wallet_id) {
                $q->where('add_method_id', $request->wallet_id);
            }
            if ($request->user_id) {
                $q->where('owner_id', $request->user_id);
            }
        })
            ->with(['owner', 'addMethod'])->paginate();
        return Inertia::render('Marketplace/Index', [
            'ads' => AddData::collect($ads),
            'wallets' => AddMethodData::collect(AddMethod::all()),
            'adUser' => $adUser,
        ]);
    }
}
