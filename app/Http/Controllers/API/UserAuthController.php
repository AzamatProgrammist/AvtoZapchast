<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'phone' => 'required|regex:/^(!?){0}([+]){1}([998]){3}\s([7-9]){1}([0-9]){1}\s([0-9]){3}\s([0-9]){2}\s([0-9]){2}$/',
            'password' => 'required|min:8',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'usertype' => 0,
            'phone' => $request->phone,
            'password' => bcrypt($request->password)
        ]);
       
        $token = $user->createToken('LaravelAuthApp')->accessToken;
 
        return response()->json(['token' => $token], 200);
    
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
         if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(
                [
                    'id' => auth()->user()->id,
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                    'phone' => auth()->user()->phone,
                    'token' => $token
                ], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }

    }

   public function update_user(Request $request)
{
    $user = Auth()->user();
    $existingRoles = $user->roles;
    $validatedData = $request->validate([
        'email' => 'required|email|unique:users,email,'.$user->id,
    ]);

    $user->name = $request->input('name');
    $user->email = $validatedData['email'];

    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
    }

    $user->save();

    $user->roles()->sync($existingRoles);
    return response()->json(['success' => $user], 200);
}

}


