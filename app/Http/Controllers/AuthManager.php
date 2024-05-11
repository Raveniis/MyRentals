<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AuthManager extends Controller
{
    function login(){
        return view('login');
    }

    function loginPost(Request $request){
        
        Auth::logout();

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        // get email and password only
        $credentials = $request->only('email', 'password');
        
        if(Auth::attempt($credentials)){
            $user = auth()->user();

            if($user->email_verified_at)
            {
                return response()->json(['success' => 'login successfully'], 200);
                // return redirect()->intended(route('home'));
            }
            Auth::logout();
            
            return response()->json(['error' => 'Please verify your email'], 200);
            return redirect(route('login'))->with("error", "Please verify your email to proceed.")->withInput( $request->except('$password'));
        }
        
        return response()->json(['error' => 'The your email or password are incorrect'], 400);
        return redirect(route('login'))->with("error", "The your email or password are incorrect.")->withInput( $request->except('$password'));
        // if login failed
    }
    
    function signup(){
        return view('signup');
    }

    function signupPost(Request $request){
        $user = Validator::make($request->all(), [
            'firstname' => 'required|string|max:128',
            'lastname' => 'required|string|max:128',
            'contact_num' => 'required|size:11|regex:/(09)[0-9]{9}/',
            'address' => 'required|string|max:128',
            'birthdate' => 'required|date|before:18 years ago',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed|required_with:password_confirmation',
            'role' => 'required|in:landowner,renter'
        ]);

        if ($user->fails()) {
            return response()->json(['errors' => $user->errors()]);
        }

        $data['firstname'] = $request->firstname;
        $data['lastname'] = $request->lastname;
        $data['contact_num'] = $request->contact_num;
        $data['address'] = $request->address;
        $data['birthdate'] = $request->birthdate;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['role'] = $request->role;

        $user = User::create($data);
        if(!$user){
            // return redirect(route('signup'))->with("error", "login details are not valid")->withInput();
            return response()->json(['error' => 'login details are not valid']);
        }

        // send email 
        event(new Registered($user));

        $credentials = $request->only('email', 'password');

        Auth::attempt($credentials);

        return response()->json(['success' => 'account has been created, please check your email']);
        // return redirect(route('login'))->with("success", "Account has been created. Please verify your email to proceed");
    }

    public function verify(EmailVerificationRequest $request) {
        $request->fulfill();
     
        return response()->json(['success' => 'sheesh']);
        // return redirect('/home');
    }
    
    public function ownerLogin() {
        return view('landowner.ownerLogin');
    }

    public function ownerLoginPost(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        
        if(Auth::attempt($credentials)){
            $user = auth()->user();

            if($user->email_verified_at || $user) //bypass muna verified at HAHHAHAHAH
            {
                return redirect()->intended(route('dashboard'));
            }
            Auth::logout();
            
            return redirect(route('ownerLogin'))->with("error", "Please verify your email to proceed.")->withInput( $request->except('$password'));
        }
        
        return redirect(route('ownerLogin'))->with("error", "The your email or password are incorrect.")->withInput( $request->except('$password'));
        // if login failed
    }

    public function ownerSignup() {
        return view('landowner.ownerSignup');
    }

    public function ownerSignupPost(Request $request) {
        $request->validate([
            'firstname' => 'required|string|max:128',
            'lastname' => 'required|string|max:128',
            'contact_num' => 'required|size:11|regex:/(09)[0-9]{9}/',
            'address' => 'required|string|max:128',
            'birthdate' => 'required|date|before:18 years ago',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed|required_with:password_confirmation',
            'role' => 'required|in:landowner,renter'
        ]);

        $data['firstname'] = $request->firstname;
        $data['lastname'] = $request->lastname;
        $data['contact_num'] = $request->contact_num;
        $data['address'] = $request->address;
        $data['birthdate'] = $request->birthdate;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['role'] = $request->role;

        $user = User::create($data);
        if(!$user){
            return redirect(route('ownerSignup'))->with("error", "login details are not valid")->withInput();
            // return response()->json(['error' => 'login details are not valid']);
        }

        // send email 
        // event(new Registered($user));

        // $credentials = $request->only('email', 'password');

        // Auth::attempt($credentials);

        return redirect(route('ownerLogin'))->with("success", "Account has been created. Please verify your email to proceed");
    }

    public function ownerLogout() {
        Auth::logout();
        return redirect(route('ownerLogin'));
    }

    function logout(){
        Auth::logout();
        return redirect(route('login'));
    }
}
