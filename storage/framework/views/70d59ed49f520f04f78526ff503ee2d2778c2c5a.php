
<h3 class="black mb-3"><?php echo e(translate('Sidebar Options')); ?></h3>
<input type="hidden" name="option_name" value="sidebar_options">


<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3 mb-3">
        <label class="font-16 bold black"><?php echo e(translate('Custom Sidebar Style')); ?>

        </label>
        <span class="d-block"><?php echo e(translate('Switch on for custom Sidebar style.')); ?></span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="custom_sidebar_c" value="0">
            <input type="checkbox"
                <?php echo e(isset($option_settings['custom_sidebar_c']) && $option_settings['custom_sidebar_c'] == 1 ? 'checked' : ''); ?>

                name="custom_sidebar_c" id="custom_sidebar" value="1">
            <span class="control" id="custom_sidebar_switch">
                <span class="switch-off">Disable</span>
                <span class="switch-on">Enable</span>
            </span>
        </label>
    </div>
</div>



<div id="custom_sidebar_switch_on_field">
    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Widgets Background Color')); ?>

            </label>
        </div>
        <div class="col-xl-8 offset-xl-1">
            <div class="row ml-2">
                <div class="color justify-content-between">
                    <input type="text" class="form-control" name="widget_background-color"
                        value="<?php echo e(isset($option_settings['widget_background-color']) ? $option_settings['widget_background-color'] : ''); ?>">
                    <input type="color" class="" id="widget_background-color"
                        value="<?php echo e(isset($option_settings['widget_background-color']) ? $option_settings['widget_background-color'] : '#fafafa'); ?>">
                    <label for="widget_background-color"><?php echo e(translate('Select Color')); ?></label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="widget_background-color-transparent_i" value="0">
                        <input type="checkbox"
                            <?php echo e(isset($option_settings['widget_background-color-transparent_i']) && $option_settings['widget_background-color-transparent_i'] == 1 ? 'checked' : ''); ?>

                            name="widget_background-color-transparent_i" id="widget_background_color_transparent"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="widget_background_color_transparent"><?php echo e(translate('Transparent')); ?></label>
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Box Shadow')); ?>

            </label>
        </div>
        <div class="col-xl-8 offset-xl-1 row">
            <input type="hidden" name="widget_custom_box-shadow" id="widget_custom_box-shadow"
                value="<?php echo e(isset($option_settings['widget_custom_box-shadow']) ? $option_settings['widget_custom_box-shadow'] : ''); ?>">
            <div class="col-xl-3">
                <label class="col-form-label col-form-label-sm"
                    for="box_shadow_offset_x_i"><?php echo e(translate('Offset X')); ?></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="icofont-arrow-up"></i>
                        </div>
                    </div>
                    <input type="number" class="form-control form-control-sm" name="box_shadow_offset_x_i"
                        id="box_shadow_offset_x" min="0"
                        value="<?php echo e(isset($option_settings['box_shadow_offset_x_i']) ? $option_settings['box_shadow_offset_x_i'] : '0'); ?>"
                        placeholder="X" onkeyup="boxShadowStyle();">
                </div>
            </div>

            <div class="col-xl-3">
                <label class="col-form-label col-form-label-sm"
                    for="box_shadow_offset_y_i"><?php echo e(translate('Offset Y')); ?></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="icofont-arrow-up"></i>
                        </div>
                    </div>
                    <input type="number" class="form-control" name="box_shadow_offset_y_i" id="box_shadow_offset_y"
                        min="0"
                        value="<?php echo e(isset($option_settings['box_shadow_offset_y_i']) ? $option_settings['box_shadow_offset_y_i'] : '0'); ?>"
                        placeholder="Y" onkeyup="boxShadowStyle();">
                </div>
            </div>

            <div class="col-xl-3">
                <label class="col-form-label col-form-label-sm"
                    for="box_shadow_blur_radius_i"><?php echo e(translate('Blur Radius')); ?></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="icofont-adjust"></i>
                        </div>
                    </div>
                    <input type="number" class="form-control" name="box_shadow_blur_radius_i"
                        id="box_shadow_blur_radius" min="0"
                        value="<?php echo e(isset($option_settings['box_shadow_blur_radius_i']) ? $option_settings['box_shadow_blur_radius_i'] : '0'); ?>"
                        pattern="Blur" onkeydown="boxShadowStyle();">
                </div>
            </div>

            <div class="col-xl-3">
                <label class="col-form-label col-form-label-sm"
                    for="box_shadow_spread_radius_i"><?php echo e(translate('Spread Radius')); ?></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="icofont-bulb-alt"></i>
                        </div>
                    </div>
                    <input type="number" class="form-control" name="box_shadow_spread_radius_i"
                        id="box_shadow_spread_radius" min="0"
                        value="<?php echo e(isset($option_settings['box_shadow_spread_radius_i']) ? $option_settings['box_shadow_spread_radius_i'] : '0'); ?>"
                        pattern="Spread" onkeyup="boxShadowStyle();">
                </div>
            </div>

            <div class="col-xl-3 mt-3">
                <label for="box_shadow_opacity_i"><?php echo e(translate('Opcacity .1-1')); ?></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="icofont-bulb-alt"></i>
                        </div>
                    </div>
                    <input type="number" class="form-control" name="box_shadow_opacity_i" step="any"
                        id="box_shadow_opacity"
                        value="<?php echo e(isset($option_settings['box_shadow_opacity_i']) ? $option_settings['box_shadow_opacity_i'] : '1'); ?>"
                        pattern="Opacity" onkeyup="boxShadowStyle();">
                </div>
            </div>

            <div class="col-xl-3 mt-2">
                <label class="col-form-label col-form-label-sm"
                    for="box_shadow_u_unit_i"><?php echo e(translate('Units')); ?></label>
                <select class="form-control select" name="box_shadow_u_unit_i" id="box_shadow_unit"
                    onchange="boxShadowStyle();">
                    <option value="px"
                        <?php echo e(isset($option_settings['box_shadow_u_unit_i']) && $option_settings['box_shadow_u_unit_i'] == 'px' ? 'selected' : ''); ?>>
                        px</option>
                    <option value="em"
                        <?php echo e(isset($option_settings['box_shadow_u_unit_i']) && $option_settings['box_shadow_u_unit_i'] == 'em' ? 'selected' : ''); ?>>
                        em</option>
                    <option value="rem"
                        <?php echo e(isset($option_settings['box_shadow_u_unit_i']) && $option_settings['box_shadow_u_unit_i'] == 'rem' ? 'selected' : ''); ?>>
                        rem</option>
                    <option value="%"
                        <?php echo e(isset($option_settings['box_shadow_u_unit_i']) && $option_settings['box_shadow_u_unit_i'] == '%' ? 'selected' : ''); ?>>
                        %</option>
                </select>
            </div>

            <div class="col-xl-4 mt-2">
                <label class="col-form-label col-form-label-sm"
                    for="box_shadow_color_i"><?php echo e(translate('Shadow Color')); ?></label>
                <div class="color w-100">
                    <input type="text" class="form-control" name="box_shadow_color_i"
                        value="<?php echo e(isset($option_settings['box_shadow_color_i']) ? $option_settings['box_shadow_color_i'] : ''); ?>">
                    <input type="color" id="box_shadow_color"
                        value="<?php echo e(isset($option_settings['box_shadow_color_i']) ? $option_settings['box_shadow_color_i'] : '#fafafa'); ?>"
                        oninput="boxShadowStyle();">
                </div>
            </div>

            <div class="col-xl-3 mt-2">
                <label class="col-form-label col-form-label-sm"
                    for="box_shadow_type_i"><?php echo e(translate('Shadow Type')); ?></label>
                <select class="form-control select" name="box_shadow_type_i" id="box_shadow_type"
                    onchange="boxShadowStyle();">
                    <option value="outside"
                        <?php echo e(isset($option_settings['box_shadow_type_i']) && $option_settings['box_shadow_type_i'] == 'outside' ? 'selected' : ''); ?>>
                        Outside</option>
                    <option value="inset"
                        <?php echo e(isset($option_settings['box_shadow_type_i']) && $option_settings['box_shadow_type_i'] == 'inset' ? 'selected' : ''); ?>>
                        Inset</option>
                </select>
            </div>

            <div class="col-xl-10" id="shadow_previewer">
                <div class="shadow-previewer-inner"
                    style="<?php echo e(isset($option_settings['widget_custom_box-shadow']) ? 'box-shadow:' . $option_settings['widget_custom_box-shadow'] : ''); ?>">
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Widget Margin')); ?>

            </label>
        </div>
        <div class="col-xl-8 offset-xl-1 row">
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-up"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_margin_u_margin-top"
                    id="widget_margin_u_margin-top"
                    value="<?php echo e(isset($option_settings['widget_margin_u_margin-top']) ? $option_settings['widget_margin_u_margin-top'] : ''); ?>"
                    placeholder="<?php echo e(translate('Top')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-right"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_margin_u_margin-right"
                    id="widget_margin_u_margin-right"
                    value="<?php echo e(isset($option_settings['widget_margin_u_margin-right']) ? $option_settings['widget_margin_u_margin-right'] : ''); ?>"
                    placeholder="<?php echo e(translate('Right')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-down"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_margin_u_margin-bottom"
                    id="widget_margin_u_margin-bottom"
                    value="<?php echo e(isset($option_settings['widget_margin_u_margin-bottom']) ? $option_settings['widget_margin_u_margin-bottom'] : ''); ?>"
                    placeholder="<?php echo e(translate('Bottom')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-left"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_margin_u_margin-left"
                    id="widget_margin_u_margin-left"
                    value="<?php echo e(isset($option_settings['widget_margin_u_margin-left']) ? $option_settings['widget_margin_u_margin-left'] : ''); ?>"
                    placeholder="<?php echo e(translate('Left')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3 mt-2">
                <select class="form-control select" name="widget_margin_unit_i" id="widget_margin_unit_i">
                    <option value="px"
                        <?php echo e(isset($option_settings['widget_margin_unit_i']) && $option_settings['widget_margin_unit_i'] == 'px' ? 'selected' : ''); ?>>
                        px</option>
                    <option value="em"
                        <?php echo e(isset($option_settings['widget_margin_unit_i']) && $option_settings['widget_margin_unit_i'] == 'em' ? 'selected' : ''); ?>>
                        em</option>
                </select>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Widget Padding')); ?>

            </label>
        </div>
        <div class="col-xl-8 offset-xl-1 row">
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-up"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_padding_u_padding-top"
                    id="widget_padding_u_padding_u_padding-top"
                    value="<?php echo e(isset($option_settings['widget_padding_u_padding-top']) ? $option_settings['widget_padding_u_padding-top'] : ''); ?>"
                    placeholder="<?php echo e(translate('Top')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-right"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_padding_u_padding-right"
                    id="widget_padding_u_padding-right"
                    value="<?php echo e(isset($option_settings['widget_padding_u_padding-right']) ? $option_settings['widget_padding_u_padding-right'] : ''); ?>"
                    placeholder="<?php echo e(translate('Right')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-down"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_padding_u_padding-bottom"
                    id="widget_padding_u_padding-bottom"
                    value="<?php echo e(isset($option_settings['widget_padding_u_padding-bottom']) ? $option_settings['widget_padding_u_padding-bottom'] : ''); ?>"
                    placeholder="<?php echo e(translate('Bottom')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-left"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_padding_u_padding-left"
                    id="widget_padding_u_padding-left"
                    value="<?php echo e(isset($option_settings['widget_padding_u_padding-left']) ? $option_settings['widget_padding_u_padding-left'] : ''); ?>"
                    placeholder="<?php echo e(translate('Left')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3 mt-2">
                <select class="form-control select" name="widget_padding_unit_i" id="widget_padding_unit_i">
                    <option value="px"
                        <?php echo e(isset($option_settings['widget_padding_unit_i']) && $option_settings['widget_padding_unit_i'] == 'px' ? 'selected' : ''); ?>>
                        px</option>
                    <option value="em"
                        <?php echo e(isset($option_settings['widget_padding_unit_i']) && $option_settings['widget_padding_unit_i'] == 'em' ? 'selected' : ''); ?>>
                        em</option>
                </select>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Widget Border')); ?>

            </label>
        </div>
        <div class="col-xl-8 offset-xl-1 row">
            <input type="hidden" name="widget_border_unit_i" value="px">
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-up"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_border_u_border-top"
                    id="widget_border_u_border-top"
                    value="<?php echo e(isset($option_settings['widget_border_u_border-top']) ? $option_settings['widget_border_u_border-top'] : ''); ?>"
                    placeholder="<?php echo e(translate('Top')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-right"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_border_u_border-right"
                    id="widget_border_u_border-right"
                    value="<?php echo e(isset($option_settings['widget_border_u_border-right']) ? $option_settings['widget_border_u_border-right'] : ''); ?>"
                    placeholder="<?php echo e(translate('Right')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-down"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_border_u_border-bottom"
                    id="widget_border_u_border-bottom"
                    value="<?php echo e(isset($option_settings['widget_border_u_border-bottom']) ? $option_settings['widget_border_u_border-bottom'] : ''); ?>"
                    placeholder="<?php echo e(translate('Bottom')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-left"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_border_u_border-left"
                    id="widget_border_u_border-left"
                    value="<?php echo e(isset($option_settings['widget_border_u_border-left']) ? $option_settings['widget_border_u_border-left'] : ''); ?>"
                    placeholder="<?php echo e(translate('Left')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3 mt-2">
                <select class="form-control select" name="widget_border_border-style"
                    id="widget_border_border-style">
                    <option value=""><?php echo e(translate('Select Style')); ?></option>
                    <option value="solid"
                        <?php echo e(isset($option_settings['widget_border_border-style']) && $option_settings['widget_border_border-style'] == 'solid' ? 'selected' : ''); ?>>
                        Solid</option>
                    <option value="dashed"
                        <?php echo e(isset($option_settings['widget_border_border-style']) && $option_settings['widget_border_border-style'] == 'dashed' ? 'selected' : ''); ?>>
                        Dashed</option>
                    <option
                        value="dotted"<?php echo e(isset($option_settings['widget_border_border-style']) && $option_settings['widget_border_border-style'] == 'dotted' ? 'selected' : ''); ?>>
                        Dotted</option>
                    <option value="double"
                        <?php echo e(isset($option_settings['widget_border_border-style']) && $option_settings['widget_border_border-style'] == 'double' ? 'selected' : ''); ?>>
                        Double</option>
                    <option value="none"
                        <?php echo e(isset($option_settings['widget_border_border-style']) && $option_settings['widget_border_border-style'] == 'none' ? 'selected' : ''); ?>>
                        None</option>
                </select>
            </div>
            <div class="input-group my-2  col-xl-5 mt-2">
                <div class="color justify-content-between">
                    <input type="text" class="form-control" name="widget_border_border-color"
                        value="<?php echo e(isset($option_settings['widget_border_border-color']) ? $option_settings['widget_border_border-color'] : ''); ?>">
                    <input type="color" class="" id="widget_border_border-color"
                        value="<?php echo e(isset($option_settings['widget_border_border-color']) ? $option_settings['widget_border_border-color'] : '#fafafa'); ?>">
                    <label for="widget_border_border-color"><?php echo e(translate('Select Color')); ?></label>
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Widget Title Margin')); ?>

            </label>
        </div>
        <div class="col-xl-8 offset-xl-1 row">
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-up"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_title_margin_u_margin-top"
                    id="widget_title_margin_u_margin-top"
                    value="<?php echo e(isset($option_settings['widget_title_margin_u_margin-top']) ? $option_settings['widget_title_margin_u_margin-top'] : ''); ?>"
                    placeholder="<?php echo e(translate('Top')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-right"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_title_margin_u_margin-right"
                    id="widget_title_margin_u_margin-right"
                    value="<?php echo e(isset($option_settings['widget_title_margin_u_margin-right']) ? $option_settings['widget_title_margin_u_margin-right'] : ''); ?>"
                    placeholder="<?php echo e(translate('Right')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-down"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_title_margin_u_margin-bottom"
                    id="widget_title_margin_u_margin-bottom"
                    value="<?php echo e(isset($option_settings['widget_title_margin_u_margin-bottom']) ? $option_settings['widget_title_margin_u_margin-bottom'] : ''); ?>"
                    placeholder="<?php echo e(translate('Bottom')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-left"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_title_margin_u_margin-left"
                    id="widget_title_margin_u_margin-left"
                    value="<?php echo e(isset($option_settings['widget_title_margin_u_margin-left']) ? $option_settings['widget_title_margin_u_margin-left'] : ''); ?>"
                    placeholder="<?php echo e(translate('Left')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3 mt-2">
                <select class="form-control select" name="widget_title_margin_unit_i"
                    id="widget_title_margin_unit_i">
                    <option value="px"
                        <?php echo e(isset($option_settings['widget_title_margin_unit_i']) && $option_settings['widget_title_margin_unit_i'] == 'px' ? 'selected' : ''); ?>>
                        px</option>
                    <option value="em"
                        <?php echo e(isset($option_settings['widget_title_margin_unit_i']) && $option_settings['widget_title_margin_unit_i'] == 'em' ? 'selected' : ''); ?>>
                        em</option>
                </select>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Widget Title Padding')); ?>

            </label>
        </div>
        <div class="col-xl-8 offset-xl-1 row">
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-up"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_title_padding_u_padding-top"
                    id="widget_title_padding_u_padding-top"
                    value="<?php echo e(isset($option_settings['widget_title_padding_u_padding-top']) ? $option_settings['widget_title_padding_u_padding-top'] : ''); ?>"
                    placeholder="<?php echo e(translate('Top')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-right"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_title_padding_u_padding-right"
                    id="widget_title_padding_u_padding-right"
                    value="<?php echo e(isset($option_settings['widget_title_padding_u_padding-right']) ? $option_settings['widget_title_padding_u_padding-right'] : ''); ?>"
                    placeholder="<?php echo e(translate('Right')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-down"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_title_padding_u_padding-bottom"
                    id="widget_title_padding_u_padding-bottom"
                    value="<?php echo e(isset($option_settings['widget_title_padding_u_padding-bottom']) ? $option_settings['widget_title_padding_u_padding-bottom'] : ''); ?>"
                    placeholder="<?php echo e(translate('Bottom')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="icofont-arrow-left"></i>
                    </div>
                </div>
                <input type="number" class="form-control" name="widget_title_padding_u_padding-left"
                    id="widget_title_padding_u_padding-left"
                    value="<?php echo e(isset($option_settings['widget_title_padding_u_padding-left']) ? $option_settings['widget_title_padding_u_padding-left'] : ''); ?>"
                    placeholder="<?php echo e(translate('Left')); ?>">
            </div>
            <div class="input-group my-2  col-xl-3 mt-2">
                <select class="form-control select" name="widget_title_padding_unit_i"
                    id="widget_title_padding_unit_i">
                    <option value="px"
                        <?php echo e(isset($option_settings['widget_title_padding_unit_i']) && $option_settings['widget_title_padding_unit_i'] == 'px' ? 'selected' : ''); ?>>
                        px</option>
                    <option value="em"
                        <?php echo e(isset($option_settings['widget_title_padding_unit_i']) && $option_settings['widget_title_padding_unit_i'] == 'em' ? 'selected' : ''); ?>>
                        em</option>
                </select>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Widget Title Color')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Set Widget Title Color.')); ?></span>
        </div>
        <div class="col-xl-8 offset-xl-1">
            <div class="row ml-2">
                <div class="color justify-content-between">
                    <input type="text" class="form-control" name="widget_title_color"
                        value="<?php echo e(isset($option_settings['widget_title_color']) ? $option_settings['widget_title_color'] : ''); ?>">
                    <input type="color" class="" id="widget_title_color"
                        value="<?php echo e(isset($option_settings['widget_title_color']) ? $option_settings['widget_title_color'] : '#fafafa'); ?>">
                    <label for="widget_title_color"><?php echo e(translate('Select Color')); ?></label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="widget_title_color-transparent_i" value="0">
                        <input type="checkbox"
                            <?php echo e(isset($option_settings['widget_title_color-transparent_i']) && $option_settings['widget_title_color-transparent_i'] == 1 ? 'checked' : ''); ?>

                            name="widget_title_color-transparent_i" id="widget_title_color-transparent_i"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="widget_title_color-transparent_i"><?php echo e(translate('Transparent')); ?></label>
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Widget Text Color')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Set Widget Text Color.')); ?></span>
        </div>
        <div class="col-xl-8 offset-xl-1">
            <div class="row ml-2">
                <div class="color justify-content-between">
                    <input type="text" class="form-control" name="widget_text_color"
                        value="<?php echo e(isset($option_settings['widget_text_color']) ? $option_settings['widget_text_color'] : ''); ?>">
                    <input type="color" class="" id="widget_text_color"
                        value="<?php echo e(isset($option_settings['widget_text_color']) ? $option_settings['widget_text_color'] : '#fafafa'); ?>">
                    <label for="widget_text_color"><?php echo e(translate('Select Color')); ?></label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="widget_text_color-transparent_i" value="0">
                        <input type="checkbox"
                            <?php echo e(isset($option_settings['widget_text_color-transparent_i']) && $option_settings['widget_text_color-transparent_i'] == 1 ? 'checked' : ''); ?>

                            name="widget_text_color-transparent_i" id="widget_text_color-transparent_i"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="widget_text_color-transparent_i"><?php echo e(translate('Transparent')); ?></label>
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Widget Anchor Color')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Set Widget Anchor Color.')); ?></span>
        </div>
        <div class="col-xl-8 offset-xl-1">
            <div class="row ml-2">
                <div class="color justify-content-between">
                    <input type="text" class="form-control" name="widget_anchor_color"
                        value="<?php echo e(isset($option_settings['widget_anchor_color']) ? $option_settings['widget_anchor_color'] : ''); ?>">
                    <input type="color" class="" id="widget_anchor_color"
                        value="<?php echo e(isset($option_settings['widget_anchor_color']) ? $option_settings['widget_anchor_color'] : '#fafafa'); ?>">
                    <label for="widget_anchor_color"><?php echo e(translate('Select Color')); ?></label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="widget_anchor_color-transparent_i" value="0">
                        <input type="checkbox"
                            <?php echo e(isset($option_settings['widget_anchor_color-transparent_i']) && $option_settings['widget_anchor_color-transparent_i'] == 1 ? 'checked' : ''); ?>

                            name="widget_anchor_color-transparent_i" id="widget_anchor_color-transparent_i"
                            value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="widget_anchor_color-transparent_i"><?php echo e(translate('Transparent')); ?></label>
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-3 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Widget Anchor Hover Color')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Set Widget Anchor Hover Color.')); ?></span>
        </div>
        <div class="col-xl-8 offset-xl-1">
            <div class="row ml-2">
                <div class="color justify-content-between">
                    <input type="text" class="form-control" name="widget_anchor_hover_color"
                        value="<?php echo e(isset($option_settings['widget_anchor_hover_color']) ? $option_settings['widget_anchor_hover_color'] : ''); ?>">
                    <input type="color" class="" id="widget_anchor_hover_color"
                        value="<?php echo e(isset($option_settings['widget_anchor_hover_color']) ? $option_settings['widget_anchor_hover_color'] : '#fafafa'); ?>">
                    <label for="widget_anchor_hover_color"><?php echo e(translate('Select Color')); ?></label>
                </div>
                <div class="d-flex align-items-center">
                    <label class="custom-checkbox position-relative ml-2 mr-1">
                        <input type="hidden" name="widget_anchor_hover_color-transparent_i" value="0">
                        <input type="checkbox"
                            <?php echo e(isset($option_settings['widget_anchor_hover_color-transparent_i']) && $option_settings['widget_anchor_hover_color-transparent_i'] == 1 ? 'checked' : ''); ?>

                            name="widget_anchor_hover_color-transparent_i"
                            id="widget_anchor_hover_color-transparent_i" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="black font-16"
                        for="widget_anchor_hover_color-transparent_i"><?php echo e(translate('Transparent')); ?></label>
                </div>
            </div>
        </div>
    </div>
    
</div>

<?php /**PATH /home/ahmedalaa/work/fashly/themes/fashion-theme/resources/views/backend/theme/option-form/sidebar_options.blade.php ENDPATH**/ ?>