<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DataTables;

class PostController extends Controller
{
   public function index(){
       return view('admin.post.index');
   }

   public function show($id){
       $model = Post::findOrFail($id);
       return view('admin.post.show',compact('model'));
   }

   public function add(){
       $category = Category::where('status',1)->get();
       $tags= Tag::where('status',1)->get();

       return view('admin.post.add',compact('category','tags'));
   }

   public function store(Request $request){
       $data = $request->all();
       $post = new Post();
       $post->category_id = $data['category_id'];
       $post->post_title = $data['post_title'];
       $post->slug = Str::slug($data['post_title']);
       $post->post_content = $data['post_content'];
       $post->seo_title = $data['seo_title'];
       $post->seo_subtitle = $data['seo_subtitle'];
       $post->seo_keywords = $data['seo_keywords'];
       $post->seo_description = $data['seo_description'];
       $post->admin_id = Auth::guard('admin')->user()->id;
       if(!empty($data['status'])){
           $post->status= 1;
       }else{
           $post->status = 0;
       }

       $slug = Str::slug($data['post_title']);
       $random = rand(1,99999);
       if($request->hasFile('image')){
        $image_tmp = $request->file('image');
        if($image_tmp->isValid()){
            $extension = $image_tmp->getClientOriginalExtension();
            $filename = $slug.'-'.$random.'.'.$extension;
            $image_path = 'uploads/'.$filename;
            Image::make($image_tmp)->save($image_path);
            $post->image = $filename;
            $tags = $data['tag_id'];
            $post->save();
            $post->tags()->attach($tags);

        }

       Session::flash('info-message','Post Has Been Added');
        return redirect()->back();


   }
}

public function edit($id){
    $post = Post::findOrFail($id);
    $category = Category::where('status',1)->get();
   $tags= Tag::where('status',1)->get();
   $post_tag = $post->tags()->pluck('tag_id')->toArray();
    return view('admin.post.edit',compact('post','tags','category','post_tag'));
}

public function update(Request $request,$id){
    $data = $request->all();
    $post = Post::findOrFail($id);
    $post->category_id = $data['category_id'];
    $post->post_title = $data['post_title'];
    $post->slug = Str::slug($data['post_title']);
    $post->post_content = $data['post_content'];
    $post->seo_title = $data['seo_title'];
    $post->seo_subtitle = $data['seo_subtitle'];
    $post->seo_keywords = $data['seo_keywords'];
    $post->seo_description = $data['seo_description'];
    $post->admin_id = Auth::guard('admin')->user()->id;
    if(!empty($data['status'])){
        $post->status= 'Published';
    }else{
        $post->status = "Unpublished";
    }
    $slug = Str::slug($data['post_title']);
    $random = rand(1,99999);
    if($request->hasFile('image')){
     $image_tmp = $request->file('image');
     if($image_tmp->isValid()){
         $extension = $image_tmp->getClientOriginalExtension();
         $filename = $slug.'-'.$random.'.'.$extension;
         $image_path = 'uploads/'.$filename;
         Image::make($image_tmp)->save($image_path);
         $post->image = $filename;
     }
     $tags = $data['tag_id'];
     $post->save();
     $post->tags()->sync($tags);
    Session::flash('info-message','Post Has Been Updated');
     return redirect()->back();
    }

}

public function delete($id){
    $post= Post::findOrFail($id);
    $post->delete();
    Session::flash('error-message','Post Has Been deleted Successfully');
    return redirect()->back();
}
public function datatable(){
    $model = Post::all();
    return DataTables::of($model)
    ->addColumn('action',function($model){
        return view('admin.post._action',[
            'model'=>$model,
            'url_edit'=>route('post.edit',$model->id),
            'url_show'=>route('post.show',$model->id),
            'url_delete'=>route('post.delete',$model->id)

        ]);
    })
    ->editColumn('status',function($model){
        if($model->status ==1){
            return "Published";
        }else{
            return "Draft";
        }
    })

    ->editColumn('category_id',function($model){
        return $model->category->category_name;
    })
    ->addIndexColumn()
    ->rawColumns(['action'])
    ->make(true);
}
}
