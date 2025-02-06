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
