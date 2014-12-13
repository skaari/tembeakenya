<!-- Page Content -->
    <div class="container">
        
        <!-- Page Heading/Breadcrumbs -->
        
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            
            <?php
                foreach($beaches as $beach){ ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img data-src="holder.js/300x300" alt="...">
                            <div class="caption">
                                <h3><?php echo($beach->name); ?></h3>
                                <p><?php echo($beach->description); ?></p>
                                <p><a href="<?php echo(base_url("beaches/beach/".$beach->id)); ?>" class="btn btn-primary" role="button">Button</a> </p>
                            </div>
                        </div>
                    </div>
            <?php } ?>
            
        </div>
    </div>