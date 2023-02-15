@extends('layouts.app')
@section('content')
    <div  class=" mt-2 row">
        <div class=" col-md-8 mx-auto card ">
            @include('layouts.message')
            <div class="offset-md-4 col-md-8 ">
                <div class="row">


                    <div class=" text-right">
                        <a type="button"  href="{{route('users.create')}}" class="btn btn-primary px-5 ">Create</a>
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
                            <th>Email</th>
                            <th>Edit</th>
                            <th>Delete</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id}}</td>
                                <td class="text-truncate">{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td class="text-center"> <a href="{{route('users.edit',$user->id)}}" class="text-warning"
                                                            title="Edit"><i class="bi bi-pencil-fill"></i></a></td>
                                <td class="text-center">

                                    <form method="POST" action="{{route('users.destroy',$user->id)}}">
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
                            <th>Drivers</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
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
