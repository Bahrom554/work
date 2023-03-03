@extends('layouts.app')
@section('content')
<div class="page-breadcrumb   align-items-center mb-3 d-flex ">
    <div class="breadcrumb-title pe-3"><a href="{{ route('building.index') }}">Buildings</a></div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
         <li class="breadcrumb-item active" aria-current="page">Edit Building</li>
        </ol>
      </nav>
  </div>
</div>
<div class="my-3 border-top"></div>
  @include('layouts.error')

<form method="POST" action="{{route('building.update',$building->id)}}">
    @method('PUT')
    @csrf
    <div class="row">
        <h2  style="text-align: center">Edit Building</h2>
        <div class="card border border-1 p-4 mt-4 offset-md-3 col-md-6">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label" style="font-size:22px;">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="name" value="{{ old('name') ?? $building->name  }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-size:22px;">Floor</label>
                    <input type="number" class="form-control" name="floor" required value="{{ old('floor') ?? $building->floor }}">
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-size:22px;">Cost</label>
                    <input type="number" class="form-control" name="cost" value="{{ old('cost') ?? $building->cost }}">
                </div>
                <div class="mb-2">
                    <label class="form-label" style="font-size:22px;">Teams</label>
                    <select class="multiple-select" name="teams[]" data-placeholder="Choose anything" multiple="multiple">
                        @foreach($teams as $team)
                            <option value="{{$team->id}}" @if($building->teams && in_array($team->id,$building->teams )) selected @endif>{{$team->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label for="exampleDataList" class="form-label">Customer</label>
                    <input class="form-control" list="datalistOptions" id="exampleDataList" value="{{old('customer') ?? $building->customer->name}}" name="customer"
                           placeholder="Type to search..." required>
                    <datalist id="datalistOptions">
                        @foreach($customers as $customer)
                            <option value="{{$customer->name}}"></option>
                        @endforeach
                    </datalist>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success py-3 px-5 ">Update</button>
                </div>
            </div>
        </div>

    </div>


</form>

@endsection
