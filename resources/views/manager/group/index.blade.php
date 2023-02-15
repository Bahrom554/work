@extends('layouts.app')
@section('content')
<div  class=" mt-2">
    <div class="card ">
        @include('layouts.message')
        <div class="d-flex align-items-center justify-content-between px-3">
            <h2 class="mb-2 text-uppercase ">Group List</h2>
            <a type="button" href="{{route('group.create')}}" class="btn btn-primary px-5 ">Add Group</a>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="for_search">
                <table id="example" class="table table-striped table-bordered" style="width:100%; ">
                    <thead>
                        <tr>
                            <th class="d-none d-md-table-cell">NO</th>
                            <th>Name</th>
                            <th class="d-none d-md-table-cell">Members</th>
                            <th class="d-none d-md-table-cell">Buildings</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groups as $group)
                        <tr>
                            <td class="d-none d-md-table-cell">{{ $group->id}}</td>
                            <td class="text-truncate">{{$group->name}}</td>
                            <td class="text-truncate d-none d-md-table-cell">{{$group->users->count()}}</td>
                            <td class="text-truncate d-none d-md-table-cell">{{$group->buildings->count()}}</td>
                            <td>
                                 <div
                                    class="  table-actions d-flex align-items-center justify-content-evenly gap-3 fs-4">
                                    <a href="{{route('group.show',$group->id)}}" class="text-warning"
                                        title="show"><i class="bi bi-eye-fill"></i></i></a>
                                    <form method="POST" action="{{route('group.destroy',$group->id)}}">
                                        @method('delete')
                                        @csrf
                                        <input name="url" hidden value="{{$groups->currentPage()}}">
                                        <a href="#" style="color: red;" onclick="
                                     if(confirm('Are sure,You want delete this?')){
                                            event.preventDefault();
                                            this.closest('form').submit();
                                           }
                                            else{
                                            event.preventDefault();}"><i class="bi bi-trash-fill"></i></a>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="d-none d-md-table-cell" >NO</th>
                            <th>Name</th>
                            <th class="d-none d-md-table-cell">Members</th>
                            <th class="d-none d-md-table-cell">Buildings</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="d-flex align-items-center justify-content-end">
                {{ $groups->links() }}
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
        "info":false,
        "searching": false,
    });


</script>
@endsection
