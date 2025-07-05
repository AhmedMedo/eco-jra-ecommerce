
<h3 class="black mb-3"><?php echo e(translate('Header Logo')); ?></h3>
<input type="hidden" name="option_name" value="header_logo">


<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4 mb-3">
        <label class="font-16 bold black"><?php echo e(translate('Custom Header Logo Style')); ?>

        </label>
        <span class="d-block"><?php echo e(translate('Switch on for custom header logo style.')); ?></span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="custom_header_logo" value="0">
            <input type="checkbox"
                <?php echo e(isset($option_settings['custom_header_logo']) && $option_settings['custom_header_logo'] == 1 ? 'checked' : ''); ?>

                name="custom_header_logo" id="custom_header_logo" value="1">
            <span class="control" id="custom_header_logo_switch">
                <span class="switch-off">Disable</span>
                <span class="switch-on">Enable</span>
            </span>
        </label>
    </div>
</div>



<div id="custom_header_logo_switch_on_field">
    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4 mb-3">
            <label for="logo_dimension" class="font-16 bold black"><?php echo e(translate('Logo Dimensions (Width/Height).')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Set logo dimensions to choose width, height, and unit.')); ?></span>
        </div>
        <div class="col-xl-7 offset-xl-1 row">
            <div class="input-group my-2  col-xl-5">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-resize"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="logo_dimension_width" id="logo_dimension_width"
                    placeholder="<?php echo e(translate('Width')); ?>"
                    value="<?php echo e(isset($option_settings['logo_dimension_width']) ? $option_settings['logo_dimension_width'] : ''); ?>">
            </div>
            <div class="input-group my-2  col-xl-5">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-resize"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="logo_dimension_height" id="logo_dimension_height"
                    placeholder="<?php echo e(translate('Height')); ?>"
                    value="<?php echo e(isset($option_settings['logo_dimension_height']) ? $option_settings['logo_dimension_height'] : ''); ?>">
            </div>
            <div class="input-group my-2  col-xl-5 mt-3">
                <select class="form-control select" name="logo_dimension_unit" id="logo_dimension_unit">
                    <option value="px"
                        <?php echo e(isset($option_settings['logo_dimension_height']) && $option_settings['logo_dimension_height'] == 'px' ? 'selected' : ''); ?>>
                        px</option>
                </select>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4 mb-3">
            <label for="logo_margin" class="font-16 bold black"><?php echo e(translate('Logo Top and Bottom Margin.')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Set logo top and bottom margin.')); ?></span>
        </div>
        <div class="col-xl-7 offset-xl-1 row">
            <div class="input-group my-2  col-xl-5">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-up"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="logo_margin_top" id="logo_margin_top"
                    placeholder="<?php echo e(translate('Top')); ?>"
                    value="<?php echo e(isset($option_settings['logo_margin_top']) ? $option_settings['logo_margin_top'] : ''); ?>">
            </div>
            <div class="input-group my-2  col-xl-5">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-down"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="logo_margin_bottom" id="logo_margin_bottom"
                    placeholder="<?php echo e(translate('Bottom')); ?>"
                    value="<?php echo e(isset($option_settings['logo_margin_bottom']) ? $option_settings['logo_margin_bottom'] : ''); ?>">
            </div>
            <div class="input-group my-2  col-xl-5 mt-3">
                <select class="form-control select" name="logo_margin_unit" id="logo_margin_unit">
                    <option value="px"
                        <?php echo e(isset($option_settings['logo_margin_unit']) && $option_settings['logo_margin_unit'] == 'px' ? 'selected' : ''); ?>>
                        px</option>
                </select>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4 mb-3">
            <label for="menu_color"
                class="font-16 bold black"><?php echo e(translate('Sticky Logo Dimensions (Width/Height).')); ?>

            </label>
            <span
                class="d-block"><?php echo e(translate('Set Sticky logo dimensions to choose width, height, and unit.')); ?></span>
        </div>
        <div class="col-xl-7 offset-xl-1 row">
            <div class="input-group my-2  col-xl-5">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-resize"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="sticky_logo_dimension_width"
                    id="sticky_logo_dimension_width" placeholder="<?php echo e(translate('Width')); ?>"
                    value="<?php echo e(isset($option_settings['sticky_logo_dimension_width']) ? $option_settings['sticky_logo_dimension_width'] : ''); ?>">
            </div>
            <div class="input-group my-2  col-xl-5">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-resize"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="sticky_logo_dimension_height"
                    id="sticky_logo_dimension_height" placeholder="<?php echo e(translate('Height')); ?>"
                    value="<?php echo e(isset($option_settings['sticky_logo_dimension_height']) ? $option_settings['sticky_logo_dimension_height'] : ''); ?>">
            </div>
            <div class="input-group my-2  col-xl-5 mt-3">
                <select class="form-control select" name="sticky_logo_dimension_unit"
                    id="sticky_logo_dimension_unit">
                    <option value="px"
                        <?php echo e(isset($option_settings['sticky_logo_dimension_unit']) && $option_settings['sticky_logo_dimension_unit'] == 'px' ? 'selected' : ''); ?>>
                        px
                    </option>
                </select>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-4 mb-3">
            <label for="menu_color" class="font-16 bold black"><?php echo e(translate('Sticky Logo Top and Bottom Margin.')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Set Sticky logo top and bottom margin.')); ?></span>
        </div>
        <div class="col-xl-7 offset-xl-1 row">
            <div class="input-group my-2  col-xl-5">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-up"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="sticky_logo_margin_top" id="sticky_logo_margin_top"
                    placeholder="<?php echo e(translate('Top')); ?>"
                    value="<?php echo e(isset($option_settings['sticky_logo_margin_top']) ? $option_settings['sticky_logo_margin_top'] : ''); ?>">
            </div>
            <div class="input-group my-2  col-xl-5">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-down"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="sticky_logo_margin_bottom"
                    id="sticky_logo_margin_bottom" placeholder="<?php echo e(translate('Bottom')); ?>"
                    value="<?php echo e(isset($option_settings['sticky_logo_margin_bottom']) ? $option_settings['sticky_logo_margin_bottom'] : ''); ?>">
            </div>
            <div class="input-group my-2  col-xl-5 mt-3">
                <select class="form-control select" name="sticky_logo_margin_unit" id="sticky_logo_margin_unit">
                    <option value="px"
                        <?php echo e(isset($option_settings['sticky_logo_margin_unit']) && $option_settings['sticky_logo_margin_unit'] == 'px' ? 'selected' : ''); ?>>
                        px
                    </option>
                </select>
            </div>
        </div>
    </div>
    
</div>

<?php /**PATH /home/ahmedalaa/work/fashly/themes/fashion-theme/resources/views/backend/theme/option-form/header_logo.blade.php ENDPATH**/ ?>