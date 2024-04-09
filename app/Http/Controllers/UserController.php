<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        try {
            $data = User::all();
            return view('users/index', ["users" => $data]);
        } catch (Exception $ex) {

            return Redirect::back()->withErrors(["error" => "tets"]);
        }
    }


    public function create()
    {
        return view('users/create');
    }



    public function post(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'role' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'status' => true,
                'password' => Hash::make('Password@123'),
            ]);
            return view('users');
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            return  Redirect::back()->withErrors($error);
        }
    }

    public function changestatus($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = !$user->status;
            $user->save();
        }
        
        return redirect(route('admin.users'));
    }
}
