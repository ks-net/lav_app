<?php
/*
 *  File:edit.blade.php  encoding:UTF-8
 *  Created at 01-13-2018 (mm/dd/yyyy) 02:19:10
 *  Belongs to project:lav_app
 *  Copyright © 2018  @KSNET.
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
        <li class="breadcrumb-item active"><?php echo mb_convert_case(trans('common.edit_post'), MB_CASE_TITLE, 'UTF-8'); ?></li>
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
            <div class="card-header"><i class="fa fa-edit"></i> <?php echo mb_convert_case(trans('common.edit_post'), MB_CASE_TITLE, 'UTF-8'); ?></div>
            <div class="card-body">

                <nav class="nav mb-3 justify-content-center justify-content-md-end">
                    <a href="<?php echo e(route('adminpostlist')); ?>" class="btn btn-danger"><?php echo mb_strtoupper(mb_substr(trans('common.back_to'), 0, 1)).mb_strtolower(mb_substr(trans('common.back_to'), 1)); ?> <?php echo mb_convert_case(trans('common.post_list'), MB_CASE_TITLE, 'UTF-8'); ?> <i class="fa fa-sign-out"></i></a>
                </nav>

                <!-- Button trigger modal -->
                <button type="button" data-remote="<?php echo e(route('modal')); ?>" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Launch demo modal
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ....
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End  modal -->


                <!-- START ADD FORM  -->
                <form action="<?php echo e(route('adminpostupdate', $post->id)); ?>" method="post" enctype="multipart/form-data">

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

                    <?php echo e(method_field('PUT')); ?>

                    <div class="form-group">
                        <select class="form-control<?php echo e($errors->has('active') ? ' is-invalid' : ''); ?>" id="active" name="active">
                            <option value="0" <?php if(old('active' , $post->active) == '0'): ?> selected="selected" <?php endif; ?>><?php echo mb_convert_case(trans('common.unpublished'), MB_CASE_TITLE, 'UTF-8'); ?></option>
                            <option value="1" <?php if(old('active' , $post->active) == '1'): ?> selected="selected" <?php endif; ?>><?php echo mb_convert_case(trans('common.published'), MB_CASE_TITLE, 'UTF-8'); ?></option>
                        </select>
                        <?php if($errors->has('active')): ?>
                        <small class="form-text<?php echo e($errors->has('active') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('active')); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
<?php echo e($post->user_id); ?>

                    </div>

                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('title') ? ' text-danger' : ''); ?>" for="title"><?php echo mb_convert_case(trans('common.title'), MB_CASE_TITLE, 'UTF-8'); ?></label>
                        <input type="text" class="form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>" id="title" name="title" placeholder="<?php echo mb_convert_case(trans('common.title'), MB_CASE_TITLE, 'UTF-8'); ?>" value="<?php echo e(old('title' , $post->title)); ?>">
                        <?php if($errors->has('title')): ?>
                        <small class="form-text<?php echo e($errors->has('title') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('title')); ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('seotitle') ? ' text-danger' : ''); ?>" for="seotitle"><?php echo mb_convert_case(trans('common.seotitle'), MB_CASE_TITLE, 'UTF-8'); ?></label>
                        <input type="text" class="form-control<?php echo e($errors->has('seotitle') ? ' is-invalid' : ''); ?>" id="seotitle" name="seotitle" placeholder="<?php echo mb_convert_case(trans('common.seotitle'), MB_CASE_TITLE, 'UTF-8'); ?>" value="<?php echo e(old('seotitle' , $post->seotitle)); ?>">
                        <?php if($errors->has('seotitle')): ?>
                        <small class="form-text<?php echo e($errors->has('seotitle') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('seotitle')); ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('main_img') ? ' text-danger' : ''); ?>" for="main_img"><?php echo mb_convert_case(trans('common.main_image'), MB_CASE_TITLE, 'UTF-8'); ?></label>
                        <input type="file" class="form-control<?php echo e($errors->has('main_img') ? ' is-invalid' : ''); ?>" name="main_img" id="main_img" value="<?php echo e(old('main_img' , $post->main_img)); ?>">
                        <?php if($errors->has('main_img')): ?>
                        <small class="form-text<?php echo e($errors->has('main_img') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('main_img')); ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('sortdesc') ? ' text-danger' : ''); ?>" for="sortdesc"><?php echo mb_convert_case(trans('common.sortdesc'), MB_CASE_TITLE, 'UTF-8'); ?></label>
                        <textarea class="form-control<?php echo e($errors->has('sortdesc') ? ' is-invalid' : ''); ?>" id="sortdesc" name="sortdesc" placeholder="<?php echo mb_convert_case(trans('common.sortdesc'), MB_CASE_TITLE, 'UTF-8'); ?>"><?php echo e(old('sortdesc' , $post->sortdesc)); ?></textarea>
                        <?php if($errors->has('sortdesc')): ?>
                        <small class="form-text<?php echo e($errors->has('sortdesc') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('sortdesc')); ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('postbody') ? ' text-danger' : ''); ?>" for="postbody"><?php echo mb_convert_case(trans('common.text_area'), MB_CASE_TITLE, 'UTF-8'); ?></label>
                        <textarea class="form-control<?php echo e($errors->has('postbody') ? ' is-invalid' : ''); ?>" id="postbody" name="postbody" placeholder="<?php echo mb_convert_case(trans('common.text_area'), MB_CASE_TITLE, 'UTF-8'); ?>"><?php echo e(old('postbody' , $post->postbody)); ?></textarea>
                        <?php if($errors->has('postbody')): ?>
                        <small class="form-text<?php echo e($errors->has('postbody') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('postbody')); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('tags') ? ' text-danger' : ''); ?>" for="tags"><?php echo mb_convert_case(trans('common.tags'), MB_CASE_TITLE, 'UTF-8'); ?></label>

                        

                        <?php

                        $class = 'form-control' ;

                        if($errors->has('tags')){
                        $class = 'form-control is-invalid' ;
                        }

                        if (old('tags')) {

                        echo '<input type="text" class="'.$class.'" name="tags" id="tags" value="'. old('tags') .'">';

                        } elseif  (count($tags) > 0) {

                        $savedtags = array();

                        foreach($tags as $tag) {
                        $savedtags[] = $tag ;
                        }

                        $savedtags = implode(',', $savedtags) ;

                        echo '<input type="text" class="'.$class.'" name="tags" id="tags" value="'. $savedtags .'">';
                        } else {
                        echo '<input type="text" class="'.$class.'" name="tags" id="tags" value="">';
                        }

                        ?>

                        

                        <?php if($errors->has('tags')): ?>
                        <small class="form-text<?php echo e($errors->has('tags') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('tags')); ?></small>
                        <?php endif; ?>
                        <small class="form-text text-muted"><?php echo app('translator')->getFromJson('common.tags_help'); ?></small>
                    </div>

                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('metatitle') ? ' text-danger' : ''); ?>" for="metatitle"><?php echo mb_convert_case(trans('common.metatitle'), MB_CASE_TITLE, 'UTF-8'); ?></label>
                        <input type="text" class="form-control<?php echo e($errors->has('metatitle') ? ' is-invalid' : ''); ?>" id="metatitle" name="metatitle" placeholder="<?php echo mb_convert_case(trans('common.metatitle'), MB_CASE_TITLE, 'UTF-8'); ?>" value="<?php echo e(old('metatitle' , $post->metatitle)); ?>">
                        <?php if($errors->has('metatitle')): ?>
                        <small class="form-text<?php echo e($errors->has('metatitle') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('metatitle')); ?></small>
                        <?php endif; ?>
                        <small class="form-text text-muted"><?php echo app('translator')->getFromJson('common.metatitle_help'); ?></small>
                    </div>
                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('metadesc') ? ' text-danger' : ''); ?>" for="metadesc"><?php echo mb_convert_case(trans('common.metadesc'), MB_CASE_TITLE, 'UTF-8'); ?></label>
                        <textarea class="form-control<?php echo e($errors->has('metadesc') ? ' is-invalid' : ''); ?>" id="metadesc" name="metadesc" placeholder="<?php echo mb_convert_case(trans('common.metadesc'), MB_CASE_TITLE, 'UTF-8'); ?>"><?php echo e(old('metadesc' , $post->metadesc)); ?></textarea>
                        <?php if($errors->has('metadesc')): ?>
                        <small class="form-text<?php echo e($errors->has('metadesc') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('metadesc')); ?></small>
                        <?php endif; ?>
                        <small class="form-text text-muted"><?php echo app('translator')->getFromJson('common.metadesc_help'); ?></small>
                    </div>
                    <div class="form-group">
                        <label class="text-primary<?php echo e($errors->has('metakeywords') ? ' text-danger' : ''); ?>" for="metakeywords"><?php echo mb_convert_case(trans('common.metakeywords'), MB_CASE_TITLE, 'UTF-8'); ?></label>
                        <input type="text" class="form-control<?php echo e($errors->has('metakeywords') ? ' is-invalid' : ''); ?>" id="metakeywords" name="metakeywords" placeholder="<?php echo mb_convert_case(trans('common.metakeywords'), MB_CASE_TITLE, 'UTF-8'); ?>" value="<?php echo e(old('metakeywords' , $post->metakeywords)); ?>">
                        <?php if($errors->has('metakeywords')): ?>
                        <small class="form-text<?php echo e($errors->has('metakeywords') ? ' text-danger' : ''); ?>"><?php echo e($errors->first('metakeywords')); ?></small>
                        <?php endif; ?>
                        <small class="form-text text-muted"><?php echo app('translator')->getFromJson('common.metakeywords_help'); ?></small>
                    </div>

                    <nav class="nav mb-3 justify-content-center justify-content-md-start">
                        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo mb_convert_case(trans('common.save'), MB_CASE_TITLE, 'UTF-8'); ?></button>
                    </nav>

                </form>
                <!-- END ADD FORM  -->

            </div>
        </div> <!-- Card END -->

    </div>
</div>
<!-- Row END -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('bottom-scripts'); ?>
<script src="<?php echo e(asset('js/ckeditor/ckeditor.js')); ?>"></script>


<script>
CKEDITOR.replace('postbody', {
    customConfig: 'config.js'
});</script>

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
    });</script>

<script>
    var tags = [
            <?php $__currentLoopData = $modeltags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modeltag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    {
    tag: "<?php echo e($modeltag); ?>"
    }
    ,
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    ];
</script>

<script>
    $('body').on('click', '[data-toggle="modal"]', function () {
        $($(this).data("target") + ' .modal-body').load($(this).data("remote"));



    });


</script>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>