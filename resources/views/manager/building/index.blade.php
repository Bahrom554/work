@extends('layouts.app')
@section('content')
<div class="card bg-transparent shadow-none">
    <div class="card-body row">
        {{-- bredcumb --}}

        <div class="page-breadcrumb   align-items-center mb-3 d-none d-md-flex col-md-6 col-lg-8 ">
            <div class="breadcrumb-title pe-3"><a href="{{ route('building.index') }}">Buildings</a></div>
            {{-- <div class="ps-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">fghfg</li>
                </ol>
              </nav>
            </div> --}}
          </div>
          <div class="col-md-6 col-lg-4 d-flex align-items-center">
            <form class="searchbar flex-grow-1">
              <input class="form-control" type="text" placeholder="Type here to search">
          </form>
          <a href="{{ route('building.create') }}" class="btn btn-primary mx-2 px-">Add Building</a>
          </div>

         
          <!--end breadcrumb-->
      <div class="my-3 border-top"></div>
      <div class="row mx-auto ">
        @foreach ($buildings  as $building )
        <div class=" col-md-6 col-lg-3 ">
            <div class="card  bg-light" >
              <div class="card-header border-top">
                  <h4 class=" d-flex justify-content-between align-items-center " >{{ $building->name }}
                   @if($building->badge) <span class="badge bg-success rounded">{{ $building->badge }}</span>@endif
                  </h4>
                   </div>
              <div class="card-body ">
                  <div class="row px-4">
                      <div class="col-5">
                      <h5>Customer :</h5>
                      </div>
                      
                      <div class="col-7">
                         <h5> <a href="{{ route('customer.show',$building->customer->id ?? '')}}">{{ $building->customer->name ?? '' }}</a></h5>
                      </div>
                      <div class="col-5">
                          <h5>Worker's Grouup :</h5>
                      </div>
                      <div class="col-7">
                       <h5> <a href="{{ route('group.show',$building->group->id ?? '')}}">{{ $building->group->name ?? '' }}</a></h5>
                      </div>
                      <div class="col-5">
                          <h5>floor :</h5>
                      </div>
                      <div class="col-7">
                              <h5>{{ $building->floor }}</h5>
                      </div>
                      <div class="col-5">
                          <h5>Cost :</h5>
                      </div>
                      <div class="col-7">
                              <h5>{{ $building->cost }}</h5>
                      </div>
                      <div class="col-5">
                          <h5>Status :</h5>
                      </div>
                      <div class="col-7">
                              <h5>{{ $building->status }}</h5>
                      </div>
                  </div>
              </div>
               <div class="card-footer d-flex justify-content-end">
                  <a href="{{ route('building.show',$building->id) }}" class="btn btn-primary">Show</a>
                  <a href="{{ route('building.edit',$building->id) }}" class="btn btn-success mx-2">Edit</a>
                  <form method="POST" action="{{route('building.destroy',$building->id)}}">
                    @method('delete')
                    @csrf
                    <input name="url" hidden value="{{$buildings->currentPage()}}">
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
