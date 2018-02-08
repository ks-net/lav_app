<?php
/*
 *  File:menu.blade.php  encoding:UTF-8
 *  Created at 01-14-2018 (mm/dd/yyyy) 01:09:07
 *  Belongs to project:lav_app
 *  Copyright © 2018  @KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */
?>

<nav class="sidebar-nav">

    <ul class="nav">
        <?php if(auth()->guard()->guest()): ?>
        <li class="nav-item"><a href="<?php echo e(route('login')); ?>">Login</a></li>
        <li class="nav-item"><a href="<?php echo e(route('register')); ?>">Register</a></li>
        <?php else: ?>


        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard <span class="badge badge-primary">NEW</span></a>
        </li>

        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="fa fa-wrench"></i> Settings
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('adminsettings')); ?>"><i class="fa fa-wrench"></i>Default Settings</a></li>
                <li class="nav-item"><a  class="nav-link" href="#"><i class="fa fa-wrench"></i>Other Settings</a></li>
            </ul>
        </li>



        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="fa fa-file-text-o"></i> Posts
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('adminpostlist')); ?>"><i class="fa fa-file-text-o"></i>List All Posts</a></li>
                <li class="nav-item"><a  class="nav-link" href="<?php echo e(route('adminpostcreate')); ?>"><i class="fa fa-file-text-o"></i>Add new Post</a></li>
            </ul>
        </li>



        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="fa fa-user-circle-o"></i> Users
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-user-circle-o"></i>Action</a></li>
                <li class="nav-item"><a  class="nav-link" href="#"><i class="fa fa-user-circle-o"></i>Another action</a></li>
            </ul>
        </li>



        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="fa fa-picture-o"></i> Media
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('adminmedialist')); ?>"><i class="fa fa-picture-o"></i>List All Media</a></li>
                <li class="nav-item"><a  class="nav-link" href="<?php echo e(route('adminmediaadd')); ?>"><i class="fa fa-picture-o"></i>Add New Media</a></li>
            </ul>
        </li>



        <li class="nav-item nav-dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user-o"></i> <?php echo e(Auth::user()->name); ?>

            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout <i class="fa fa-sign-out"></i>
                </a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                </form>
            </div>
        </li>

        <li class="divider"></li>
        <li class="nav-title">
            Extras
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-folder-open-o"></i> Pages</a>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link" href="pages-login.html" target="_top"><i class="icon-star"></i> Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages-register.html" target="_top"><i class="icon-star"></i> Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages-404.html" target="_top"><i class="icon-star"></i> Error 404</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages-500.html" target="_top"><i class="icon-star"></i> Error 500</a>
                </li>
            </ul>
        </li>

        <?php endif; ?>
    </ul>

</nav>
