<?php

namespace App\Http\Controllers;

use App\Data\UserData;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        $users = User::where(function ($query) use ($request) {
            $search = $request->search;
            $query->whereNot('id', auth()->id());
            if ($request->has('search')) {
                if (empty($search)) {
                    $query->whereNull('id');
                }else{
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('id', 'like', '%' . $search . '%');
                }
            }
        })->get();
        return response()->json(UserData::collect($users));
    }
}
