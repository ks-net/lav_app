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
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
              <title><?php echo e(config('app.name', 'Laravel')); ?></title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <!-- Styles -->
        <link href="<?php echo e(asset('css/admin.css')); ?>" rel="stylesheet">

        <?php echo $__env->yieldPushContent('head-scripts'); ?>

    </head>
    <body class="app header-fixed sidebar-fixed">
        <header class="app-header navbar">
            <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler sidebar-toggler d-md-down-none mr-auto" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>

        </header>

        <div class="app-body" id="app">
            <div class="sidebar">
                <?php echo $__env->make('elements.admin.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <button class="sidebar-minimizer brand-minimizer" type="button"></button>
            </div>

            <!-- Main content -->
            <main class="main">

                    <?php echo $__env->yieldContent('breadcrumbs'); ?>


                <div class="container-fluid">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>

            </main>

        </div> <!-- app-body end -->

        <footer class="app-footer">
            <?php echo $__env->make('elements.admin.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </footer>

        <!-- Scripts -->
        <script src="<?php echo e(asset('js/admin.js')); ?>"></script>

        <?php echo $__env->yieldPushContent('bottom-scripts'); ?>
        <!-- Scripts End -->

    </body>
</html>
