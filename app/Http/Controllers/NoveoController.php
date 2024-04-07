<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoveoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth:web');
    }

    public function index(Request $request)
    {
        return view('nov.index', ['header' => 'Задачи']);

    }
        public function indexis(Request $request)
    {
        // Authenticate user using the web guard
        if (!Auth::guard('web')->check()) {
            // Redirect to login if user is not authenticated via web guard
            $redirectUrl = $request->url();
            session()->put('url.intended', $redirectUrl);
            return redirect()->route('login');
        }
 //       $this->middleware('api', ['except' => ['login']]);
        if (! $token = auth('api')->attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // Authenticate user using the API guard

        // Pass the JWT token to the view
        return view('nov.index', ['header' => 'Задачи', 'token' => $token]);
    }

}
