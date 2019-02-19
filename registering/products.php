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

<html>
<head>
    <meta charset = "UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="products.css">
</head>
<body>
<header>
<div class = "header_section">
    <div class = "headerlogo"><a href="#">Snow Universe </a></div>
    <div class = "headerButton"><a href = "products.php">Products</a></div>
    <div class = "headerButton"><a href = "#">Comics</a></div>
    <div class = "headerButton"><a href = "#">Games</a></div>
    <div class = "headerButton"><a href = "#">Movies</a></div>
    <div class = "headerButton"><a href = "login.php">Log in</a></div>
</div>
</header>
<div class = "flex_parent">
    <div class="grid_parent">
        <?php/*
        $query="SELECT * FROM `products`";
        $results = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($results)) {
            echo "<div class = 'item'>";
            echo "<img src='".$row[img]."' >";
            echo $row[name]."<br>Size: ".$row[size]."<br>Balance: ".$row[balance]."<br>Price: ".$row[price]."$";
            echo "<img  class=\"icon\" src=\"https://image.flaticon.com/icons/png/512/2/2772.png\"></a>";
            echo "</div>";
        }
        mysqli_close($conn);
        */?>




    </div>
</div>
</body>
<footer>
    <p>©2018 SNOW-UNIVERSE </p>
</footer>
</html>