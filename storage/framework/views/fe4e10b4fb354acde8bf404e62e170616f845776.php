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



<?php $__env->startSection('breadcrumbs'); ?>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-list-alt"></i> <a href="<?php echo e(route('admin')); ?>"><?php echo mb_convert_case(trans('common.admin_dashboard'), MB_CASE_TITLE, 'UTF-8'); ?></a>
        </li>
        <li class="breadcrumb-item active"><?php echo mb_convert_case(trans('common.post_list'), MB_CASE_TITLE, 'UTF-8'); ?></li>
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
            <div class="card-header"><i class="fa fa-copy"></i> <?php echo mb_convert_case(trans('common.post_list'), MB_CASE_TITLE, 'UTF-8'); ?></div>
            <div class="card-body">

                <nav class="nav mb-3 justify-content-center justify-content-md-end">
                    <!-- Top Button Group -->
                    <div class="btn-group" role="group">
                        <?php if($cancreate): ?>
                        <button type="button" onclick="window.location.href ='<?php echo e(route('adminpostcreate')); ?>'" class="btn btn-success">
                            <?php echo mb_convert_case(trans('common.create_new'), MB_CASE_TITLE, 'UTF-8'); ?>
                            <i class="fa fa-plus-circle"></i>
                        </button>
                        <?php endif; ?>
                        <?php if($candeletemany): ?>
                        <div class="btn-group d-none d-md-inline" role="group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                                <?php echo mb_convert_case(trans('common.with_checked_records'), MB_CASE_TITLE, 'UTF-8'); ?>
                            </button>
                            <div class="dropdown-menu">
                                <div class="d-none">
                                    <form action="<?php echo e(route('adminpostdeletemany')); ?>" method="post" name="deletechecked" id="deletechecked">
                                        <?php echo csrf_field(); ?>

                                        <?php echo e(method_field('DELETE')); ?>

                                    </form>
                                </div>
                                <a href="javascript:void(0);" class="dropdown-item" onclick="if (confirm('<?php echo e(__('common.confirm_delete_checked_records')); ?>')){ document.deletechecked.submit(); }">
                                    <i class="fa fa-trash"></i>
                                    <?php echo mb_convert_case(trans('common.delete'), MB_CASE_TITLE, 'UTF-8'); ?>
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- Top Button Group  End -->
                </nav>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('adminSearchPosts', App\Post::class)): ?>
                <form action="<?php echo e(route('adminpostsearch')); ?>" method="get" name="search">
                    <?php echo csrf_field(); ?>

                    <div class="form-row">
                        <div class="col-lg-5 col-sm-12 mt-2">
                            <div class="form-group<?php echo e($errors->has('search') ? ' has-error' : ''); ?>">
                                <input type="text" class="form-control p-2" id="search" name="search" placeholder="search" value="<?php if(isset($search)): ?><?php echo e($search); ?><?php endif; ?>">
                                <?php if($errors->has('search')): ?>
                                <span class="help-block"><?php echo e($errors->first('search')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-7 col-sm-12 text-center text-lg-left ">
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-search"></i> <?php echo mb_convert_case(trans('common.search'), MB_CASE_TITLE, 'UTF-8'); ?>
                            </button>
                            <a href="<?php echo e(route('adminpostlist')); ?>" class="btn btn-light ">
                                <?php echo mb_convert_case(trans('common.clear'), MB_CASE_TITLE, 'UTF-8'); ?> <i class="fa fa-magic"></i>
                            </a>
                            <div class="d-inline-block col-lg-6 col-md-4 col-sm-9 mt-2">
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                                    </div>
                                    <select class="form-control" id="user" name="user">
                                        <option value=""><?php echo mb_convert_case(trans('common.filter_by_user'), MB_CASE_TITLE, 'UTF-8'); ?></option>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($selecteduser)): ?>
                                        <option value="<?php echo e($user->id); ?>" <?php if($selecteduser == $user->id): ?> selected <?php endif; ?>><?php echo e($user->name); ?></option>
                                        <?php else: ?>
                                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php endif; ?>

                <?php if(count($posts) === 0): ?>
                <div class="alert alert-warning">
                    <i class="fa fa-exclamation-triangle"></i> &nbsp;
                    <?php echo mb_convert_case(trans('common.no_records_found'), MB_CASE_TITLE, 'UTF-8'); ?>
                </div>
                <?php else: ?>
                <div class="row">
                    <div class="col-md-4 col-sm-12 mt-2 pt-1  text-center text-md-left">
                        <span class="badge badge-secondary"><?php echo e($posts->total()); ?></span> <span class=""><?php echo mb_convert_case(trans('common.total_posts'), MB_CASE_TITLE, 'UTF-8'); ?></span>
                    </div>
                    <div class="col-md-8 col-sm-12 p-2 text-right">
                        <div class="d-none d-md-block">
                            <div class="d-inline">
                                <?php echo e($posts->appends(\Request::except('page'))->render('resources.vendor.pagination.table-top-bootstrap-4')); ?>

                            </div>
                            <div class="small d-none d-lg-inline">
                                (<?php echo e(__('pagination.page')); ?> <?php echo e($posts->currentPage()); ?> <?php echo e(__('pagination.page_from')); ?> <?php echo e($posts->lastPage()); ?> <?php echo e(__('pagination.pages')); ?>)
                            </div>
                        </div>
                    </div>

                </div>
                <?php endif; ?>
            </div> <!-- Card Body End -->

            <?php if(count($posts) > 0): ?>
            <!-- Table -->
            <table class="table table-hover table-striped " style="background:#fff;">
                <thead class="thead-light">
                    <tr>
                        <?php if($candeletemany): ?>
                        <th scope="col" class="d-none d-md-table-cell">
                            <input type="checkbox" class="" id="checkall">
                        </th>
                        <?php endif; ?>
                        <th scope="col" class="d-none d-sm-table-cell">
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('id', 'Id'));?>
                        </th>
                        <th scope="col">
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('title', __('common.short_title')));?>
                        </th>
                        <th scope="col" class="text-center">
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('active', __('common.short_active')));?>
                        </th>
                        <th scope="col" class="d-none d-md-table-cell text-center">
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('order', __('common.short_order')));?>
                        </th>
                        <th scope="col" class="d-none d-md-table-cell">
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('created_at', __('common.short_created_at')));?>
                        </th>
                        <th scope="col" class="d-none d-md-table-cell">
                            <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('updated_at', __('common.short_updated_at')));?>
                        </th>
                        <th scope="col" class="text-center">
                            <?php echo app('translator')->getFromJson('common.short_actions'); ?>
                        </th>
                </thead>
                </tr>

                <tbody>
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="<?php echo e($post->active === 1 ? '' : 'gray-out'); ?>">
                        <?php if($candeletemany): ?>
                        <td class="d-none d-md-table-cell">
                            <input class="deletechecked" type="checkbox" form="deletechecked" name="deletechecked[]" value="<?php echo e($post->id); ?>">
                        </td>
                        <?php endif; ?>
                        <th scope="row" class="d-none d-sm-table-cell">
                            <span class=""><?php echo e($post->id); ?></span>
                        </th>
                        <td style="border-left:1px dashed #ddd;max-width:440px;">
                            <span class="">
                                <?php echo e(str_limit($post->title , config('settings.admin_title_trim') , '...')); ?>

                            </span>
                        </td>
                        <td class="text-center">
                            <i class="activatepost cursor-pointer fa <?php echo e($post->active === 1 ? 'fa-check active' : 'fa-eye-slash inactive'); ?>"></i>
                            <input type="hidden" name="activateid" value="<?php echo e($post->id); ?>">
                        </td>
                        <td class="d-none d-md-table-cell" style="max-width:64px;">
                            <form>
                                <div class="form-row">
                                    <div class="ml-auto mr-auto" style="max-width:64px;">
                                        <input type="text" class="form-control p-1 order d-inline" name="order" maxlength="4" style="max-width:34px;" value="<?php echo e($post->order); ?>">
                                        <input type="hidden" name="orderid" value="<?php echo e($post->id); ?>">
                                        <i class="order-submit fa fa-save cursor-pointer d-inline"></i>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="small"><?php echo e($post->created_at); ?></span>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="small"><?php echo e($post->updated_at); ?></span>
                        </td>
                        <td class="text-center">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit', $post)): ?>
                            <a class="d-block d-sm-inline" href="<?php echo e(route('adminpostedit', $post->id)); ?>" title="<?php echo mb_convert_case(trans('common.edit'), MB_CASE_TITLE, 'UTF-8'); ?>">
                                <i class="fa fa-pencil"></i>
                            </a> &nbsp;
                            <?php endif; ?>
                            <a class="d-block d-sm-inline" href="<?php echo e(url('post/'.$post->seotitle)); ?>" title="<?php echo mb_convert_case(trans('common.display'), MB_CASE_TITLE, 'UTF-8'); ?>">
                                <i class="fa fa-eye"></i>
                            </a> &nbsp;
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $post)): ?>
                            <div class="d-none">
                                <form name="deletepost<?php echo e($post->id); ?>" id="deletepost<?php echo e($post->id); ?>" action="<?php echo e(route('adminpostdelete', $post->id)); ?>" method="post">
                                    <?php echo csrf_field(); ?>

                                    <?php echo e(method_field('DELETE')); ?>

                                </form>
                            </div>
                            <a class="d-block d-sm-inline"
                               onclick="if (confirm('<?php echo e(__('common.confirm_delete_record')); ?>: <?php echo e($post->id); ?>?')){ document.deletepost<?php echo e($post->id); ?>.submit(); }"
                               href="javascript:void(0);"
                               title="<?php echo mb_convert_case(trans('common.delete'), MB_CASE_TITLE, 'UTF-8'); ?>">
                                <i class="fa fa-trash"></i>
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
        <!-- Card End -->

        <!-- Pagination -->
        <?php echo e($posts->appends(\Request::except('page'))->render('resources.vendor.pagination.bootstrap-4')); ?>


    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('bottom-scripts'); ?>

<script>
    $(document).ready(function () {

    $('input#checkall').change(function () {
    if ($(this).is(':checked')) {
    $('input.deletechecked').prop('checked', true);
    $('input.deletechecked').closest('tr').addClass('table-warning');
    } else {
    $('input.deletechecked').prop('checked', false);
    $('input.deletechecked').closest('tr').removeClass('table-warning');
    }
    });
    $('input.deletechecked').change(function () {
    if ($(this).is(':checked')) {
    $(this).closest('tr').addClass('table-warning');
    } else {
    $(this).closest('tr').removeClass('table-warning');
    }
    });
    });</script>

<script>

    $('input.order').change(function () {
    $(this).next().next().addClass('text-warning');
    $(this).addClass('text-warning');
    });
    // disable form submit with Enter Key
    $('input.order').on('keyup keypress', function (e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
    e.preventDefault();
    return false;
    }
    });
    // start ajax
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    // ajax reorder posts
    $('.order-submit').click(function (e) {

    e.preventDefault();
    var order = $(this).closest('form').find('input[name=order]').val();
    var id = $(this).closest('form').find('input[name=orderid]').val();
    var selectedbutton = $(this);
    var selectedinput = $(this).closest('form').find('input[name=order]');
    $.ajax({

    type: 'POST',
            url: '<?php echo e(route('adminpostreorder')); ?>',
            data: {order: order, id: id},
            success: function (response) {

            if (response.success) {
            $(selectedinput).removeClass('text-warning text-danger is-invalid').addClass('text-success is-valid');
            $(selectedbutton).removeClass('text-warning text-danger').addClass('text-success');
            setTimeout(function () {
            $(selectedinput).removeClass('text-success is-valid').fadeOut('fast');
            $(selectedbutton).removeClass('text-success').fadeOut('fast');
            }, 1200);
            }
            else if (response.error) {
            $(selectedinput).addClass('text-danger is-invalid').fadeIn('slow');
            $(selectedbutton).addClass('text-danger').fadeIn('slow');
            alert(response.error);
            }

            }
    });
    });
    // ajax activate posts
    $('.activatepost').click(function (e) {

    e.preventDefault();
    //
    $(this).addClass('text-warning');
    //
    var id = $(this).next('input[name=activateid]').val();
    var currentelement = $(this);
    if ($(this).hasClass('active')) {
    var activestatus = 1;
    var setactive = 0;
    } else if ($(this).hasClass('inactive')) {
    var activestatus = 0;
    var setactive = 1;
    }

    $.ajax({

    type: 'POST',
            url: '<?php echo e(route('adminactivatepost')); ?>',
            data: {active: setactive, id: id},
            success: function (response) {

            if (response.success) {
            if (response.state == 0) {
            $(currentelement).addClass('fa-eye-slash inactive').removeClass('fa-check active text-warning');
            $(currentelement).closest('tr').addClass('gray-out');
            } else if (response.state == 1) {
            $(currentelement).addClass('fa-check active').removeClass('fa-eye-slash inactive text-warning');
            $(currentelement).closest('tr').removeClass('gray-out');
            }
            }
            else if (response.error) {
            alert(response.error);
            }

            }
    });
    });

</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>