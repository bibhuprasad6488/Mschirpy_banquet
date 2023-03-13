<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cuisine;
use Socialite;
use Session;
use Exception;


class AuthenticationController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\MobileUser
     */
    public function googleSocial()
    {
        return view('api.googlesocial');
    }

    public function socialLogin(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
          try {
            $data = Socialite::driver('google')->user();
            dd($data);
            
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function list_show()
    {
        $data = Cuisine::orderBy('id','DESC')->get();
        return response()->json($data);
    }

    public function addcuisine(Request $request)
    {
        $obj = new Cuisine(['user_id'=>4,'cuisine_name'=>$request->cuisine]);
        $save = $obj->save();
        if($save){
            return response()->json(['data'=>"Added Successfully"]);
        }
    }
}
