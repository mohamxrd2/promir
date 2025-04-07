<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class profilesManagementController extends Controller
{
    public function returnModifyPage(Request $request){
        $user = Auth::user();
        return view('profile.modify', compact('user'));
    }


    public function editeUserProfile(Request $request){

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:20',
            'last_stname'      => 'required|string|max:50',
            'phone_number' => 'required|string|max:20|unique:users,phone_number,'.Auth::id(),
            'second_phone_number' => 'nullable|string|max:20|unique:users,second_phone_number,'.Auth::id(),
            'gender' => 'required|string|max:8',
            'fonction' => 'required|string|max:60',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ],
        [
            'name.required' => 'Champs requis',
            'name.max' => 'Max de :max requis',

            'gender.required' => 'Champs requis',
            'gender.max' => 'Max de :max requis',

            'fonction.required' => 'Champs requis',
            'fonction.max' => 'Max de :max requis',

            'last_stname.required' => 'Champs requis',
            'last_stname.max' => 'Max de :max requis',

            'phone_number.required' => 'Champs requis',
            'phone_number.max' => 'Max de :max requis',
            'phone_number.unique' => 'Numéro incorrecte',

            'second_phone_number.max' => 'Max de :max requis',
            'second_phone_number.unique' => 'Numéro incorrecte',

            'photo.mimes' => 'Image incorrecte',
            'photo.max' => 'Image trop volumineuse',

        ]
    );

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

        $user = Auth::user();
        $user->name = $request->name;
        $user->last_stname = $request->last_stname;
        $user->phone_number = $request->phone_number;
        $user->gender = $request->gender;
        $user->fonction = $request->fonction;
        $user->second_phone_number = $request->second_phone_number??NULL;


        if ($request->photo) {

            if ($user->photo && $user->photo != "defaultProfileImage.jpg") {
                Storage::delete('public/profile_images/' . $user->photo);
            }

            $imageName = $user->name . $user->id .  '_profile_' . time() . '.' . $request->photo->extension();
            $request->photo->storeAs('public/profile_images', $imageName);

            $user->photo = $imageName;
            
        }


        $user->update();



        return response()->json("OK");
    }
}
