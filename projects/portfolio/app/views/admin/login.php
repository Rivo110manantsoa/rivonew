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
            <h3>Sign in</h3>
            <p>your email <span>*</span></p>
            <input type="email" name="email" id="email" class="form-input">
            <p>your password <span>*</span></p>
            <input type="password" name="password" id="password" class="form-input"><br>
            <input type="submit" value="Sign in" class="btn"><br>
            <p>No account yet? click <a href="<?=ROOT?>register">here</a></p>
            <p>NB: <span>*</span> is required</p>
        </form>
     </section>
    <!-- register section end-->
    <script src="js/script.js"></script>
</body>
</html>