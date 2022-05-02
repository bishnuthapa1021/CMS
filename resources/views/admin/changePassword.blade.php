@extends('admin.includes.admin_design')

@section('site_title')Change Password @endsection
@section('content')
<div class="row align-items-center">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4 class="font-size-18">Change Password</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Profile</a></li>
                <li class="breadcrumb-item active">Change Password</li>
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
                <form class="custom-validation" method="post" action="{{route('updatePassword',$user->id)}}">
                    @csrf
                   <div class="row">
                       <div class="col-md-6">
                        <div class="form-group">
                            <label for="current_password">Current password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" value=""/>
                        </div>
                       </div>
                   </div>

                   <div class="row">
                    <div class="col-md-6">
                     <div class="form-group">
                         <label for="password">New Password</label>
                         <input type="password" class="form-control" id="password" name="password" value=""/>
                     </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                     <div class="form-group">
                         <label for="pass_confirmation">Confirm Password</label>
                         <input type="password" class="form-control" id="pass_confirmation" name="pass_confirmation" value=""/>
                     </div>
                    </div>
                </div>


                    <div class="form-group mb-0">
                        <div class="text-left">
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
