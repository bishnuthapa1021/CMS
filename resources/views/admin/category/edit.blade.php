@extends('admin.includes.admin_design')
@section('site_title')Edit Category @endsection
@section('content')
<div class="row align-items-center">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4 class="font-size-18">Category</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0);">Category</a></li>
                <li class="breadcrumb-item active">Edit Category</li>
            </ol>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="float-right d-none d-md-block">
            <div class="dropdown">
                <a href="{{route('category.index')}}" class="btn btn-primary">
                    <i class="mdi mdi-eye mr-2"></i> View All Category
                </a>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @include('admin.includes.message')
                <form method="post" action="{{route('category.update',$category->id)}}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <div class="form-group mb-4">
                                    <label for="category_name">Category Name</label>
                                    <input id="category_name" class="form-control" name="category_name" value="{{$category->category_name}}">

                                </div>

                            </div>
                            <input type="checkbox" id="switch3" name ="status" value="1" switch="bool" @if ($category->status==1) checked @endif/>
                        <label for="switch3" data-on-label="Active"
                                data-off-label="In Active"></label>
                                <div class="form-group mb-0">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mr-1">
                                            Submit
                                        </button>

                                    </div>
                                </div>
                        </div>


                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

@endsection

