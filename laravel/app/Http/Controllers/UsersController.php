<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use File;

class UsersController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->get();

        return view('user.index', ['users' => $users]);
    }

    public function edit_user($id){
        $user = DB::table('users')->where('id', $id)->first(); 
        return view('user.edit_user', ['userinfo' => $user]);  
    }

    public function update_user($id, Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');
        $update_array = array();

        if($name)
            $update_array['name']=  $name;
        
        if($email){
            $user = DB::table('users')->where('email', $email)->first();
            if(!$user)
              $update_array['email']=  $email;     
        }

        if($password && $password==$password_confirmation)
            $update_array['password']=  bcrypt($password);

        if(!empty($update_array)){
            DB::table('users')
                ->where('id', $id)
                ->update($update_array); 
        }

        return redirect('/users/edit_user/'.$id);
    }

    public function manage_images($id){
        $images = DB::table('users_images')->where('user_id', $id)->get();
        return view('user.manage_images', ['images' => $images, 'user_id'=>$id]);
    }

    public function add_image($id, Request $request){
        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $image_name = time()."-".$image->getClientOriginalName();
            $image->move('images', $image_name);
            DB::table('users_images')->insert([
                'user_id' => $id,
                'image_name' => $image_name,
            ]);

            return redirect('/users/manage_images/'.$id);
        }
        
    }

    public function delete_image($id, $image_id){
        $image = DB::table('users_images')->where('id', $image_id)->first(); 
        $path = public_path('images/' . $image->image_name); 
        File::delete($path);
        DB::table('users_images')->where(['id'=> $image_id, 'user_id'=>$id])->delete();
        return redirect('/users/manage_images/'.$id);
    }
}