<?php
    $admin_logo = getGeneralSetting('admin_dark_logo');
?>

<?php $__env->startSection('title'); ?>
    <?php echo e(translate('Login')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_css'); ?>
    <style>
        .login-page-layout {
            height: 100vh;
            background-size: cover;
            min-height: 100%;
            background-repeat: no-repeat;
        }

        .card {
            border-radius: 4px !important;
        }

        .logo {
            min-height: 70px;
        }

        .container-fluid.login-page-layout:before {
            content: "";
            background-color: rgb(183 180 180 / 50%);
            top: 0;
            height: 100%;
            left: 0;
            width: 100%;
            position: absolute;
        }

        .text-darkest {
            color: #000
        }

        .bg-image {
            height: 100vh;
            background-image: url('<?php echo e(asset('web-assets/backend/img/log-in-bg.jpg')); ?>');
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content'); ?>
    <div class="container-fluid login-page-layout position-relative">
        <div class="row">
            <div class="col-lg-8 d-none d-lg-block bg-image">

            </div>
            <div class="align-items-center bg-custom vh-100 col-12 col-lg-4 d-flex p-5 text-white">
                <div class="user-auth-card w-100">
                    <div class="auth-card-header text-center pt-3">
                        <div class="logo">
                            <?php if($admin_logo != null): ?>
                                <a href="/" class="default-logo">
                                    <img src="<?php echo e(getFilePath($admin_logo, false)); ?>"
                                        alt="<?php echo e(getGeneralSetting('system_name')); ?>">
                                </a>
                            <?php else: ?>
                                <h3 class="default-logo"><?php echo e(getGeneralSetting('system_name')); ?></h3>
                            <?php endif; ?>
                        </div>
                        <h3 class="font-20 mb-2"><?php echo e(translate('Welcome Back')); ?></h3>
                        <p><?php echo e(translate('Login to Seller Dashboard')); ?></p>
                        <?php if($errors->has('login_error')): ?>
                            <div class="text-danger mt-2 fz-12"><?php echo e($errors->first('login_error')); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="auth-card-body">
                        <form action="<?php echo e(route('plugin.multivendor.seller.login.attempt')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <!-- Form Group -->
                            <div class="form-group mb-20">
                                <label for="email" class="mb-2 font-14 bold black"><?php echo e(translate('Email')); ?></label>
                                <input type="email" id="email" name="email" class="theme-input-style text-darkest"
                                    placeholder="<?php echo e(translate('Email Address')); ?>" value="<?php echo e(old('email')); ?>">
                                <?php if($errors->has('email')): ?>
                                    <div class="text-danger mt-2 fz-12"><?php echo e($errors->first('email')); ?></div>
                                <?php endif; ?>
                            </div>
                            <!-- End Form Group -->

                            <!-- Form Group -->
                            <div class="form-group mb-20">
                                <label for="password" class="mb-2 font-14 bold black"><?php echo e(translate('Password')); ?></label>
                                <input type="password" id="password" name="password" class="theme-input-style text-darkest"
                                    placeholder="<?php echo e(translate('********')); ?>">
                                <?php if($errors->has('password')): ?>
                                    <div class="text-danger mt-2 fz-12"><?php echo e($errors->first('password')); ?></div>
                                <?php endif; ?>
                            </div>
                            <!-- End Form Group -->

                            <div class="d-flex justify-content-between mb-20">
                                <a href="<?php echo e(route('plugin.multivendor.seller.password.reset.link.page')); ?>"
                                    class="font-12 text_color"><?php echo e(translate('Forgot Password?')); ?></a>
                            </div>

                            <div class="form-row">
                                <button type="submit" class="btn long w-100"><?php echo e(translate('Log In')); ?></button>
                            </div>
                        </form>
                        <?php if(env('APP_DEMO') == true): ?>
                            <div class="mt-4">
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p class="mt-2 email-value">saller@test.com</p>
                                            </td>
                                            <td>
                                                <p class="mt-2 password-value">111111</p>
                                            </td>
                                            <td>
                                                <button class="btn btn-info sm auto-fill-btn">
                                                    <i class="icofont-copy-invert"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>


            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_scripts'); ?>
    <script>
        $(function($) {
            "use strict";
            $('.auto-fill-btn').on('click', function(e) {
                $("#email").val($('.email-value').html());
                $("#password").val($('.password-value').html());
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core::base.auth.auth_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/medo/work/eco-jara/fashly/plugins/multivendor/views/seller/auth/login.blade.php ENDPATH**/ ?>