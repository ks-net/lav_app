<?php
/*
 *  File:postsingle.blade.php part-of-project:lav_app encoding:UTF-8
 *  Last Modified at 6 Ιαν 2018 6:23:02 πμ.
 *  NOTE: COMMERCIAL LICENSE.. !
 *  Copyright 2018 KSNET.
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
                        <li>CACHETIME SETTING= <b><?php echo e(config('settings.cachetime')); ?></b></li>
                    </ul>
                </div>

                <div class="panel-body">
                    <?php if(session('status')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('status')); ?>

                    </div>
                    <?php endif; ?>
                    <h3><i class="fas fa-clipboard"></i>  <?php echo e($post->title); ?> </h3>
                    <a href="<?php echo e(route('adminpostcreate')); ?>" class="btn btn-success"> Create New Post <i class="fas fa-plus-circle"></i></a>
                    <a href="<?php echo e(url('post/')); ?>" class="btn btn-default"> Posts Index Page <i class="fas fa-share"></i></a>
                    <a href="<?php echo e(route('adminpostlist')); ?>" class="btn btn-danger"> Posts List Page <i class="fas fa-share"></i></a>
                    <hr/>


                    <ul>
                        <li><b>ID</b>= <?php echo e($post->id); ?></li>
                        <li><b><?php echo e(__('common.Title')); ?> </b>= <span style="color:#3097D1;text-transform:uppercase;font-weight:700;"><?php echo e($post->title); ?></span></li>
                    </ul>
                    <?php if($post->main_img): ?>
                    <img  class="img-responsive center-block" src="<?php echo e(asset($post->main_img)); ?>" />
                    <?php endif; ?>
                    <ul>
                        <li><b><?php echo e(__('common.Sortdesc')); ?></b>= <?php echo e($post->sortdesc); ?></li>
                        <li><b>POSTBODY</b>= <?php echo $post->postbody; ?></li>
                        <li><b>METATITLE</b>= <?php echo e($post->metatitle); ?></li>
                        <li><b>METAKEYWORDS</b>= <?php echo e($post->metakeywords); ?></li>
                        <li><b>METADESC</b>= <?php echo e($post->metadesc); ?></li>
                        <li><b>SEOTITLE</b>= <span style="color:#2AB27B;font-style:italic;"><?php echo e($post->seotitle); ?></span></li>
                        <li><b>ACTIVE</b>= <?php echo e($post->active); ?></li>
                        <li><b>CREATED_AT</b>= <?php echo $post->created_at->formatLocalized('%A %d %B %Y'); ?></li>
                        <li><b>UPDATED_AT</b>= <?php echo e($post->updated_at->diffForHumans()); ?></li>
                    </ul>

                    <hr/>
                    <?php if(count($tags) > 0): ?>
                    <?php echo e(__('common.Tags')); ?>: <i class="fas fa-tags"></i>
                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="#"  class="label label-info"><?php echo e($tag); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <hr/>
                    <?php endif; ?>

                    <?php if($previous): ?>
                    <span  class="pull-left text-left col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <a class="btn btn-default" href="<?php echo e(url('post/'.$previous->seotitle)); ?>"><i class="fas fa-chevron-circle-left"></i> <?php echo e(__('common.Previous')); ?></a>
                        <br/>
                        <span class="text-left small previous-link-title">
                            <?php echo e(str_limit($previous->title, config('settings.frontend_next_prev_trim'), '...')); ?>

                        </span>
                    </span>
                    <?php endif; ?>
                    <?php if($next): ?>
                    <span class="pull-right text-right col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <a class="btn btn-default" href="<?php echo e(url('post/'.$next->seotitle)); ?>"><?php echo e(__('common.Next')); ?> <i class="fas fa-chevron-circle-right"></i></a>
                        <br/>
                        <span class="text-right small next-link-title">
                            <?php echo e(str_limit($next->title, config('settings.frontend_next_prev_trim'), '...')); ?>

                        </span>
                    </span>
                    <?php endif; ?>
                    <div class="clear"></div>
                    <br/><br/>

                    <!-- START DISQUS COMMENTS -->
                    <div id="disqus_thread" class="well-lg"></div>

                </div> <!-- Panel Body end -->
            </div>


            <?php $__env->startPush('bottom-scripts'); ?>
            <script>
                // DISQUS COMMENTS SCRIPT
                var disqus_config = function () {
                    this.page.url = "<?php echo e(config('settings.site_url')); ?>/post/<?php echo e($post->seotitle); ?>"; // page's canonical URL variable
                    this.page.identifier = "<?php echo e($post->seotitle); ?>_<?php echo e($post->id); ?>"; // Important page's unique identifier variable
                    this.language = "el"; //@TODO  add language settings parameter
                };
                (function () { // DON'T EDIT BELOW THIS LINE
                    var d = document, s = d.createElement('script');
                    s.src = "<?php echo e(config('settings.disqus_site_url')); ?>/embed.js";
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
            <script id="dsq-count-scr" src="<?php echo e(config('settings.disqus_site_url')); ?>/count.js" async></script>
            <?php $__env->stopPush(); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>