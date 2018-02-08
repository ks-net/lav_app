<?php
/*
 *  File:postadd.blade.php part-of-project:lav_app encoding:UTF-8
 *  Last Modified at 29 Δεκ 2017 9:18:26 μμ.
 *  NOTE: COMMERCIAL LICENSE.. !
 *  Copyright 2017 KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */
?>



<?php $__env->startSection('breadcrumbs'); ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-list-alt"></i> <a href="<?php echo e(route('admin')); ?>"><?php echo mb_convert_case(trans('common.admin_dashboard'), MB_CASE_TITLE, 'UTF-8'); ?></a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('adminpostlist')); ?>"><?php echo mb_convert_case(trans('common.post_list'), MB_CASE_TITLE, 'UTF-8'); ?></a></li>
        <li class="breadcrumb-item active"><?php echo mb_convert_case(trans('common.create_new_post'), MB_CASE_TITLE, 'UTF-8'); ?></li>
    </ol>
</nav>
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
            <div class="card-header"><i class="fa fa-plus-square"></i> <?php echo mb_convert_case(trans('common.create_new_post'), MB_CASE_TITLE, 'UTF-8'); ?></div>
            <div class="card-body">

                <nav class="nav mb-3 justify-content-center justify-content-md-end">
                    <a href="<?php echo e(route('adminpostlist')); ?>" class="btn btn-danger"><?php echo mb_strtoupper(mb_substr(trans('common.back_to'), 0, 1)).mb_strtolower(mb_substr(trans('common.back_to'), 1)); ?> <?php echo mb_convert_case(trans('common.post_list'), MB_CASE_TITLE, 'UTF-8'); ?> <i class="fa fa-sign-out"></i></a>
                </nav>

                <!-- START ADD FORM  -->
                <form action="<?php echo e(route('adminpostcreate')); ?>" method="post" enctype="multipart/form-data">

                    <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0  pl-2">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <select class="form-control<?php echo e($errors->has('active') ? ' is-invalid' : ''); ?>" id="active" name="active">
                            <option value="0" <?php if(old('active') == '0'): ?> selected="selected" <?php endif; ?>><?php echo mb_convert_case(trans('common.unpublished'), MB_CASE_TITLE, 'UTF-8'); ?></option>
                            <option value="1" <?php if(old('active') == '1'): ?> selected="selected" <?php endif; ?>><?php echo mb_convert_case(trans('common.published'), MB_CASE_TITLE, 'UTF-8'); ?></option>
                        </select>
                        <?php if($errors->has('active')): ?>
                        <span class="form-text<?php echo e($errors->has('active') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('active')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('title') ? ' text-danger' : ''); ?>" for="title"><?php echo mb_convert_case(trans('common.title'), MB_CASE_TITLE, 'UTF-8'); ?></label>
                        <input type="text" class="form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>" id="title" name="title" placeholder="<?php echo mb_convert_case(trans('common.title'), MB_CASE_TITLE, 'UTF-8'); ?>" value="<?php echo e(old('title')); ?>">
                        <?php if($errors->has('title')): ?>
                        <span class="form-text<?php echo e($errors->has('title') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('title')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('seotitle') ? ' text-danger' : ''); ?>" for="seotitle"><?php echo mb_convert_case(trans('common.seotitle'), MB_CASE_TITLE, 'UTF-8'); ?></label>
                        <input type="text" class="form-control<?php echo e($errors->has('seotitle') ? ' is-invalid' : ''); ?>" id="seotitle" name="seotitle" placeholder="<?php echo mb_convert_case(trans('common.seotitle'), MB_CASE_TITLE, 'UTF-8'); ?>" value="<?php echo e(old('seotitle')); ?>">
                        <?php if($errors->has('seotitle')): ?>
                        <span class="form-text<?php echo e($errors->has('seotitle') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('seotitle')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('main_img') ? ' text-danger' : ''); ?>" for="main_img"><?php echo mb_convert_case(trans('common.main_image'), MB_CASE_TITLE, 'UTF-8'); ?></label>
                        <input type="file" class="form-control<?php echo e($errors->has('main_img') ? ' is-invalid' : ''); ?>" name="main_img" id="main_img" value="<?php echo e(old('main_img')); ?>">
                        <?php if($errors->has('main_img')): ?>
                        <span class="form-text<?php echo e($errors->has('main_img') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('main_img')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('sortdesc') ? ' text-danger' : ''); ?>" for="sortdesc"><?php echo mb_convert_case(trans('common.sortdesc'), MB_CASE_TITLE, 'UTF-8'); ?></label>
                        <textarea class="form-control<?php echo e($errors->has('sortdesc') ? ' is-invalid' : ''); ?>" id="sortdesc" name="sortdesc" placeholder="<?php echo mb_convert_case(trans('common.sortdesc'), MB_CASE_TITLE, 'UTF-8'); ?>"><?php echo e(old('sortdesc')); ?></textarea>
                        <?php if($errors->has('sortdesc')): ?>
                        <span class="form-text<?php echo e($errors->has('sortdesc') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('sortdesc')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('postbody') ? ' text-danger' : ''); ?>" for="postbody"><?php echo mb_convert_case(trans('common.text_area'), MB_CASE_TITLE, 'UTF-8'); ?></label>
                        <textarea class="form-control<?php echo e($errors->has('postbody') ? ' is-invalid' : ''); ?>" id="postbody" name="postbody" placeholder="<?php echo mb_convert_case(trans('common.text_area'), MB_CASE_TITLE, 'UTF-8'); ?>"><?php echo e(old('postbody')); ?></textarea>
                        <?php if($errors->has('postbody')): ?>
                        <span class="form-text<?php echo e($errors->has('postbody') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('postbody')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('tags') ? ' text-danger' : ''); ?>" for="tags"><?php echo mb_convert_case(trans('common.tags'), MB_CASE_TITLE, 'UTF-8'); ?></label>
                        <input type="text" class="form-control<?php echo e($errors->has('tags') ? ' is-invalid' : ''); ?>" name="tags" id="tags" value="<?php echo e(old('tags')); ?>">
                        <?php if($errors->has('tags')): ?>
                        <span class="form-text<?php echo e($errors->has('tags') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('tags')); ?></span>
                        <?php endif; ?>
                        <span class="form-text text-muted"><?php echo app('translator')->getFromJson('common.tags_help'); ?></span>
                    </div>
                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('metatitle') ? ' text-danger' : ''); ?>" for="metatitle"><?php echo mb_convert_case(trans('common.metatitle'), MB_CASE_TITLE, 'UTF-8'); ?></label>
                        <input type="text" class="form-control<?php echo e($errors->has('metatitle') ? ' is-invalid' : ''); ?>" id="metatitle" name="metatitle" placeholder="<?php echo mb_convert_case(trans('common.metatitle'), MB_CASE_TITLE, 'UTF-8'); ?>" value="<?php echo e(old('metatitle')); ?>">
                        <?php if($errors->has('metatitle')): ?>
                        <span class="form-text<?php echo e($errors->has('metatitle') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('metatitle')); ?></span>
                        <?php endif; ?>
                        <span class="form-text text-muted"><?php echo app('translator')->getFromJson('common.metatitle_help'); ?></span>
                    </div>
                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('metadesc') ? ' text-danger' : ''); ?>" for="metadesc"><?php echo mb_convert_case(trans('common.metadesc'), MB_CASE_TITLE, 'UTF-8'); ?></label>
                        <textarea class="form-control<?php echo e($errors->has('metadesc') ? ' is-invalid' : ''); ?>" id="metadesc" name="metadesc" placeholder="<?php echo mb_convert_case(trans('common.metadesc'), MB_CASE_TITLE, 'UTF-8'); ?>"><?php echo e(old('metadesc')); ?></textarea>
                        <?php if($errors->has('metadesc')): ?>
                        <span class="form-text<?php echo e($errors->has('metadesc') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('metadesc')); ?></span>
                        <?php endif; ?>
                        <span class="form-text text-muted"><?php echo app('translator')->getFromJson('common.metadesc_help'); ?></span>
                    </div>
                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('metakeywords') ? ' text-danger' : ''); ?>" for="metakeywords"><?php echo mb_convert_case(trans('common.metakeywords'), MB_CASE_TITLE, 'UTF-8'); ?></label>
                        <input type="text" class="form-control<?php echo e($errors->has('metakeywords') ? ' is-invalid' : ''); ?>" id="metakeywords" name="metakeywords" placeholder="<?php echo mb_convert_case(trans('common.metakeywords'), MB_CASE_TITLE, 'UTF-8'); ?>" value="<?php echo e(old('metakeywords')); ?>">
                        <?php if($errors->has('metakeywords')): ?>
                        <span class="form-text<?php echo e($errors->has('metakeywords') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('metakeywords')); ?></span>
                        <?php endif; ?>
                        <span class="form-text text-muted"><?php echo app('translator')->getFromJson('common.metakeywords_help'); ?></span>
                    </div>

                    <nav class="nav mb-3 justify-content-center justify-content-md-start">
                        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo mb_convert_case(trans('common.save'), MB_CASE_TITLE, 'UTF-8'); ?></button>
                    </nav>

                </form>
                <!-- END ADD FORM  -->

            </div>
        </div> <!-- card END -->

    </div>
</div>
<!-- container END -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('bottom-scripts'); ?>
<script src="<?php echo e(asset('js/ckeditor/ckeditor.js')); ?>"></script>
<script>
CKEDITOR.replace('postbody', {
    customConfig: 'config.js'
});
</script>

<script>
    $(document).ready(function () {
        $('#tags').selectize({
            delimiter: ',',
            persist: false,
            valueField: 'tag',
            labelField: 'tag',
            searchField: 'tag',
            options: tags,
            maxItems: 10,
            maxOptions: 100,
            plugins: ['remove_button'],
            create: function (input) {
                return {
                    tag: input
                }
            }
        });
    });
</script>

<script>
    var tags = [
            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    {
    tag: "<?php echo e($tag); ?>"
    }
    ,
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    ];
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>