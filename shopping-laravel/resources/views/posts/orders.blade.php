<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Snow Shopping</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/basket.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
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
<section>
    <h3>User Orders</h3>
    <div class="table-responsive">
        <table id="table_fd" class="table table-bordered">
            <tr>
                <th width="50%">Items Names</th>
                <th width="5%">User id</th>
                <th width="15%">User name</th>
                <th width="15%">Total sum</th>
                <th width="15%">Time</th>
            </tr>
            @foreach($orders as $order)
            <tr>
                <td ><?php echo DB::table('products')->find($order['prod_id'])->name; ?></td>
                <td ><?php echo DB::table('users')->find($order['user_id'])->id; ?></td>
                <td ><?php echo DB::table('users')->find($order['user_id'])->name; ?></td>
                <td >{{$order->total_sum}}</td>
                <td >{{$order->updated_at}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</section>
</body>
</html>
