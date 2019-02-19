<?php
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
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="js/basket.js" defer></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
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

<section class="item_sec">
<div class="item-card">
  <?php
        $query="SELECT * FROM `prod` LIMIT 1";
        $results = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($results)) {
            echo "<div class = 'item-card-left'>";
            echo "<img class='left-card-img' src='".$row["img"]."' >";
            echo "</div>";
            echo "<div class='item-card-right'>";
            echo "<h1 id='item-card-name'>".$row["name"]."</h1>";
            echo "<p id='item-card-orig' style='color:grey;'>Original Seria</p>";
            echo "<p id='pgph'>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>";
            echo "<h6 id='item-price'>$".$row["price"]."</h6>";
            if(!isset($_COOKIE["admin"])) {
                echo "<button class='item-button-cart' onclick='addToBasket(".$row['id'].")'>Add to Cart</button>";
            }
            echo "</div>";    
        }
            
        
        mysqli_close($conn);
        ?>
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