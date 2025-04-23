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

    <!-- about section start -->
     <section class="about">
        <div class="row">
            <div class="image">
            <img src="<?=ASSETS?>front/images/project/profile.png" alt="">
            </div>
            <div class="content">
                <h3 class="heading">why choose me?</h3>
                <?php if(isset($rows) && is_array($rows)): ?>
                <?php foreach($rows as $about): ?>
                    <p><?=$about->texts?></p>
                <?php endforeach;?>
                <?php endif;?>
                
                <a href="<?=ROOT?>home/contact" class="inline-option-btn">Contact me</a>
            </div>
        </div>
        <h1 class="heading">Educations</h1>
        <div class="box-container">
            <div class="box">
                <i class="fa-solid fa-user-graduate"></i>
                <div>
                    <h3>BACHELOR IN Sciences Technology</h3>
                    <span>HECMMA UNIVERSITY - Antsirabe</span>
                    <small>2008</small>
                </div>
            </div>
            
            <div class="box">
                <i class="fa-solid fa-user-graduate"></i>
                <div>
                    <h3>DTS IN Sciences Technology</h3>
                    <span>HECMMA UNIVERSITY - Antsirabe</span>
                    <small>2006</small>
                </div>
            </div>

            <div class="box">
                <i class="fa-solid fa-user-graduate"></i>
                <div>
                    <h3>BACC D</h3>
                    <span>LYCEE - Antsirabe</span>
                    <small>2004</small>
                </div>
            </div>

        </div>
        
        <h1 class="heading">Experiences</h1>
        <div class="box-container">

            <div class="box">
                <i class="fa-solid fa-chalkboard-teacher"></i>
                <div>
                    <h3>DEVELOPER FULL-STACK</h3>
                    <span>FREELANCE<br></span>
                    <small>2024</small>
                </div>
            </div>   

            <div class="box">
                <i class="fa-solid fa-chalkboard-teacher"></i>
                <div>
                    <h3>Computer scientist</h3>
                    <span>CECAM - MADAGASCAR</span>
                    <small>2018 - 2022</small>
                </div>
            </div>          

            <div class="box">
                <i class="fa-solid fa-chalkboard-teacher"></i>
                <div>
                    <h3>ARCHITECT/AUTOCAD</h3>
                    <span>COLAS - MADAGASCAR<br></span>
                    <small>2012</small>
                </div>
            </div>           
                   
             
          
        </div>

        <h1 class="heading">Skills</h1>
        <div class="box-container">
            <div class="box">
                <i class="fa-solid fa-code"></i>
                <div>
                    <h3>HTML & CSS</h3>
                    <span>2+ ans d'expérience</span>
                </div>
            </div>
            <div class="box">
                <i class="fa-solid fa-database"></i>
                <div>
                    <h3>PHP & MySQL</h3>
                    <span>2+ ans d'expérience</span>
                </div>
            </div>                 
            <div class="box">
                <i class="fab fa-bootstrap"></i>
                <div>
                    <h3>Bootstrap</h3>
                    <span>2+ ans d'expérience</span>
                </div>
            </div>
            <div class="box">
                <i class="fab fa-js"></i>
                <div>
                    <h3>JavaScript</h3>
                    <span>2+ ans d'expérience</span>
                </div>
            </div> 
            <div class="box">
                <i class="fab fa-docker"></i>
                <div>
                    <h3>Docker</h3>
                    <span>1+ ans d'expérience</span>
                </div>
            </div>
        </div>
        <h1 class="heading">Languages</h1>
        <div class="box-container">
            <div class="box">
                <i class="fa-solid fa-language"></i>
                <div>
                    <h3>Malagasy</h3>
                    <span>Native Speaker</span>
                </div>
            </div>
            <div class="box">
                <i class="fa-solid fa-language"></i>
                <div>
                    <h3>Français</h3>
                    <span>Intermediate</span>
                </div>
            </div>
            <div class="box">
                <i class="fa-solid fa-language"></i>
                <div>
                    <h3>Anglais</h3>
                    <span>Intermediate</span>
                </div>
            </div>
        </div>
        <h1 class="heading">Interests</h1>
        <div class="box-container">
            <div class="box">
                <i class="fa-solid fa-gamepad"></i>
                <div>
                    <h3>Gaming</h3>
                    <span>Video and Online Games</span>
                </div>
            </div>
            <div class="box">
                <i class="fa-solid fa-book"></i>
                <div>
                    <h3>Reading</h3>
                    <span>Technology and Fiction Books</span>
                </div>
            </div>
            <div class="box">
                <i class="fa-solid fa-music"></i>
                <div>
                    <h3>Music</h3>
                    <span>Playing Guitar</span>
                </div>
            </div>
        </div>

        <h1 class="heading">Interventions</h1>
        <div class="box-container">
            <div class="box">
                <i class="fas fa-globe"></i>
                <div>
                    <h3>+10k</h3>
                    <span>web development</span>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-cogs"></i>
                <div>
                    <h3>+10k</h3>
                    <span>software development</span>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-gamepad"></i>
                <div>
                    <h3>+10k</h3>
                    <span>game development</span>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-file-alt"></i>
                <div>
                    <h3>100k</h3>
                    <span>templatings</span>
                </div>
            </div>
        </div>

     </section>
    <!-- about section end -->
     
    <!-- reviews section start -->
     <section class="reviews">
        <h1 class="heading">client's reviews</h1>
        <div class="box-container">
            <?php if (!empty($reviews) && is_array($reviews)):?>
                <?php foreach($reviews as $row): ?>
                    <div class="box">
                        <div class="flex-btn">
                           
                            <div class="user">
                                <img src="<?=ROOT?><?=$row->image1?>" alt="">
                                <div>
                                    <h3><?=$row->name?></h3>
                                    <div class="stars">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star-half-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="message">
                                <p class="title"><?=$row->message?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
     </section>
    <!-- reviews section end -->

<?php $this->load_view("footer",$data); ?>
