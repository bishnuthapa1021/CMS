<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class AdminProfileController extends Controller
{
    //
    public function adminProfile(){
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function adminProfileUpdate(Request $request, $id){
        $admin = Admin::findOrFail($id);
        $data = $request->all();
        $rules = [
            'admin_name' => 'required',
        ];
        $customeMessage = [
            'admin_name.required' => "Admin Name Cannot Be Empty",
        ];
        $this->validate($request,$rules,$customeMessage);
        $admin->admin_name = $data['admin_name'];
        $admin->phone = $data['phone'];
        $admin->address = $data['address'];
        $random = Str::random(10);
        if($request->hasFile('image')){
            $image_tmp = $request->file('image');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $random.'.'.$extension;
                $image_path = 'uploads/'.$filename;
                Image::make($image_tmp)->save($image_path);
                $admin->image = $filename;

                $admin->save();

            }
        }
        $admin->save();
        Session::flash('info_message', 'Admin profile has Been updated successfully');
        return redirect()->back();


        $admin->save();
        Session::flash('info-message','Admin Profile Updated Successfully');
        return redirect()->back();
    }

    public function changePassword(){
        $user = Admin::where('email',Auth::guard('admin')->user()->email)->first();
        return view('admin.changePassword',compact('user'));
    }
    public function updatePassword(Request $request,$id ){
        $data = $request->all();
      //  dd($data);
      $validateData = $request->validate([
          'current_password'=>'required|max:255',
          'password'=>'min:6',
          'pass_confirmation'=> 'required_with:password|same:password|min:6'
      ]);
      $user = Admin::where('email',Auth::guard('admin')->user()->email)->first();
      $current_user_password = $user->password;
      if(Hash::check($data['current_password'], $current_user_password )){
        $user->password  = bcrypt($data['password']);
        $user->save();
        Session::flash('info-message','Password Have Been updated Successfully');
        return redirect()->back();
      }else{
        Session::flash('error-message','Your Current Password doesnot Match In Our DataBase');
        return redirect()->back();
      }
    }

}
