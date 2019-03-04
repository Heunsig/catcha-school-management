<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->nickname = $request->nickname;
        $user->note = $request->note;
        $user->save();

        $updated_user = User::where('id', $request->user()->id)->first();

        return response()->json($updated_user);
    }

    public function change_password(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->new_password, [
                                'rounds' => 12
                              ]);
            $user->save();

            return response()->json('success');
        } else {
            return response()->json('Password is invaild', 401);
        }

    }
}
