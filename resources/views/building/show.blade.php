@extends('layouts.app')
@section('content')
<div class="card bg-transparent shadow-none">
  <div class="card-body row">
      {{-- bredcumb --}}

      <div class="page-breadcrumb d-flex  align-items-center mb-3 col-md-8  ">
          <div class="breadcrumb-title pe-3 "><a href="{{ route('building.index') }}">Buildings</a></div>
          <div class="breadcrumb-title pe-3 mx-2"><a href="">{{ $building->name }}</a>
          </div>
        </div>
        <div class=" col-md-4 d-md-flex align-items-center justify-content-end">
          @hasanyrole('manager|admin')
        <a href="" class="btn btn-primary mx-2 ">Complete Building</a>
        @else
        <a type="button" href="#addModal"  data-toggle="modal" class="btn btn-primary px-3 mx-1 ">Add Apartment</a>
        @endhasanyrole
        </div>
        {{-- modal --}}

        <div class="modal fade" id="addModal" tabindex="-1" >
          <div class="modal-dialog">
              <form role="form" id="editform" action="{{route('apartment.store')}}"   method="POST">
                  {{csrf_field()}}
            <div class="modal-content">
              <div class="d-flex justify-content-between px-3" style="border-bottom:1px solid #e5e5e5;">
                  <h3 class="text-uppercase text-truncate">Add apartment</h3>
                  <button type="button" class="close" data-dismiss="modal" >
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
             <div class="modal-body">
                  <div class=" form-team">
                    <input type="hidden" name="building_id" value="{{ $building->id }}">
                      <label>Floor</label>
                      <input type="number" name="floor" class="form-control" value="{{old('floor') }}" required min=1>
                  </div>
                  <div class=" form-team">
                    <label>Apartment Number</label>
                    <input type="number" name="apartment_number" class="form-control" value="{{old('apartment_number') }}" required min=0>
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
        <!--end breadcrumb-->
    <div class="my-3 border-top"></div>
    <div class="row mx-auto ">
      @foreach ($building->apartments  as $apartment )
      <div class=" col-md-6 col-lg-3 ">
          <div class="card  bg-light" >
            <div class="card-header border-top">
                <h4 class=" d-flex justify-content-between align-items-center " >
                  floor:{{ $apartment->floor }} Aparmtent :{{ $apartment->apartment_number }}  <span class="badge bg-success rounded">{{ $apartment->badge }}</span>
                </h4>
                 </div>
                 
           
            
             <div class="card-footer d-flex justify-content-end">
                <a href="{{ route('apartment.show',$apartment->id) }}" class="btn btn-primary">Show</a>
                {{-- <a href="" class="btn btn-success mx-2">Finish</a> --}}
              <a href="{{ route('apartment.edit',$apartment->id) }}" class="btn btn-success mx-2">Edit</a>
                <form method="POST" action="{{route('apartment.destroy',$apartment->id)}}">
                  @method('delete')
                  @csrf
                  <a href="#" class="btn btn-danger"  onclick="
               if(confirm('Are sure,You want delete this?')){
                      event.preventDefault();
                      this.closest('form').submit();
                     }
                      else{
                      event.preventDefault();}">Delete</a>
              </form>
               </div>
          </div>
        </div> 
      @endforeach
      
         
        </div>
    </div>
</div>
@endsection

