<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <?php echo $this->Html->meta('icon'); ?>
    <!-- Title here -->
    <title><?php echo $title_for_layout; ?></title>
    <!-- Description, Keywords and Author -->
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your,Keywords">
    <meta name="author" content="ResponsiveWebInc">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    echo $this->Html->css(array(
        'bootstrap.min.css',
        'font-awesome.min.css',
        'style.css',
        'ie-style.css'
    ));
    ?>

    <!-- Favicon -->
    <link rel="shortcut icon" href="#">
</head>

<body class="external">
<div class="external-header">
    <div class="external-logo pull-left">
        <?php echo $this->Html->link($this->Html->image('/img/logo.png', array('class' => 'img-responsive', 'alt' => '')) . '<h1>ChefMemo</h1>', '/', array('escape' => false)); ?>
    </div>
    <div class="col-md-6 col-sm-6 " id="external-search">
        <!-- Header top right content search box -->
        <div class=" header-search">
            <form class="form" role="form" method="get" action="/search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search recipe..." name="q">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <a href="<?php echo $recipe['direction']['url']; ?>" class="close pull-right" title="Close this frame">
        <i class="fa fa-times text-white"></i>&nbsp;
    </a>
</div>

<?php echo $this->Session->flash(); ?>

<?php echo $this->fetch('content'); ?>

<!-- Javascript files -->
<?php
echo $this->Html->script(array(
    'jquery.js', //jQuery
    'bootstrap.min.js', //Bootstrap JS
    'respond.min.js', //Respond JS for IE8
    'html5shiv.js', //TML5 Support for IE
));
?>

<!--Bottom scripts-->
<?php echo $this->fetch('bottom_scripts'); ?>
</body>
</html>