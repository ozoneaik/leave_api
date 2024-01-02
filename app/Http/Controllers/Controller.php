<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $users = User::all();

        return response()->json([
            'message' => $users ? 'success' : 'error',
            'users' => $users ?: [],
        ]);
    }

    public function edit($id){
        $user = User::FindOrFail($id);
        if ($user){
            return response()->json([
                'message' => 'success',
                'user' => $user
            ]);
        }else{
            return response()->json([
                'message' => 'error',
                'user' => null
            ]);
        }
    }

    public function update(Request $request, $id){
        $user = User::FindOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return response()->json([
            'message' => 'success',
            'user' => $user
        ]);

    }

    public function delete($id){
        $message = 'error';
        $user = User::FindOrFail($id);
        if ($user){
            $user->delete();
            $message = 'success';
        }
        return response()->json(['message' => $message]);
    }


}
