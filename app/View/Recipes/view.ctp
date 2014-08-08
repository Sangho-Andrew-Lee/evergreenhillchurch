<?php
$this->append('bottom_scripts');
echo $this->element('search/bottom_scripts');
$this->end();
?>

<!-- Banner Start -->
<div class="banner padd">
    <div class="container">
        <!-- Image -->
        <img class="img-responsive" src="/img/crown-white.png" alt="" />
        <!-- Heading -->
        <h2 class="white"><?php echo $recipe['name']; ?></h2>
        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="menu.html">Menu</a></li>
            <li class="active">Recipes</li>
        </ol>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Banner End -->

<!-- Inner Content -->
<div class="inner-page padd">

    <!-- Recipe Start -->
    <div class="recipe">
        <div class="container">
            <!-- Recipe contents -->
            <div class="recipe-content">
                <!-- Recipe Name / Heading -->
                <h4><?php echo $recipe['name']?></h4>
                <div class="row">
                    <?php if ($recipe): ?>
                        <div class="col-md-4 col-sm-6">
                            <div class="recipe-item">
                                <img class="img-responsive" src="<?php echo $recipe['image']['lg']; ?>" alt= " " />
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="recipe-item">
                                <h5>Ingredients :-</h5>
                                <ul class="list-unstyled">
                                    <?php foreach ($recipe['ingredientLines'] as $ingredient): ?>
                                        <li>
                                            <i class="fa fa-check"></i>
                                            <?php echo $ingredient ?>
                                            <div class="clearfix"></div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12">
                            <!-- Recipe Items -->
                            <div class="recipe-item">
                                <!-- Heading -->
                                <h5>Direction (<?php echo $recipe['totalTime'];?>):</h5>
                                <!-- Recipe Description -->
                                <div class="recipe-description">
                                    <!-- Paragraph -->
                                    <p>Duos aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla paria tusunt in culpa qui officia deserunt molliipsa quae ab tit anim id est laborious.</p>
                                    <!-- Paragraph -->
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem, totam rem aperiam, eaque ipsa quae ab tis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                    <!-- Heading -->
                                    <h5>Nutrition Info:</h5>
                                    <!-- Recipe nutrition table -->
                                    <div class="table-responsive">
                                        <table class="table table-condensed table-bordered">
                                            <tr>
                                                <th>Amount</th>
                                                <th>Value</th>
                                            </tr>
                                            <tbody>
                                            <tr>
                                                <td>Calories</td>
                                                <td>200</td>
                                            </tr>
                                            <tr>
                                                <td>Fat</td>
                                                <td>9g</td>
                                            </tr>
                                            <tr>
                                                <td>Carbohydrate</td>
                                                <td>33%</td>
                                            </tr>
                                            <tr>
                                                <td>Protein</td>
                                                <td>25g</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php echo $this->Html->link('View Full Preparation Article', array('controller' => 'recipes', 'action' => 'external', 'id' => $recipe['id']), array('class'=>'btn btn-primary') );?><br />
                                    (From <small class="text-muted"><?php echo $recipe['direction']['name']; ?></small>)
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

