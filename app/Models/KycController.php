<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Data\KycData;
use App\Enum\Status;

class KycController extends Model
{
    /**
     * Undocumented function
     */
    public function store(Request $request)
    {
        $request->validate([
            'doc_type' => ['required'],
            'front_image' => ['required'],
            'back_image' => ['required'],
        ]);
        $data = KycData::from($request)->except(
            'created_at_human',
            'updated_at_human',
        )->toArray();
        $kyc = Kyc::updateOrCreate(['user_id' => auth()->id()], [
            'user_id' => auth()->id(),
            ...$data,
            'approved_at' => null,
            "approved_at" => null,
            "updated_at" => now(),
        ]);
        $kyc->user()->update(['kyc_status' => Status::PENDING->value]);
        return back();
    }
}
