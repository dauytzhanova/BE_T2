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

$need_to_add=true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Snow Shopping</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/basket.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
                <?php if(isset($_COOKIE['user'])) {
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
            <li>
                <a href='basket.php'><img id='basket_icon' src='css/images/basket.png'></a>

            </li>
        </ul>
    </div>
</nav>
<section>
    <h3>Order Details</h3>
    <div class="table-responsive">
        <table id="table_fd" class="table table-bordered">
            <tr>
                <th width="50%">Item Name</th>
                <th width="5%">Count</th>
                <th width="15%">Price</th>
                <th width="15%">Total</th>
                <th width="15%">Action</th>
            </tr>
            <?php
            $totalsum=0;
            foreach($_SESSION['basket'] as $key => $val){
                $need_to_add=false;
                $query="SELECT * FROM `prod` WHERE `id`=".$key;
                $results = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($results)) {
                    echo "<tr id='row".$key."'>\n";
                    echo "<td>".$row['name']."</td>\n";
                    echo "<td class='count' id='count".$key."'>\n<input class='input_' id='".$key."' type='number' value=".$val."><button id='svb".$key."' hidden onclick='change(".$row['id'].")'></button>\n</td>\n";
                    echo "<td>".$row['price']."$</td>\n";
                    $total=$val*$row['price'];
                    $totalsum+=$total;
                    echo "<td>".$total."$</td>\n";
                    echo "<td class='text-danger' onclick='remove(".$row['id'].")'>Remove line</td>\n</tr>\n";
                }
            }
            if ($need_to_add){
                echo "<tr><td class='text-danger'>You didn't add anything to the cart</td><td>0</td><td>0</td><td>0</td><td>:)</td></tr>";
            }
            else{
                echo "<tr  id='right_td'><td  onclick='buy()'>Buy</td><td> </td><td></td><td>".$totalsum."$</td></tr>";
            }
            ?>
        </table>
    </div>
</section>
<?php include 'footer.php';?>
</body>
<script>
    function out() {
        document.cookie="user=; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
        change=document.getElementById("change_admin1");
        change.innerHTML="<a class='dropdown-toggle' data-toggle='dropdown' href='basket.php'><img id='basket_icon' src='css/images/profile.png'><span class='caret'></span></a>";
    }
    function remove(a) {
        // Здесь мы отправляем данные на сервер
        $.get("admin.php?remove="+a, { }, onAjaxSuccess );
    }
    function change(a) {
        let input=document.getElementById(a);
        var value = input.value;
        $.get("admin.php?idc="+a+"&change="+value, { }, onChangeSuccess );
    }

    $(function(){
        $('.input_').keypress(function(e){
            let index=this.id;
            if(e.keyCode==13)
                $('#svb'+index).click();
        });
    });
    function onAjaxSuccess(data) {
        // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
        let table = document.getElementById("table_fd");
        let tr=document.getElementById("row"+data);
        alert(data);
        tr.parentNode.removeChild(tr);
    }
    function onChangeSuccess(data) {
        // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
        alert("please update the page");
    }
    function onBuySuccess(data) {
        // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
        if(data=="buy1"){
            alert("YOU BUYing the products");
        }
        else if(data=="buy0"){
            alert("You need to loged in for buying smth");
            location.assign("http://localhost/ainurShopping/login.php");
        }
    }
    function buy() {
        // Здесь мы отправляем данные на сервер
        $.post("admin.php?buy=1", {}, onBuySuccess );
    }
</script>
</html>
