<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        .form-check-label{
            padding-left: 15px !important;
        }
        body{
            margin: 0;
            padding: 0;
            background-image: url('{{ asset('css/images/ffff.jpg') }}');
            background-size: 100%;
            background-attachment: fixed;
        }
        ul{
            display: inline-block;
        }

        #basket_icon {
            width: 20px;
            height: 20px;
        }
        .navbar{
            border: none !important;
            padding: 5px 0;
            margin-bottom: 0 !important;
            border-radius: 0 !important;
        }
        .navbar .navbar-brand{
            color: white !important;
            font-size: 30px;
        }
        #basket_icon {
            width: 20px;
            height: 20px;
        }
        .dropdown-toggle {
            color: white !important;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Snow Shopping</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="/prod">Items</a></li>

            <li class="dropdown" id="change_admin1">
                @guest
                <a class='dropdown-toggle' data-toggle='dropdown' href='orders.blade.php'><img id='basket_icon' src='css/images/profile.png'><span class='caret'></span></a>
                <ul class='dropdown-menu'>
                    <li><a href='/login'>Sigh In</a></li>
                    <li><a href='/reg'>Sign Up</a></li>
                </ul>
                @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" style="color: black" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @if(Auth::user()->name == 'Admin' )
            <li class="nav-item dropdown">
                <a class='dropdown-toggle' data-toggle='dropdown' href='/orders' >ALL ORDERS</a>
            </li>
            @else
            <li class="nav-item dropdown">
                <a href='/basket'><img id='basket_icon' src='css/images/basket.png'></a>
            </li>
            @endif
            @endguest
            <li id="change_admin2">
                <?php if(isset($_COOKIE["admin"])) {
                    echo "<a class='dropdown-toggle' data-toggle='dropdown' href='empty.php' onclick='out()'>ADMIN</a>";
                }
                else{
                    echo "<a href='/basket'><img id='basket_icon' src='css/images/basket.png'></a>";
                } ?>
            </li>
        </ul>
    </div>
</nav>

<main class="py-4">
    @yield('content')
</main>
</body>
</html>
