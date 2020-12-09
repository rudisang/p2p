<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'omang' => ['required'],
            'occupation' => ['required', 'string', 'max:255'],
            'phone' => ['required'],
            'address' => ['required', 'string', 'max:255'],
            'residence' => ['required', 'image'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if(request()->hasFile('residence')){
            // Get filename with the extension
            $filenameWithExt = request()->file('residence')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = request()->file('residence')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = request()->file('residence')->storeAs('public/residences', $fileNameToStore);
		
	    // make thumbnails
	          $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make(request()->file('residence')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/residences/'.$thumbStore);
		
        } 

        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'gender' => $data['gender'],
            'omang' => $data['omang'],
            'isUser' => true,
            'isAdmin' => false,
            'occupation' => $data['occupation'],
            'salary' => $data['salary'],
            'employer' => $data['employer'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'residence' => $fileNameToStore,
            'employer_email' => $data['employer_email'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
