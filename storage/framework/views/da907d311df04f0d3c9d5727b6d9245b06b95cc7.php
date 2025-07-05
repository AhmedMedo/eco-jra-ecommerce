<?php
   $fonts = getAllFonts();
?>

<h3 class="black mb-3"><?php echo e(translate('Button Typography')); ?></h3>
<input type="hidden" name="option_name" value="button_typography">


<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3 mb-3">
        <label for="" class="font-16 bold black"><?php echo e(translate('Button Typography')); ?>

        </label>
        <span class="d-block"><?php echo e(translate('These settings control the typography for button.')); ?></span>
    </div>
    <div class="col-xl-8 offset-xl-1">
        <input type="hidden" name="button_typography_google_link_s" id="button_typography_google_link_s" value="<?php echo e(isset($option_settings['button_typography_google_link_s']) ? $option_settings['button_typography_google_link_s']:''); ?>">

        <input type="hidden" name="button_typography_css_i" id="button_typography_css" value="<?php echo e(isset($option_settings['button_typography_css_i']) ? $option_settings['button_typography_css_i']:''); ?>">

        <input type="hidden" name="button_font_unit_i" value="px">
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Font Family')); ?></label>
                    <select name="button_font_font-family" class="form-control select font_family" id="button_font_family" data-section="button">
                        <option value="" <?php echo e(isset($option_settings['button_font_font-family']) ? '':'selected'); ?>><?php echo e(translate('Select  Fonts')); ?></option>
                        <optgroup label="<?php echo e(translate('Custom Fonts')); ?>">
                            <option value="custom-font-1,sans-serif" <?php echo e(isset($option_settings['button_font_font-family']) && $option_settings['button_font_font-family'] == 'custom-font-1,sans-serif' ? 'selected':''); ?> data-subsets="" data-variations=""><?php echo e(translate('Custom Font 1')); ?></option>
                            
                            <option value="custom-font-2,sans-serif" <?php echo e(isset($option_settings['button_font_font-family']) && $option_settings['button_font_font-family'] == 'custom-font-2,sans-serif' ? 'selected':''); ?> data-subsets="" data-variations=""><?php echo e(translate('Custom Font 2')); ?></option>
                        </optgroup>
                        <optgroup label="<?php echo e(translate('Google Web Fonts')); ?>">
                            <?php $__currentLoopData = $fonts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $font): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($font['family'].',sans-serif'); ?>"
                                    <?php echo e(isset($option_settings['button_font_font-family']) && $option_settings['button_font_font-family'] == $font['family'].',sans-serif' ? 'selected':''); ?> 
                                    data-subsets="<?php echo e($font['subsets']); ?>" data-variations="<?php echo e($font['variants']); ?>">
                                    <?php echo e($font['family']); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Font Weight & Style')); ?></label>
                    <input type="hidden" name="button_font_font-style" id="button_font_style" value="<?php echo e(isset($option_settings['button_font_font-style']) ? $option_settings['button_font_font-style']:''); ?>">

                    <input type="hidden" name="button_font_font-weight" id="button_font_weight" value="<?php echo e(isset($option_settings['button_font_font-weight']) ? $option_settings['button_font_font-weight']:''); ?>">

                    <select name="button_font_weight_style_i" class="form-control select" id="button_font_weight_style_i" data-value="<?php echo e(isset($option_settings['button_font_weight_style_i']) ? $option_settings['button_font_weight_style_i']:null); ?>" onchange="createUrl('button')">
                        <option value="" <?php echo e(isset($option_settings['button_font_weight_style_i']) ? '':'selected'); ?>><?php echo e(translate('Select Weight & Style')); ?></option>
                        <option value="400" <?php echo e(isset($option_settings['button_font_weight_style_i']) && $option_settings['button_font_weight_style_i'] == '400' ? 'selected':''); ?>>Normal 400</option>
                        <option value="700" <?php echo e(isset($option_settings['button_font_weight_style_i']) && $option_settings['button_font_weight_style_i'] == '700' ? 'selected':''); ?>>Bold 700</option>
                        <option value="400italic" <?php echo e(isset($option_settings['button_font_weight_style_i']) && $option_settings['button_font_weight_style_i'] == '400italic' ? 'selected':''); ?>>Normal 400 Italic</option>
                        <option value="700italic" <?php echo e(isset($option_settings['button_font_weight_style_i']) && $option_settings['button_font_weight_style_i'] == '700italic' ? 'selected':''); ?>>Bold 700 Italic</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Font Subsets')); ?></label>
                    <select name="button_font_font-subsets_i" class="form-control select" id="button_font_subsets" data-value="<?php echo e(isset($option_settings['button_font_font-subsets_i']) ? $option_settings['button_font_font-subsets_i']:null); ?>"  onchange="createUrl('button')">
                        <option value="" <?php echo e(isset($option_settings['button_font_font-subsets_i']) ? '':'selected'); ?>><?php echo e(translate('Select Font Subsets')); ?></option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Text Align')); ?></label>
                    <select name="button_font_text-align" class="form-control select" id="button_text_align" onchange="createFontCss('button')">
                        <option value="" disabled <?php echo e(isset($option_settings['button_font_text-align']) ? '':'selected'); ?>><?php echo e(translate('Text Align')); ?></option>
                        <option value="inherit" <?php echo e(isset($option_settings['button_font_text-align']) && $option_settings['button_font_text-align'] == 'inherit' ? 'selected':''); ?>>Inherit</option>
                        <option value="left" <?php echo e(isset($option_settings['button_font_text-align']) && $option_settings['button_font_text-align'] == 'left' ? 'selected':''); ?>>Left</option>
                        <option value="right" <?php echo e(isset($option_settings['button_font_text-align']) && $option_settings['button_font_text-align'] == 'right' ? 'selected':''); ?>>Right</option>
                        <option value="center" <?php echo e(isset($option_settings['button_font_text-align']) && $option_settings['button_font_text-align'] == 'center' ? 'selected':''); ?>>Center</option>
                        <option value="justify" <?php echo e(isset($option_settings['button_font_text-align']) && $option_settings['button_font_text-align'] == 'justify' ? 'selected':''); ?>>Justify</option>
                        <option value="initial" <?php echo e(isset($option_settings['button_font_text-align']) && $option_settings['button_font_text-align'] == 'initial' ? 'selected':''); ?>>Initial</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Text Transform')); ?></label>
                    <select name="button_font_text-transform" class="form-control select" id="button_text_transform" onchange="createFontCss('button')">
                        <option value="" disabled <?php echo e(isset($option_settings['button_font_text-transform']) ? '':'selected'); ?>><?php echo e(translate('Text Transform')); ?></option>
                        <option value="none" <?php echo e(isset($option_settings['button_font_text-transform']) && $option_settings['button_font_text-transform'] == 'none' ? 'selected':''); ?>>None</option>
                        <option value="capitalize" <?php echo e(isset($option_settings['button_font_text-transform']) && $option_settings['button_font_text-transform'] == 'capitalize' ? 'selected':''); ?>>Capitalize</option>
                        <option value="uppercase" <?php echo e(isset($option_settings['button_font_text-transform']) && $option_settings['button_font_text-transform'] == 'uppercase' ? 'selected':''); ?>>Uppercase</option>
                        <option value="lowercase" <?php echo e(isset($option_settings['button_font_text-transform']) && $option_settings['button_font_text-transform'] == 'lowercase' ? 'selected':''); ?>>Lowercase</option>
                        <option value="initial" <?php echo e(isset($option_settings['button_font_text-transform']) && $option_settings['button_font_text-transform'] == 'initial' ? 'selected':''); ?>>Initial</option>
                        <option value="inherit" <?php echo e(isset($option_settings['button_font_text-transform']) && $option_settings['button_font_text-transform'] == 'inherit' ? 'selected':''); ?>>Inherit</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label><?php echo e(translate('Font Size')); ?></label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="button_font_u_font-size"
                                id="button_font_size" placeholder="<?php echo e(translate('Size')); ?>" value="<?php echo e(isset($option_settings['button_font_u_font-size']) ? $option_settings['button_font_u_font-size']:''); ?>" onkeyup="createFontCss('button')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label><?php echo e(translate('Line Height')); ?></label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="button_font_u_line-height"
                                id="button_line_height" placeholder="<?php echo e(translate('Height')); ?>" value="<?php echo e(isset($option_settings['button_font_u_line-height']) ? $option_settings['button_font_u_line-height']:''); ?>" onkeyup="createFontCss('button')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 row">
                <div class="col-xl-4">
                    <div class="form-group">
                        <label><?php echo e(translate('Word Spacing')); ?></label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="button_font_u_word-spacing"
                                id="button_word_spacing" placeholder="<?php echo e(translate('Word Spacing')); ?>" value="<?php echo e(isset($option_settings['button_font_u_word-spacing']) ? $option_settings['button_font_u_word-spacing']:''); ?>" onkeyup="createFontCss('button')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <div class="form-group">
                        <label><?php echo e(translate('Letter Spacing')); ?></label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="button_font_u_letter-spacing"
                                id="button_letter_spacing" placeholder="<?php echo e(translate('Letter Spacing')); ?>" value="<?php echo e(isset($option_settings['button_font_u_letter-spacing']) ? $option_settings['button_font_u_letter-spacing']:''); ?>" onkeyup="createFontCss('button')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <label for="button_font_color"><?php echo e(translate('Select Color')); ?></label>
                    <div class="color justify-content-xl-between w-100">
                        <input type="text" class="form-control" name="button_font_color"
                            value="<?php echo e(isset($option_settings['button_font_color']) ? $option_settings['button_font_color']:''); ?>">
                        <input type="color" class="" id="button_font_color" value="<?php echo e(isset($option_settings['button_font_color']) ? $option_settings['button_font_color']:'#fafafa'); ?>" oninput="createFontCss('button')">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 border p-4 typography_preview" id="button_typography_preview">
            <?php echo e(translate('The Quick Brown Fox Jumps Over The Lazy Dog')); ?>

        </div>
    </div>
</div>

<?php /**PATH /home/ahmedalaa/work/fashly/themes/fashion-theme/resources/views/backend/theme/option-form/button_typography.blade.php ENDPATH**/ ?>