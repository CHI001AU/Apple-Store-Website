<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apple (Australia)</title>
    <link rel="stylesheet" href="assets/css/applestore.css">

    <link rel="shortcut icon" href="assets/img/favicon/android-chrome-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png">
    <link rel="shortcut icon" href="assets/img/favicon/favicon.ico" type="image/x-icon"/>


</head>
<body>

    <!-- Banner -->
    <!-- <div class="banner">
        <h1 class="banner-title"></h1>
    </div> -->
    <!-- Banner -->
<div class="banner">
    <a href="index.php?page=home">
        <img src="assets/img/apple-logo.png" class="banner-title" alt="Banner Image">
    </a>
</div>

    <!-- Site Header -->
    <header class="site-header">
        <div class="container">
            <h2>Apple Australia </h2>
            <p class="subtitle">Order the latest macbook and iphones today!</p>

            <!-- Navigation Bar -->
            <nav class="navbar">
                <ul class="nav-list">
                    <li><a href="index.php?page=home"             class="nav-link active">Home</a></li>
                        <div class="dropdown">
                        <a href="index.php?page=iphones" class="dropbtn">Iphone</a>
                        <div class="dropdown-content">
                            <a href="index.php?page=iphone17">Iphone 17</a>    
                            <a href="index.php?page=iphone17pro">Iphone 17 Pro</a>
                        </div>
                    </div>
                        <div class="dropdown">
                        <a href="index.php?page=applewatch" class="dropbtn">Apple Watch</a>
                        <div class="dropdown-content">
                            <a href="index.php?page=applewatchse">Se 3</a>
                            <a href="index.php?page=applewatch11">Series 11</a>
                            <a href="index.php?page=applewatchultra3">Ultra 3</a>
                        </div>  
                    </div>
                       <div class="dropdown">
                        <a href="index.php?page=macbooks" class="dropbtn">Macbook</a>
                        <div class="dropdown-content">
                            <a href="index.php?page=macbookneo">Macbook Neo</a>
                            <a href="index.php?page=macbookair">Macbook Air</a>
                            <a href="index.php?page=macbookpro">Macbook Pro</a>
                        </div>  
                    </div>     
                    <li><a href="index.php?page=accessories"     class="nav-link active">Accessories</a></li>
                <?php 
                IF (isset($_SESSION["user"])) {
                ?>
                    <li><a href="index.php?page=login&action=logout" class="nav-link active">Logout</a></li>
                    <li><a href="index.php?page=registration&action=register" class="nav-link active">User Maintenance
                    <?php
                    $user=unserialize($_SESSION["user"]); 
                    echo(" (");
                    echo($user->getUsername())."-";
                    echo($user->getFirstName())." ";
                    echo($user->getLastName());
                    echo(")");
                } else {
                ?>
                    <li><a href="index.php?page=login&action=login" class="nav-link active">Login</a></li>
                    <li><a href="index.php?page=registration&action=register" class="nav-link active">Register
                <?php
                    echo("(Not logged in)");
                } 
                ?>    
                     </a></li>
                </ul>
            </nav>
        </div>
    </header>
<main class="container"> 