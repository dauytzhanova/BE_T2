<?php
$host = 'localhost';
$user='root';
$password = 'root';
$db = 'back';
$conn = mysqli_connect($host,$user,$password,$db);
$conn_error = mysqli_connect_error();
if ($conn_error != null){
    echo "There is some connection error:<p>  $conn_error </p>";
}
$Name=filter_input(INPUT_POST,'Name');
$Password=filter_input(INPUT_POST,'Password');
$query="SELECT * FROM `users` ";
$results = mysqli_query($conn, $query);
if (isset($Name)) {
    while ($row = mysqli_fetch_array($results)) {
        if ($row['password'] == $Password && $row['username']==$Name) {
            if ($row['admin'] == 1) {
                setcookie("user", "", time() - 100);
                setcookie("admin", $Name);
            } else {
                setcookie("admin", "", time() - 100);
                setcookie("user", $Name);
            }
            header("Location:  index.php");
            die();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign in</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/styleLogin.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
</head>
<body >
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Snow Shopping</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="index.php"> HOME </a></li>
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
                    echo "<a class='dropdown-toggle' data-toggle='dropdown' href='orders.blade.php'><img id='basket_icon' src='css/images/profile.png'><span class='caret'></span></a>
                <ul class='dropdown-menu'>
                    <li><a href='/login'>Sigh In</a></li>
                    <li><a href='/reg'>Sign Up</a></li>
                </ul>";
                } ?>

            </li>
            <li id="change_admin2">
                <?php if(isset($_COOKIE["admin"])) {
                    echo "<a class='dropdown-toggle' data-toggle='dropdown' href='prod.php' onclick='out()'>ADMIN</a>";
                }
                else{
                    echo "<a href='basket.php'><img id='basket_icon' src='css/images/basket.png'></a>";
                } ?>
            </li>
        </ul>
    </div>
</nav>

<section class="login_sec">
    <div class="container">

        <form action = "login.php" method="post">

            <h1>Sign in</h1>
            <?php
            $thereis=false;
            if (isset($Name)) {
                echo "<div id='errors'>";
                while ($row = mysqli_fetch_array($results)) {
                    if($row['username']==$Name && $row['password']!=$Password){
                        $thereis=true;
                        echo "<div class='error'>";
                        echo "Wrong username or password!!!";
                        echo "</div>";
                        echo "<br>";
                        break;
                    }
                }
                if(!$thereis) {
                    echo "<div class='error'>";
                    echo "Wrong username or password!!!";
                    echo "</div>";
                    echo "<br>";
                }
                echo "</div>";
            }
            mysqli_close($conn);
            ?>
            <label><b>Username:</b></label>
            <input id="name" type="text" name="Name" placeholder="Enter Username" class="user_field" required <?php //не больше 15
            if (isset($Name)){
                echo "value='".$Name."'";
            }?>>
            <label><b>Password:</b></label>
            <input id="password" type="password" name="Password" placeholder="Enter Password" required>
            <button type="submit" id="signin" ><a href="index.php">Login</a></button>

        </form></div>
</section>
</body>
<?php include 'footer.php';?>
</html>
