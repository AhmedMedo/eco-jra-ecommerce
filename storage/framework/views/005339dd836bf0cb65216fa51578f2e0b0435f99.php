<?php
    $isactivateCoupon = isActivePlugin('coupon');
?>
<?php if($isactivateCoupon): ?>
    <?php if(auth()->user()->can('Manage Coupons')): ?>
        <li
            class="<?php echo e(Request::routeIs(['plugin.coupon.marketing.coupon.create.new', 'plugin.coupon.marketing.coupon.edit', 'plugin.coupon.marketing.coupon.list']) ? 'active ' : ''); ?>">
            <a href="<?php echo e(route('plugin.coupon.marketing.coupon.list')); ?>"><?php echo e(translate('Coupons')); ?><span
                    class="badge badge-danger ml-2"><?php echo e(translate('Free Addon')); ?></span></a>
        </li>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /home/ahmedalaa/work/fashly/plugins/coupon/views/includes/submenu/marketing.blade.php ENDPATH**/ ?>