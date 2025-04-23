<?php $this->load_view("header",$data); ?>


     <!-- quick option section start -->
     <section class="quick-select">
        <h1 class="heading">quick options</h1>
        <div class="box-container">
            <div class="box">
                <h3 class="title">popular projects</h3>
                <div class="flex">
                    <div class="slide-0">
                        <a href="#"><i class="fa-solid fa-laptop-code"></i><span>web development</span></a>
                        <a href="#"><i class="fa-solid fa-cogs"></i><span>software development</span></a>
                        <a href="#"><i class="fa-solid fa-gamepad"></i><span>game development</span></a>
                        <a href="#"><i class="fa-solid fa-layer-group"></i><span>templating development</span></a>
                        <a href="#"><i class="fa-solid fa-paint-brush"></i><span>ui/ux development</span></a>
                        <a href="#"><i class="fa-solid fa-briefcase"></i><span>freelancing development</span></a>
                        <a href="#"><i class="fa-solid fa-bullhorn"></i><span>Digital development</span></a>
                        <a href="#"><i class="fa-solid fa-chalkboard-teacher"></i><span>Tutorials development</span></a>
                        <a href="#"><i class="fa-solid fa-atom"></i><span>AI development</span></a>
                    </div>
                </div>
            </div>
            <div class="box">
                <h3 class="title">popular technologies</h3>
                <div class="flex">
                    <div class="slide-1">
                        <a href="#"><i class="fab fa-html5"></i><span>HTML5</span></a>
                        <a href="#"><i class="fab fa-css3"></i><span>CSS3</span></a>
                        <a href="#"><i class="fab fa-js"></i><span>JavaScript</span></a>
                        <a href="#"><i class="fab fa-lpython"></i><span>Python</span></a>
                        <a href="#"><i class="fab fa-php"></i><span>PHP</span></a>
                        <a href="#"><i class="fab fa-bootstrap"></i><span>Bootstrap CSS</span></a>
                        <a href="#"><i class="fab fa-java"></i><span>Java</span></a>
                        <a href="#"><i class="fa-solid fa-database"></i><span>SQL</span></a>
                        <a href="#"><i class="fa-solid fa-laptop-code"></i><span>C/C++</span></a>
                        <a href="#"><i class="fab fa-node-js"></i><span>Node.js</span></a>
                        <a href="#"><i class="fab fa-react"></i><span>React.js</span></a>
                        <a href="#"><i class="fab fa-angular"></i><span>Angular.js</span></a>
                        <a href="#"><i class="fab fa-vuejs"></i><span>Vue.js</span></a>
                        <a href="#"><i class="fa-solid fa-layer-group"></i><span>Laravel</span></a>
                        <a href="#"><i class="fa-solid fa-puzzle-piece"></i><span>Symfony</span></a>
                        <a href="#"><i class="fa-solid fa-fire"></i><span>Codeigniter</span></a>
                    </div>
                </div>
            </div>
        </div>
     </section>
    <!-- quick option section end -->
     <!-- contact section start -->
      <section class="contact">
        <div class="row">
            <div class="image">
                <img src="<?=ASSETS?>front/images/project/contact-img.svg" alt="">
            </div>
            <?php if(!empty($_SESSION['success'])): ?>                    
                    <p id="success"><script>swal('Sending...','<?=$_SESSION['success']?>', 'success')</script></p> 
            <?php endif;?>
            
            <?php if(!empty($_SESSION['error'])): ?>                    
                <p id="error"><script>swal('Sending...','<?=$_SESSION['error']?>', 'error')</script></p> 
            <?php endif;?>

            <form action="" method="post">
                <h3 class="heading">get in touch</h3>
                <input type="text" maxlength="100" name="name" placeholder="Enter your name here" class="box">
                <input type="text" maxlength="100" name="subject" placeholder="Enter your subject here" class="box">
                <input type="email" maxlength="100" name="email" placeholder="Enter your email here" class="box">
                <input type="text" maxlength="100" name="phone" placeholder="Enter your phone number here" class="box">
                <textarea name="message" placeholder="Please enter your message here" class="box"></textarea>
                <button type="submit" class="inline-btn">Send message</button>
            </form>
        </div>
        <div class="box-container">
            <div class="box">
                <i class="fa-solid fa-phone"></i>
                <h3>phone number</h3>
                <a href="tel:+261331603425">+261331603425</a>
                <a href="tel:+261349364008">+261349364008</a>
            </div>
            
            <div class="box">
                <i class="fa-solid fa-envelope"></i>
                <h3>E-mail</h3>
                <a href="mailto:herimandimbyrivo@gmail.com">herimandimbyrivo@gmail.com</a>
            </div>
            <div class="box">
                <i class="fa-solid fa-map-marker-alt"></i>
                <h3>location</h3>
                <a href="#">lot Antsirabe, Vakinankaratra</a>
            </div>

        </div>
      </section>
     <!-- contact section end -->

<?php $this->load_view("footer",$data); ?>
