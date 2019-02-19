<?php
error_reporting(0);
$host = 'localhost';
$user='root';
$password = '';
$db = 'back';
$conn = mysqli_connect($host,$user,$password,$db);
$conn_error = mysqli_connect_error();
        
if($conn_error != null){
    echo "<p> We have a connection problem: " .$conn_error . "</p>";
}
if(isset($_GET['remember'])){
    echo '<script>';
    echo 'alert("dont forget to add an image ")';
    echo '</script>';
}
if(isset($_GET['update'])){
    echo '<script>';
    echo 'alert("please update the page")';
    echo '</script>';
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
            <li class="active"><a href="index.php">Home</a></li>
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
                    echo "<a class='dropdown-toggle' data-toggle='dropdown' onclick='out()'>ADMIN</a>";
                }
                else{
                    echo "<a href='basket.php'><img id='basket_icon' src='css/images/basket.png'></a>";
                } ?>
            </li>
        </ul>
    </div>
</nav>

<section class="prod_sec">
<div class="section_products">
    <?php $selected = $_GET["gender"];
    if($selected=='Male'){
        echo "<h1> Men's Wear <h1>";
    }else if($selected=='Female'){
        echo "<h1> Women's Wear <h1>";
    }else{
        echo "<h1> Kid's Wear <h1>";
    }
    ?>
    <div class="cards">
        <?php
        $selected = $_GET["gender"];
        $query="SELECT * FROM `prod` WHERE gender='$selected'";
        $results = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($results)) {
            echo "<div class = 'card'>";
            if($row['img']== ''){
                if(isset($_COOKIE["admin"])) {
                    echo "<div id='add_img'>";
                    echo "<img id='item-img2' src='css/images/add.png' onclick='add_img()'>";
                    echo "</div>";
                }else{
                    echo "<img class='item-img' src='css/images/noprod.png' >";
                }
            }else{

                echo "<img class='item-img' src='".$row["img"]."'' >";
            }
            echo "<div class='item-desc'>";
            echo "<p style='color:grey;'>Originals</p>";
            echo "<h5 class='item-name'><a href='item.php?index=".$row['id']."'>".$row["name"]."</a></h5>";
            echo "<h6>$".$row["price"]."</h6>";
            if(!isset($_COOKIE["admin"])) {
                echo "<button class='item-button' onclick='addToBasket(".$row['id'].")'>Add to Cart</button>";
            }
            echo "</div>";
            if (isset($_COOKIE["admin"])) {
                echo "<form action='admin.php' method='post' class='del'>";
                echo "<input type='submit' class='del' value='X''>";
                echo "<input type='hidden' name='namedel' value='".$row['id']."'></form>";
            }
            echo "</div>";
        }
        if(isset($_COOKIE["admin"])) {
            echo "<div class = 'card' id='add_product'>";
            echo "<label class='add_label'>ADD PRODUCT</label>";
            echo "<img  id='add_img1' src='css/images/add.png' onclick='add()'>";
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
