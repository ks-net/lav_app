<?php
/*
 *  File:dashboard.blade.php  encoding:UTF-8
 *  Created at 01-12-2018 (mm/dd/yyyy) 16:00:46
 *  Belongs to project:lav_app
 *  Copyright © 2018  @KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */
?>


<?php $__env->startPush('head-scripts'); ?>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>


    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-cogs"></i> Admin Dashboard</div>
        <div class="panel-body">
            <ul>
                <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($route->uri); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startPush('bottom-scripts'); ?>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>