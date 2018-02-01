<?php

/*
 *  File:table-top-bootstrap-4.blade.php  encoding:UTF-8
 *  Created at 01-23-2018 (mm/dd/yyyy) 19:36:44
 *  Belongs to project:lav_app
 *  Copyright © 2018  @KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */
?>

<?php if($paginator->hasPages()): ?>

        
        <?php if($paginator->onFirstPage()): ?>
            <span class="btn btn-sm btn-light disabled cursor-disabled"><?php echo app('translator')->getFromJson('pagination.previous_page'); ?></span>
        <?php else: ?>
        <a class="btn btn-sm btn-light" href="<?php echo e($paginator->url(1)); ?>" rel="first"  title="<?php echo app('translator')->getFromJson('pagination.first_page'); ?>">
            <i class="fa fa-backward text-muted"></i> <span class="d-none d-md-inline"><?php echo app('translator')->getFromJson('pagination.first_page'); ?></span>
        </a>
            <a class="btn btn-sm btn-light" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev"><?php echo app('translator')->getFromJson('pagination.previous_page'); ?></a>
        <?php endif; ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <a class="btn btn-sm btn-light" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next"><?php echo app('translator')->getFromJson('pagination.next_page'); ?></a>
            <a class="btn btn-sm btn-light" href="<?php echo e($paginator->url($paginator->lastPage())); ?>" rel="last" title="<?php echo app('translator')->getFromJson('pagination.last_page'); ?>">
                <span class="d-none d-md-inline"><?php echo app('translator')->getFromJson('pagination.last_page'); ?></span> <i class="fa fa-forward text-muted"></i>
            </a>
        <?php else: ?>
            <span class="btn btn-sm btn-light disabled cursor-disabled"><?php echo app('translator')->getFromJson('pagination.next_page'); ?></span>
        <?php endif; ?>

<?php endif; ?>