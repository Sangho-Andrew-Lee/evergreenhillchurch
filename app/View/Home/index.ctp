<?php
$this->Html->script(
    array(
        'jquery.themepunch.plugins.min.js', //SLIDER REVOLUTION 4.x SCRIPTS
        'jquery.themepunch.revolution.min.js', //SLIDER REVOLUTION 4.x SCRIPTS
        'jquery.flexslider-min.js' //FLEX SLIDER SCRIPTS
    ),
    array('block' => 'bottom_scripts')
);

$this->append('bottom_scripts');
echo $this->element('home/bottom_scripts');
$this->end();
?>

<?php echo $this->element('home/slider'); ?>

<!-- Main Content -->
<div class="main-content">

    <!-- Recipes -->
    <div class="dishes padd">
        <div class="container">
            <!-- Default Heading -->
            <div class="default-heading">
                <!-- Crown image -->
                <?php echo $this->Html->image('crown.png', array('class' => 'img-responsive', 'alt' => '')); ?>
                <!-- Heading -->
                <h2>New Recipes</h2>
                <!-- Paragraph -->
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <!-- Border -->
                <div class="border"></div>
            </div>
            <div class="row">
                <?php
                    for ($i = 0; $i < 4; $i++):
                        $newRecipe = $newRecipes[$i];
                ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="dishes-item-container">
                            <!-- Image Frame -->
                            <div class="img-frame">
                                <!-- Image -->
                                <?php echo $this->Html->image($newRecipe['image']['lg'], array('class' => 'img-responsive', 'alt' => '')); ?>
                                <!-- Block for on hover effect to image -->
                                <div class="img-frame-hover">
                                    <!-- Hover Icon -->
                                    <?php echo $this->Html->link('<i class="fa fa-cutlery"></i>', array('controller' => 'recipes', 'action' => 'view', 'id' => $newRecipe['id']), array('escape' => false)); ?>
                                </div>
                            </div>
                            <!-- Dish Details -->
                            <div class="dish-details">
                                <!-- Heading -->
                                <h3><?php echo $newRecipe['title']; ?></h3>
                                <!-- Paragraph -->
                                <p>At vero eos et accusal gusto for ides residuum lores.</p>
                                <!-- Button -->
                                <?php echo $this->Html->link('Read more', array('controller' => 'recipes', 'action' => 'view', 'id' => $newRecipe['id']), array('class' => 'btn btn-danger btn-sm', 'escape' => false)); ?>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    <!-- /Recipes -->

    <!-- Categories -->
    <div class="menu padd">
        <div class="container">
            <!-- Default Heading -->
            <div class="default-heading">
                <!-- Crown image -->
                <?php echo $this->Html->image('crown.png', array('class' => 'img-responsive', 'alt' => '')); ?>
                <!-- Heading -->
                <h2>Popular Recipes</h2>
                <!-- Paragraph -->
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <!-- Border -->
                <div class="border"></div>
            </div>
            <!-- Menu content container -->
            <div class="menu-container">
                <div class="row">
                    <?php foreach ($popularRecipes as $popularCategory => $popularRecipesArr): ?>
                    <div class="col-md-4 col-sm-4">
                        <!-- Menu header -->
                        <div class="menu-head">
                            <!-- Image for menu item -->
                            <?php echo $this->Html->image($popularCategories[$popularCategory]['image'], array('class' => 'menu-img img-responsive img-thumbnail', 'alt' => '')); ?>
                            <!-- Menu title / Heading -->
                            <h3><?php echo $popularCategory; ?></h3>
                            <!-- Border for above heading -->
                            <div class="title-border <?php echo $popularCategories[$popularCategory]['class']; ?>"></div>
                        </div>
                        <!-- Menu item details -->
                        <div class="menu-details <?php echo $popularCategories[$popularCategory]['class']; ?>">
                            <!-- Menu list -->
                            <ul class="list-unstyled">
                                <?php foreach($popularRecipesArr as $popularRecipe): ?>
                                    <li>
                                        <div class="menu-list-item">
                                            <?php echo $this->Html->link('<i class="fa fa-angle-right"></i>' . $popularRecipe['title'], array('controller' => 'recipes', 'action' => 'view', 'id' => $popularRecipe['id']), array('escape' => false)); ?>
                                            <div class="clearfix"></div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div><!-- / Menu details end -->
                    </div>
                    <?php endforeach; ?>
                </div>
            </div> <!-- /Menu container end -->
        </div>
    </div>
    <!-- /Categories -->

    <!-- Testimonial -->
    <div class="testimonial padd">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- BLock heading -->
                    <h3>Recent Dishes</h3>
                    <!-- Flex slider Content -->
                    <div class="flexslider-recent">
                        <ul class="slides">
                            <li>
                                <!-- Image for background -->
                                <?php echo $this->Html->image('dish/dish9.jpg', array('class' => 'img-responsive', 'alt' => '')); ?>
                                <!-- Slide content -->
                                <div class="slider-content">
                                    <!-- Heading -->
                                    <h4>Healthy Salad</h4>
                                    <!-- Paragraph -->
                                    <p>Sed ut perspiciatis unde omnis iste natus error sitvolua rchitecto beatae vitae dicta sunt explicabo eaque ipsa quae ab illo inventore.</p>
                                </div>
                            </li>
                            <li>
                                <!-- Image for background -->
                                <?php echo $this->Html->image('dish/dish10.jpg', array('class' => 'img-responsive', 'alt' => '')); ?>
                                <!-- Slide content -->
                                <div class="slider-content">
                                    <!-- Heading -->
                                    <h4>White Vanilla Cake</h4>
                                    <!-- Paragraph -->
                                    <p>Sed ut perspiciatis unde omnis iste natus error sitvolua rchitecto beatae vitae dicta sunt explicabo eaque ipsa quae ab illo inventore.</p>
                                </div>
                            </li>
                            <li>
                                <!-- Image for background -->
                                <?php echo $this->Html->image('dish/dish11.jpg', array('class' => 'img-responsive', 'alt' => '')); ?>
                                <!-- Slide content -->
                                <div class="slider-content">
                                    <!-- Heading -->
                                    <h4>Tasty Fried Fish</h4>
                                    <!-- Paragraph -->
                                    <p>Sed ut perspiciatis unde omnis iste natus error sitvolua rchitecto beatae vitae dicta sunt explicabo eaque ipsa quae ab illo inventore.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- BLock heading -->
                    <h3>Our Client Says</h3>
                    <!-- Flex slider Content -->
                    <div class="flexslider-testimonial">
                        <ul class="slides">
                            <li>
                                <!-- Testimonial Content -->
                                <div class="testimonial-item">
                                    <!-- Quote -->
                                    <span class="quote lblue">&#8220;</span>
                                    <!-- Your comments -->
                                    <blockquote>
                                        <!-- Paragraph -->
                                        <p>Sed ut perspiciatis unde omnis iste natus error sitvolu accusative ntium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta.</p>
                                    </blockquote>
                                    <!-- Heading with image -->
                                    <h4>
                                        <?php echo $this->Html->image('user.jpg', array('class' => 'img-responsive img-circle', 'alt' => '')); ?>
                                        Jhon Doe<span>, your designation</span>
                                    </h4>
                                    <div class="clearfix"></div>
                                </div>
                            </li>
                            <li>
                                <!-- Testimonial Content -->
                                <div class="testimonial-item">
                                    <!-- Quote -->
                                    <span class="quote lblue">&#8220;</span>
                                    <!-- Your comments -->
                                    <blockquote>
                                        <!-- Paragraph -->
                                        <p> I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the dislikes.</p>
                                    </blockquote>
                                    <!-- Heading with image -->
                                    <h4>
                                        <?php echo $this->Html->image('user.jpg', array('class' => 'img-responsive img-circle', 'alt' => '')); ?>
                                        Marten<span>, your designation</span>
                                    </h4>
                                    <div class="clearfix"></div>
                                </div>
                            </li>
                            <li>
                                <!-- Testimonial Content -->
                                <div class="testimonial-item">
                                    <!-- Quote -->
                                    <span class="quote lblue">&#8220;</span>
                                    <!-- Your comments -->
                                    <blockquote>
                                        <!-- Paragraph -->
                                        <p>At vero eos et accusamus et iusto odio dignis simos ducimus qui bland itiis praes entium volup tatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non laboratory.</p>
                                    </blockquote>
                                    <!-- Heading with image -->
                                    <h4>
                                        <?php echo $this->Html->image('user.jpg', array('class' => 'img-responsive img-circle', 'alt' => '')); ?>
                                        Katrina Doe<span>, your designation</span>
                                    </h4>
                                    <div class="clearfix"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Testimonial -->

</div><!-- / Main Content End -->