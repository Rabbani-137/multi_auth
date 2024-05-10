<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginController extends Controller
{
    // This method will show login page for controller 
    public function index(){
        return view('login');
     }
  
      // This method will show login page for controller 
      public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
          'email'=> 'required|email',
          'password'=> 'required'
        ]);

        if($validator->passes()) {
          
          if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            return redirect()->route('account.dashboard');
            
          } else {
            return redriect()->route('account.login')->with('Either email or password incorret');
          }
        }
        else{
          return redirect()->route('account.login')
          ->withInput()
          ->withErrors($validator);
          
          // withErros() to display the errors
          // withInput() helper function cz form er value jate clear na hoi
          
        }
        
      }
      
      public function register(){
        return view('register');
       
      }
//to save register data into database
      public function processRegister(Request $request){

        $validator = Validator::make($request->all(),[
          'email'=> 'required|email|unique:users',
          'password'=> 'required|confirmed'
        ]);

        if($validator->passes()) {

          //save data in database

          $user = new User();
          $user->name = $request->name;
          $user->email = $request->email;
          $user->password = Hash::make($request->password);
          $user->role = 'customer';
          $user->save();

          return redirect()->route('account.login')->with('success','You have registed successfully');
        }
        else{
          return redirect()->route('account.register')
          ->withInput()
          ->withErrors($validator);
          
        }
        
      }

      
      public function dashboard(){
        return view('dashboard');
      }

      public function logout(){
        Auth::logout();
        return redirect()->route('account.login');
      }
}