@extends('admin.includes.admin_design')

@section('site_title') Admin Profile @endsection
@section('content')
                        <!-- start page title -->
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="page-title-box">
                                    <h4 class="font-size-18">Admin Profile</h4>
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Profile</a></li>
                                        <li class="breadcrumb-item active">Update Profile</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        @include('admin.includes.message')
                                        <form class="custom-validation" action="{{route('adminProfileUpdate',$admin->id)}}" method="Post" enctype="multipart/form-data">
                                            @csrf
                                           <div class="row">
                                               <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="admin_name">Admin Name</label>
                                                    <input type="text" class="form-control" id="admin_name" name="admin_name" value="{{$admin->admin_name}}"/>
                                                </div>
                                               </div>

                                               <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Admin Email</label>
                                                    <input type="text" class="form-control" id="email" name="email" disabled value="{{$admin->email}}"/>
                                                </div>
                                               </div>

                                               <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Admin Phone</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" value="{{$admin->phone}}"/>
                                                </div>
                                               </div>

                                               <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <input type="text" class="form-control" id="address" name="address" value="{{$admin->address}}"/>
                                                </div>
                                               </div>

                                               <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file" class="form-control" id="image" name="image" onchange="readURL(this);" accept="image/*"/>
                                                </div>
                                                <img src="{{asset('uploads/'.$admin->image)}}" id="one" width="100px">
                                               </div>
                                           </div>


                                            <div class="form-group mb-0">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light mr-1">
                                                        Submit
                                                    </button>

                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div> <!-- end col -->


                        </div> <!-- end row -->
@endsection

@section('js')
 <script>
     function readURL(input){
         if(input.files && input.files[0]){
             var reader = new FileReader();
             reader.onload = function(e){
                 $("#one").attr('src', e.target.result).width(100);
             };
             reader.readAsDataURL(input.files[0]);
         }
     }
 </script>
@endsection
