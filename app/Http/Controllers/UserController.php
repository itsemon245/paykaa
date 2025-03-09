<?php

namespace App\Http\Controllers;

use App\Data\UserData;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where(function ($query) use ($request) {
            $search = $request->search;
            $query->whereNot('id', auth()->id());
            $query->whereNot('id', 1);
            $query->where('id', $search);
        })->get();
        return response()->json(UserData::collect($users));
    }
}
