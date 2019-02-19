<?php
$host = 'localhost';
$user='root';
$password = '';
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
            setcookie("user", $Name);
            
            header("Location:  empty.html");
            die();
        }
    }
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="script.js" defer></script>
  
    <script src="index.js" defer></script>
    <link rel="stylesheet" href="style.css">
</head>
<body >
<div class = "header_section">
    <div class = "headerlogo"><a href="#">Snow Universe </a></div>
    <div class = "headerButton"><a href = "#">Characters</a></div>
    <div class = "headerButton"><a href = "#">Comics</a></div>
    <div class = "headerButton"><a href = "#">Games</a></div>
    <div class = "headerButton"><a href = "#">Movies</a></div>
    <div class = "headerButton"><a href = "register.php">Register</a></div>
</div>

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
        <input id="name" type="text" name="Name" placeholder="Enter Username" class="user_field" required 
        <?php //не больше 15
        if (isset($Name)){
            echo "value='".$Name."'";
        }?>>
        <label><b>Password:</b></label>
        <input id="password" type="password" name="Password" placeholder="Enter Password" required>
        <button type="submit" id="signin">Login</button>

    </form></div>
</body>
</html>