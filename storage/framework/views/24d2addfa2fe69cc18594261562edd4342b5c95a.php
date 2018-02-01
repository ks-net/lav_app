<?php
/*
 *  File:admin.blade.php  encoding:UTF-8
 *  Created at 01-12-2018 (mm/dd/yyyy) 15:10:33
 *  Belongs to project:lav_app
 *  Copyright © 2018  @KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */
?>

<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo e(config('app.name', 'Laravel')); ?></title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <!-- Styles -->
        <link href="<?php echo e(asset('css/admin.css')); ?>" rel="stylesheet">

        <?php echo $__env->yieldPushContent('head-scripts'); ?>

    </head>
    <body>
        <div id="app" >
            <?php echo $__env->make('elements.admin.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- Start Content -->
            <div class="container mt-2">
            <?php echo $__env->yieldContent('breadcrumbs'); ?>
            </div>
            <div class="container">
            <?php echo $__env->yieldContent('content'); ?>
            </div>
            <!-- Content End -->
            <div class="container mt-2 mb-5">
            <?php echo $__env->make('elements.admin.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div> <!-- APP END -->

        <!-- Scripts -->
        <script src="<?php echo e(asset('js/admin.js')); ?>"></script>

        <?php echo $__env->yieldPushContent('bottom-scripts'); ?>
        <!-- Scripts End -->

    </body>
</html>
