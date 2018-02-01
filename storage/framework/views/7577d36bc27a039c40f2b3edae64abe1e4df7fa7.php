<?php
/*
 *  File:media.blade.php  encoding:UTF-8
 *  Created at 01-10-2018 (mm/dd/yyyy) 23:52:10
 *  Belongs to project:lav_app
 *  Copyright © 2018  @KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */
?>




<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12 col-md-offset-0">

            <?php if(Session::has('flash_message')): ?>
            <div class="alert alert-success">
                <i class="fa fa-info-circle"></i> <?php echo e(Session::get('flash_message')); ?>

            </div>
            <?php endif; ?>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading"><i class="fa fa-copy"></i> ALL POSTS LIST</div>
                <div class="panel-body">
                    <div class="well-sm">
                        <a href="<?php echo e(route('adminmediaadd')); ?>" class="btn btn-success">
                            Add New Media
                            <i class="fa fa-plus-circle"></i>
                        </a>
                    </div>
                    <?php if(count($medias) === 0): ?>
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i>
                        <?php echo e(__('common.no_records_found')); ?>

                    </div>
                    <?php endif; ?>
                </div>

                <?php if(count($medias) > 0): ?>
                <!-- Table -->
                <table class="table" style="background:#fff;">
                    <tr class="bg-info">
                        <td class="hidden-xs">
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('id', 'Id'));?>
                        </td>
                        <td>
                            Image
                        </td>
                        <td class="hidden-xs">
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name', trans('common.Name')));?>
                        </td>
                        <td class="text-center">
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('active'));?>
                        </td>
                        <td class="hidden-xs">
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('created_at'));?>
                        </td>
                        <td class="hidden-xs">
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('updated_at'));?>
                        </td>
                        <td class="text-center">
                            Actions
                        </td>
                    </tr>
                    <?php $__currentLoopData = $medias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="hidden-xs">
                            <span class="small"><?php echo e($media->id); ?></span>
                        </td>
                        <td class="">
                            <a href="<?php echo e(asset($media->image)); ?>"  data-fancybox="group" data-caption="<?php echo e($media->name); ?>">
                                <img class="img-thumbnail" src="<?php echo e(asset($media->image_thumb)); ?>" alt="<?php echo e($media->name); ?>" title="<?php echo e($media->name); ?>"/>
                            </a>
                        </td>

                        <td  class="hidden-xs" style="border-left:1px dashed #ddd;max-width:640px;">
                            <div class="small text-success <?php echo e($media->active === 1 ? '' : 'gray-out'); ?>">
                                <?php echo e(str_limit($media->name , config('settings.admin_title_trim') , '...')); ?>

                            </div>
                            <div style="font-style:italic;" class="small <?php echo e($media->active === 1 ? '' : 'gray-out'); ?>">
                                <?php echo e(str_limit($media->image , '120', '...')); ?>

                            </div>
                        </td>
                        <td class="text-center">
                            <span class="small">
                                <i class="material-icons <?php echo e($media->active === 1 ? '' : 'gray-out'); ?>">
                                    <?php echo e($media->active === 1 ? 'check' : 'visibility_off'); ?>

                                </i>
                            </span>
                        </td>
                        <td class="hidden-xs">
                            <span class="small"><?php echo e($media->created_at); ?></span>
                        </td>
                        <td class="hidden-xs">
                            <span class="small"><?php echo e($media->updated_at); ?></span>
                        </td>
                        <td class="text-center">
                            <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block"
                               href="<?php echo e(route('adminmedialist')); ?>">
                                <i class="fa fa-edit"></i>
                            </a> &nbsp;
                            <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block"
                               href="<?php echo e(route('adminmedialist')); ?>">
                                <i class="fa fa-eye"></i>
                            </a> &nbsp;

                            <form name="deletemedia<?php echo e($media->id); ?>" action="<?php echo e(route('adminmediadelete', $media->id)); ?>" method="post" style="display:none;">
                                <?php echo csrf_field(); ?>

                                <?php echo e(method_field('DELETE')); ?>

                            </form>
                            <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block"
                               onclick="if (confirm('<?php echo e(__('common.confirm_delete_record')); ?>: <?php echo e($media->id); ?>?')){ document.deletemedia<?php echo e($media->id); ?>.submit(); }"
                               href="#"
                               title="<?php echo e(__('common.Delete')); ?>">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
                <?php endif; ?>

                <?php if($medias->total() > $medias->perPage()): ?>
                <div class="panel-footer">
                    <?php echo e($medias->appends(\Request::except('page'))->render()); ?>

                </div>
                <?php endif; ?>

            </div> <!-- Panel End -->

        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('bottom-scripts'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>