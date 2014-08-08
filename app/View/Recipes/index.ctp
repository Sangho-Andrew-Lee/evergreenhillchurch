<?php
$this->append('bottom_scripts');
echo $this->element('search/bottom_scripts');
$this->end();
?>

<!-- Banner Start -->
<div class="banner padd">
    <div class="container">
        <!-- Image -->
        <?php echo $this->Html->image('crown-white.png', array('class' => 'img-responsive', 'alt' => '')); ?>
        <!-- Heading -->
        <h2 class="white">All Recipes</h2>
        <ol class="breadcrumb">
            <li><?php echo $this->Html->link('Home', '/'); ?></li>
            <li class="active">Recipes</li>
        </ol>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Banner End -->

<!-- Inner Content -->
<div class="inner-page padd">

    <?php foreach ($allRecipes as $categoryUri => $recipes): ?>
        <!-- Gallery Start -->
        <div class="gallery">
            <div class="container">
                <h3>
                    <?php echo $this->Html->link($categories[$categoryUri], array('controller' => 'recipes', 'action' => 'category', 'category' => $categoryUri), array('title' => 'View All ' . $categories[$categoryUri] . ' Recipes', 'escape' => false)); ?>
                    <?php echo $this->Html->link('<small class="pull-right">View All Recipes</small>', array('controller' => 'recipes', 'action' => 'category', 'category' => $categoryUri), array('escape' => false)); ?>
                </h3>
                <!-- Gallery elements with pretty photo -->
                <div class="gallery-content">
                    <div class="row">
                        <?php if ($recipes): ?>
                            <?php foreach ($recipes as $i => $recipe): ?>
                                <div class="col-md-3 col-sm-4">
                                    <div class="element">
                                        <?php echo $this->Html->image($recipe['image']['md'], array('class' => 'img-responsive img-thumbnail', 'alt' => '')); ?>
                                        <span class="gallery-img-hover"></span>
                                        <a href="<?php echo $recipe['image']['hd']; ?>" class="gallery-img-link">
                                            <i class="fa fa-search-plus hover-icon icon-left"></i>
                                        </a>
                                        <?php echo $this->Html->link('<i class="fa fa-link hover-icon icon-right"></i>', array('controller' => 'recipes', 'action' => 'view', 'id' => $recipe['id']), array('escape' => false)); ?>
                                    </div>
                                    <h4 class="element-title" title="<?php echo $recipe['title']; ?>"><?php echo $recipe['title']; ?></h4>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div><!-- Separate gallery element --><!--/ End Gallery content class -->
            </div><!-- Separate gallery element --><!--/ End Gallery content class -->
        </div>
        <!-- Gallery End -->
    <?php endforeach; ?>

</div>
<!-- / Inner Page Content End -->