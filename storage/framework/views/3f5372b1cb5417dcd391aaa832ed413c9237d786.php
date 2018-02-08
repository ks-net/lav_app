<?php
/*
 *  File:post.list.blade.php part-of-project:lav_app encoding:UTF-8
 *  Last Modified at 7 Ιαν 2018 3:11:29 πμ.
 *  NOTE: COMMERCIAL LICENSE.. !
 *  Copyright 2018 KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */
?>

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
            <div class="card-header"><i class="fa fa-copy"></i> <?php echo mb_convert_case(trans('common.post_list'), MB_CASE_TITLE, 'UTF-8'); ?></div>
            <div class="card-body">
                <nav class="nav mb-3 justify-content-center justify-content-md-start">
                    <a href="<?php echo e(route('adminpostcreate')); ?>" class="btn btn-success d-md-inline">
                        <?php echo mb_convert_case(trans('common.create_new_post'), MB_CASE_TITLE, 'UTF-8'); ?>
                        <i class="fa fa-plus-circle"></i>
                    </a>
                </nav>

                <form action="<?php echo e(route('adminpostsearch')); ?>" method="get" name="search">
                    <?php echo csrf_field(); ?>

                    <div class="form-row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group<?php echo e($errors->has('search') ? ' has-error' : ''); ?>">
                                <input type="text" class="form-control" id="search" name="search" placeholder="search" value="<?php if(isset($search)): ?> <?php echo e($search); ?> <?php endif; ?>">
                                <?php if($errors->has('search')): ?>
                                <span class="help-block"><?php echo e($errors->first('search')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 text-center text-md-left">
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-search"></i> <?php echo mb_convert_case(trans('common.search'), MB_CASE_TITLE, 'UTF-8'); ?>
                            </button>
                            <a href="<?php echo e(route('adminpostlist')); ?>"  class="btn btn-light ">
                                <?php echo mb_convert_case(trans('common.clear'), MB_CASE_TITLE, 'UTF-8'); ?> <i class="fa fa-magic"></i>
                            </a>
                        </div>
                    </div>
                </form>

                <?php if(count($posts) === 0): ?>
                <div class="alert alert-warning">
                    <i class="fa fa-exclamation-triangle"></i> &nbsp;
                    <?php echo mb_convert_case(trans('common.no_records_found'), MB_CASE_TITLE, 'UTF-8'); ?>
                </div>
                <?php else: ?>
                <div class="row">
                    <div class="col-md-6 col-sm-12 p-2  text-center text-md-left">
                        <span class="badge badge-secondary"><?php echo e($posts->total()); ?></span> <span class=""><?php echo mb_convert_case(trans('common.total_posts'), MB_CASE_TITLE, 'UTF-8'); ?></span>
                    </div>
                    <div class="col-md-6 col-sm-12  text-right">
                        <form action="<?php echo e(route('adminpostdeletemany')); ?>" method="post" name="deletechecked" id="deletechecked">
                            <?php echo csrf_field(); ?>

                            <?php echo e(method_field('DELETE')); ?>

                            <button type="submit" class="btn  btn-sm btn-default d-none d-md-inline " onclick="return confirm('<?php echo e(__('common.confirm_delete_checked_records')); ?>')">
                                <i class="fa fa-times-circle"></i> <?php echo mb_convert_case(trans('common.delete_checked'), MB_CASE_TITLE, 'UTF-8'); ?>
                            </button>
                        </form>
                    </div>
                    <div class="d-none d-md-block">
                        <div class="d-inline"><?php echo e($posts->appends(\Request::except('page'))->render('resources.vendor.pagination.table-top-bootstrap-4')); ?></div>
                        <div class="small d-none d-sm-inline-block">
                            (<?php echo e(__('pagination.page')); ?> <?php echo e($posts->currentPage()); ?> <?php echo e(__('pagination.page_from')); ?> <?php echo e($posts->lastPage()); ?> <?php echo e(__('pagination.pages')); ?>)
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <?php if(count($posts) > 0): ?>
            <!-- Table -->
            <table class="table table-hover table-striped" style="background:#fff;">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="d-none d-md-table-cell">
                            <input  type="checkbox" class="" id="checkall">
                        </th>
                        <th scope="col" class="d-none d-sm-table-cell">
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('id', 'Id'));?>
                        </th>
                        <th scope="col">
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('title', __('common.short_title')));?>
                        </th>
                        <th scope="col">
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('active', __('common.short_active')));?>
                        </th>
                        <th scope="col" class="d-none d-md-table-cell">
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('created_at', __('common.short_created_at')));?>
                        </th>
                        <th scope="col" class="d-none d-md-table-cell">
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('updated_at', __('common.short_updated_at')));?>
                        </th>
                        <th scope="col">
                            <?php echo app('translator')->getFromJson('common.short_actions'); ?>
                        </th>
                </thead>
                </tr>

                <tbody>
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="d-none d-md-table-cell">
                            <input class="deletechecked" type="checkbox" form="deletechecked" name="deletechecked[]" value="<?php echo e($post->id); ?>">
                        </td>
                        <th scope="row" class="d-none d-sm-table-cell">
                            <span class=" "><?php echo e($post->id); ?></span>
                        </th>
                        <td style="border-left:1px dashed #ddd;max-width:640px;">
                            <span class="<?php echo e($post->active === 1 ? '' : 'gray-out'); ?>">
                                <?php echo e(str_limit($post->title , config('settings.admin_title_trim') , '...')); ?>

                            </span>
                        </td>
                        <td class="text-center">
                            <span class=" ">
                                <i class="fa <?php echo e($post->active === 1 ? 'fa-check' : 'fa-eye-slash gray-out'); ?>"></i>
                            </span>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="small <?php echo e($post->active === 1 ? '' : 'gray-out'); ?>"><?php echo e($post->created_at); ?></span>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="small <?php echo e($post->active === 1 ? '' : 'gray-out'); ?>"><?php echo e($post->updated_at); ?></span>
                        </td>
                        <td class="text-center">
                            <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block"
                               href="<?php echo e(route('adminpostedit', $post->id)); ?>"
                               title="<?php echo mb_convert_case(trans('common.edit'), MB_CASE_TITLE, 'UTF-8'); ?>">
                                <i class="fa fa-pencil"></i>
                            </a> &nbsp;
                            <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block"
                               href="<?php echo e(url('post/'.$post->seotitle)); ?>"
                               title="<?php echo mb_convert_case(trans('common.display'), MB_CASE_TITLE, 'UTF-8'); ?>">
                                <i class="fa fa-eye"></i>
                            </a> &nbsp;
                            <form name="deletepost<?php echo e($post->id); ?>" action="<?php echo e(route('adminpostdelete', $post->id)); ?>" method="post" style="display:none;">
                                <?php echo csrf_field(); ?>

                                <?php echo e(method_field('DELETE')); ?>

                            </form>
                            <a class="visible-lg-inline visible-md-inline visible-sm-inline visible-xs-block"
                               onclick="if (confirm('<?php echo e(__('common.confirm_delete_record')); ?>: <?php echo e($post->id); ?>?')){ document.deletepost<?php echo e($post->id); ?>.submit(); }"
                               href="#"
                               title="<?php echo mb_convert_case(trans('common.delete'), MB_CASE_TITLE, 'UTF-8'); ?>">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php endif; ?>

            <?php if($posts->total() > $posts->perPage()): ?>
            <div class="card-footer">
                <?php echo e($posts->appends(\Request::except('page'))->render('resources.vendor.pagination.bootstrap-4')); ?>

            </div>
            <?php endif; ?>

        </div> <!-- Panel End -->

    </div>
</div>

<?php $__env->startPush('bottom-scripts'); ?>
<?php $__env->stopPush(); ?>


<script>
$(document).ready(function() {

        $("#checkall").change(function() {
            if($(this).on(":checked")) {
        var checkBoxes = $("input[name=deletechecked\\[\\]]");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
            }

            if ($('input.deletechecked').is(':checked')) {
                $('input.deletechecked').parent().parent().addClass('table-warning');
            }else {
                $('input.deletechecked').parent().parent().removeClass('table-warning');
            }

        });

    $('input.deletechecked').change(function(){
        if($(this).is(":checked")) {
            $(this).parent().parent().addClass('table-warning');
        } else {
            $(this).parent().parent().removeClass('table-warning');
        }
    });

 });
</script>

<script>
    $('a.page-link').on('click', function (event) {
    event.preventDefault();
    var page = $(this).attr('href');
    console.log(page);
    alert('hai');
});
</script>





