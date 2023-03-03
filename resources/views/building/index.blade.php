@extends('layouts.app')
@section('content')
<div class="card bg-transparent shadow-none" >
    <div class="card-body row">
        {{-- bredcumb --}}

        <div class="page-breadcrumb   align-items-center mb-3 d-none d-md-flex col-md-6 col-lg-8 ">
            <div class="breadcrumb-title pe-3"><a href="{{ route('building.index') }}">Buildings</a></div>
            </div>
          <div class="col-md-6 col-lg-4 d-flex align-items-center">
            <form class="searchbar flex-grow-1">
              <input class="form-control" type="text" placeholder="Type here to search">
          </form>
          @hasanyrole('manager|admin')
          <a href="{{ route('building.create') }}" class="btn btn-primary mx-2 px-">Add Building</a>
          @endhasanyrole
          </div>
    </div>
      <div class="my-3 border-top"></div>
      <div class="row">
        @foreach ($buildings  as $building )
        <div class="col-lg-4 col-xl-3 d-lg-flex align-items-stretch">
            <div class="card  bg-light"  >
              <div class="card-header border-top">
                  <h4 class=" d-flex justify-content-between align-items-center text-truncate" >
                    {{ $building->name }}
                   @if($building->badge) <span class="badge bg-success rounded">{{ $building->badge }}</span>@endif
                  </h4>
                   </div>
              <div class="card-body ">
                   <div class="row px-2">
                      <div class="col-5">
                      <h5>Customer :</h5>
                      </div>
                      
                      <div class="col-7">
                         <h5>
                           <a href="@hasanyrole('manager|admin'){{ route('customer.show',$building->customer->id ?? '')}}
                            @endhasanyrole">{{ $building->customer->name ?? '' }}</a></h5>
                      </div>
                      <div class="col-5">
                          <h5> Grouups :</h5>
                      </div>
                      <div class="col-7">
                       <h5> @foreach ($building->team as $team )
                        <a href="@hasanyrole('manager|admin'){{ route('team.show',$team->id ?? '')}}@endhasanyrole">{{ $team->name ?? '' }}</a>,
                         
                       @endforeach</h5>
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
               <div class=" card-footer">
                <div class="d-flex justify-content-end">
                  <a href="{{ route('building.show',$building->id) }}" class="btn btn-success">show</a>
                  @hasanyrole('manager|admin')
                  <a href="{{ route('export.xlsx',$building->id) }}" class="btn btn-success mx-2">.xlsx</a>
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
                @endhasanyrole
               </div>
              </div>
            </div>
          </div> 
        @endforeach
        
           
          </div>
      </div>
</div>

       
@endsection
