<?php


namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class AdminLoginController extends Controller
{
    public function index(){
        return view('admin.login');
    }

     // This method will show login page for controller 
     public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
          'email'=> 'required|email',
          'password'=> 'required'
        ]);

        if($validator->passes()) {
          
         if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){

            return redirect()->route('account.dashboard');
            
          } else {
            return redirect()->route('verify')->with('Either email or password incorret');
          }
        }
        else{
          return redirect()->route('account.register')
          ->withInput()
          ->withErrors($validator);
          
          // withErros() to display the errors
          // withInput() helper function cz form er value jate clear na hoi
          
        }
        
      }
}