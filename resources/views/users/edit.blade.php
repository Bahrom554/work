@extends('layouts.app')
@section('content')
    @include('layouts.error')
    <form method="POST" action="{{route('users.update',$user)}}">
        @method('PUT')
        @csrf
        <div class="row">
            <div style="font-size: 40px" class="col-3"><a href="{{route('users.index')}}"><i
                        class="bi bi-chevron-left"></i></a></div>
            <h2 class="col col-6" style="text-align: center">Edit User</h2>
            <div class="card border border-1 p-4 mt-4 offset-md-3 col-md-6">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" style="font-size:22px;">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="name" value="{{old('name', $user->name)}} " autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:22px;">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="name" value="{{old('email', $user->email)}} " required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:22px;">Password</label>
                        <input name="password" id="password" type="password" class="form-control" onkeyup='check();' />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:22px;">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password"  onkeyup='check();' />
                        <span id='message'></span>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button id="button" type="submit" class="btn btn-success py-3 px-5 ">Edit</button>
                    </div>
                </div>
            </div>

        </div>


    </form>

@endsection

@section('jscontent')
    <script>
        var check = function() {
            if (document.getElementById('password').value ==
                document.getElementById('confirm_password').value) {
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'matching';
                document.getElementById('button').disabled = false;


            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'not matching';
                document.getElementById('button').disabled = true;

            }
        }
    </script>
@endsection
