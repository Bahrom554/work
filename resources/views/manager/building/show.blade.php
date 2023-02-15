@extends('layouts.app')
@section('content')
<div class="card bg-transparent shadow-none">
  <div class="card-body row">
      {{-- bredcumb --}}

      <div class="page-breadcrumb d-flex  align-items-center mb-3  col-md-8  ">
          <div class="breadcrumb-title pe-3 "><a href="{{ route('building.index') }}">Buildings</a></div>
          <div class="breadcrumb-title pe-3 mx-2"><a href="">{{ $building->name }}</a></div>
        </div>
        <div class="col-md-4 d-flex align-items-center justify-content-end">
        <a href="" class="btn btn-primary mx-2 px-">Complete Building</a>
        </div>

       
        <!--end breadcrumb-->
    <div class="my-3 border-top"></div>
    <div class="row mx-auto ">
      @foreach ($building->apartments  as $apartment )
      <div class=" col-md-6 col-lg-3 ">
          <div class="card  bg-light" >
            <div class="card-header border-top">
                <h4 class=" d-flex justify-content-between align-items-center " >{{ $apartment->apartment_number }}<span class="badge bg-success rounded">{{ $apartment->badge }}</span>
                </h4>
                 </div>
            <div class="card-body ">
                <div class="row px-4">
                    <div class="col-5">
                    <h5></h5>
                    </div>
                    
                    <div class="col-7">
                       
                    </div>
                   
                   
                   
                </div>
            </div>
             <div class="card-footer d-flex justify-content-end">
                <a href="" class="btn btn-primary">Show</a>
                <a href="" class="btn btn-success mx-2">Complete</a>
               </div>
          </div>
        </div> 
      @endforeach
      
         
        </div>
    </div>
</div>
@endsection

