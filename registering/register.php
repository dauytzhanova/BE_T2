<?php
$host = 'localhost';
$user='root';
$password = '';
$db = 'back';
$conn = mysqli_connect($host,$user,$password,$db);
$conn_error = mysqli_connect_error();
$query='SELECT * FROM `users`';
$results = mysqli_query($conn, $query);
$pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
$pattern_for_email = '/[\'\/~`\!#\$%\^&\*\(\)\-\+=\{\}\[\]\|;:"\<\>,\\?\\\]/';
$pattern_for_name = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
$username=filter_input(INPUT_POST,'username');
$Password=filter_input(INPUT_POST,'Password');
$ConfPassw=filter_input(INPUT_POST,'ConfPassw');
$email=filter_input(INPUT_POST,'email');
$Name=filter_input(INPUT_POST,'Name');
$isError = false;
$free=true;
$WP=false;

if (isset($Name)){
    /* проверяет не занято ли имя пользователя*/
    while ($row = mysqli_fetch_array($results)) {
        if ($row['username']==$username){
            $free=false;
            break;
        }
    }
    if(strlen($Password)>8 && preg_match("#[0-9]+#",$Password) && preg_match("#[a-zA-z]+#",$Password) && $Password==$ConfPassw){
        $WP=true;
    }
    if ($free && $WP){
        /* отправляет данные на дб*/
        $query="INSERT INTO `users` (`username`, `password`, `email`, `FullName`) VALUES ('".$username."', '".$Password."', '".$email."', '".$Name."');";
        $results = mysqli_query($conn, $query);
        header("Location: empty.html");
        die();
    }
}
if ($conn_error != null){
    echo "There is some connection error:<p>  $conn_error </p>";
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/script.js" defer></script>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<div class = "header_section">
    <div class = "headerlogo"><a href="#">Snow Universe </a></div>
    <div class = "headerButton"><a href = "#">Characters</a></div>
    <div class = "headerButton"><a href = "#">Comics</a></div>
    <div class = "headerButton"><a href = "#">Games</a></div>
    <div class = "headerButton"><a href = "#">Movies</a></div>
    <div class = "headerButton"><a href = "login.php">Log in</a></div>
</div>    
<form action = "register.php" method="post">
    <div class="container">
    <h1>Registering</h1>
  <?php
if (isset($Name)){
    echo "<div id='errors'>";
    
    if(!$free){
        /*выводит ошибку если  занято имя пользователя*/
        echo "<div class='error'>";
        echo "*The username ".$username." is already reserved!!!";
        echo "</div>" ;
        echo "<br>";
    }
    if(preg_match($pattern, $username)){
        echo "<div class='error'>";
        echo "*Username sholud not contain any kind of symbol";
        echo "</div>";
        echo "<br>";
    }
    if($Password!=$ConfPassw){
        echo "<div class='error'>";
        echo "*Password and Confirm password does not equal to each other";
        echo "</div>";
        echo "<br>";
    }

   elseif(strlen($Password)<8){
        echo "<div class='error'>";
        echo "*Password should be not less than 8 characters";
        echo "</div>";
        echo "<br>";
    }
    elseif(!preg_match("#[0-9]+#",$Password)||!preg_match("#[a-zA-z]+#",$Password)){
        echo "<div class='error'>";
        echo "*Password should have at least 1 number and 1 letter";
        echo "</div>";
        echo "<br>";
    }
    elseif(ctype_upper($Password) || ctype_lower($Password)){
        echo "<div class='error'>";
        echo "Password should include uppercase and lowercase letters";
        echo "</div>";
        echo "<br>";
    }
    if(preg_match($pattern_for_email, $email)){
        echo "<div class='error'>";
        echo "*Email sholud not contain any kind of symbol except: @ _ .";
        echo "</div>";
        echo "<br>";
    }
    if(preg_match($pattern_for_name,$Name)||preg_match("#[0-9]+#",$Name)){
        echo "<div class='error'>";
        echo "*Name sholud not contain any kind of symbol or numbers";
        echo "</div>";
        echo "<br>";
    }
    
    else{

    }

    echo "</div>";

}
mysqli_close($conn);
?>
        <label><b>Username:</b></label>
        <input type="text" name="username" placeholder="Enter Username" id="user_field" required <?php 
        if (isset($username)){
            echo "value='".$username."'";
        }
        ?>>
        <label><b>Password:</b></label>
        <input  type="password" name="Password" placeholder="At least 8 characters" class="password_field" required>
        <label><b>Confirm Password:</b></label>
        <input type="password" name="ConfPassw" placeholder="Check the password" class="password_field"  required>
        <label><b>e-mail:</b></label>
        <input type="text" name="email" placeholder="Enter e-mail" class="email_field" required <?php
        if (isset($email)){
            echo "value='$email'";
        }
        ?>>
        <label><b>Name:</b></label>
        <input type="text" name="Name" placeholder="Surname Name" class="name_field" required <?php
        if (isset($Name)){
            echo "value='".$Name."'";
        }
        ?>>
        <button type="submit" id="signin"">Enter</button>
    </form>
</div>


</body>
</html>
