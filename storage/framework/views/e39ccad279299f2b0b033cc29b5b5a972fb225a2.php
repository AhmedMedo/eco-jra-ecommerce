<?php $__env->startSection('title'); ?>
    <?php echo e(translate('Plugings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content'); ?>
    <div class="align-items-center border-bottom2 d-flex flex-wrap gap-10 justify-content-between mb-4 pb-3">
        <h4><i class="icofont-plugin"></i> <?php echo e(translate('Plugings')); ?></h4>
        <div class="d-flex align-items-center gap-10 flex-wrap">
            <a href="<?php echo e(route('core.plugins.create')); ?>" class="btn long"><?php echo e(translate('Install Plugin')); ?></a>
        </div>
    </div>
    <div class="app-items">
        <div>
            <?php if(count($errors) > 0): ?>
                <div>
                    <ul class="p-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p class="alert alert-danger"><?php echo e($error); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <?php $__currentLoopData = $plugins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plugin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mb-30">
                    <div class="app-item">
                        <div class="app-icon">
                            <img src="<?php echo e(asset('/plugins' . '/' . $plugin['location'] . '/banner.png')); ?>"
                                alt="<?php echo e($plugin['name']); ?>" />
                        </div>
                        <div class="app-details">
                            <h4 class="app-name">
                                <?php echo e($plugin['name']); ?><span class="badge badge-success ml-2">Free</span>
                            </h4>
                        </div>
                        <div class="app-footer">
                            <div class="app-description" title="<?php echo e($plugin['name']); ?>">
                                <?php echo e($plugin['description']); ?>

                            </div>
                            <div class="app-author">
                                By:
                                <a href="<?php echo e($plugin['url']); ?>" target="_blank"><?php echo e($plugin['author']); ?></a>
                            </div>
                            <div class="app-version"><?php echo e(translate('Version')); ?>: <?php echo e($plugin['version']); ?></div>
                            <div class="app-actions">
                                <?php if($plugin['is_activated'] == config('settings.general_status.active')): ?>
                                    <button class="btn sm btn-warning btn-trigger-change-status deactive-plugin"
                                        data-plugin="<?php echo e($plugin['id']); ?>">
                                        <?php echo e(translate('Deactivate')); ?>

                                    </button>
                                <?php else: ?>
                                    <button class="btn sm btn-info btn-trigger-change-status active-plugin"
                                        data-plugin="<?php echo e(json_encode($plugin)); ?>">
                                        <?php echo e(translate('Activate')); ?>

                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>

    <!--Deactive Modal-->
    <div id="deactive-modal" class="delete-modal modal fade show" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6"><?php echo e(translate('Deactive Confirmation')); ?></h4>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1"><?php echo e(translate('Are you sure to deactive this plugin')); ?>?</p>
                    <form method="POST" action="<?php echo e(route('core.plugins.inactive')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" id="deactive-plugin-id" name="id">
                        <button type="button" class="btn long mt-2 btn-danger"
                            data-dismiss="modal"><?php echo e(translate('Cancel')); ?></button>
                        <button type="submit" class="btn long mt-2"><?php echo e(translate('Deactivate')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Deactive  Modal-->

    <!--Active Modal-->
    <div id="active-modal" class="delete-modal modal fade show" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6"><?php echo e(translate('Activate Confirmation')); ?></h4>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1"><?php echo e(translate('Are you sure to active this plugin')); ?>?</p>
                    <form method="POST" action="<?php echo e(route('core.plugins.active')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" id="active-plugin-id" name="id">
                        <button type="button" class="btn long mt-2 btn-danger"
                            data-dismiss="modal"><?php echo e(translate('Cancel')); ?></button>
                        <button type="submit" class="btn long mt-2"><?php echo e(translate('Activate')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Active  Modal-->

    <!-- Purchase Key Modal-->
    <div id="verify-purchase-modal" class="verify-purchase-modal modal fade show" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6"><?php echo e(translate('Active Confirmation')); ?></h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo e(route('core.plugins.purchase.verify')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" id="plugin-location" name="plugin-location">
                        <input type="hidden" id="license_api" name="license_api">
                        <label for="purchase_key" class="black bold font-14 mb-1"><?php echo e(translate('Purchase Key')); ?></label>
                        <input type="text" id="purchase_key" name="purchase_key" class="form-control mb-2"
                            placeholder="<?php echo e(translate('Give Purchase Key To Activate This Plugin')); ?>">
                        <button type="button" class="btn long mt-2 btn-danger"
                            data-dismiss="modal"><?php echo e(translate('Cancel')); ?></button>
                        <button type="submit" class="btn long mt-2"><?php echo e(translate('Activate')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Purchase Key Modal-->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_scripts'); ?>
    <script>
        (function($) {
            'use strict';

            /**
             * Deactive plugin
             * */
            $('.deactive-plugin').on('click', function(e) {
                e.preventDefault();
                let $this = $(this);
                let id = $this.data('plugin');
                $("#deactive-plugin-id").val(id);
                $('#deactive-modal').modal('show');
            });

            /**
             * Activate plugin
             * */
            $('.active-plugin').on('click', function(e) {
                e.preventDefault();
                let plugin = $(this).data('plugin');

                if (plugin.license && !plugin.is_verified) {
                    $("#plugin-location").val(plugin.location);
                    $("#license_api").val(plugin.license_api);
                    $('#verify-purchase-modal').modal('show');
                } else {
                    $("#active-plugin-id").val(plugin.id);
                    $('#active-modal').modal('show');
                }
            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core::base.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ahmedalaa/work/fashly/Core/resources/views/base/plugins/index.blade.php ENDPATH**/ ?>