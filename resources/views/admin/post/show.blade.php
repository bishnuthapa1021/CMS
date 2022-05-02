<table class="table-hover">
    <tr>
        <th>Post Title</th>
        <td>{{$model->post_title}}</td>
    </tr>

   <tr>
       <th>Image</th>
       <td>
           <img src="{{asset('uploads/'.$model->image)}}" alt=""width = "200px">
       </td>
   </tr>

   <tr>
    <th>Posted By </th>
    <td>{{$model->admin->admin_name}}</td>
</tr>


</table>
