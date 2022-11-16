<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ACX Attendance System</title>
    <link rel="icon" href="../dist/img/logo-acx2.png" type="image/x-icon">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="{{ asset('js/calendar.js') }}" defer></script>
    <script src="{{ asset('js/tags.js') }}" defer></script>
    <script src="{{ asset('js/pagination.js') }}" defer></script>


    <!-- redirect a route after specific time using Jquery in laravel, NOT FORCING LOGGING OUT -->
    <script>
         setTimeout(function(){
            window.location.href = '/';
         }, 22619000);
      </script>


    <!-- AJAX SCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Montserrat:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    


    {{-- Summernote --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
</head>

<body>
    
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="../img/logo-acx.png" alt="" srcset="">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @guest
                        <a class="nav-logo" href="{{ url('/') }}">
                            <img src="../dist/img/logo-acx.png" alt="" srcset=""
                                style="padding: 10px 0px; width: 180px;">
                        </a>
                        @else
                        <a class="nav-logo" href="{{ url('/user/home') }}">
                            <img src="../dist/img/logo-acx.png" alt="" srcset=""
                                style="padding: 10px 0px; width: 180px;">
                        </a>
                        @endguest

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <a href="{{ route('admin.login') }}" class="layout__menu">Admin</a>
                        @else

                        <li class="nav-item dropdown">
                            <a id="navbar" class="nav-link" href="{{ route('user.home') }}" role="button"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                Time Tracker <span class="caret"></span>
                            </a>
                        </li>
                        
                        <li class="nav-item dropdown">
                            <a id="navbar" class="nav-link" href="{{ route('user.dashboard') }}" role="button"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                Dashboard <span class="caret"></span>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::User()->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item profile__overlay__cursor" href="{{ route('user.profile') }}" >Update Profile</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

    </div>
    
    <main class="">
        @yield('content')
    </main>

    
    <footer id="footer">
        <p class="m-0 p-3 text-center">©ACX Outsourcing Hub 2022. All Rights Reserved.</p>
    </footer>

    @yield('script')

</body>

<script>
$('#myModal').on('shown.bs.modal', function() {
    $('#myInput').trigger('focus')
})
</script>

</html>