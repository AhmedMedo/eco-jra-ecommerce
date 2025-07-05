
<h3 class="black mb-3"><?php echo e(translate('404 Page')); ?></h3>
<input type="hidden" name="option_name" value="page_404">


<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4 mb-3">
        <label class="font-16 bold black"><?php echo e(translate('Custom 404 Style')); ?>

        </label>
        <span class="d-block"><?php echo e(translate('Switch on for custom 404 style.')); ?></span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="custom_404" value="0">
            <input type="checkbox"
                <?php echo e(isset($option_settings['custom_404']) && $option_settings['custom_404'] == 1 ? 'checked' : ''); ?>

                name="custom_404" id="custom_404" value="1">
            <span class="control" id="custom_404_switch">
                <span class="switch-off">Disable</span>
                <span class="switch-on">Enable</span>
            </span>
        </label>
    </div>
</div>



<div id="custom_404_switch_on_field">
    
    <div class="form-group row py-3 border-bottom">
        <div class="col-xl-4">
            <label for="page_404_title" class="font-16 bold black"><?php echo e(translate('Page Title')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Set Page Title')); ?></span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="text" name="page_404_title" id="page_404_title" class="form-control"
                value="<?php echo e(isset($option_settings['page_404_title']) ? $option_settings['page_404_title'] : ''); ?>"
                placeholder="<?php echo e(translate('Page Title')); ?>">
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4 mb-3">
            <label for="404_image" class="font-16 bold black"><?php echo e(translate('404 Image')); ?>

            </label>
            <span
                class="d-block"><?php echo e(translate('Upload your site 404_image for header ( recommendation png format ).')); ?></span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <?php echo $__env->make('core::base.includes.media.media_input', [
                'input' => '404_image',
                'data' => isset($option_settings['404_image']) ? $option_settings['404_image'] : null,
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    

    
    <div class="form-group row py-3 border-bottom">
        <div class="col-xl-4">
            <label for="page_404_button_text" class="font-16 bold black"><?php echo e(translate('Button Text')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Button Text')); ?></span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <input type="text" name="page_404_button_text" id="page_404_button_text" class="form-control"
                value="<?php echo e(isset($option_settings['page_404_button_text']) ? $option_settings['page_404_button_text'] : ''); ?>"
                placeholder="<?php echo e(translate('Button Text')); ?>">
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Button Background Color')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Button Background Color.')); ?></span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color justify-content-between">
                    <input type="text" class="form-control" name="button_bg_color"
                        value="<?php echo e(isset($option_settings['button_bg_color']) ? $option_settings['button_bg_color'] : ''); ?>">

                    <input type="color" class="" id="button_bg_color"
                        value="<?php echo e(isset($option_settings['button_bg_color']) ? $option_settings['button_bg_color'] : '#fafafa'); ?>">

                    <label for="button_bg_color"><?php echo e(translate('Select Color')); ?></label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="button_bg_color_transparent" value="0">
                        <input type="checkbox"
                            <?php echo e(isset($option_settings['button_bg_color_transparent']) && $option_settings['button_bg_color_transparent'] == 1 ? 'checked' : ''); ?>

                            name="button_bg_color_transparent" id="button_bg_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="button_bg_color_transparent"><?php echo e(translate('Transparent')); ?></label>
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Button Text Color')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Button Text Color.')); ?></span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color justify-content-between">
                    <input type="text" class="form-control" name="button_text_color"
                        value="<?php echo e(isset($option_settings['button_text_color']) ? $option_settings['button_text_color'] : ''); ?>">

                    <input type="color" class="" id="button_text_color"
                        value="<?php echo e(isset($option_settings['button_text_color']) ? $option_settings['button_text_color'] : '#fafafa'); ?>">

                    <label for="button_text_color"><?php echo e(translate('Select Color')); ?></label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="button_text_color_transparent" value="0">
                        <input type="checkbox"
                            <?php echo e(isset($option_settings['button_text_color_transparent']) && $option_settings['button_text_color_transparent'] == 1 ? 'checked' : ''); ?>

                            name="button_text_color_transparent" id="button_text_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="button_text_color_transparent"><?php echo e(translate('Transparent')); ?></label>
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Button Hover Background Color')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Button Hover Background Color.')); ?></span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color justify-content-between">
                    <input type="text" class="form-control" name="button_hover_bg_color"
                        value="<?php echo e(isset($option_settings['button_hover_bg_color']) ? $option_settings['button_hover_bg_color'] : ''); ?>">

                    <input type="color" class="" id="button_hover_bg_color"
                        value="<?php echo e(isset($option_settings['button_hover_bg_color']) ? $option_settings['button_hover_bg_color'] : '#fafafa'); ?>">

                    <label for="button_hover_bg_color"><?php echo e(translate('Select Color')); ?></label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="button_hover_bg_color_transparent" value="0">
                        <input type="checkbox"
                            <?php echo e(isset($option_settings['button_hover_bg_color_transparent']) && $option_settings['button_hover_bg_color_transparent'] == 1 ? 'checked' : ''); ?>

                            name="button_hover_bg_color_transparent" id="button_hover_bg_color_transparent"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="button_hover_bg_color_transparent"><?php echo e(translate('Transparent')); ?></label>
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Button Hover Text Color')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Button Hover Text Color.')); ?></span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color justify-content-between">
                    <input type="text" class="form-control" name="button_hover_text_color"
                        value="<?php echo e(isset($option_settings['button_hover_text_color']) ? $option_settings['button_hover_text_color'] : ''); ?>">

                    <input type="color" class="" id="button_hover_text_color"
                        value="<?php echo e(isset($option_settings['button_hover_text_color']) ? $option_settings['button_hover_text_color'] : '#fafafa'); ?>">

                    <label for="button_hover_text_color"><?php echo e(translate('Select Color')); ?></label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="button_hover_text_color_transparent" value="0">
                        <input type="checkbox"
                            <?php echo e(isset($option_settings['button_hover_text_color_transparent']) && $option_settings['button_hover_text_color_transparent'] == 1 ? 'checked' : ''); ?>

                            name="button_hover_text_color_transparent" id="button_hover_text_color_transparent"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="button_hover_text_color_transparent"><?php echo e(translate('Transparent')); ?></label>
                </div>
            </div>
        </div>
    </div>
    
</div>

<?php /**PATH /home/ahmedalaa/work/fashly/themes/fashion-theme/resources/views/backend/theme/option-form/page_404.blade.php ENDPATH**/ ?>