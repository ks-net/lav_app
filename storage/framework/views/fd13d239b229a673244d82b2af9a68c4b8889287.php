<?php
/*
 *  File:settings.blade.php  encoding:UTF-8
 *  Created at 01-17-2018 (mm/dd/yyyy) 17:21:03
 *  Belongs to project:lav_app
 *  Copyright © 2018  @KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */
?>



<?php $__env->startSection('breadcrumbs'); ?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-list-alt"></i> <a href="<?php echo e(route('admin')); ?>"><?php echo e(__('common.admin_dashboard')); ?></a></li>
    <li class="breadcrumb-item active"><?php echo mb_strtoupper(mb_substr(trans('common.settings'), 0, 1)).mb_strtolower(mb_substr(trans('common.settings'), 1)); ?></li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col">

        <!-- flash Messages Start -->
        <?php if(Session::has('flash_message')): ?>
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-info-circle"></i> <?php echo e(Session::get('flash_message')); ?>

        </div>
        <?php endif; ?>
        <?php if(Session::has('flash_message_success')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-check-circle"></i> <?php echo e(Session::get('flash_message_success')); ?>

        </div>
        <?php endif; ?>
        <?php if(Session::has('flash_message_warning')): ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-exclamation-triangle"></i> <?php echo e(Session::get('flash_message_warning')); ?>

        </div>
        <?php endif; ?>
        <?php if(Session::has('flash_message_error')): ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> <?php echo e(Session::get('flash_message_error')); ?></div>
        <?php endif; ?>
        <!-- flash Messages End -->

        <div class="card">
            <div class="card-header"><i class="fa fa-cogs"></i> <?php echo mb_strtoupper(mb_substr(trans('common.settings'), 0, 1)).mb_strtolower(mb_substr(trans('common.settings'), 1)); ?></div>
            <div class="card-body">

                <?php if(count($settings) === 0): ?>
                <div class="alert alert-warning">
                    <i class="fa fa-exclamation-triangle"></i> &nbsp;
                    <?php echo e(__('common.no_records_found')); ?>

                </div>
                <?php endif; ?>

                <!-- START ADD FORM  -->
                <form action="<?php echo e(route('adminsettingsupdate')); ?>" method="post" >

                    <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0 pl-2">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php echo csrf_field(); ?>

                    <?php echo e(method_field('PUT')); ?>

                    <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has($setting->name) ? ' text-danger' : ''); ?>" for="<?php echo e($setting->name); ?>"><?php echo e($setting->name); ?></label>
                        <input type="text" class="form-control<?php echo e($errors->has($setting->name) ? ' is-invalid' : ''); ?>" id="<?php echo e($setting->name); ?>" name="<?php echo e($setting->name); ?>"  value="<?php echo e(old($setting->name , $setting->value)); ?>">
                        <?php if(Lang::has('common.'.$setting->name.'_help')): ?>
                        <small class="form-text text-muted"><?php echo app('translator')->getFromJson('common.'.$setting->name.'_help'); ?></small>
                        <?php endif; ?>
                        <?php if($errors->has($setting->name)): ?>
                        <small class="form-text<?php echo e($errors->has($setting->name) ? ' text-danger' : ''); ?>"><?php echo e($errors->first($setting->name)); ?></small>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
                <!-- END  FORM  -->
            </div>

            <div class="card-footer">
                ...
            </div>
        </div> <!-- Card  End -->

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>