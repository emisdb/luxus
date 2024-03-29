<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all users from the database
        $users = User::query()->select(['id','name'])->get();

        // Return users as JSON response
        return response()->json($users);
    }
}
