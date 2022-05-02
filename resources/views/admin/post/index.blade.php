@extends('admin.includes.admin_design')

@section('site_title')Post @endsection
@section('content')
<div class="row align-items-center">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4 class="font-size-18">Post</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0);">Post</a></li>
                <li class="breadcrumb-item active">All Post</li>
            </ol>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="float-right d-none d-md-block">
            <div class="dropdown">
                <a href="{{route('post.add')}}" class="btn btn-primary"><i class="mdi mdi-plus mr-2"></i> Add New Post </a>
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
                        <th>Image</th>
                        <th> Post title</th>
                        <th> Category</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="modal-header">
        <h5 class="modal-title" id="modal-title">Modal Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
    <!-- Required datatable js -->
    <script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script>
    <script>

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

<script>
    $('#datatable').DataTable({
        processing:true,
        serverSide:true,
        sorting:true,
        searchable:true,
        responsive:true,
        ajax:"{{route('table.post')}}",
        columns:[
            {data:"DT_RowIndex",name:"DT_RowIndex"},
            {data:"image",name:'image',
                render: function(data,type,full,meta){
                    if(data){
                        return "<img src={{URL::to('/')}}/uploads/" + data + " width:'50'>";
                    }
                }
            },
            {data:"post_title",name:"post_title"},
            {data:"category_id",name:"category_id"},
            {data:"status",name:"status"},
            {data:"action",name:"action",orderable:false},
        ]
    });

    $('body').on('click', '.btn-show', function (event){
            event.preventDefault();
            var me =$(this),
            url = me.attr('href'),
            title = me.attr('title');
            $('#modal-title').text(title);

            $.ajax({
                url:url,
                dataType:"html",
                success: function(response){
                    $('#modal-body').html(response);
                }
            })
               $('#modal').modal('show');

        });

</script>

@endsection
