<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use DataTables;

class CategoryController extends Controller
{
    //
    public function index(){
        return view('admin.category.index');
    }
    public function add(){
        return view('admin.category.add');
    }

    public function store(Request $request){
        $data = $request->all();
        $validateData = $request->validate([
            'category_name'=>'required|max:255'
        ]);
        $category = new Category();
        $category->category_name = $data['category_name'];
        $category->slug = Str::slug($data['category_name']);
        if(!empty($data['status'])){
            $category->status = 1;
        }else{
            $category->status = 0;
        }
        $category->save();
        Session::flash('info-message','New Category Has Been Added');
        return redirect()->back();
    }

    //datab tables
    public function datatable(){
        $model = Category::all();
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.category._action',[
                'model'=>$model,
                'url_edit'=>route('category.edit',$model->id),
                'url_delete'=>route('category.delete',$model->id)

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
        $category = Category::findOrFail($id);
        return view('admin.category.edit',compact('category'));
    }
    public function update(Request $request, $id){
        $data = $request->all();
        $validateData = $request->validate([
            'category_name'=>'required|max:255'
        ]);
        $category = Category::findOrFail($id);
        $category->category_name = $data['category_name'];
        $category->slug = Str::slug($data['category_name']);
        if(!empty($data['status'])){
            $category->status = 1;
        }else{
            $category->status = 0;
        }
        $category->save();
        Session::flash('info-message','Category Has Been Updated Successfully');
        return redirect()->back();
    }
    public function delete($id){
        $category = Category::findOrFail($id);
        $category->delete();
        Session::flash('error-message','Category Has Been deleted Successfully');
        return redirect()->back();
    }
}
