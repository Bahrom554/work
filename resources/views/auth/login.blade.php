
<!doctype html>
<html lang="en" class="semi-dark">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{asset('admin/images/favicon-32x32.png')}}" type="image/png" />
  <!-- Bootstrap CSS -->
  <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('admin/css/bootstrap-extended.css')}}" rel="stylesheet" />
  <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" />
  <link href="{{asset('admin/css/icons.css')}}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- loader-->
	<link href="{{asset('admin/css/pace.min.css')}}" rel="stylesheet" />

  <title></title>
</head>

<body class="bg-login">

  <!--start wrapper-->
  <div class="wrapper">
    
       <!--start content-->
       <main class="authentication-content mt-5">
        <div class="container-fluid">
         <div class="row">
          <div class="col-12 col-lg-4 mx-auto">
            <div class="card shadow rounded-5 overflow-hidden">
                  <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title">Sign In</h5>
                    <p class="card-text">See your growth and get consulting support!</p>
                    <form class="form-body" method="POST" action="{{ route('login') }}">
                      @csrf
                     
                      <div class="login-separater text-center mb-4"> <span> SIGN IN WITH EMAIL</span>
                        <hr>
                      </div>
                        <div class="row g-3">
                          <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                            <div class="ms-auto position-relative">
                              <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus  placeholder="Email Address">
                              @if ($errors->has('email'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                            </div>
                          </div>
                          <div class="col-12">
                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                            <div class="ms-auto position-relative">
                              <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required  id="inputChoosePassword" placeholder="Enter Password">
                              <i class="bi bi-eye-fill" id="iconcadur" style=" position: absolute; z-index: 100; top:50%; right: 30px; transform: translateY(-50%);   cursor: pointer;"></i>
                              @if ($errors->has('password'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                            </div>
                          </div>
                         
                          <div class="col-12 mt-5">
                            <div class="d-grid">
                              <button type="submit" class="btn btn-primary px-5 ml-auto d-block">
                                {{ __('Login') }}
                            </button>
                            </div>
                          </div>
                        </div>
                    </form>
                 </div>
            </div>
          </div>
        </div>
        </div>
       </main>
        
       <!--end page main-->

  </div>
  <!--end wrapper-->





</body>
<script>
  const togglePassword = document.querySelector('#iconcadur');
  const password = document.querySelector('#inputChoosePassword');

  togglePassword.addEventListener('click', function (e) {
      // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // toggle the eye slash icon
      togglePassword.classList.toggle('bi-eye-slash-fill');
  });
</script>
</html>
                           
                        