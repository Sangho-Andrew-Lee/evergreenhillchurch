
<!-- Shopping cart Modal -->
<div class="modal fade" id="shoppingcart1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Shopping Cart</h4>
            </div>
            <div class="modal-body">
                <!-- Items table -->
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><a href="#">Exception Reins Evocative</a></td>
                        <td>2</td>
                        <td>$200</td>
                    </tr>
                    <tr>
                        <td><a href="#">Taut Mayoress Alias Appendicitis</a></td>
                        <td>1</td>
                        <td>$190</td>
                    </tr>
                    <tr>
                        <td><a href="#">Sinter et Molests Perfectionist</a></td>
                        <td>4</td>
                        <td>$99</td>
                    </tr>
                    <tr>
                        <th></th>
                        <th>Total</th>
                        <th>$489</th>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Continue Shopping</button>
                <button type="button" class="btn btn-info">Checkout</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Model End -->

<!-- Page Wrapper -->
<div class="wrapper">

    <!-- Banner Start -->
    <div class="banner padd">
        <div class="container">
            <!-- Image -->
            <?php echo $this->Html->image('crown-white.png', array('class' => 'img-responsive', 'alt' => '')); ?>
            <!-- Heading -->
            <h2 class="white">General Info</h2>
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">General Info</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Inner Content -->
    <div class="inner-page padd">

        <!-- General Info Start -->

        <div class="general">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <!-- General information content -->
                        <div class="general-content">
                            <!-- Navigation tab -->
                            <ul class="nav nav-tabs">
                                <!-- Navigation tabs (Job titles ). Use unique value for "href" in "anchor tags". -->
                                <li class="active"><a href="#tab1" data-toggle="tab">About Us</a></li>
                                <li><a href="#tab2" data-toggle="tab">Terms &amp; Conditions</a></li>
                                <li><a href="#tab3" data-toggle="tab">Disclaimer</a></li>
                                <li><a href="#tab4" data-toggle="tab">Privacy Policy</a></li>
                            </ul>
                            <!-- Tab content -->
                            <div class="tab-content">
                                <!-- In "id", use the value which you used in above anchor tags -->
                                <div class="tab-pane active" id="tab1">
                                    <!-- Heading -->
                                    <h5>About Us</h5>
                                    <!-- Paragraph -->
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vulputate eros nec odio egestas in dictum nitusrpis egestas. Suspendisse porttitor luctus imperdiet. <a href="#">Praesent ultricies</a> enim ac ipsum aliquet pellentesque. Nullam justo nunc, dignissim at convallis posuere, sit amet blandit viverra, dignissim eget est. Ut <strong>commodo ullamcorper risus nec</strong> mattis.</p>
                                    <!-- Paragraph -->
                                    <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestibulum libero, ut vestibulum tellus magna nec enim. Nunc dapibus varius interdum. Phasellus at lorem ut lectus fermentum convallis. Sed diam nisi, pulvinar vitae molestie hendrerit, venenatis eget mauris. Integer porta erat ac eros porta ultrices. Proin porttitor eros a ante molestie gravida commodo dui adipiscing. <a href="#">Morbi dictum nibh gravida</a> mi pretium dapibus. Nullam in est urna. In vitae adipiscing enim. Curabitur rhoncus condimen laoreet justo ullamcorper.</p>
                                    <!-- List content -->
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-check"></i> Etiam adipiscing posuere, nec iaculis justo dictum non</li>
                                        <li><i class="fa fa-check"></i> Cras tincidunt mi non arcu hendrerit eleifend</li>
                                        <li><i class="fa fa-check"></i> Aenean tincidunt justo aliquet et lobortis diam faucibus</li>
                                        <li><i class="fa fa-check"></i> Maecenas hendrerit neque id ante dictum mattis</li>
                                        <li><i class="fa fa-check"></i> Vivamus non neque lacus, et cursus tortor</li>
                                    </ul>
                                </div> <!--/ tab-pane end -->
                                <div class="tab-pane" id="tab2">
                                    <!-- heading -->
                                    <h5>Terms &amp; Conditions</h5>
                                    <!-- Paragraph -->
                                    <p>Nulla facilisi. Sed justo dui, scelerisque ut consectetur vel, eleifend id erat. Morbi auctor adipiscing tempor. Phasellus condimentum rutrum aliquet. Quisque eu consectetur erat. Proin rutrum, erat eget posuere semper, <em>arcu mauris posuere tortor</em>, in commodo enim magna id massa. Suspendisse potenti. Aliquam erat volutpat. Maecenas quis tristique turpis. Nulla facilisi. Duis sed velit at <a href="#">magna sollicitudin cursus</a> ac ultrices magna. Aliquam consequat, purus vitae auctor ullamcorper, sem velit convallis quam, a pharetra justo nunc et mauris. Vivamus diam diam, fermentum sed dapibus eget, egestas sed eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <!-- Paragraph -->
                                    <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestibulum libero, ut vestibulum tellus magna nec enim. Nunc dapibus variusam in est urna. In vitae adipiscing enim. Curabitur rhoncus condimentum lorem, non convallis dolor faucibus eget. In ut nulla est. Sed a interdum mauris. Duis eget risus ac orci vulputate vestibul interdum. Phasellus at lorem ut lectus fermentum convallis. Sed diam nisi, pulvinar vitae molestiat laoreet justo ullamcorper.</p>
                                    <!-- Paragraph -->
                                    <p>ium dapibus. Nullam in est urna. In vitae adipiscing enim. Curabitur rhoncus condimentum lorem, non convallis dolor faucibus eget. In ut nulla est. Sed a interdum mauris. Duis eget risus ac orci vulputate vestibulum sit amet id orci. Etiam ac ante at lorem ultrices elementum. Vestibulum quis elit odio, id hendrerit ipsum. Fusce consequat leo vitae velit interdum at laoreet justo ullamcorper.</p>
                                </div> <!--/ tab-pane end -->
                                <div class="tab-pane" id="tab3">
                                    <!-- heading -->
                                    <h5>Disclaimer</h5>
                                    <!-- Paragraph -->
                                    <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestibulum libero, ut vestibulum tellus magna nec enim. Nunc dapibus varius interdum. Phasellus at lorem ut lectus fermentum convallis. Sed diam nisi, pulvinar vitae molestie hendrerit, venenatis eget mauris. Integer porta erat ac eros porta ultrices. Proin porttitor eros a ante molestie gravida commodo dui adipiscing. <a href="#">Morbi dictum nibh gravida</a> velit interdum at laoreet justo ullamcorper.</p>
                                    <!-- Paragraph -->
                                    <p>Prisus eget viverra faucibus, diam mi vestibulum libero, ut vestibulum tellus magna nec enim. Nunc dapibus varius interdum. Phasellus at lorem ut lectus fermentum convallis. Sed diam nisi, pulvinar vitae molestie hendrerit, venenatis eget mauris. Integer porta erat ac eros porta ultrices. Proin porttitor eros a ante molestie gravida commodo dui adipiscing. <a href="#">Morbi dictum nibh gravida</a> mi pretium dapibus.am in est urna. In vitae adipiscing enim. Curabitur rhoncus condimentum lorem, non convallis dolor faucibus eget. In ut nulla est. Sed a interdum mauris. Duis eget risus ac orci vulputate vestibul Nullam in est urna. In vitae adipiscing enim. Curabitur rhoncus condimentum lorem, non convallis dolor faucibus eget. In ut nulla est. Sed a interdum mauris. Duis eget risus ac orci vulputate vestibulum sit amet id orci. Etiam ac ante at lorem ultrices elementum. Vestibulum quis elit odio, id hendrerit ipsum. Fusce consequat lamcorper.</p>
                                    <!-- Paragraph -->
                                    <p>Mi pretium dapibus. Nullam in est urna. In vitae adipiscing enim. Curabitur rhoncus condimentum lorem, non convallis dolor faucibus eget. In ut nulla est. Sed a interdum mauris. Duis eget risus ac orci vulputate vestibulum sit amet id orci. Etiam ac ante at lorem ultrices elementum. Vestibulum quis elit odio, id hendrerit ipsum. Fusce consequat leo vitae velit interdum at laoreet justo ullamcorper.</p>
                                </div> <!--/ tab-pane end -->
                                <div class="tab-pane" id="tab4">
                                    <!-- Heading -->
                                    <h5>Privacy Policy</h5>
                                    <!-- Paragraph -->
                                    <p> Duis eget risus ac orci vulputate vestibulum sit amet id orci. Etiam ac ante at lorem ultrices elementum. Vestibulum quis elit am in est urna. In vitae adipiscing enim. Curabitur rhoncus condimentum lorem, non convallis dolor faucibus eget. In ut nulla est. Sed a interdum mauris. Duis eget risus ac orci vulputate vestibulodio, id hendrerit ipsum. Fusce consequat leo vitae velit interdum at laoreet justo ullamcorper.</p>
                                    <!-- paragraph -->
                                    <p>Fusce imperdiet, risus eget viverra faucibus, diam mi vestibulum libero, ut vestibulum tellus magna nec enim. Nunc dapibus varius interdum. Phasellus at lorem ut lectus fermentum convallis. Sed diam nisi, pulvinar vitae molestie hendrerit, venenatis eget mauris. Integer porta erat ac eros porta ultrices. Proin porttitor eros a ante molestie gravida commodo dui adipiscing. <a href="#">Morbi dictum nibh gravida</a> mi pretium dapibus. Nullam in est urna..</p>
                                    <!-- Paragraph -->
                                    <p>Eet viverra faucibus, diam mi vestibulum libero, ut vestibulum tellus magna nec enim. Nunc dapibus varius interdum. Phasellus at lorem ut lectus fermentum convallis. Sed diam nisi, pulvinar vitae molestie hendrerit, venenatis eget mauris. Integer porta erat ac eros porta ultrices. Proin porttitor eros a ante molestie gravida commodo dui adipiscing. <a href="#">Morbi dictum nibh gravida</a> mi pretium dapibus. Nullam in est urna. In vitae adipiscing enim. Curabitur rhoncus condimentum lorem, non convallis dolor faucibus eget. In ut nulla est. Sed a interdum mauris. Duis eget risus ac orci vulputate vestibulum sit amet id orci. Etiam ac ante at lorem ultrices elementum. Vestibulum quis elit odio, id hendrerit ipsum. Fusce consequat leo vitae velit interdum at laoreet justo ullamcorper.</p>
                                </div>
                            </div><!--/ Tab content end -->
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <!-- General Sidebar image -->
                        <div class="general-img">
                            <img class="img-responsive img-thumbnail" src="img/dish/dish1.jpg" alt="" />
                            <!-- Hot tag -->
                            <span class="hot-tag br-green">New</span>
                        </div>
                        <!-- General Sidebar image -->
                        <div class="general-img">
                            <img class="img-responsive img-thumbnail" src="img/dish/dish2.jpg" alt="" />
                            <!-- Hot tag -->
                            <span class="hot-tag br-red">Hot</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- General Info End -->

    </div><!-- / Inner Page Content End -->

</div><!-- / Wrapper End -->


<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="fa fa-angle-up"></i></a></span>

