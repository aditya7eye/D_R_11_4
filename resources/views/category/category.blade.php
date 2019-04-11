@extends('layouts.app') 
@section('title', 'Category') 
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center m-t-lg mybg">
                <h1>
                    <b>Category</b>
                </h1>
{{--                 
                <hr> --}}


                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#store">Category List &nbsp;<i class="fa fa-step-forward"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#addstore">Add Category &nbsp;<i class="fa fa-plus"></i></a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="store" class="tab-pane active"><br>
                       <table class="table table-striped table-bordered">
                           <thead class="thead-inverse">
                               <tr>
                                   <th style="text-align: center">#</th>
                                   <th style="text-align: center">Name</th>
                                   <th style="text-align: center">Action</th>
                               </tr>
                               </thead>
                               <tbody>
        @foreach ($catlist as $index => $item)
        <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ ucwords($item->name) }}</td>
                <td><a href="{{ url('edit_category').'/'.base64_encode($item->id)}}"><button class="btn btn-success btn-sm">Edit</button></a> <button onclick="del_cate({{ $item->id }});" class="btn btn-danger btn-sm">Delete</button></td>
            </tr>   
        @endforeach
                                 
                               </tbody>
                       </table>

                    </div>
                    <div id="addstore" class="tab-pane fade"><br>
                        <form action="{{ url('insert_category') }}" method="GET" id="insert_category">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="" class="pull-left">Name</label>
                                        <input type="text" name="name" autocomplete="off" class="form-control required" placeholder="Enter Category Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-primary pull-left">Create Category &nbsp;<i class="fa fa-step-forward"></i></button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>
<script>


function del_cate(id)
{
    Swal.fire({
  title: 'Are you sure?',
  text: "Delete This Store",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {

    $.get('{{ url('del_cate') }}', {
        did: id
                }, function (data) {
                   
                        
                        // return false;
                        setTimeout(function () {
                    Swal.fire({
                        position: 'bottom',
                        title: 'Category has Been Deleted',
                        showConfirmButton: false,
                        timer: 1200,
                        animation: false,
                        customClass: {
                            popup: 'animated fadeInDown'
                        }
                    })
                }, 500);
                setTimeout(function(){ location.reload(); }, 1000);
                   
                //     console.log(data);
                //    alert(data);
                });
  }
})
}
</script>
@endsection