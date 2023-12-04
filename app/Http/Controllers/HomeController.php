<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function forgot_password($id){
        
        try {
            $userid = Crypt::decrypt($id);
            
            $user = User::where('id', $userid)->first();
        
            return view('auth.passwords.forgot_password', compact('user'));
        } catch (DecryptException $e) {
            return back();
        }
    }


    public function password_forgot(Request $request) {

        $id = $request->id;
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ],
        [
            'confirm_password.required' => 'confirm_password is required',
            'password.required' => 'Password is required',
            'confirm_password.same' => 'confirm password must matched',
           

        ]);
        
        User::where('id', $id)->update(['password' => bcrypt($request->password)]);
        // dd($request->all());
         return redirect('/')->with('message', 'Password reset successfully');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
