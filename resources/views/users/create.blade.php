@extends('layouts.app')
@section('content')
    @include('layouts.error')
    <form method="POST" action="{{route('user.store')}}">
        @csrf
        <div class="row">
            <div style="font-size: 40px" class="col-3"><a href="{{route('user.index')}}"><i
                        class="bi bi-chevron-left"></i></a></div>
            <h2 class="col col-6" style="text-align: center">Add User</h2>
            <div class="card border border-1 p-4 mt-4 offset-md-3 col-md-6">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" style="font-size:22px;">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="name" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:22px;">Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="phone"  required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:22px;">Team</label>
                        <select type="text" name="team_id" class="form-control" >
                            <option value=Null><option>
                            @foreach($teams as $team)
                                <option value="{{$team->id}}">{{$team->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:22px;">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="email"  required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:22px;">Password</label>
                        <input name="password" id="password" type="password" placeholder=" password" class="form-control" onkeyup='check();' />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:22px;">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="confirm password" id="confirm_password"  onkeyup='check();' />
                        <span id='message'></span>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button id="button" type="submit" class="btn btn-success py-3 px-5 " >Create</button>
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
