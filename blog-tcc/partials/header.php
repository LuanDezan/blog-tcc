<?php
require 'config/database.php';

// fetch current user from database
if(isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($result);
}
?>


<!DOCTYPE html>
<html lang="pt-br">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Levup</title>
    <!-- CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    <!-- ICONSCOUT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- GOOGLE FONT (MONTSERRAT) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?= ROOT_URL ?>favicon.png" type="image/x-icon">
</head>
<body>
    <nav>
        <div class="container nav__container">
            <a href="<?= ROOT_URL ?>" class="nav__logo">
            <i>
                <svg version="1.1" viewBox="0 0 312.88 338.41" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                    <linearGradient id="g2"><stop stop-color="#7100c7" offset=".054568"/><stop stop-color="#e0a0ff" offset=".92123"/></linearGradient>
                    <linearGradient id="g1" x1="616.25" x2="464.57" y1="-57.655" y2="-209.34" gradientTransform="matrix(.70909 .70909 -.70909 .70909 -777.38 19.597)" gradientUnits="userSpaceOnUse" xlink:href="#g2"/>
                    </defs>
                    <g transform="translate(459.46 -118.51)" fill-rule="evenodd">
                    <rect transform="rotate(45)" x="-111.7" y="316.84" width="220.53" height="220.53" stop-color="#000000"/>
                    <path d="m-149.06 274.95-146.03 146.05 1.2838-106.96-42.216-42.472 53.619-130.09z" fill="url(#g1)" stop-color="#000000" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.941"/>
                    <path d="m-356.44 276.41 47.637 47.637-0.1528 98.937-148.04-148.04 153.97-153.97 9.2298 9.4978z" fill="url(#g1)" stop-color="#000000" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.941"/>
                    </g>
                </svg>
            </i>
            <p>Levup</p>
            </a>
            <ul class="nav__items">
                <li><a href="<?= ROOT_URL ?>blog.php">Blog</a></li>
                <li><a href="<?= ROOT_URL ?>about.php">Sobre</a></li>
                <li><a href="<?= ROOT_URL ?>contact.php">Contatos</a></li>
                <?php if(isset($_SESSION['user-id'])): ?>
                    <li class="nav__profile">              
                    <div class="avatar">
                        <img src="<?= ROOT_URL . 'images/' . $avatar['avatar'] ?>">
                    </div>
                    <ul class="nav__panel">
                        <?php if (isset($_SESSION['user_is_admin']) || isset($_SESSION['user_is_author'])) : ?>
                        <li><a href="<?= ROOT_URL ?>admin/index.php">Painel</a></li>
                        <?php endif ?>
                        <li><a href="<?= ROOT_URL ?>admin/perfil.php">Perfil</a></li>
                        <li><a href="<?= ROOT_URL ?>logout.php">Deslogar</a></li>
                    </ul>
                </li>
                <?php else : ?>
                <li><a href="<?= ROOT_URL ?>signin.php">Login</a></li>
               <?php endif ?>
            </ul>
            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>
    <!--================================= END OF NAV ==============================-->
