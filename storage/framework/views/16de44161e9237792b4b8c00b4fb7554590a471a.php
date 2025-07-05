 
<h3 class="black mb-3"><?php echo e(translate('Theme Color')); ?></h3>
<input type="hidden" name="option_name" value="theme_color">
 
 
 
    <div class="form-group row py-3 border-bottom">
        <div class="col-xl-4">
            <label class="font-16 bold black"><?php echo e(translate('Theme Primary Color')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Set theme primary color')); ?></span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <div class="row ml-2">
                <div class="color justify-content-between">
                    <input type="text" class="form-control" name="theme_primary_color" 
                    value="<?php echo e(isset($option_settings['theme_primary_color']) ? $option_settings['theme_primary_color'] : ''); ?>">
                    
                    <input type="color" class="" id="theme_primary_color"
                        value="<?php echo e(isset($option_settings['theme_primary_color']) ? $option_settings['theme_primary_color'] : '#fafafa'); ?>">
                        
                    <label for="theme_primary_color"><?php echo e(translate('Select Color')); ?></label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="theme_primary_color_transparent" value="0">
                        <input type="checkbox"
                            <?php echo e(isset($option_settings['theme_primary_color_transparent']) && $option_settings['theme_primary_color_transparent'] == 1 ? 'checked' : ''); ?>

                            name="theme_primary_color_transparent"
                            id="theme_primary_color_transparent" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="theme_primary_color_transparent"><?php echo e(translate('Transparent')); ?></label>
                </div>
            </div>
        </div>
    </div>
    <?php /**PATH /home/ahmedalaa/work/fashly/themes/fashion-theme/resources/views/backend/theme/option-form/theme_color.blade.php ENDPATH**/ ?>