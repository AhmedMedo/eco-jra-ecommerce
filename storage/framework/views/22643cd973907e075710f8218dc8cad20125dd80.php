<?php
    $isactivateCarrier = isActivePlugin('carrier');
?>
<?php if($isactivateCarrier): ?>
    <li class="<?php echo e(Request::routeIs(['plugin.carrier.list']) ? 'active ' : ''); ?>">
        <a href="<?php echo e(route('plugin.carrier.list')); ?>"><?php echo e(translate('Carriers')); ?><span
                class="badge badge-danger ml-2"><?php echo e(translate('Adoon')); ?></span></a>
    </li>
<?php endif; ?>
<?php /**PATH /home/medo/work/eco-jara/fashly/plugins/carrier/views/includes/submenu/shipping.blade.php ENDPATH**/ ?>