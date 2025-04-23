<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$page?></title>
    <link rel="stylesheet" href="<?=ASSETS?>front/css/style.css">
    <link rel="stylesheet" href="<?=ASSETS?>front/icons/css/all.min.css">
    <script rel="stylesheet" href="<?=ASSETS?>front/js/sweetalert.min.js"></script>
</head>
<body>
    
    <!-- header section start-->
    <header class="header">
        <section class="flex">
            <a href="index.html" class="logo"><img src="<?=ASSETS?>front/images/project/logo.png" alt=""></a>
            <form class="form-search">
                <!-- <input disabled type="text" class="input-search" placeholder="search project..........">
                <button class="fa-solid fa-search"></button> -->
                <h1 class="headings" style="color: var(--main-color);font-size: 2rem;margin-bottom: 0;width: 100%;
                    border: 1px solid var(--main-color);padding:.2rem .5rem;border-radius: 5px;">
                    <marquee behavior="smooth" direction="left" style="cursor: pointer;">Call or whatsApp me on (+261)033 16 034 25 or email me using this email address herimandimbyrivo@gmail.com</marquee>
                </h1>
            </form>
            <div class="icons">
                <div id="menu-btn" class="fa-solid fa-bars"></div>
                <div id="search-btn" class="fa-solid fa-search"></div>
                <div id="user-btn" class="fa-solid fa-user"></div>
                <div id="switch-mode-btn" class="fa-solid fa-sun"></div>
            </div>
            <div class="profile">
                <img src="<?=ASSETS?>front/images/project/profile.png" alt="">
                <h3>Rivo Manantsoa</h3>
                <span>Full-Stack Developer</span>
                <a href="<?=ROOT?>home/contact" class="btn">Hire me</a>
                <div class="flex-btn">
                    <?php if(isset($_SESSION['user'])):?>
                        <a href="<?=ROOT?>login" class="option-btn">login</a>
                        <a href="<?=ROOT?>logout" class="option-btn">logout</a>
                    <?php endif;?>
                </div>
            </div>
        </section>
    </header>
    <!-- header section end -->

    <!-- sidebar section start -->
    <section class="sidebar">
        <div class="close-sidebar"><i class="fa-solid fa-times"></i></div>
        <div class="profile">
            <img src="<?=ASSETS?>front/images/project/profile.png" alt="">
            <h3>Rivo Manantsoa</h3>
            <span>Full Stack Developer</span>
            <a href="<?=ROOT?>home/contact" class="btn">hire me</a>
        </div>
        <nav class="navbar">
        <a href="<?=ROOT?>" class="<?=isset($page) && $page == 'Home' || $page == 'Portfolio|Details' ? 'active' : '';?>"><i class="fa-solid fa-home"></i> <span>home</span></a>
            <a href="<?=ROOT?>home/about" class="<?=isset($page) && $page == 'About' ? 'active' : '';?>"><i class="fa-solid fa-question"></i><span>about me</span></a>
            <a href="<?=ROOT?>home/contact" class="<?=isset($page) && $page == 'Contact' ? 'active' : '';?>"><i class="fa-solid fa-headset"></i><span>contact me</span></a>
            <a href="<?=ROOT?>home/portfolio" class="<?=isset($page) && $page == 'Portfolio' ? 'active' : '';?>"><i class="fa-solid fa-briefcase"></i><span>portfolio</span></a>
            <a href="<?=ROOT?>home/blog" class="<?=isset($page) && $page == 'Blog' ? 'active' : '';?>"><i class="fa-solid fa-chalkboard-user"></i><span>blog</span></a>
        </nav>
    </section>
    <!-- sidebar section end -->