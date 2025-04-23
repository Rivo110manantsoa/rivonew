<?php $this->load_view("header",$data); ?>
    <!-- banner section start -->
     <section class="banner">
        <div class="sliders">
            <div class="slide">
                <img src="<?=ASSETS?>front/images/slider/slide-0.png" alt="">
               
            </div>
            
            <div class="slide">
                <img src="<?=ASSETS?>front/images/slider/slide-1.png" alt="">
               
            </div>
            <div class="slide">
                <img src="<?=ASSETS?>front/images/slider/slide-2.jpg" alt="">
               
            </div>
            <div class="slide">
                <img src="<?=ASSETS?>front/images/slider/slide-3.jpg" alt="">
               
            </div>
            <div class="slide">
                <img src="<?=ASSETS?>front/images/slider/slide-4.png" alt="">
               
            </div>

        </div>
        <div class="btn prev">&#10094;</div>
        <div class="btn next">&#10095;</div>
     </section>
    <!-- banner section end -->
    
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
    <!-- portfolio section start -->
    <section class="portfolio">
        <h1 class="heading">All projects</h1>
        <div class="box-container">
            <?php if(isset($rows) && is_array($rows)):?>
                <?php foreach($rows as $row):?>
                <div class="box">
                    <div class="developer">
                        <img src="<?=ASSETS?>front/images/project/profile.png" alt="">
                        <div>
                            <h3>Rivo Manantsoa</h3>
                            <span><?=date("D, jS F Y a",strtotime($row->date))?></span>
                        </div>
                    </div>
                    <img src="<?=ROOT?><?=$row->image1?>" alt="" class="thumb">
                    <h3 class="title"><?=$row->title?></h3>
                    <div class="flex-btn">
                        <a target="_blank" href="<?=$row->link?>" class="btn">Live (Demo)</a>
                        <a href="<?=ROOT?>home/details/<?=$row->id?>" class="btn">view project</a>
                    </div>
                </div>
            <?php endforeach;?>
            <?php endif;?>
        </div>
     </section>
    <!-- portfolio section end -->

<?php $this->load_view("footer",$data); ?>