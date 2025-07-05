<?php $__env->startSection('title'); ?>
    <?php echo e(translate('Install Plugin')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content'); ?>
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card mb-30">
                <div class="card-header bg-white py-3">
                    <h4><?php echo e(translate('Install New Plugin')); ?></h4>
                </div>
                <div class="card-body">
                    <?php if($errors->has('error')): ?>
                        <p class="alert alert-danger"><?php echo e($errors->first('error')); ?></p>
                    <?php endif; ?>
                    <form action="<?php echo e(route('core.plugins.install')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-row mb-20">
                            <div class="col-sm-2">
                                <label class="font-14 bold black"><?php echo e(translate('Zip File')); ?></label>
                            </div>
                            <div class="col-sm-10">
                                <input type="file" name="zip_file" class="theme-input-style">
                                <?php if($errors->has('zip_file')): ?>
                                    <div class="invalid-input"><?php echo e($errors->first('zip_file')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn long"><?php echo e(translate('Submit')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core::base.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ahmedalaa/work/fashly/Core/resources/views/base/plugins/install.blade.php ENDPATH**/ ?>