<!-- Banner Start -->
<div class="banner padd">
    <div class="container">
        <!-- Image -->
        <?php echo $this->Html->image('crown-white.png', array('class' => 'img-responsive', 'alt' => '')); ?>
        <!-- Heading -->
        <h2 class="white">Contact Us</h2>
        <ol class="breadcrumb">
            <li><?php echo $this->Html->link('Home', '/'); ?></li>
            <li class="active">Contact</li>
        </ol>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Banner End -->

<!-- Inner Content -->
<div class="inner-page padd">

    <!-- Contact Us Start -->
    <div class="contactus">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Contact Us content -->
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <!-- Contact content details -->
                            <div class="contact-details">
                                <!-- Heading -->
                                <h4>Location</h4><!-- Address / Icon -->
                                <i class="fa fa-map-marker br-red"></i> <span>#768, 5th floor, N S Building,<br />Csm Block, Park Road,<br /> Bangalore - 234567</span>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <!-- Contact content details -->
                            <div class="contact-details">
                                <!-- Heading -->
                                <h4>On-line Order</h4>
                                <!-- Contact Number / Icon -->
                                <i class="fa fa-phone br-green"></i> <span>+91 88-88-888888</span>
                                <div class="clearfix"></div>
                                <!-- Email / Icon -->
                                <i class="fa fa-envelope-o br-lblue"></i> <span><a href="#">abc@example.com</a></span>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div><!--/ Inner row end -->
                    <!-- Contact form -->
                    <div class="contact-form">
                        <!-- Heading -->
                        <h3>Contact Form</h3>
                        <!-- Form -->
                        <form role="form">
                            <div class="form-group">
                                <!-- Form input -->
                                <input class="form-control" type="text" placeholder="Name" />
                            </div>
                            <div class="form-group">
                                <!-- Form input -->
                                <input class="form-control" type="email" placeholder="Email" />
                            </div>
                            <div class="form-group">
                                <!-- Form text area -->
                                <textarea class="form-control" rows="3" placeholder="Message..."></textarea>
                            </div>
                            <!-- Form button -->
                            <button class="btn btn-danger btn-sm" type="submit">Send</button>&nbsp;
                            <button class="btn btn-default btn-sm" type="reset">Reset</button>
                        </form>
                    </div><!--/ Contact form end -->
                </div>
                <div class="col-md-6">
                    <!-- Map holder -->
                    <div class="map-container">
                        <!-- Google Map -->
                        <iframe	src="https://maps.google.co.in/?ie=UTF8&amp;ll=12.953997,77.63094&amp;spn=0.815042,1.352692&amp;t=m&amp;z=10&amp;output=embed"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Us End -->

</div><!-- / Inner Page Content End -->