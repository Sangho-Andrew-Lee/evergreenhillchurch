<!DOCTYPE html><html><head>    <meta charset="utf-8">    <?php echo $this->Html->meta('icon'); ?>    <!-- Title here -->    <title><?php echo $title_for_layout; ?></title>    <!-- Description, Keywords and Author -->    <meta name="description" content="Your description">    <meta name="keywords" content="Your,Keywords">    <meta name="author" content="ResponsiveWebInc">    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <?php        echo $this->Html->css(array(            'bootstrap.min.css',            'settings.css',            'flexslider.css',            'prettyPhoto.css',            'font-awesome.min.css',            'less-style.css',            'style.css',            'ie-style.css'        ));        echo $this->Html->script(array(			  'jquery.js'        ));    ?>    <!-- Favicon -->    <link rel="shortcut icon" href="#"></head><body><!-- Page Wrapper --><div class="wrapper"><!-- Header Start --><div class="header"><div class="container"><div class="header-top">    <div class="row">        <div class="col-md-6 col-sm-6">            <!-- Header top left content contact -->            <div class="header-contact">                <!-- Contact number -->                <span><i class="fa fa-phone red"></i> <a href="tel:+13105160430">310-516-0430</a></span>            </div>        </div>        <div class="col-md-6 col-sm-6">            <!-- Header top right content search box -->            <div class=" header-search"><!--                <form class="form" role="form" method="get" action="/search">                    <div class="input-group">                        <input type="text" class="form-control" placeholder="Search..." name="q">								 <span class="input-group-btn">									  <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>								 </span>                    </div>                </form>-->            </div>        </div>    </div></div><div class="row">    <div class="col-md-4 col-sm-5">        <!-- Link -->        <a href="/">            <!-- Logo area -->            <div class="logo">                <?php echo $this->Html->image('/img/evergreenhill_logo.jpg', array('class' => 'img-responsive', 'alt' => '')); ?>                <!-- Heading -->                <!-- <h1>ChefMemo</h1> -->                <!-- Paragraph -->                <p>EVERGREEN HILL PRESBYTERIAN CHURCH</p>            </div>        </a>    </div>    <div class="col-md-8 col-sm-7">        <!-- Navigation -->        <nav class="navbar navbar-default navbar-right" role="navigation">            <div class="container-fluid">                <!-- Brand and toggle get grouped for better mobile display -->                <div class="navbar-header">                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">                        <span class="sr-only">Toggle navigation</span>                        <span class="icon-bar"></span>                        <span class="icon-bar"></span>                        <span class="icon-bar"></span>                    </button>                </div>                <!-- Collect the nav links, forms, and other content for toggling -->                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">                    <ul class="nav navbar-nav">                        <li>                            <?php //echo $this->Html->link($this->Html->image('nav-menu/nav1.jpg', array('class' => 'img-responsive', 'alt' => '')) . 'Home', '/', array('escape' => false)); ?>                        </li><!--                        <li class="dropdown hidden-xs">--><!--                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="/img/nav-menu/nav2.jpg" class="img-responsive" alt="" /> Menu <b class="caret"></b></a>--><!--                            <ul class="dropdown-menu dropdown-md">--><!--                                <li>--><!--                                    <div class="row">--><!--                                        <div class="col-md-4 col-sm-6">--><!--                                            <!-- Menu Item --> <!-- --><!--                                            <div class="menu-item">--><!--                                                <!-- Heading --> <!-- --><!--                                                <h3>Vegetarian</h3>--><!--                                                <!-- Image --> <!-- --><!--                                                --><?php //echo $this->Html->image('dish/dish1.jpg', array('class' => 'img-responsive', 'alt' => '')); ?><!--                                                <!-- Paragraph --> <!-- --><!--                                                <p>Sea nut perspicacity under omni piste natures mirror of there with consequent.</p>--><!--                                                <!-- Button --> <!-- --><!--                                                <a href="menu.html" class="btn btn-danger btn-xs">View Menu</a>--><!--                                            </div>--><!--                                        </div>--><!--                                        <div class="col-md-4 col-sm-6">--><!--                                            <!-- Menu Item --> <!-- --><!--                                            <div class="menu-item">--><!--                                                <!-- Heading --> <!-- --><!--                                                <h3>Non-Vegetarian</h3>--><!--                                                <!-- Image --> <!-- --><!--                                                --><?php //echo $this->Html->image('dish/dish2.jpg', array('class' => 'img-responsive', 'alt' => '')); ?><!--                                                <!-- Paragraph --> <!-- --><!--                                                <p>Sea nut perspicacity under omni piste natures mirror as precode consequent.</p>--><!--                                                <!-- Button --> <!-- --><!--                                                <a href="menu.html" class="btn btn-danger btn-xs">View Menu</a>--><!--                                            </div>--><!--                                        </div>--><!--                                        <div class="col-md-4">--><!--                                            <!-- Menu Item --> <!-- --><!--                                            <div class="menu-item">--><!--                                                <!-- Heading --> <!-- --><!--                                                <h3>Special Menu</h3>--><!--                                                <!-- Image --> <!-- --><!--                                                --><?php //echo $this->Html->image('dish/dish3.jpg', array('class' => 'img-responsive', 'alt' => '')); ?><!--                                                <!-- Paragraph --> <!-- --><!--                                                <p>Sea nut perspicacity under omni piste natures mirror consequent.</p>--><!--                                                <!-- Button --> <!-- --><!--                                                <a href="menu.html" class="btn btn-danger btn-xs">View Menu</a>--><!--                                            </div>--><!--                                        </div>--><!--                                    </div>--><!--                                </li>--><!--                            </ul>--><!--                        </li>--><!--                        <li class="dropdown visible-xs">--><!--                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu <b class="caret"></b></a>--><!--                            <ul class="dropdown-menu">--><!--                                <li><a href="menu.html">Vegetarian</a></li>--><!--                                <li><a href="menu.html">Non Vegetarian</a></li>--><!--                                <li><a href="menu.html">Special Menu</a></li>--><!--                            </ul>--><!--                        </li>-->                        <li>                            <?php //echo $this->Html->link($this->Html->image('nav-menu/nav3.jpg', array('class' => 'img-responsive', 'alt' => '')) . 'Recipes', array('controller' => 'recipes', 'action' => 'index'), array('escape' => false)); ?>                        </li>                        <li class="dropdown">                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->Html->image('introduction.jpg', array('class' => 'img-responsive', 'alt' => '')); ?>교회소개 <b class="caret"></b></a>                            <ul class="dropdown-menu">                                <li><a href="/our_church">늘푸른 동산 교회는</a></li>                                <li><a href="/staff">섬기는 이들</a></li>                                <li><a href="/directions">오시는 길</a></li>                                <li><a href="/service_times">예배시간</a></li>                            </ul>                        </li>                        <li class="dropdown">                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->Html->image('history.jpg', array('class' => 'img-responsive', 'alt' => '')); ?> 구속사 스리즈 안내 <b class="caret"></b></a>                            <ul class="dropdown-menu">                                <li><a href="http://book.pyungkang.com/new_book/01/01.php">1 권</a></li>                                <li><a href="http://book.pyungkang.com/new_book/02/01.php">2 권</a></li>                                <li><a href="http://book.pyungkang.com/new_book/03/01.php">3 권</a></li>                                <li><a href="http://book.pyungkang.com/new_book/04/01.php">4 권</a></li>                                <li><a href="http://book.pyungkang.com/new_book/05/01.php">5 권</a></li>                                <li><a href="http://book.pyungkang.com/new_book/06/01.php">6 권</a></li>                            </ul>                        </li>                        <li class="dropdown">                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->Html->image('sermon.jpg', array('class' => 'img-responsive', 'alt' => '')); ?> 말씀<b class="caret"></b></a>                            <ul class="dropdown-menu">                                <li><?php echo $this->Html->link('주일예배', array('controller' => 'sermons', 'action' => 'sunday'), array('escape' => false)); ?></li>                                <li><?php echo $this->Html->link('수요예배', array('controller' => 'sermons', 'action' => 'wednesday'), array('escape' => false)); ?></li>                                <li><?php echo $this->Html->link('성경공부', array('controller' => 'sermons', 'action' => 'biblestudy'), array('escape' => false)); ?></li>                                <li><?php echo $this->Html->link('구속사', array('controller' => 'sermons', 'action' => 'historyofredemption'), array('escape' => false)); ?></li>                                <li><?php echo $this->Html->link('이벤트', array('controller' => 'sermons', 'action' => 'events'), array('escape' => false)); ?></li>                            </ul>                        </li>                        <li class="dropdown">                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->Html->image('gospel.jpg', array('class' => 'img-responsive', 'alt' => '')); ?> 찬양<b class="caret"></b></a>                            <ul class="dropdown-menu">                                <li><a href="/sermons_sunday">호산나 성가대</a></li>                                <li><a href="/sermons_wednesday">에벤에셀 찬양 팀</a></li>                                <li><a href="/bible_study">악보통</a></li>                                <li><a href="/history_of_redemption">CCM</a></li>                            </ul>                        </li>                        <li class="dropdown">                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->Html->image('community.jpg', array('class' => 'img-responsive', 'alt' => '')); ?> 커뮤니티<b class="caret"></b></a>                            <ul class="dropdown-menu">                                <li><a href="/sermons_sunday">교회소식</a></li>                                <li><a href="/sermons_wednesday">교회일정</a></li>                                <li><a href="/bible_study">새가족 소개</a></li>                                <li><a href="/history_of_redemption">자유게시판</a></li>                                <li><a href="/events">교육부 게시판</a></li>                                <li><a href="/events">부서별 게시판</a></li>                            </ul>                        </li>                        <li class="dropdown">                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->Html->image('storage.jpg', array('class' => 'img-responsive', 'alt' => '')); ?>교회 자료실<b class="caret"></b></a>                            <ul class="dropdown-menu">                                <li><a href="/sermons_sunday">주보자료실</a></li>                                <li><a href="/sermons_wednesday">사진자료실</a></li>                                <li><a href="/bible_study">동영상자료실</a></li>                            </ul>                        </li>                        <!--<li>-->                            <!--<?php //echo $this->Html->link($this->Html->image('nav-menu/nav6.jpg', array('class' => 'img-responsive', 'alt' => '')) . ' About', array('controller' => 'pages', 'action' => 'staticPage', 'about_us'), array('escape' => false)); ?>-->                        <!--</li>-->                        <!--<li>-->                            <!--<?php //echo $this->Html->link($this->Html->image('nav-menu/nav3.jpg', array('class' => 'img-responsive', 'alt' => '')) . 'Sign Up', array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?>-->                        <!--</li>-->                    </ul>                </div><!-- /.navbar-collapse -->            </div><!-- /.container-fluid -->        </nav>    </div></div></div> <!-- / .container --></div><!-- Header End --><?php echo $this->Session->flash(); ?><?php echo $this->fetch('content'); ?><!-- Footer Start --><div class="footer padd">    <div class="container">        <div class="row">            <div class="col-md-4 col-sm-6">                <!-- Footer widget -->                <div class="footer-widget">                    <!-- Heading -->                    <h4>About Us</h4>                    <!-- Paragraph -->                    <p>There is no one who loves pain itself, who seeks after it and wants to have it.</p>                    <!-- Logo area -->                    <div class="logo">                        <img class="img-responsive" src="/img/evergreenhill_footerlogo.jpg" alt="" />                        <!-- Heading -->                        <h1>늘푸른동산교회</h1>                    </div>                    <!-- Paragraph -->                    <p>Evergreen Hill Presbyterian Church.</p>                </div> <!--/ Footer widget end -->            </div>            <!--<div class="col-md-3 col-sm-6">-->                <!--&lt;!&ndash; Footer widget &ndash;&gt;-->                <!--<div class="footer-widget">-->                    <!--&lt;!&ndash; Heading &ndash;&gt;-->                    <!--<h4>Famous Dishes</h4>-->                    <!--&lt;!&ndash; Images &ndash;&gt;-->                    <!--<?php//                        foreach ($famousDishes as $famousDish) {//                            echo $this->Html->link($this->Html->image($famousDish['image']['sm'], array('class' => 'dish img-responsive', 'alt' => '')), array('controller' => 'recipes', 'action' => 'view', 'id' => $famousDish['id']), array('title' => $famousDish['title'], 'escape' => false));-->//                        }                    ?>                <!--</div> &lt;!&ndash;/ Footer widget end &ndash;&gt;-->            <!--</div>-->            <div class="clearfix visible-sm"></div>            <div class="col-md-4 col-sm-6">                <!-- Footer widget -->                <div class="footer-widget">                    <!-- Heading -->                    <h4>Join Us Today</h4>                    <!-- Paragraph -->                    <p>There is no one who loves pain itself, who seeks after it and wants to have it.</p>                    <!-- Subscribe form -->                    <form role="form">                        <div class="form-group">                            <input class="form-control" type="text" placeholder="Your name" />                        </div>                        <div class="form-group">                            <input class="form-control" type="email" placeholder="Your email" />                        </div>                        <button class="btn btn-danger" type="button">Subscribe</button>                    </form>                </div> <!--/ Footer widget end -->            </div>            <div class="col-md-4 col-sm-6">                <!-- Footer widget -->                <div class="footer-widget">                    <!-- Heading -->                    <h4>Contact Us</h4>                    <div class="contact-details">                        <!-- Address / Icon -->                        <i class="fa fa-map-marker br-red"></i> <span>17116 S Figueroa St,<br />Gardena,<br /> California - 90248</span>                        <div class="clearfix"></div>                        <!-- Contact Number / Icon -->                        <i class="fa fa-phone br-green"></i> <span><a href="tel:+13105160430">+1 (310) 516-0430</a></span>                        <div class="clearfix"></div>                        <!-- Email / Icon -->                        <i class="fa fa-envelope-o br-lblue"></i> <span><a href="#">abc@example.com</a></span>                        <div class="clearfix"></div>                    </div>                    <!-- Social media icon -->                    <div class="social">                        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>                        <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>                        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>                        <a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a>                    </div>                </div> <!--/ Footer widget end -->            </div>        </div>        <!-- Copyright -->        <div class="footer-copyright">            <!-- Paragraph -->            <p>&copy; Copyright 2014 <a href="#">EverGreen Hill Presbyterian Church</a></p>        </div>    </div></div><!-- Footer End --></div><!-- / Wrapper End --><!-- Scroll to top --><span class="totop"><a href="#"><i class="fa fa-angle-up"></i></a></span><!-- Javascript files --><?php    echo $this->Html->script(array(        'jquery.js', //jQuery        'bootstrap.min.js', //Bootstrap JS        'jquery.prettyPhoto.js', //Pretty Photo JS        'respond.min.js', //Respond JS for IE8        'html5shiv.js', //TML5 Support for IE        'custom.js' //Custom JS    ));?><!--Bottom scripts--><?php echo $this->fetch('bottom_scripts'); ?></body></html>