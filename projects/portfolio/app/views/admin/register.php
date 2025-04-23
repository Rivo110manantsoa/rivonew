<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="<?=ASSETS?>front/css/style.css">
    <link rel="stylesheet" href="<?=ASSETS?>front/icons/css/all.min.css">
</head>
<body style="width:100%;">

    <!-- register section start-->
    <section class="form-container">
        <form action="" method="post">
            <?php if(isset($_SESSION['error'])): ?>
                <p style="color:red;font-size:12px"><?=$_SESSION['error']?></p>
            <?php endif;?>
            <h3>Registeration</h3>
            <p>your name <span>*</span></p>
            <input type="name" name="name" id="name" class="form-input">
            <p>your email <span>*</span></p>
            <input type="email" name="email" id="email" class="form-input">
            <p>your password <span>*</span></p>
            <input type="password" name="password" id="password" class="form-input"><br>
            <p>Confirm your password <span>*</span></p>
            <input type="password" name="password2" id="password2" class="form-input"><br>
            <input type="submit" value="Register" class="btn"><br>
            <p>Already have an account? click <a href="<?=ROOT?>login">here</a></p>
            <p>NB: <span>*</span> is required</p>
        </form>
     </section>
    <!-- register section end-->

   
   
    <!-- footer section starts -->
    <footer class="footer">
        &copy;copyright @2024 by <span>Asdon Soter</span> | All rights reserved
     </footer>
    <!-- footer section ends -->

    <script src="<?=ASSETS?>front/js/script.js"></script>
</body>
</html>