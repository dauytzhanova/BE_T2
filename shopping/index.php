<?php
session_start();
$host = 'localhost';
$user='root';
$password = '';
$db = 'back';
$conn = mysqli_connect($host,$user,$password,$db);
$conn_error = mysqli_connect_error();

if($conn_error != null){
    echo "<p> We have a connection problem: " .$conn_error . "</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Snow Shopping</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Snow Shopping</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#">Home</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">MEN<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="prod.php?gender=Male">Customs</a></li>
                    <li><a href="prod.php?gender=Male">Shoes</a></li>
                    <li><a href="prod.php?gender=Male">Sport Equipment</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">WOMEN<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="prod.php?gender=Female">Customs</a></li>
                    <li><a href="prod.php?gender=Female">Shoes</a></li>
                    <li><a href="prod.php?gender=Female">Sport Equipment</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">KIDS<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="prod.php?gender=Kids">Customs</a></li>
                    <li><a href="prod.php?gender=Kids">Shoes</a></li>
                    <li><a href="prod.php?gender=Kids">Sport Equipment</a></li>
                </ul>
            </li>
            <li class="dropdown" id="change_admin1">
                <?php if(isset($_COOKIE['user'])||isset($_COOKIE['admin'])){
                    echo "<a class='dropdown-toggle' data-toggle='dropdown' href='#' onclick='out()'>LOG OUT</a>";
                }
                else{
                    echo "<a class='dropdown-toggle' data-toggle='dropdown' href='basket.php'><img id='basket_icon' src='css/images/profile.png'><span class='caret'></span></a>
                <ul class='dropdown-menu'>
                    <li><a href='login.php'>Sigh In</a></li>
                    <li><a href='register.php'>Sign Up</a></li>
                </ul>";
                } ?>

            </li>
            <li id="change_admin2">
                <?php if(isset($_COOKIE["admin"])) {
                    echo "<a class='dropdown-toggle' data-toggle='dropdown'  onclick='out()' >ADMIN</a>";
                }
                else{
                    echo "<a href='basket.php'><img id='basket_icon' src='css/images/basket.png'></a>";
                } ?>
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
            <?php
            $query="SELECT * FROM `prod` LIMIT 3";
            $results = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($results)) {
                echo "<div class = 'card'>";
                echo "<img class='item-img' src='".$row["img"]."' >";
                echo "<div class='item-desc'>";
                echo "<p id='item_orig' style='color:grey;'>Originals</p>";
                echo "<h5 class='item-name'><a href='item.php?index=".$row['id']."'>".$row["name"]."</a></h5>";
                echo "<h6>$".$row["price"]."</h6>";
                if(!isset($_COOKIE["admin"])) {
                    echo "<button class='item-button' onclick='addToBasket(".$row['id'].")'>Add to Cart</button>";
                }
                echo "</div>";
                echo "</div>";
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
</section>
<?php include 'footer.php';?>
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
        $.get("admin.php?basket="+a, { }, onAjaxSuccess );
    }

    function onAjaxSuccess(data) {
        // Здесь мы получаем данные, отправленные сервером и выводим их на экран
        alert(data);
    }
</script>
</html>
