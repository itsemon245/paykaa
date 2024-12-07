<?php

namespace App\Http\Controllers;

use App\Data\UserData;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    /**
     * Undocumented function

     * @return UserData[]
     */
    public function index(Request $request){
        $users = User::where(function ($query) use ($request) {
            $search = $request->search;
            if ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%');
            }
        })->get();
        return response()->json(UserData::collect($users));
    }
}
