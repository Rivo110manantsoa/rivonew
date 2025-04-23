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
    <!-- details section start -->
     <section class="details-container">
        <h1 class="heading">project details : <?=$row->title?></h1>
        <div class="box-container">
            <div class="box">
                <div class="large-box">
                    <img src="<?=ROOT?><?=$row->image1?>" alt="" class="largeImage" id="largeImage">
                </div>
                <div class="small-box">
                    <img src="<?=ROOT?><?=$row->image1?>" alt="" class="smallImage">
                    <img src="<?=ROOT?><?=$row->image2?>" alt="" class="smallImage">
                    <img src="<?=ROOT?><?=$row->image3?>" alt="" class="smallImage">
                    <img src="<?=ROOT?><?=$row->image4?>" alt="" class="smallImage">
                    <img src="<?=ROOT?><?=$row->image5?>" alt="" class="smallImage">
                </div>
            </div>
            <div class="box">
                <div class="flex-btn">
                    <a href="<?=ROOT?>home/portfolio" class="option-btn"><i class="fa-solid fa-arrow-circle-left"></i> back</a>
                </div>
                <div class="divider"></div>
                <div class="descriptions">
                    <p><?=$row->description?></p>                    
                </div>
            </div>
        </div>
     </section>
    <!-- details section end -->
     <!-- client section start -->
      <section class="clients">
        <h1 class="heading">Client writing</h1>
        <div class="box-container">
            <div class="box">
                <?php if(!empty($_SESSION['success'])): ?>                    
                    <p id="success"><script>swal('Sending...','<?=$_SESSION['success']?>', 'success')</script></p> 
                <?php endif;?>
                
                <?php if(!empty($_SESSION['error'])): ?>                    
                    <p id="error"><script>swal('Sending...','<?=$_SESSION['error']?>', 'error')</script></p> 
                <?php endif;?>

                <form action="" method="post">
                    <h3 class="heading">Comment this project</h3>
                    <input type="hidden" name="portfolio_id" class="box-input" value="<?=$row->id?>">
                    <input type="text" name="name" maxlength="100" placeholder="Enter your name here" class="box-input">
                    <textarea name="message" placeholder="Please enter your message here" class="box-input"></textarea>
                    <button class="inline-btn">Post your comment</button>
                </form>

            </div>
            <div class="box">
                <h1 class="heading">Client's reviews</h1>
                <div class="box-flex">
                <?php if(!empty($comments) && is_array($comments)): ?>
                    <?php foreach ($comments as $comment) : ?>
                    <div class="user">
                        <div class="flex-user-des">
                            <img src="<?=ROOT?><?=$comment->image1?>" alt="">
                            <div>
                                <h3><?=$comment->name?></h3>
                                <div class="stars">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <p><?=$comment->message?></p>
                    </div>
                    <?php endforeach;?>
                <?php else:?>
                    <p style="color:red;">Comments not found for this moment.</p>
                <?php endif;?>
                    
                </div>
            </div>
        </div>
      </section>
     <!-- client section end -->
     <!-- footer section start -->
<?php $this->load_view("footer",$data); ?>
