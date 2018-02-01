<?php

/*
 *  File:media-add.blade.php  encoding:UTF-8
 *  Created at 01-10-2018 (mm/dd/yyyy) 23:52:51
 *  Belongs to project:lav_app
 *  Copyright © 2018  @KSNET.
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
            <div class="alert alert-info"><i class="fas fa-info-circle"></i> <?php echo e(Session::get('flash_message')); ?></div>
            <?php endif; ?>

            <div class="panel panel-default">
                <div class="panel-heading"><i class="fas fa-caret-right"></i> this will be add-new-post layout</div>

                <div class="panel-body">
                    <?php if(session('status')): ?>
                    <div class="alert alert-info">
                        <?php echo e(session('status')); ?>

                    </div>
                    <?php endif; ?>
                    <h3><i class="fas fa-edit"></i> CREATE-ADD NEW POST BLADE VIEW</h3>
                    <a href="<?php echo e(route('adminmedialist')); ?>" class="btn btn-default"> Media Index Page <i class="fas fa-image"></i></a>

                    <!-- START ADD FORM  -->
                    <h1>Add New Post</h1>
                    <form action="<?php echo e(route('adminmediaadd')); ?>" method="post" enctype="multipart/form-data">

                        <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <?php endif; ?>

                        <?php echo csrf_field(); ?>

                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <label for="name">Title</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo e(old('name')); ?>">
                            <?php if($errors->has('title')): ?>
                            <span class="help-block"><?php echo e($errors->first('name')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group<?php echo e($errors->has('desc') ? ' has-error' : ''); ?>">
                            <label for="desc">Seotitle</label>
                            <input type="text" class="form-control" id="desc" name="desc" placeholder="Description" value="<?php echo e(old('desc')); ?>">
                            <?php if($errors->has('seotitle')): ?>
                            <span class="help-block"><?php echo e($errors->first('desc')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group<?php echo e($errors->has('image') ? ' has-error' : ''); ?>">
                            <label for="image">Post Main Image</label>
                            <input type="file" name="image" id="image" value="<?php echo e(old('image')); ?>">
                            <?php if($errors->has('main_img')): ?>
                            <span class="help-block"><?php echo e($errors->first('image')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <input type="text" name="tags" id="tags" value="<?php echo e(old('tags')); ?>">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    <!-- END ADD FORM  -->

                </div>
            </div>

        </div>
    </div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('bottom-scripts'); ?>
<script>
    $(document).ready(function () {
        $('#tags').selectize({
            delimiter: ',',
            persist: false,
            valueField: 'tag',
            labelField: 'tag',
            searchField: 'tag',
            options: tags,
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