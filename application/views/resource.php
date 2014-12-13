    <!-- Page Content -->
    
    <?php var_dump($resource); ?>
    
    <?php
        if($resource_type == "museums"){
            $resource_name = $resource[0]->name;
            $resource_description = $resource[0]->description;
            $resource_full=$resource[0]->fulldes;
            $resource_id = $resource[0]->id;
        }
         if ($resource_type == "lakes"){
            $resource_name = $resource[0]->name;
            $resource_description = $resource[0]->description;
            $resource_full=$resource[0]->fulldes;
            $resource_id = $resource[0]->id;
        }
        if ($resource_type == "beaches"){
            $resource_name = $resource[0]->name;
            $resource_description = $resource[0]->description;
            $resource_full=$resource[0]->fulldes;
            $resource_id = $resource[0]->id;
        }
         if ($resource_type == "safaris"){
            $resource_name = $resource[0]->name;
            $resource_description = $resource[0]->description;
            $resource_full=$resource[0]->fulldes;
            $resource_id = $resource[0]->id;
        }
         if ($resource_type == "hotels"){
            $resource_name = $resource[0]->name;
            $resource_description = $resource[0]->description;
            $resource_full=$resource[0]->fulldes;
            $resource_id = $resource[0]->id;
        }
        
    ?>
    
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo($resource_type); ?>
                    <small>: <a href="#"><?php echo($resource_name); ?></a>
                    </small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Resource -->
                <!-- Preview Image -->
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo(substr($resource_description, 0, 1000). " ..."); ?></p>
                <p><?php echo($resource_full); ?></p>
                <!--<hr>-->
                
                <?php
                    $recommend_resource = strtolower($resource_type);
                ?>
                <a href="<?php echo(base_url($recommend_resource."/recommend/".$recommend_resource."/".$resource_id)); ?>" class="btn btn-success">Get Recommendations</a>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>
