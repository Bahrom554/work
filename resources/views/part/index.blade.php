@extends('layouts.app')
@section('content')
    <div  class=" mt-2 row">
        <div class=" col-md-8 mx-auto card ">
            @include('layouts.message')
            @include('layouts.error')
            <div class="offset-md-4 col-md-8 ">
                <div class="row">
                <div class=" text-right">
                        <a type="button"   href="#addModal"  data-toggle="modal" class="btn btn-primary px-5 ">Create</a>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive" id="for_search">
                    <table id="example" class="table table-striped table-bordered" style="width:100%; ">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Edit</th>
                            <th>Delete</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($parts as $part)
                            <tr>
                                <td>{{ $part->id}}</td>
                                <td class="text-truncate">{{$part->name}}</td>
                                <td>{{$part->type}}</td>
                                <td class="text-center"> <a href="{{route('part.edit',$part->id)}}" class="text-warning"
                                                            title="Edit"><i class="bi bi-pencil-fill"></i></a></td>
                                <td class="text-center">

                                    <form method="POST" action="{{route('part.destroy',$part->id)}}">
                                        @method('delete')
                                        @csrf
                                        <a href="#" style="color: red;" onclick="
                                     if(confirm('Are sure,You want delete this?')){
                                            event.preventDefault();
                                            this.closest('form').submit();
                                           }
                                            else{
                                            event.preventDefault();}"><i class="bi bi-trash-fill"></i></a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" >
        <div class="modal-dialog">
            <form role="form" id="editform" action="{{route('part.store')}}"   method="POST">
                {{csrf_field()}}
          <div class="modal-content">
            <div class="d-flex justify-content-between px-3" style="border-bottom:1px solid #e5e5e5;">
                <h3 class="text-uppercase text-truncate">Create Part</h3>
                <button type="button" class="close" data-dismiss="modal" >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
           <div class="modal-body row">
               <div class=" form-group col-md-6">
                  <label>name</label>
                  <input type="text" name="name" class="form-control"  required>
              </div>
              <div class=" form-group col-md-6">
                <label>type</label>
                <input type="text" name="type" class="form-control" >
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </div>
            </form>
        </div>
      </div>
    </div>
    @endsection
@section('jscontent')

    <script>
        $('#example').dataTable({
            "columnDefs": [{
                "width": "10%",
                "targets": 0
            },
                {
                    "width": "60%",
                    "targets": 1
                },
                {
                    "width": "10%",
                    "targets": 2
                },
                {
                    "width": "10%",
                    "targets": 3
                },
                {
                    "width": "10%",
                    "targets": 4
                },

            ],
            "paging": false,
            "order": [0, 'desc'],
        });


    </script>
@endsection
