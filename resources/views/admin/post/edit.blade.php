@extends('admin.includes.admin_design')

@section('site_title')Edit Post @endsection
@section('content')
<div class="row align-items-center">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4 class="font-size-18">Post</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0);">Post</a></li>
                <li class="breadcrumb-item active">Edit Post</li>
            </ol>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="float-right d-none d-md-block">
            <div class="dropdown">
                <a href="{{route('post.index')}}" class="btn btn-primary">
                    <i class="mdi mdi-eye mr-2"></i> View All Post
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
                <form method="post" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                                <div class="form-group mb-4">
                                    <label for="category_name">Under Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option selected disabled>Select Category</option>
                                        @foreach ($category as $categories )
                                            <option value="{{$categories->id}}"
                                                @if ($categories->id==$post->category_id)
                                                    selected
                                                @endif
                                                >{{$categories->category_name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group mb-4">
                                <label for="post_title">Post Title</label>
                                <input id="post_title" class="form-control" name="post_title" value="{{$post->post_title}}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label for="post_content">Post Content </label>
                                <textarea name="post_content" id="post_content" cols="30" rows="10" class="form-control">
                                    {{$post->post_content}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label for="image">Post Image </label>
                                <input type="file" id="image" class="form-control" name="image" >
                                @if ($post->image)
                                <img src="{{asset('uploads/'.$post->image)}}" alt=""width = "200px">

                                @endif
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group mb-4">
                                <label for="post_title">Select Tags </label>
                                <select name="tag_id[]" id="tag_id" class="form-control" multiple="multiple">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" >{{ $tag->tag_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="checkbox" id="switch3" name="status" @if ($post->status =='Published')
                                checked
                            @endif switch="bool"  checked/>
                            <label for="switch3" data-on-label="Active"
                                   data-off-label="In Active"></label>
                        </div>
                    </div>

                    <h3>SEO Settings</h3>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="seo_title">SEO Title </label>
                                <input type="text" id="seo_title" class="form-control" name="seo_title" value="{{$post->seo_title}}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="seo_subtitle">SEO Sub Title </label>
                                <input type="text" id="seo_subtitle" class="form-control" name="seo_subtitle" value="{{$post->seo_subtitle}}" >
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="seo_keywords">SEO Keywords </label>
                                <input type="text" id="seo_keywords" class="form-control" name="seo_keywords"value="{{$post->seo_keywords}}" >
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="seo_description">SEO Description </label>
                                <input type="text" id="seo_description" class="form-control" name="seo_description" value="{{$post->seo_description}}">
                            </div>
                        </div>
                    </div>


                                <div class="form-group mb-0">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mr-1">
                                            Submit
                                        </button>

                                    </div>
                                </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tag_id').select2();
    });
</script>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('post_content', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>


@endsection
