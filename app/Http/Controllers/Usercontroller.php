<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Data;
use Carbon\Carbon; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Exception;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\SuperSubCategory;
use App\Models\wallet;
use App\Models\Point;
use Error;
use Yajra\DataTables\DataTables;
use GuzzleHttp\Client;
class Usercontroller extends Controller
{
    //
    public function user_list(Request $request)
    {
    
        if ($request->ajax()) {
            
            
            $data = User::where('role',1)->where('is_store',0)->leftjoin('wallets','wallets.user_id','users.id')->select('users.*','wallets.points as wallet_points')->orderBy('id', 'DESC')->get();
           
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if($row->status==1){
   
                           $btn_data = "<div class='edit btn btn-sm toggle_btn ' onclick='changeStatus($row->id)'>
                           <div class=''>
                                <input class='custom-control-input' type='checkbox' checked >
                            </div>
                           </div>";
     
                            return $btn_data;
                        }
                        else{
                            $btn_data = "<div class='edit btn btn-sm toggle_btn' onclick='changeStatus($row->id)'>
                            <div class=''>
                                 <input class='custom-control-input' type='checkbox'>
                             </div>
                            </div>";
     
                            return $btn_data;
      
                            
                        }
                    })
                    ->addColumn('image', function($row){
                        if($row->user_image==null){
                            
                            $url= asset('images/slider/'.$row->image);  
                            $btn = "<img class='img_avatar'  src='".$url."'>";
                        }
                        else{

                            $url= asset('uploads/'.$row->user_image);  
                            $btn = "<img class='img_avatar'  src='".$url."'>";
                        }

                 
  
                         return $btn;
                 })
                 ->addColumn('points', function($row){
                   
                        
                       
                        $btn ="<div class=' btn-sm toggle_btn '>$row->wallet_points
                        <button class='btn btn-primary btn-sm' type='checkbox'  onclick='changePoints($row->id)' >
                        Edit
                        </div>

                               
                        </div>";
                    
                   

                     
                    

             

                     return $btn;
             })
                    
                    ->rawColumns(['action','image','points'])
                    ->make(true);
                    
        }
        // $data = Data::all();
        
         return view('user.user_list');
    }
    public function change_password(Request $request){
        $id=Auth::id();
        $admin=User::where('id',$id)->first();
       
        return view('auth.change_password',compact('admin'));
    }

    // change password
    public function change_password_user(Request $request){
        
        $request->validate([
         "old_password" => "required",
         "new_password" => "required",
         'confirm_password' => 'required|same:new_password'
        ]);
        $user_id=Auth::id();
        $users = User::where('id',$user_id)->first();
        $current_password=$users->password;
        //  dd(back()->withError('Old password dont match!'));
        if(Hash::check($request->old_password,$current_password)){
        $data=User::find(Auth::id());
        $data->password=bcrypt($request->new_password);
        $data->update();
        // dd($data);
        // return redirect()->route('dashboard');
        return back()->withAlert('Password Change Successfully');
    }else{
         return back()->withError('Old password dont match!');

    }
    }

     ## change  stautus
     public function change_status_update(Request $request){
        
         $user=User::find($request->id);
        // dd($user->status); 
        
         if($user->status == 0){
            $user->status = 1;
         
         }
         else{
            $user->status = 0;
         }
         $user->save();

        // dd($user);
         return response()->json(["msg"=>$user->status]);
       } 
    public function forgot_password(Request $request)
    {
        return view('user.forgot_password');
    }

    public function getUserDetails(Request $request) {

        return view('user.view');
    }

    public function edit(Request $request)
    {   
        $id= $request->id;
        $book  = User::where('id',$id)->first();
 
        return response()->json($book);
    }
    public function update(Request $request){

        $id=$request->user_id;
        
        // DB::beginTransaction();
        try {
            $user=User::find($id);
            // dd($user);
            $user->user_name=$request->name;
            
            $user->user_image=$request->image;
            $user->save();
            return response()->json(["status"=>"success","msg"=>$user]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["status"=>"error","msg"=>$user]);
            // DB::rollBack();
        }
        // DB::commit();
        // $user=User::find($id);
        // $user->user_name=$request->name;
        
        // $user->user_image=$request->image;
        // $user->update();
        // // return redirect('user_list')->with('success', 'updated successfully');
        // return response()->json(["msg"=>$user]);
    }

    public function importView(Request $request){
        return view('import-excel');
    }
  
    public function import(Request $request){
        Product::truncate();
        Category::truncate();
        Subcategory::truncate();
        SuperSubCategory::truncate();
        Image::truncate();
        Excel::import(new ImportUser, 
                      $request->file('file'));
        return redirect('products');
    }

    public function submitForgetPasswordForm(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);
          $url =  url('reset-password').'/'. $token ;
          $html = '<p><a href='. $url .'>Click here</a></p>';
      
          
          $email = new \SendGrid\Mail\Mail();
          $email->setFrom("testingteam220@gmail.com", "flowrolls");
          $email->addTo("test@example.com", "Example User");
          $email->setSubject("verification code  ");
          $email->addTo('codobux.social@gmail.com', 'hello');
          $email->addContent("text/html", $html);
  
          $sendgrid = new \SendGrid('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');

             try {
                $sendgrid->send($email);
             } catch (\Throwable $th) {
               dd($th);
             }  

        return redirect('/forgot_password')->with('message', 'We have e-mailed your password reset link!');
    }


    public function showResetPasswordForm($token) { 
       
        return view('auth.change_password', ['token' => $token]);
     }
        public function submitResetPasswordForm(Request $request)
        {
            $request->validate([
                'email' => 'required|email|exists:users',
                'new_password' => 'required',
                'confirm_password' => 'required|same:new_password'
            ]);

            // $updatePassword = DB::table('password_resets')
            //                     ->where([
            //                     'email' => $request->email, 
            //                     'token' => $request->token
            //                     ])
            //                     ->first();

            // if(!$updatePassword){
                
            //     return back()->withInput()->with('error', 'Invalid token!');
            // }


            $user = User::where('email', $request->email)
                        ->update(['password' => Hash::make($request->new_password)]);
            $admin=User::where('email',$request->email)->first();
            
            // DB::table('password_resets')->where(['email'=> $request->email])->delete();
           

            return redirect('/')->with('message', 'Your password has been changed!');
        }


        public function edit_points(Request $request){
            $data=wallet::where('user_id',$request->id)->first();
            return response()->json(['statuscode'=>200,'data'=>$data]);

        }

        public function change_points_value(Request $request){
           
            $data=wallet::where('user_id',$request->id)->first();
            $points=$data->points;
            if($request->status==1){
                $data->points=$points+$request->user_points;
                $data->save();
                $points_table=new Point();
                $points_table->points_status="collected";
                $points_table->order_id="points by Admin";
                $points_table->user_id=$request->id;
                $points_table->points=$request->user_points;
                $points_table->save();
                
                return response()->json(['statuscode'=>200,'data'=>$data]);
            }
            if($request->status==2){
                if($points<$request->user_points){
                    return response()->json(['statuscode'=>400,'msg'=>"you dont have enough points"]);
                }
                $data->points=$points-$request->user_points;
                $data->save();
                return response()->json(['statuscode'=>200,'data'=>$data]);
            }
      
        }

         public function fetchAndSaveAnimeData(){
         	
    	for($i=1;$i<=50;$i++){
    		$animeIds[]=$i;
    		
    	}
        // $animeIds = [1, 2, 3, /*... add more anime IDs ...*/];

        foreach ($animeIds as $animeId) {
            $animeData = $this->fetchAnimeData($animeId);
            // echo "<pre>";
            // print_r($animeData['data']['images']['jpg']['image_url']);            
            // echo "</pre>";
            // die;

            if ($animeData !== false) {
                $this->saveAnimeToDatabase($animeData['data']);
            }
        }

        return response()->json(['message' => 'Anime data saved successfully.']);
    }

    private function fetchAnimeData($animeId)
    {
        $client = new Client();
        $url = "https://api.jikan.moe/v4/anime/{$animeId}";

        try {
            $response = $client->get($url);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            // Handle errors, log them, or return false
            return false;
        }
    }

    private function saveAnimeToDatabase($animeData)
    {
        DB::table('anime')->insert([
            'title' => $animeData['title'],
            'synopsis' => $animeData['synopsis'],
            'image' => $animeData['images']['jpg']['image_url'],
            'embed_url'=>$animeData['trailer']['embed_url'],
            'title_japanese'=>$animeData['title_japanese'],
            'type'=>$animeData['type'],
            'source'=>$animeData['source'],
            'episodes'=>$animeData['episodes'],
            'status'=>$animeData['status'],
            'duration'=>$animeData['duration'],
            'rating'=>$animeData['rating'],
            'score'=>$animeData['score'],
            'rank'=>$animeData['rank'],
            'popularity'=>$animeData['popularity'],
            'favorites'=>$animeData['favorites'],
            'members'=>$animeData['members'],
            'season'=>$animeData['season'],
            'year'=>$animeData['year'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    }