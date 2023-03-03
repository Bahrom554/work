@extends('layouts.app')
@section('content')
<div class="card my-0 bg-transparent shadow-none">
    
  <div class="card-body row">
      {{-- bredcumb --}}
      @include('layouts.error')
    <div class="page-breadcrumb d-flex   mb-3  col-md-8 align-items-stretch  ">
           <div class="breadcrumb-title pe-3 ">
            <a href="{{ route('building.index') }}">Buildings</a>
           </div>
           <div class="breadcrumb-title pe-3 mx-2">
            <a href="{{ route('building.show',$apartment->building->id ?? '') }}">{{ $apartment->building->name ?? '' }}</a>
           </div>
          <div class="breadcrumb-title pe-3 mx-2">
            <a href="">{{$apartment->floor}}/{{ $apartment->apartment_number }}</a>
          </div>
         </div>
    <div class="col-md-4 d-md-flex align-items-stretch justify-content-end">
          @hasanyrole('manager|admin')
        <a href="" class="btn btn-primary mx-2">Complete Apartment</a>
        @else
        <a type="button" href="#addModal"  data-toggle="modal" class="btn btn-primary px-3 mx-1 ">Add workt</a>
        @endhasanyrole
    </div>
    <div class="my-3 border-top"></div>
    <!--end breadcrumb-->
  </div>
</div>
<div class="card my-0 ">
    <div class="card-body">
            <div class="table-responsive" id="for_search">
                <table id="example" class="table table-striped table-bordered" style="width:100%; ">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th >area</th>
                            <th >workers</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apartment->parts as $part )
                        <tr>
                           
                            <td >{{ $part->name}}/{{ $part->type}}</td>
                            <td >{{ $part->pivot->area }}</td>
                            <td>{{$part->workers}}</td>
                            <td>
                                 <div
                                    class="  table-actions d-flex align-items-center justify-content-evenly gap-3 fs-4">
                                     <a href="{{route('part.edit',$part->id)}}" class="text-warning"
                                        title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                    <form method="POST" action="{{ route('part.destroy',$part->id) }}">
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
                             </div>
                            </td>
                        </tr>   
                        @endforeach
                        
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th >Total: {{ $apartment->total }}</th>
                                <th ></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
            </div>
            <div class="d-flex align-items-center justify-content-end">
                
            </div>
        </div>
    </div>

{{-- modal --}}

<div class="modal fade" id="addModal" tabindex="-1" >
    <div class="modal-dialog">
        <form role="form" id="editform" action="{{route('pivot')}}"   method="POST">
            {{csrf_field()}}
      <div class="modal-content">
        <div class="d-flex justify-content-between px-3" style="border-bottom:1px solid #e5e5e5;">
            <h3 class="text-uppercase text-truncate">Create your work</h3>
            <button type="button" class="close" data-dismiss="modal" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
       <div class="modal-body row">
        <div class="mb-3">
            <label class="form-label" style="font-size:22px;" >Part</label>
            <select type="number" name="part_id" class="form-control" >
                @foreach($parts as $part)
                    <option value={{$part->id}}>{{$part->name}}/{{$part->type}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" style="font-size:22px;">area</label>
            <input type="number" name="area" class="form-control"  required>
        </div>
        <div class="mb-3">
            <label class="form-label" style="font-size:22px;">Workers</label>
            <select class="multiple-select" name="users[]" data-placeholder="Choose anything" multiple="multiple">
                @foreach($users as $user)
                <option value={{ $user->id}}>{{$user->name}}</option>
                @endforeach
            </select>
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
        "info":false,
        "searching": false,
    });


</script>
@endsection


