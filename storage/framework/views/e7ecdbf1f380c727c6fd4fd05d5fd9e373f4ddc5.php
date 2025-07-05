<?php
    $isactivateFlashdeal = isActivePlugin('flashdeal');
?>
<?php if($isactivateFlashdeal): ?>
    <?php if(auth()->user()->can('Manage Flash Deals')): ?>
        <li class="<?php echo e(Request::routeIs(['plugin.flashdeal.list']) ? 'active ' : ''); ?>">
            <a href="<?php echo e(route('plugin.flashdeal.list')); ?>"><?php echo e(translate('Flash Deals')); ?><span
                    class="badge badge-danger ml-2"><?php echo e(translate('Free Addon')); ?></span></a>
        </li>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /home/medo/work/eco-jara/fashly/plugins/flashdeal/views/includes/submenu/marketing.blade.php ENDPATH**/ ?>