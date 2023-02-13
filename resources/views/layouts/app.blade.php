<!doctype html>
<html lang="en" class="semi-dark">

@include('layouts.head')

<body>


    <!--start wrapper-->
    <div class="wrapper  ">
        <!--start top header-->
        @include('layouts.header')
        <!--end top header-->
        <!--start sidebar -->
        @include('layouts.sidebar')
        <!--end sidebar -->
        <main class="page-content" id="table">
            @yield('content')
        </main>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap bundle JS -->
    @include('layouts.footer')

</body>

</html>
