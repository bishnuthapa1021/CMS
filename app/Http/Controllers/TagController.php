<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use DataTables;

class TagController extends Controller
{
    //
    public function index(){
        return view('admin.tag.index');
    }
    public function add(){
        return view('admin.tag.add');
    }
    public function store(Request $request){
        $data = $request->all();
        $validateData = $request->validate([
            'tag_name'=>'required|max:255'
        ]);
        $tag = new Tag();
        $tag->tag_name = $data['tag_name'];
        $tag->slug = Str::slug($data['tag_name']);
        if(!empty($data['status'])){
            $tag->status = 1;
        }else{
            $tag->status = 0;
        }
        $tag->save();
        Session::flash('info-message','New Tag Has Been Added');
        return redirect()->back();
    }
    public function datatable(){
        $model = Tag::all();
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.tag._action',[
                'model'=>$model,
                'url_edit'=>route('tag.edit',$model->id),
                'url_delete'=>route('tag.delete',$model->id)

            ]);
        })
        ->editColumn('status',function($model){
            if($model->status ==1){
                return "Active";
            }else{
                return "Inactive";
            }
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->make(true);
    }
    public function edit($id){
        $tag = Tag::findOrFail($id);
        return view('admin.tag.edit',compact('tag'));
    }
    public function update(Request $request, $id){
        $data = $request->all();
        $validateData = $request->validate([
            'tag_name'=>'required|max:255'
        ]);
        $tag = Tag::findOrFail($id);
        $tag->tag_name = $data['tag_name'];
        $tag->slug = Str::slug($data['tag_name']);
        if(!empty($data['status'])){
            $tag->status = 1;
        }else{
            $tag->status = 0;
        }
        $tag->save();
        Session::flash('info-message','Tag Has Been Updated Successfully');
        return redirect()->back();
    }
    public function delete($id){
        $tag = Tag::findOrFail($id);
        $tag->delete();
        Session::flash('error-message','tag Has Been deleted Successfully');
        return redirect()->back();
    }
}
