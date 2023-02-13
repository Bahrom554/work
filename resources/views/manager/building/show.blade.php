@extends('layouts.app')
@section('content')
<div  class=" mt-2">
    
    <div class="card ">
        @include('layouts.message')
       
        <div class="d-flex align-items-center justify-content-between ">
            <a href="{{route('group.index')}}" style="font-size:30px" class="d-block pr-4 "><i
                class="bi bi-chevron-left"></i></a>
            <h2 class="text-uppercase text-truncate ml-4 ">{{ $group->name }}</h2>
           <div class="d-none d-md-flex">
            <a type="button" href="#editModal"  data-toggle="modal" class="btn btn-primary px-3 mx-1 ">Edit Name</a>
            <a  type="button" href="#addModal"  data-toggle="modal" class="btn btn-primary px-3 mx-1 ">Add Member</a>
        </div>
        </div>
        <div class="d-md-none">
            <a type="button" href="#editModal"  data-toggle="modal" class="btn btn-primary px-3 my-1 d-block ">Edit Name</a>
            <a  type="button" href="#addModal"  data-toggle="modal" class="btn btn-primary px-3 my-1  d-block">Add Member</a>
        </div>
         <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" >
    <div class="modal-dialog">
        <form role="form" id="editform" action="{{route('group.update',$group)}}"   method="POST">
            {{csrf_field()}}
            {{method_field('PUT')}}
      <div class="modal-content">
        <div class="d-flex justify-content-between px-3" style="border-bottom:1px solid #e5e5e5;">
            <h3 class="text-uppercase text-truncate">{{ $group->name }}</h3>
            <button type="button" class="close" data-dismiss="modal" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
       <div class="modal-body">
            <div class=" form-group">
                <label>Create new name</label>
                <input type="text" name="name" class="form-control" value="{{old('name',$group->name) }}" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
        </form>
    </div>
  </div>
  <div class="modal fade" id="addModal" tabindex="-1" >
    <div class="modal-dialog">
        <form role="form" id="editform" action="{{route('group.update',$group)}}"   method="POST">
            {{csrf_field()}}
            {{method_field('PUT')}}
      <div class="modal-content">
        <div class="d-flex justify-content-between px-3" style="border-bottom:1px solid #e5e5e5;">
            <h3 class="text-uppercase text-truncate">{{ $group->name }}</h3>
            <button type="button" class="close" data-dismiss="modal" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
       <div class="modal-body">
            <div class=" form-group">
               
                <label class="form-label" style="font-size:22px;">Add members</label>
                    <select class="multiple-select" name="users[]" data-placeholder="Choose anything" multiple="multiple">
                        @foreach($users as $user)
                        <option value="{{ $user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
        </form>
    </div>
  </div>
    </div>
    <div class="card mx-2 px-2">
        <div class="row">
            <div class="my-2 col-lg-6">
                <div class="accordion" id="paymentdad">
                    <div class="accordion-item" >
                        <button class="accordion-button font-14" type="button" data-toggle="collapse"
                                data-target="#users">
                            Members 
                        </button>
                        <div id="users" class="collapse" aria-labelledby="headingOne" data-bs-parent="#paymentdad">
                            <div class="accordion-body" >
                                <div class="table-responsive" style="overflow-y: scroll; max-height: 400px">
                                    <table  class="table table-striped table-bordered example"  style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Name</th>
                                            <th >phone</th>
                                            <th>Delete from group</th>
                                        </tr>
                                        </thead>
                                        <tbody id="table_body">
                                         @foreach ($group->users as $user )
                                            <tr> 
                                          <td>{{ $loop->index}}</td>
                                          <td><a href="{{ route('user.show',$user) }}">{{ $user->name }}</a></td>
                                         <td>{{ $user->phone }}</td>
                                              <td class="text-center">
                                                    <form method="POST" action="{{route('remove_from_group',$user)}}">
                                                        <input class="d-none" name="group_id" value="{{ $group->id}}">
                                                        @method('PUT')
                                                        @csrf
                                                        <a href="#" style="color: red;" onclick="
                                     if(confirm('{{$user->name}}  delete from group')){
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
                                    
                                    </table>

                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="mx-3">All:</h5>
                                    <h5 class="mx-3">{{$group->users->count()}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" my-2 col-lg-6">
                <div class="accordion" id="buildingid">
                    <div class="accordion-item" >
                        <button class="accordion-button font-14" type="button" data-toggle="collapse"
                                data-target="#building">
                           Buildings
                        </button>
                        <div id="building" class="collapse" aria-labelledby="headingOne" data-bs-parent="#servicdad">
                            <div class="accordion-body">
                                <div class="table-responsive" style=" overflow-y: scroll; max-height: 400px">
                                    <table  class="table table-striped table-bordered example"  style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th >Status</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody id="table_body">
                                        @foreach($group->buildings as $building)
                                            <tr id="tr">
                                                <td>{{$loop->index}}</td>
                                                <td ><a href="{{ route('building.show',$building) }}">{{ $building->name }}</a></td>
                                                <td>{{ $building->updated_at}}</td>
                                                <td >{{$building->status}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

