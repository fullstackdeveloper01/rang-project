<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $materials = DB::table('materials')->orderBy('name', 'asc')->get(); 
        
        return view('auth.register', ['materials'=>$materials]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validation = [
            'role' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'company_name' => ['required', 'string', 'max:255'],
            'company_address' => ['required', 'string', 'max:255'],
            'gst_number' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'profile_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4048'],
        ]; 
        // if($data['role'] == 1)
        // {
        //     $validation['material'] = "required|array|min:1"; 
        // } 
        return Validator::make($data, $validation);

        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(80)
        ]);*/ 

        // $role = Role::create(['name' => 'manufacturer']);
        // $role->givePermissionTo(Permission::all());

 
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'company_name' => $data['company_name'],
            'company_address' => $data['company_address'],
            'gst_number' => $data['gst_number'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(80)
        ]);
        if($data['role'] == 1)
        {
            $user->assignRole('manufacturer');
        }else{
            $user->assignRole('buyer');
        }  
 

        if ($data['profile_image']) {

            $file = $data['profile_image'];

            $profile_path = 'uploads/users/';

            $filename = 'users/'. time().uniqid(rand()) . '_image.' . $file->getClientOriginalExtension();

            $file->move(public_path($profile_path), $filename);

            $user->profile_image = $filename;
            
            $user->update();
        } 

        if($data['role'] == 1)
        { 
            $material = $data['material'];

            $materialArr = array();

            if(!empty($material))
            {
                foreach ($material as $key => $material_id) {
                     $materialArr[] = array('user_id' => $user->id, 'material_id' => $material_id);
                }
                DB::table('users_material')->insert($materialArr);
            } 
        }

        return $user;
    }
}
