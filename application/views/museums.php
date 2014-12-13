<!-- Page Content -->
    <div class="container">
        
        <!-- Page Heading/Breadcrumbs -->
        
        <!-- /.row -->

        <!-- Content Row --> 
        
        <div class="row">       
            <?php
                foreach($museums as $museum){ ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img data-src="holder.js/300x300" alt="...">
                            <div class="caption">
                                <h3><?php echo($museum->name); ?></h3>
                                <p><?php echo($museum->description); ?></p>
                                <p><a href="<?php echo(base_url("museums/museum/".$museum->id)); ?>" class="btn btn-primary" role="button">View</a> </p>
                            </div>
                        </div>
                    </div>
            <?php } ?>
            
        </div>
    </div>