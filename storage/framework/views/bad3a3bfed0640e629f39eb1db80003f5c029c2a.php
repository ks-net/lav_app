<?php
/*
 *  File:blog.blade.php part-of-project:lav_app encoding:UTF-8
 *  Last Modified at 28 Δεκ 2017 11:23:02 μμ.
 *  NOTE: COMMERCIAL LICENSE.. !
 *  Copyright 2017 KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */
?>



<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            <?php if(Session::has('flash_message')): ?>
            <div class="alert alert-success"><i class="fas fa-info-circle"></i> <?php echo e(Session::get('flash_message')); ?></div>
            <?php endif; ?>


            <div class="panel panel-default">
                <div class="panel-heading" style="font-weight: 300;"><i class="fas fa-caret-right"></i> Αυτή θα είναι η λίστα με τα άρθρα -> post list layout
                    <ul>
                        <li>PAGINATION SETTING= <b><?php echo e(config('settings.public_pagination')); ?></b></li>
                        <li>CACHETIME SETTING= <b><?php echo e(config('settings.cachetime')); ?></b></li>
                    </ul>
                </div>

                <div class="panel-body">
                    <?php if(session('status')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('status')); ?>

                    </div>
                    <?php endif; ?>
                    <h3><i class="fas fa-th-list"></i> ΛΙΣΤΑ ΑΡΘΡΩΝ - Αγγλικός Τίτλος:  LIST-ALL-POSTS BLADE VIEW</h3>
                    <a href="<?php echo e(route('adminpostcreate')); ?>" class="btn btn-success"> Create New Post <i class="fas fa-plus-circle"></i></a>
                    <a href="<?php echo e(url('post/')); ?>" class="btn btn-default"> Posts Index Page <i class="fas fa-share"></i></a>
                    <a href="<?php echo e(route('adminpostlist')); ?>" class="btn btn-danger"> Posts List Page <i class="fas fa-share"></i></a>
                    <hr/>

                    <?php if(isset($posts)): ?>
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <ul>
                        <li><b>ID</b>= <?php echo e($post->id); ?></li>
                        <li><b><?php echo e(__('common.Title')); ?> </b>= <span style="color:#3097D1;text-transform:uppercase;font-weight:700;">
                                <a href="<?php echo e(url('post/'.$post->seotitle)); ?>"><?php echo e(str_limit($post->title , config('settings.frontend_title_trim') , '...')); ?></a>
                            </span>
                        </li>
                    </ul>
                    <?php if($post->main_img): ?>
                    <img class="img-responsive center-block" src="<?php echo e(asset($post->medium_img)); ?>" />
                    <?php endif; ?>
                    <ul>
                        <li><b><?php echo e(__('common.Sortdesc')); ?></b>= <?php echo e(str_limit($post->sortdesc , config('settings.frontend_desc_trim') , '...')); ?></li>

                        <li><b>METATITLE</b>= <?php echo e($post->metatitle); ?></li>
                        <li><b>METAKEYWORDS</b>= <?php echo e($post->metakeywords); ?></li>
                        <li><b>METADESC</b>= <?php echo e($post->metadesc); ?></li>
                        <li><b>TAGS</b>=  </li>
                        <li><b>SEOTITLE</b>= <span style="color:#2AB27B;font-style:italic;"><a href="<?php echo e(url('post/'.$post->seotitle)); ?>"><?php echo e($post->seotitle); ?></a></span></li>
                        <li><b>ACTIVE</b>= <?php echo e($post->active); ?></li>
                        <li><b>CREATED_AT</b>= <?php echo e($post->created_at); ?></li>
                        <li><b>UPDATED_AT</b>= <?php echo e($post->updated_at); ?></li>
                    </ul>
                    <hr/>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($posts->links()); ?>

                    <?php endif; ?>

                    <?php if(empty($posts)): ?>
                    NO POSTS YET
                    <?php endif; ?>

                    <?php if(count($posts) === 0): ?>
                    I don't have any records!
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>