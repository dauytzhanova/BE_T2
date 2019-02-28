<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Snow Shopping</title>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet"  href="css/style.css">
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Snow Shopping</a>
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
                    {{ Auth::user()->name }} <span class="caret"></span>
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
            <li><a href="/orders">ALL ORDERS</a></li>
            @else
            <li class="nav-item dropdown">
            <a href='/basket'><img id='basket_icon' src='css/images/basket.png'></a>
            </li>
            @endif
                @endguest

            <li id="change_admin2">

            </li>
        </ul>
    </div>
</nav>

<section>
    <div class="container">
        <div class="section_info">
            <div id="info_block">
                <h1 id="info_title">GET YOUR FIRST SPORT EQUIPMENT FROM SNOW</h1>
                <h3>'Best shopping service 2019' Award</h3>
            </div>
            <div class="button black">
                <button id="start_shop_button"  onclick = "window.location.href='prod.php?gender=Female'">Start Shopping</button>
            </div>
        </div>
        <div class="section_carousel">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                    <li data-target="#myCarousel" data-slide-to="4"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="css/images/crsl3.jpg" >
                    </div>

                    <div class="item">
                        <img src="css/images/crsl2.jpg">
                    </div>

                    <div class="item">
                        <img src="css/images/crsl1.jpg">
                    </div>
                    <div class="item">
                        <img src="css/images/crsl4.jpg">
                    </div>
                    <div class="item">
                        <img src="css/images/crsl5.jpg">
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div class="section_products">
        <h1>WHAT'S TRENDING?</h1>
        <div class="cards">
            @foreach($prods as $prod)
            <div class = 'card'>
                <img class='item-img' src=' {{$prod->img}}' >
                <div class='item-desc'>
                    <p id='item_orig' style='color:grey;'>Originals</p>
                    <h5 class='item-name'><a href='#'>{{$prod->name}}</a></h5>
                    <h6>{{$prod->price}}</h6>
                    <button class='item-button' onclick='addToBasket( {{ $prod -> id }} )'>Add to Cart</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<footer class="footer-distributed">
    <div class="footer-left">
        <img src="css/images/top.png">
        <p class="footer-links">
            <a href="#">Home</a>
            ·
            <a href="#">Men</a>
            ·
            <a href="#">Women</a>
            ·
            <a href="#">Kids</a>
        </p>
        <p class="footer-company-name">Copyright &copy; 2019</p>
    </div>
    <div class="footer-center">
        <div>
            <p><span>21 Revolution Street</span> Almaty, Kazakhstan</p>
        </div>
        <div>
            <br>
            <p>+7 747 707 0077</p>
        </div>
        <div>
            <p><a href="mailto:support@company.com">support@company.com</a></p>
        </div>
    </div>
    <div class="footer-right">
        <p class="footer-company-about">
            <span>About the company</span>
        </p>
        <div class="footer-icons">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-github"></i></a>
        </div>
    </div>
</footer>
</body>
<script>
    function out() {  // changed
        document.cookie="admin=; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
        document.cookie="user=; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
        change1=document.getElementById("change_admin1");
        change1.innerHTML="<a class='dropdown-toggle' data-toggle='dropdown' href='basket.php'><img id='basket_icon' src='css/images/profile.png'><span class='caret'></span></a>";
        change2=document.getElementById("change_admin2");
        change2.innerHTML="<a href='basket.php'><img id='basket_icon' src='css/images/basket.png'></a>";
    }
    function addToBasket(a) {
        // Здесь мы отправляем данные на сервер
        $.get("/admin?basket="+a, { }, onAjaxSuccess );
    }

    function onAjaxSuccess(data) {
        // Здесь мы получаем данные, отправленные сервером и выводим их на экран
        alert(data);
    }
</script>
</html>
