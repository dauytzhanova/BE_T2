<!DOCTYPE html>
<html lang="en">
<head>
    <title>Snow Shopping</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="js/products.js"></script>
    <script src="js/basket.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
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
            @endguest

            </li>
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
<section class="prod_sec">
<div class="section_products">

    <div class="cards">
        <?php
         foreach ($products as $product){
            echo "<div class = 'card'>";
            if($product->img== ''){
                if(isset($_COOKIE["admin"])) {
                    echo "<div id='add_img'>";
                    echo "<img id='item-img2' src='css/images/add.png' onclick='add_img()'>";
                    echo "</div>";
                }else{
                    echo "<img class='item-img' src='css/images/noprod.png' >";
                }
            }else{

                echo "<img class='item-img' src=$product->img>";
            }
            echo "<div class='item-desc'>";
            echo "<p style='color:grey;'>Originals</p>";
            echo "<h5 class='item-name'><a href='item.php?index=".$product->id."'>$product->Name</a></h5>";
            echo "<h6>$$product->price</h6>";
            if(!isset($_COOKIE["admin"])) {
                echo "<button class='item-button' onclick='addToBasket($product-id)'>Add to Cart</button>";
            }
            echo "</div>";
            if (isset($_COOKIE["admin"])) {
                echo "<form action='../../public/admin.php' method='post' class='del'>";
                echo "<input type='submit' class='del' value='X''>";
                echo "<input type='hidden' name='namedel' value='".$product->id."'></form>";
            }
            echo "</div>";
        }

        if(isset($_COOKIE["admin"])) {
            echo "<div class = 'card' id='add_product'>";
            echo "<label class='add_label'>ADD PRODUCT</label>";
            echo "<img  id='add_img1' src='css/images/add.png' onclick='add()'>";
            echo "</div>";
        }
        ?>
    </div>
</div>
</section>
</body>

<script>
    function out() {
        document.cookie="admin=; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
        document.cookie="user=; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
        change1=document.getElementById("change_admin1");
        change1.innerHTML="<a class='dropdown-toggle' data-toggle='dropdown' href='basket.php'><img id='basket_icon' src='css/images/profile.png'><span class='caret'></span></a>\n";
        change2=document.getElementById("change_admin2");
        change2.innerHTML="<a href='basket.php'><img id='basket_icon' src='css/images/basket.png'></a>";
    }
    function addToBasket(a) {
        // Здесь мы отправляем данные на сервер
        $.get("admin.php?basket="+a, { }, onAjaxSuccess );
    }
    function onAjaxSuccess(data) {
        // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
        alert(data);
    }
</script>
</html>
