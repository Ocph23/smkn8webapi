<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {

            $user =  Socialite::driver('google')->user();
            $finduser = User::where('gauth_id', $user->id)->orWhere("email",$user->email) ->first();
            if($finduser){
                if($finduser->gauth_id==null){
                    $finduser->gauth_id= $user->id;
                    $finduser->avatar= $user->avatar;
                    $finduser->gauth_type = $user->gauth_type;
                    $finduser->save();
                }

                Auth::login($finduser);
                if(Auth::user()->isAdmin()){
                    $data= json_encode($finduser);
                    setcookie("auth",$data);
                    return redirect('/admin');
                }
            }else{
                $finduser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id'=> $user->id,
                    'avatar'=> $user->avatar,
                    'role' => 'guest',
                    'status' => true,
                    'gauth_type'=> 'google',
                    'password' => encrypt('Password@123')
                ]);
                Auth::login($finduser);
            }
            $data= json_encode($finduser);
            setcookie("auth",$data);
            return redirect('/dashboard');

        } catch (\Exception $e) {

            dd($e->getMessage());
        }
    }


    public function withapi(Request $req)
    {
        try {
            $finduser = User::where('gauth_id', $req->gauth_id)->orWhere("email",$req->email) ->first();
            if($finduser){
                if($finduser->gauth_id==null){
                    $finduser->gauth_id= $req->gauth_id;
                    $finduser->avatar= $req->avatar;
                    $finduser->gauth_type = $req->gauth_type;
                    $finduser->save();
                }
            }else{
                $finduser = User::create([
                    'name' => $req->name,
                    'email' => $req->email,
                    'gauth_id'=> $req->gauth_id,
                    'avatar'=> $req->avatar,
                    'role' =>$req->role,
                    'status' => true,
                    'gauth_type'=> $req->gauth_type,
                    'password' => encrypt('Password@123')
                ]);
            }
            Auth::login($finduser);
            $data= json_encode($finduser);
            return $data;

        } catch (\Exception $e) {

            dd($e->getMessage());
        }
    }
}
