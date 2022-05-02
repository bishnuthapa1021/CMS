@extends('admin.includes.admin_design')

@section('site_title')VIew All Tags @endsection
@section('content')
<div class="row align-items-center">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4 class="font-size-18">Tags</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0);">Tags</a></li>
                <li class="breadcrumb-item active">All Tags</li>
            </ol>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="float-right d-none d-md-block">
            <div class="dropdown">
                <a href="{{route('tag.add')}}" class="btn btn-primary"><i class="mdi mdi-plus mr-2"></i> Add New Tag </a>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
@include('admin.includes.message')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Tag Name</th>
                        <th>Tag Slug</th>
                        <th>Tag Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection

@section('js')
    <!-- Required datatable js -->
    <script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script>
    <script>
        $('#datatable').DataTable({
            processing:true,
            serverSide:true,
            sorting:true,
            searchable:true,
            responsive:true,
            ajax:"{{route('table.tag')}}",
            columns:[
                {data:"DT_RowIndex",name:"DT_RowIndex"},
                {data:"tag_name",name:"tag_name"},
                {data:"slug",name:"slug"},
                {data:"status",name:"status"},
                {data:"action",name:"action",orderable:false},
            ]
        });
        $('body').on('click', '.btn-delete', function (event){
            event.preventDefault();
            var SITEURL = '{{ URL::to('') }}';
            var id = $(this).attr('rel');
            var deleteFunction = $(this).attr('rel1');
            swal({
                    title: "Are You Sure? ",
                    text: "You will not be able to recover this record again",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, Delete it!"
                },
                function () {
                    window.location.href =  SITEURL + "/admin/" + deleteFunction + "/" + id;
                });
        });


    </script>

@endsection
