<?php if($paginator->hasPages()): ?>
    <ul class="pagination  flex-wrap justify-content-center justify-content-sm-start">
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="page-item disabled"><span class="page-link">&laquo; <span class="d-inline d-sm-none"><?php echo e(__('pagination.previous')); ?></span></span></li>
        <?php else: ?>
        <li class="page-item"><a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">&laquo; <span class="d-inline d-sm-none"><?php echo e(__('pagination.previous')); ?></span></a></li>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php if(is_string($element)): ?>
                <li class="page-item disabled d-none d-sm-inline-block"><span class="page-link  d-none d-sm-inline-block"><?php echo e($element); ?></span></li>
            <?php endif; ?>

            
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="page-item active d-none d-sm-inline"><span class="page-link"><?php echo e($page); ?></span></li>
                    <?php else: ?>
                        <li class="page-item d-none d-sm-inline"><a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <li class="page-item"><a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next"><span class="d-inline d-sm-none"><?php echo e(__('pagination.next')); ?></span> &raquo;</a></li>
        <?php else: ?>
            <li class="page-item disabled"><span class="page-link"><span class="d-inline d-sm-none"><?php echo e(__('pagination.previous')); ?></span> &raquo;</span></li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
