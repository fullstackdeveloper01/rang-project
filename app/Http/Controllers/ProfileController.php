<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {  
        $materials = DB::table('materials')->orderBy('name', 'asc')->get(); 
        $users_material = DB::table('users_material')->select('material_id')->where('user_id', auth()->user()->id)->get();  
        $users_materialArr =[];
        if(!empty($users_material))
        {
            foreach ($users_material as $key => $data) {
                $users_materialArr[] = $data->material_id;
            }
        }         
        return view('profile.edit', ['materials' => $materials, 'users_material' => $users_materialArr]);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());


        $material = $request->material; 

        //users material deleted
        DB::table('users_material')->where('user_id', auth()->user()->id)->delete();

        if(!empty($material))
        {
            $materialArr = [];
            foreach ($material as $key => $material_id) {
                    $materialArr[] = array('user_id' => auth()->user()->id, 'material_id' => $material_id);
            }
            //users material insert
            DB::table('users_material')->insert($materialArr);
        }  
        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
