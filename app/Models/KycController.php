<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Data\KycData;

class KycController extends Model
{
    /**
     * Undocumented function
     */
    public function store(Request $request)
    {
        if (auth()->user()->kyc && !auth()->user()->kyc->failed_at) {
            return back()->with('error', 'You have already submitted your documents');
        }
        $data = KycData::from($request)->except(
            'created_at_human',
            'updated_at_human',
        )->toArray();
        $kyc = Kyc::updateOrCreate(['user_id' => auth()->id()], [
            'user_id' => auth()->id(),
            ...$data,
        ]);
        return back();
    }
}
