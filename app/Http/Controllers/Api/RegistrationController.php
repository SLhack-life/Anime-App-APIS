<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\wallet;
use App\Traits\ValidationErrorTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Exception;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    //
    use ValidationErrorTrait;

    /* Register */
    public function register(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'user_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'device_type' => 'required',
            'device_token' => 'required',
       
        ]);

        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }

        $otp = mt_rand(1000, 9999);

        $users = new User();
        $users->email = $request->get('email');
        $users->user_name = $request->get('user_name');
        $users->password = bcrypt($request->get('password'));
        $users->device_type = $request->get('device_type');
        $users->device_token = $request->get('device_token');
        $users->user_code=mt_rand(10000000,99999999);
       
       
        $users->otp = $otp;
        $users->save();

        $user = User::where('id', $users->id)->first();

        //  $writer = new PngWriter();
        // $qrurl = mt_rand(000,9999). '.png';
        // $qrData = url($user->id);

        // $wallet=new wallet();
        // $wallet->user_id=$user->id;
        // $wallet->points=0;
        // $wallet->save();
        // Create QR code
       
       
       
        $name=$user->user_name;
    
        // $user = User::where(['email' => $get_mail])->first();
        // $html =  view('verify-otp', compact('name','otp'))->render();
    
        // $html="verification code :       ".$otp;
        // $email = new \SendGrid\Mail\Mail();
        // $email->setFrom("testingteam220@gmail.com", "flowrolls");
        // $email->setSubject("verification code  ");
        // $email->addTo($user->email, $user->username);
        // $email->addContent("text/html", $html);

        // $sendgrid = new \SendGrid('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');
        try {               
            // $sendgrid->send($email);
            return response(['statusCode' => 200, 'message' => 'Otp has been sent to your registered email', 'data' => $user]);
            // dd($response);
        } catch (Exception $e) {
            return response(['statusCode' => 400, 'message' => 'Error', 'data' => $e->getMessage()]);
        }        
    }

    /* Register */


    /*  OTP Verify */

    public function otp_verify(Request $request)
    {   
        // $data = $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'otp'   => 'required',
        ]);

        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }

        $user_exist = User::where('email', $request->email)->first();
        
        if ($user_exist) {
            if($user_exist->otp == $request->otp) {
                $accessToken = $user_exist->createToken('authToken')->accessToken;
                $updateDetails = [
                    'is_verified' => 1,
                    'remember_token' => $accessToken
                ];
                User::where('email', $request->email)->update($updateDetails);
                $data = User::where('email', $request->email)->first();            
                return response(['statusCode' => 200, 'message' => 'Account Verified Successfully.', 'data' => $data]);
            } else {
                return response(['statusCode' => 400, 'message' => 'Entered otp does not matches, please enter valid otp.']);
            }
            // $user =  User::where('email', $request->email)->update(['is_verified' => 1]);
            // $userdata = User::where('email', $request->email)->where('otp', $request->otp)->first();
            // $accessToken = $userdata->createToken('authToken')->accessToken;
            // $update = User::where('email', $request->email)->update(['remember_token' => $accessToken]);
            // $userdata->token = $accessToken;
            // return response(['statusCode' => 200, 'message' => 'Account Verified Successfully.', 'data' => $userdata]);
        } else {
            return response(['statusCode' => 400, 'message' => 'You have entered an invalid email address']);
        }
        
    }

    /*  End OTP Verify */


    /* Login */

    public function login(Request $request)
    {
        
        $json_data = json_decode($request->getContent(), true);
        $validator = Validator::make($json_data, [
            'email' => 'required',
            'password' => 'required',
            'device_token' => 'required',
            'device_type' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = User::where('email', $json_data['email'])->where('is_verified', 1)->first();
            if (!empty($user)) {
                if ($user->status == 1) {
                    $accessToken = $user->createToken('authToken')->accessToken;
                    
                    $update = User::where('email', $json_data['email'])
                        ->update([
                            'remember_token' => $accessToken, 
                            'device_token' => $json_data['device_token'], 
                            'device_type' => $json_data['device_type']
                        ]);
                    $user = Auth::user();
                    if ($user) {
						    $userData = [
						        'id' => $user->id,
						        'user_name' => $user->user_name,
						        'email' => $user->email,
						        'otp' => $user->otp,
						        'is_verified' => $user->is_verified,
						        'device_type' => $user->device_type,
						        'device_token' => $user->device_token,
						        'remember_token' => $user->remember_token,
						    ];

						    // Now $userData contains the selected user data.
						    // You can use $userData as needed.
						}
                    // $data->token=$accessToken;
                    

                    return response()->json(['statusCode' => 200, 'message' => 'Login successfully.', 'data' => $userData]);
                } else {
                    return response()->json(['statusCode' => 400, 'message' => 'Your Account has been deleted.']);
                }
            } else {
                $user_data=User::select('id','user_name','otp','email','remember_token')->where('email',$request->email)->first();
                return response()->json(['statusCode' => 201, 'message' => 'Please verify your account before login!','data'=>$user_data]);
            }
        }
             else{
            return response()->json(['statusCode' => 400, 'message' => 'Invalid credentials.']);
        }
        
    }
    public function store_login(Request $request)
    {
        $json_data = json_decode($request->getContent(), true);
        $validator = Validator::make($json_data, [
            'email' => 'required',
            'password' => 'required',
            'device_token' => 'required',
            'device_type' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }

        if(Auth::attempt(['email' => request('email'), 'password' => request('password'),'role'=>2])){
            $user = User::where('email', $json_data['email'])->where('role', 2)->first();
            if (!empty($user)) {
                if ($user->status == 1) {
                    $accessToken = $user->createToken('authToken')->accessToken;
                    $update = User::where('email', $json_data['email'])
                        ->update([
                            'remember_token' => $accessToken, 
                            'device_token' => $json_data['device_token'], 
                            'device_type' => $json_data['device_type']
                        ]);
                    $data = Auth::user();
                    $data->token=$accessToken;

                    return response()->json(['statusCode' => 200, 'message' => 'Login successfully.', 'data' => $data]);
                } else {
                    return response()->json(['statusCode' => 400, 'message' => 'Your Account has been deactivated by Admin.']);
                }
            } else {
                return response()->json(['statusCode' => 201, 'message' => 'Please verify your account before login!']);
            }
        }
             else{
            return response()->json(['statusCode' => 400, 'message' => 'Invalid credentials.']);
        }
        
    }

    /* Login */


    /* Resend OTP */
    // public function resend_otp(Request $request)
    // {
    //     $data = json_decode($request->getContent(), true);
    //     $validator = Validator::make($data, [
    //         'country_code' => 'required',
    //         'phone_no' => 'required'
    //     ]);

    //     if ($validator->fails()) {
    //         $messages = implode(",", $this->errorMessages($validator->errors()));
    //         return response(['statusCode' => 400, 'message' => $messages]);
    //     }
    //     $otp = mt_rand(1000, 9999);

    //     $resend_otp = User::where('country_code', $request->country_code)
    //         ->where('phone_no', $request->phone_no)
    //         ->update(['otp' => $otp]);

    //     return response(['statusCode' => 200, 'message' => 'OTP sent to your mobile, Please Verify.', 'otp' => $otp]);
    // }
    
    public function resend_otp(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data, [
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }

        $email = $request->get('email');

        $email_exists = User::where(['email' => $email])->exists();
        if (!$email_exists) {
            return response()->json(['statusCode' => 400, 'message' => 'email number does not exist']);
        }

        $otp = mt_rand(1000, 9999);
       
        $update = User::where('email', $email)->update(['otp' => $otp]);

        $user = User::where(['email' => $email])->first();
        $html="verification code :       ".$otp;
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("testingteam220@gmail.com", "flowrolls");
        $email->setSubject("verification code  ");
        $email->addTo($user->email, $user->username);
        $email->addContent("text/html", $html);
        $sendgrid = new \SendGrid('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');
        try {               
            $sendgrid->send($email);
            return response(['statusCode' => 200, 'message' => 'Otp has been sent to your registered email', 'data' => $user]);
        } catch (Exception $e) {
            return response(['statusCode' => 400, 'message' => 'Error', 'data' => $e->getMessage()]);
        } 
    }
    /* Resend OTP */



    /**************Social Register/Login Api*************/

    public function social_login(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data, [
            'user_name' => 'required',
            'email' => 'required',
            'social_id'     =>    'required',
            'device_type'   =>    'required',
            'device_token'  =>    'required',
        
        ]);

        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($user->status == 0) {
                return response()->json(['statusCode' => 510, 'message' => 'Sorry, Your Account has been deactivated by Admin.']);
            }
            if ($request->social_image) {
                $file = $request->social_image;
               
                $imageName= $request->social_image;
        
               
            }
            User::where('id', $user->id)->update([
                'device_token'  => $data['device_token'],
                'device_type'   => $data['device_type'],
                'social_id'     => $request->get('social_id'),
                'user_name'     =>  $request->get('user_name'),
                'social_image'   =>empty($imageName)?'null':$imageName
            ]);

            $reg_accessToken    = $user->createToken('authToken')->accessToken;
            $update             = User::where('id', $user->id)->update(['remember_token' => $reg_accessToken]);
            $user               = User::where('id', $user->id)->first();
            $user->token        = $reg_accessToken;
        } else {
            $otp = mt_rand(1000, 9999);
            $user = new User([
                'social_id'      =>  $request->get('social_id'),
                'user_name'     =>  $request->get('user_name'),
                'email'        =>  $request->get('email'),
                'device_type'    =>  $request->get('device_type'),
                'device_token'   =>  $request->get('device_token'),
                'otp' =>  $otp

            ]);
            if ($request->social_image) {
                $file = $request->social_image;
                
                $imageName= $request->social_image;
            
            }
            $user->social_image=$imageName;
            $user->save();
            $user = User::where('id', $user->id)->first();
        $accessToken = $user->createToken('authToken')->accessToken;
        $user->token = $accessToken;
        User::where('email', $user->email)->update(['remember_token' => $accessToken]);

        }
        $points=wallet::where('user_id',$user->id)->first();
        if(empty($points)){
            $data=new wallet();
            $data->points=0;
            $data->user_id=$user->id;
            $data->save();
        }

        return response()->json(['statusCode' => 200, 'message' => 'Login Successfully.', 'data' => $user]);
    }
    /**************Social Register/Login Api*************/

    /* logout */

    public function logout(Request $request)
    {
        $device_token_null = User::where('id', Auth::id())->update(['device_token' => Null]);
        $token = $request->user()->token();
        $token->revoke();
        return response()->json(['statusCode' => 200, 'message' => 'You have been successfully logged out!']);
    }

    /* logout */

    /* Edit Profile Api */

    public function edit_profile(Request $request)
    {
        $data = $request->all();
        // $user_id = Auth::id();
        $validator = Validator::make($data, [
            'user_name' => 'required',
        
           
        ]);

        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }

       $user=Auth::user();

        if (!empty($request->get('user_name'))) {
            $user->user_name = $request->get('user_name');
        }
        
        

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // $imageName = time() . '.' . $request->image->extension();
            $imageName= time().'.'.$request->image->getClientOriginalName();
             $relativeImagePath = 'uploads/' . $imageName;
                $absoluteImagePath = public_path($relativeImagePath);
            $image = $request->image->move(public_path('uploads/'), $imageName);
            $user->user_image = $imageName;
        }
        $user->save();
        $user_data=User::select('id','user_name','user_image')->where('id',Auth::id())->first();
        $user_data->path=$absoluteImagePath;
        return response(['statusCode' => 200, 'message' => 'Profile Successfully Updated.', 'data' => $user_data]);
    }

    /* Edit Profile Api */

    /* Get Profile */

    public function get_profile(Request $request)
    {
       
       
        // $user = User::select('users.*','wallets.points')->where('users.id', $request->user_id)
        //     ->leftjoin('wallets', 'user_id', '=', 'users.id')
        //     ->first();
        // $user->user_code=mt_rand(10000000,99999999);
        $user = User::select('user_name','email','user_image')->where('users.id',Auth::id())->first();
        $user->image_path = $user->user_image ? url('public/uploads/' . $user->user_image) : null;
                return response(['statusCode' => 200, 'message' => 'Profile Successfully Fetched.', 'data' => $user]);

    }

    /* Get Profile */

    /* Change Password */

    public function change_password(Request $request)
    {

        $data  = json_decode($request->getContent(), true);
        $validator = Validator::make($data, [
            'old_password' => 'required',
            'new_password' => 'required'
        ]);
        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }

        if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
            return response()->json(['statusCode' => 400, 'message' => 'Please check your old password.']);
        }

        $new_password       = $request->get('new_password');
        $user               = User::where(['id' => Auth::id()])->first();
        $user->password     = bcrypt($new_password);
        $user->save();
        return response()->json(['statusCode' => 200, 'message' => 'Password changed successfully.']);
    }

    /* Change Password */

    /* Reset Password */
    public function reset_password(Request $request)
    {

        $data  = json_decode($request->getContent(), true);
        $validator = Validator::make($data, [
            'email' => 'required',
            'password' => 'required|min:6',

            
            'confirm_password' => 'required|same:password|min:6'
        ]);
        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }

        $password           = $request->get('password');
        $user               = User::where('email', $request->email)->first();
        $user->password     = bcrypt($password);
        $user->save();
        return response()->json(['statusCode' => 200, 'message' => 'Password changed successfully.']);
    }
     /* Reset Password */

    public function forgot_password(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data, [
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }

        $email = $request->get('email');

        $email_exists = User::where(['email' => $email])->exists();
        if (!$email_exists) {
            return response()->json(['statusCode' => 400, 'message' => 'email number does not exist']);
        }

        $otp = mt_rand(1000, 9999);
        
        $update = User::where('email', $email)
            ->update(['otp' => $otp]);
        $user = User::where(['email' => $email])->first();
        $html="verification code :       ".$otp;
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("testingteam220@gmail.com", "flowrolls");
        $email->setSubject("verification code  ");
        $email->addTo($user->email, $user->username);
        $email->addContent("text/html", $html);
        $sendgrid = new \SendGrid('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');
        try {               
            $sendgrid->send($email);
            return response(['statusCode' => 200, 'message' => 'Otp has been sent to your registered email', 'data' => $user]);
        } catch (Exception $e) {
            return response(['statusCode' => 400, 'message' => 'Error', 'data' => $e->getMessage()]);
        } 

    }


    public function delete_account(Request $request){
       
            $data=User::where('id',Auth::id())->first();
            $data->status=0;
            $data->save();
            return response()->json(['statusCode'=>200,'success'=>false,'message'=>"account deleted successfully"]);

    }
    public function anime_list(){
         $animeList = DB::table('anime')->get();

        return response()->json(['anime_list' => $animeList]);

    }

    public function get_anime_list_by_id(Request $request){
          $validator = Validator::make($request->all(), [
        'id' => 'required', // Assuming 'id' should be an integer
    ]);

    // Check for validation errors
    if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }

    // Retrieve anime data based on the provided 'id'
    $anime = DB::table('anime')->where('id', $request->id)->first();
    $get_anime_list=DB::table('anime')->select('id','image','embed_url','title_japanese','title')->get()->take(10);
    $anime->data=$get_anime_list;
    $is_favourite=2;
    $is_saved=2;
    $is_watched_later=2;

    $anime_find_watched = DB::table('watch_later')->where('anime_id', $request->id)->where('user_id',Auth::id())->first();
    if(!empty($anime_find_watched)){
    $is_watched_later=1;

    }

    $anime_find_saved = DB::table('save_anime')->where('anime_id', $request->id)->where('user_id',Auth::id())->first();
    if(!empty($anime_find_saved)){
    $is_saved=1;

    }
    $user_id=Auth::id();

    // $anime_find_favourite = DB::table('favourite')->where('user_id',Auth::id())->first();


    $anime_find_favourite = DB::table('favourite')->where('anime_id', $request->id)->where('user_id',Auth::id())->first();
    
    if(!empty($anime_find_favourite)){
    $is_favourite=1;

    }



    // Check if the anime is found
    if (!$anime) {
        return response()->json(['error' => 'Anime not found'], 404);
    }
    $anime->is_favourite=$is_favourite;
    $anime->is_saved=$is_saved;
    $anime->is_watched_later=$is_watched_later;


    return response()->json(['anime_list' => $anime]);
    }


    public function saved_to_watch_later(Request $request){

        $data = $request->all();
        $validator = Validator::make($data, [
           
            'anime_id' => 'required',
            "type"  =>'required'
           
          
        ]);

        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }
        if($request->type=="1"){
             $check_list= DB::table('watch_later')->where('user_id',Auth::id())->where('anime_id',$request->anime_id)->get();
            if(count($check_list)>0){
            return response(['statusCode' => 201, 'message' => 'already in list!',]);

            }

         DB::table('watch_later')->insert([
                "anime_id"=>$request->anime_id,
                "user_id"=>Auth::id()
        
                ]);
            return response(['statusCode' => 200, 'message' => 'add to watch later saved successfully!',]);

          }
          else{

            $animeList = DB::table('watch_later')->where('anime_id',$request->anime_id)->where('user_id',Auth::id())->delete();
            return response(['statusCode' => 200, 'message'=>"anime deleted successfully."]);
          }


      }


   

    public function saved_to_favourite(Request $request){

        $data = $request->all();
        $validator = Validator::make($data, [
           
            'anime_id' => 'required',
            "type"  => 'required'
           
          
        ]);

        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }
        if($request->type=="1"){
            $check_list= DB::table('favourite')->where('user_id',Auth::id())->where('anime_id',$request->anime_id)->get();
            if(count($check_list)>0){
            return response(['statusCode' => 201, 'message' => 'already in list!',]);

            }

         DB::table('favourite')->insert([
                "anime_id"=>$request->anime_id,
                "user_id"=>Auth::id()
        

        ]);
            return response(['statusCode' => 200, 'message' => 'add to favourites saved successfully!',]);
        }else{

             $animeList = DB::table('favourite')->where('anime_id',$request->anime_id)->where('user_id',Auth::id())->delete();
            return response(['statusCode' => 200, 'message'=>"anime deleted successfully."]);

        }
          


    }



    public function save_anime(Request $request){

        $data = $request->all();
        $validator = Validator::make($data, [
           
            'anime_id' => 'required',
            'type'  => 'required'
           
          
        ]);

        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }
        if($request->type=="1"){
             $check_list= DB::table('save_anime')->where('user_id',Auth::id())->where('anime_id',$request->anime_id)->get();


             if(count($check_list)>0){
            return response(['statusCode' => 201, 'message' => 'already in list!',]);

            }

         DB::table('save_anime')->insert([
                "anime_id"=>$request->anime_id,
                "user_id"=>Auth::id()
        ]);
            return response(['statusCode' => 200, 'message' => 'anime saved successfully!',]);
          
        }
        else{
             $animeList = DB::table('save_anime')->where('anime_id',$request->anime_id)->where('user_id',Auth::id())->delete();
            return response(['statusCode' => 200, 'message'=>"anime deleted successfully."]);

        }



    }




     public function get_saved_to_watch_later(Request $request){

       // $animeList = DB::table('watch_later')->where('user_id',Auth::id())->get();

        $animeList = DB::table('watch_later')
        ->select('anime.id','anime.image','anime.embed_url','anime.title_japanese','anime.title','watch_later.*')
    ->join('anime', 'watch_later.anime_id', '=', 'anime.id') // Assuming there's a video_id column in watch_later and an id column in videos
    ->where('watch_later.user_id', Auth::id())
    ->get();

       if(count($animeList)>0){

            return response(['statusCode' => 200, 'data' => $animeList]);

       }
       else{
            return response(['statusCode' => 200, 'data' => ($animeList),'message'=>"no anime in watch later"]);

       }

       
          


    }




    public function get_from_favourite(Request $request){

       $animeList = DB::table('favourite')
        ->select('anime.id','anime.image','anime.embed_url','anime.title_japanese','anime.title','favourite.*')
    ->join('anime', 'favourite.anime_id', '=', 'anime.id')
    ->where('favourite.user_id',Auth::id())->get();
       if(count($animeList)>0){
            return response(['statusCode' => 200, 'data' => $animeList]);

       }
       else{
            return response(['statusCode' => 200, 'data' => ($animeList),'message'=>"no anime in favourite"]);

       }


    }



    public function get_saved_anime(Request $request){

       $animeList = DB::table('save_anime')
        ->select('anime.id','anime.image','anime.embed_url','anime.title_japanese','anime.title','save_anime.*')
    ->join('anime', 'save_anime.anime_id', '=', 'anime.id')
       ->where('save_anime.user_id',Auth::id())->get();
       if(count($animeList)>0){
            return response(['statusCode' => 200, 'data' => $animeList]);

       }
       else{
            return response(['statusCode' => 200, 'data' => ($animeList),'message'=>"no anime in favourite"]);

       }

       
    }

    // public function delete_from_watch_later(Request $request){
    //      $data = $request->all();
    //     $validator = Validator::make($data, [
           
    //         'id' => 'required'
           
          
    //     ]);

    //     if ($validator->fails()) {
    //         $messages = implode(",", $this->errorMessages($validator->errors()));
    //         return response(['statusCode' => 400, 'message' => $messages]);
    //     }

    //    $animeList = DB::table('watch_later')->where('id',$request->id)->delete();
    //         return response(['statusCode' => 200, 'message'=>"anime deleted successfully."]);



    // }

    // public function delete_from_favourite(Request $request){
    //      $data = $request->all();
    //     $validator = Validator::make($data, [
           
    //         'id' => 'required'
           
          
    //     ]);

    //     if ($validator->fails()) {
    //         $messages = implode(",", $this->errorMessages($validator->errors()));
    //         return response(['statusCode' => 400, 'message' => $messages]);
    //     }

    //    $animeList = DB::table('favourite')->where('id',$request->id)->delete();
    //         return response(['statusCode' => 200, 'message'=>"anime deleted successfully."]);



    // }


    // public function delete_from_saved(Request $request){
    //      $data = $request->all();
    //     $validator = Validator::make($data, [
           
    //         'id' => 'required'
           
          
    //     ]);

    //     if ($validator->fails()) {
    //         $messages = implode(",", $this->errorMessages($validator->errors()));
    //         return response(['statusCode' => 400, 'message' => $messages]);
    //     }

    //    $animeList = DB::table('save_anime')->where('id',$request->id)->delete();
    //         return response(['statusCode' => 200, 'message'=>"anime deleted successfully."]);
       


    // }

    // public function forgot_password(Request $request)
    // {

    //     $data = json_decode($request->getContent(), true);
    //     $validator = Validator::make($data, [
    //         'email' => 'required',
    //     ]);
    //     if ($validator->fails()) {
    //         $messages = implode(",", $this->errorMessages($validator->errors()));
    //         return response(['statusCode' => 400, 'message' => $messages]);
    //     }

    //     $get_mail = $request->get('email');
    //     if (!filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
    //         return response()->json(['statusCode' => 400, 'message' => 'Please enter valid email address.']);
    //     }
    //     $email_exists = User::where(['email' => $get_mail])->exists();
    //     if (!$email_exists) {
    //         return response()->json(['statusCode' => 400, 'message' => 'Email does not exist']);
    //     }
    //     $user = User::where(['email' => $get_mail])->first();
    //     $html =  view('reset_password_template', compact('user'))->render();
    //     if ($user->status == 1) {
    //         $email = new \SendGrid\Mail\Mail();
    //         $email->setFrom("testingteam220@gmail.com", "flowrolls");
    //         $email->setSubject("Forgot Password Link");
    //         $email->addTo($user->email, $user->username);
    //         $email->addContent("text/html", $html);
    //         $sendgrid = new \SendGrid('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');
    //         try {
                
    //             $response = $sendgrid->send($email);
    //             // dd($response);
    //         } catch (Exception $e) {
    //             return response(['statusCode' => 400, 'message' => 'Error', 'data' => $e->getMessage()]);
    //         }
    //         return response(['statusCode' => 200, 'message' => 'Reset password link sent to mail']);
    //     } else {
    //         return response()->json(['statusCode' => 400, 'message' => 'Sorry, Your Account has been deactivated by Admin.']);
    //     }
    // }


}
