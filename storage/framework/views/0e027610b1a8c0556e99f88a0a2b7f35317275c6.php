<?php
   $fonts = getAllFonts();
?>

<h3 class="black mb-3"><?php echo e(translate('Heading Typography')); ?></h3>
<input type="hidden" name="option_name" value="heading_typography">


<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3 mb-3">
        <label for="" class="font-16 bold black"><?php echo e(translate('All Heading Typography')); ?>

        </label>
        <span class="d-block"><?php echo e(translate('These settings control the typography for all Heading.')); ?></span>
    </div>
    <div class="col-xl-8 offset-xl-1">
        <input type="hidden" name="all_heading_typography_google_link_s" id="all_heading_typography_google_link_s" value="<?php echo e(isset($option_settings['all_heading_typography_google_link_s']) ? $option_settings['all_heading_typography_google_link_s']:''); ?>">

        <input type="hidden" name="all_heading_typography_css_i" id="all_heading_typography_css" value="<?php echo e(isset($option_settings['all_heading_typography_css_i']) ? $option_settings['all_heading_typography_css_i']:''); ?>">

        <input type="hidden" name="all_heading_font_unit_i" value="px">
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Font Family')); ?></label>
                    <select name="all_heading_font_font-family" class="form-control select font_family" id="all_heading_font_family" data-section="all_heading">
                        <option value="" <?php echo e(isset($option_settings['all_heading_font_font-family']) ? '':'selected'); ?>><?php echo e(translate('Select  Fonts')); ?></option>
                        <optgroup label="<?php echo e(translate('Custom Fonts')); ?>">
                            <option value="custom-font-1,sans-serif" <?php echo e(isset($option_settings['all_heading_font_font-family']) && $option_settings['all_heading_font_font-family'] == 'custom-font-1,sans-serif' ? 'selected':''); ?> data-subsets="" data-variations=""><?php echo e(translate('Custom Font 1')); ?></option>
                            <option value="custom-font-2,sans-serif" <?php echo e(isset($option_settings['all_heading_font_font-family']) && $option_settings['all_heading_font_font-family'] == 'custom-font-2,sans-serif' ? 'selected':''); ?> data-subsets="" data-variations=""><?php echo e(translate('Custom Font 2')); ?></option>
                        </optgroup>
                        <optgroup label="<?php echo e(translate('Google Web Fonts')); ?>">
                            <?php $__currentLoopData = $fonts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $font): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($font['family'].',sans-serif'); ?>"
                                    <?php echo e(isset($option_settings['all_heading_font_font-family']) && $option_settings['all_heading_font_font-family'] == $font['family'].',sans-serif' ? 'selected':''); ?> 
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
                    <input type="hidden" name="all_heading_font_font-style" id="all_heading_font_style" value="<?php echo e(isset($option_settings['all_heading_font_font-style']) ? $option_settings['all_heading_font_font-style']:''); ?>">

                    <input type="hidden" name="all_heading_font_font-weight" id="all_heading_font_weight" value="<?php echo e(isset($option_settings['all_heading_font_font-weight']) ? $option_settings['all_heading_font_font-weight']:''); ?>">

                    <select name="all_heading_font_weight_style_i" class="form-control select" id="all_heading_font_weight_style_i" data-value="<?php echo e(isset($option_settings['all_heading_font_weight_style_i']) ? $option_settings['all_heading_font_weight_style_i']:null); ?>" onchange="createUrl('all_heading')">
                        <option value="" <?php echo e(isset($option_settings['all_heading_font_weight_style_i']) ? '':'selected'); ?>><?php echo e(translate('Select Weight & Style')); ?></option>
                        <option value="400" <?php echo e(isset($option_settings['all_heading_font_weight_style_i']) && $option_settings['all_heading_font_weight_style_i'] == '400' ? 'selected':''); ?>>Normal 400</option>
                        <option value="700" <?php echo e(isset($option_settings['all_heading_font_weight_style_i']) && $option_settings['all_heading_font_weight_style_i'] == '700' ? 'selected':''); ?>>Bold 700</option>
                        <option value="400italic" <?php echo e(isset($option_settings['all_heading_font_weight_style_i']) && $option_settings['all_heading_font_weight_style_i'] == '400italic' ? 'selected':''); ?>>Normal 400 Italic</option>
                        <option value="700italic" <?php echo e(isset($option_settings['all_heading_font_weight_style_i']) && $option_settings['all_heading_font_weight_style_i'] == '700italic' ? 'selected':''); ?>>Bold 700 Italic</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Font Subsets')); ?></label>
                    <select name="all_heading_font_font-subsets_i" class="form-control select" id="all_heading_font_subsets" data-value="<?php echo e(isset($option_settings['all_heading_font_font-subsets_i']) ? $option_settings['all_heading_font_font-subsets_i']:null); ?>"  onchange="createUrl('all_heading')">
                        <option value="" <?php echo e(isset($option_settings['all_heading_font_font-subsets_i']) ? '':'selected'); ?>><?php echo e(translate('Select Font Subsets')); ?></option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Text Align')); ?></label>
                    <select name="all_heading_font_text-align" class="form-control select" id="all_heading_text_align" onchange="createFontCss('all_heading')">
                        <option value="" disabled <?php echo e(isset($option_settings['all_heading_font_text-align']) ? '':'selected'); ?>><?php echo e(translate('Text Align')); ?></option>
                        <option value="inherit" <?php echo e(isset($option_settings['all_heading_font_text-align']) && $option_settings['all_heading_font_text-align'] == 'inherit' ? 'selected':''); ?>>Inherit</option>
                        <option value="left" <?php echo e(isset($option_settings['all_heading_font_text-align']) && $option_settings['all_heading_font_text-align'] == 'left' ? 'selected':''); ?>>Left</option>
                        <option value="right" <?php echo e(isset($option_settings['all_heading_font_text-align']) && $option_settings['all_heading_font_text-align'] == 'right' ? 'selected':''); ?>>Right</option>
                        <option value="center" <?php echo e(isset($option_settings['all_heading_font_text-align']) && $option_settings['all_heading_font_text-align'] == 'center' ? 'selected':''); ?>>Center</option>
                        <option value="justify" <?php echo e(isset($option_settings['all_heading_font_text-align']) && $option_settings['all_heading_font_text-align'] == 'justify' ? 'selected':''); ?>>Justify</option>
                        <option value="initial" <?php echo e(isset($option_settings['all_heading_font_text-align']) && $option_settings['all_heading_font_text-align'] == 'initial' ? 'selected':''); ?>>Initial</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Text Transform')); ?></label>
                    <select name="all_heading_font_text-transform" class="form-control select" id="all_heading_text_transform" onchange="createFontCss('all_heading')">
                        <option value="" disabled <?php echo e(isset($option_settings['all_heading_font_text-transform']) ? '':'selected'); ?>><?php echo e(translate('Text Transform')); ?></option>
                        <option value="none" <?php echo e(isset($option_settings['all_heading_font_text-transform']) && $option_settings['all_heading_font_text-transform'] == 'none' ? 'selected':''); ?>>None</option>
                        <option value="capitalize" <?php echo e(isset($option_settings['all_heading_font_text-transform']) && $option_settings['all_heading_font_text-transform'] == 'capitalize' ? 'selected':''); ?>>Capitalize</option>
                        <option value="uppercase" <?php echo e(isset($option_settings['all_heading_font_text-transform']) && $option_settings['all_heading_font_text-transform'] == 'uppercase' ? 'selected':''); ?>>Uppercase</option>
                        <option value="lowercase" <?php echo e(isset($option_settings['all_heading_font_text-transform']) && $option_settings['all_heading_font_text-transform'] == 'lowercase' ? 'selected':''); ?>>Lowercase</option>
                        <option value="initial" <?php echo e(isset($option_settings['all_heading_font_text-transform']) && $option_settings['all_heading_font_text-transform'] == 'initial' ? 'selected':''); ?>>Initial</option>
                        <option value="inherit" <?php echo e(isset($option_settings['all_heading_font_text-transform']) && $option_settings['all_heading_font_text-transform'] == 'inherit' ? 'selected':''); ?>>Inherit</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label><?php echo e(translate('Font Size')); ?></label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="all_heading_font_u_font-size"
                                id="all_heading_font_size" placeholder="<?php echo e(translate('Size')); ?>" value="<?php echo e(isset($option_settings['all_heading_font_u_font-size']) ? $option_settings['all_heading_font_u_font-size']:''); ?>" onkeyup="createFontCss('all_heading')">
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
                            <input type="number" class="form-control" name="all_heading_font_u_line-height"
                                id="all_heading_line_height" placeholder="<?php echo e(translate('Height')); ?>" value="<?php echo e(isset($option_settings['all_heading_font_u_line-height']) ? $option_settings['all_heading_font_u_line-height']:''); ?>" onkeyup="createFontCss('all_heading')">
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
                            <input type="number" class="form-control" name="all_heading_font_u_word-spacing"
                                id="all_heading_word_spacing" placeholder="<?php echo e(translate('Word Spacing')); ?>" value="<?php echo e(isset($option_settings['all_heading_font_u_word-spacing']) ? $option_settings['all_heading_font_u_word-spacing']:''); ?>" onkeyup="createFontCss('all_heading')">
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
                            <input type="number" class="form-control" name="all_heading_font_u_letter-spacing"
                                id="all_heading_letter_spacing" placeholder="<?php echo e(translate('Letter Spacing')); ?>" value="<?php echo e(isset($option_settings['all_heading_font_u_letter-spacing']) ? $option_settings['all_heading_font_u_letter-spacing']:''); ?>" onkeyup="createFontCss('all_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <label for="all_heading_font_color"><?php echo e(translate('Select Color')); ?></label>
                    <div class="color justify-content-xl-between w-100">
                        <input type="text" class="form-control" name="all_heading_font_color"
                            value="<?php echo e(isset($option_settings['all_heading_font_color']) ? $option_settings['all_heading_font_color']:''); ?>">
                        <input type="color" class="" id="all_heading_font_color" value="<?php echo e(isset($option_settings['all_heading_font_color']) ? $option_settings['all_heading_font_color']:'#fafafa'); ?>" oninput="createFontCss('all_heading')">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 border p-4 typography_preview" id="all_heading_typography_preview">
            <?php echo e(translate('The Quick Brown Fox Jumps Over The Lazy Dog')); ?>

        </div>
    </div>
</div>



<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3 mb-3">
        <label for="" class="font-16 bold black"><?php echo e(translate('(H1) Heading Typography')); ?>

        </label>
        <span class="d-block"><?php echo e(translate('These settings control the typography for all (H1)Heading.')); ?></span>
    </div>
    <div class="col-xl-8 offset-xl-1">
        <input type="hidden" name="h1_heading_typography_google_link_s" id="h1_heading_typography_google_link_s" value="<?php echo e(isset($option_settings['h1_heading_typography_google_link_s']) ? $option_settings['h1_heading_typography_google_link_s']:''); ?>">
        
        <input type="hidden" name="h1_heading_typography_css_i" id="h1_heading_typography_css" value="<?php echo e(isset($option_settings['h1_heading_typography_css_i']) ? $option_settings['h1_heading_typography_css_i']:''); ?>">

        <input type="hidden" name="h1_heading_font_unit_i" value="px">
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Font Family')); ?></label>
                    <select name="h1_heading_font_font-family" class="form-control select font_family" id="h1_heading_font_family" data-section="h1_heading">
                        <option value="" <?php echo e(isset($option_settings['h1_heading_font_font-family']) ? '':'selected'); ?>><?php echo e(translate('Select  Fonts')); ?></option>
                        <optgroup label="<?php echo e(translate('Custom Fonts')); ?>">
                            <option value="custom-font-1,sans-serif" <?php echo e(isset($option_settings['h1_heading_font_font-family']) && $option_settings['h1_heading_font_font-family'] == 'custom-font-1,sans-serif' ? 'selected':''); ?> data-subsets="" data-variations=""><?php echo e(translate('Custom Font 1')); ?></option>
                            <option value="custom-font-2,sans-serif" <?php echo e(isset($option_settings['h1_heading_font_font-family']) && $option_settings['h1_heading_font_font-family'] == 'custom-font-2,sans-serif' ? 'selected':''); ?> data-subsets="" data-variations=""><?php echo e(translate('Custom Font 2')); ?></option>
                        </optgroup>
                        <optgroup label="<?php echo e(translate('Google Web Fonts')); ?>">
                            <?php $__currentLoopData = $fonts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $font): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($font['family'].',sans-serif'); ?>"
                                    <?php echo e(isset($option_settings['h1_heading_font_font-family']) && $option_settings['h1_heading_font_font-family'] == $font['family'].',sans-serif' ? 'selected':''); ?> 
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
                    <input type="hidden" name="h1_heading_font_font-style" id="h1_heading_font_style" value="<?php echo e(isset($option_settings['h1_heading_font_font-style']) ? $option_settings['h1_heading_font_font-style']:''); ?>">

                    <input type="hidden" name="h1_heading_font_font-weight" id="h1_heading_font_weight" value="<?php echo e(isset($option_settings['h1_heading_font_font-weight']) ? $option_settings['h1_heading_font_font-weight']:''); ?>">

                    <select name="h1_heading_font_weight_style_i" class="form-control select" id="h1_heading_font_weight_style_i" data-value="<?php echo e(isset($option_settings['h1_heading_font_weight_style_i']) ? $option_settings['h1_heading_font_weight_style_i']:null); ?>" onchange="createUrl('h1_heading')">
                        <option value="" <?php echo e(isset($option_settings['h1_heading_font_weight_style_i']) ? '':'selected'); ?>><?php echo e(translate('Select Weight & Style')); ?></option>
                        <option value="400" <?php echo e(isset($option_settings['h1_heading_font_weight_style_i']) && $option_settings['h1_heading_font_weight_style_i'] == '400' ? 'selected':''); ?>>Normal 400</option>
                        <option value="700" <?php echo e(isset($option_settings['h1_heading_font_weight_style_i']) && $option_settings['h1_heading_font_weight_style_i'] == '700' ? 'selected':''); ?>>Bold 700</option>
                        <option value="400italic" <?php echo e(isset($option_settings['h1_heading_font_weight_style_i']) && $option_settings['h1_heading_font_weight_style_i'] == '400italic' ? 'selected':''); ?>>Normal 400 Italic</option>
                        <option value="700italic" <?php echo e(isset($option_settings['h1_heading_font_weight_style_i']) && $option_settings['h1_heading_font_weight_style_i'] == '700italic' ? 'selected':''); ?>>Bold 700 Italic</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Font Subsets')); ?></label>
                    <select name="h1_heading_font_font-subsets_i" class="form-control select" id="h1_heading_font_subsets" data-value="<?php echo e(isset($option_settings['h1_heading_font_font-subsets_i']) ? $option_settings['h1_heading_font_font-subsets_i']:null); ?>"  onchange="createUrl('h1_heading')">
                        <option value="" <?php echo e(isset($option_settings['h1_heading_font_font-subsets_i']) ? '':'selected'); ?>><?php echo e(translate('Select Font Subsets')); ?></option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Text Align')); ?></label>
                    <select name="h1_heading_font_text-align" class="form-control select" id="h1_heading_text_align" onchange="createFontCss('h1_heading')">
                        <option value="" disabled <?php echo e(isset($option_settings['h1_heading_font_text-align']) ? '':'selected'); ?>><?php echo e(translate('Text Align')); ?></option>
                        <option value="inherit" <?php echo e(isset($option_settings['h1_heading_font_text-align']) && $option_settings['h1_heading_font_text-align'] == 'inherit' ? 'selected':''); ?>>Inherit</option>
                        <option value="left" <?php echo e(isset($option_settings['h1_heading_font_text-align']) && $option_settings['h1_heading_font_text-align'] == 'left' ? 'selected':''); ?>>Left</option>
                        <option value="right" <?php echo e(isset($option_settings['h1_heading_font_text-align']) && $option_settings['h1_heading_font_text-align'] == 'right' ? 'selected':''); ?>>Right</option>
                        <option value="center" <?php echo e(isset($option_settings['h1_heading_font_text-align']) && $option_settings['h1_heading_font_text-align'] == 'center' ? 'selected':''); ?>>Center</option>
                        <option value="justify" <?php echo e(isset($option_settings['h1_heading_font_text-align']) && $option_settings['h1_heading_font_text-align'] == 'justify' ? 'selected':''); ?>>Justify</option>
                        <option value="initial" <?php echo e(isset($option_settings['h1_heading_font_text-align']) && $option_settings['h1_heading_font_text-align'] == 'initial' ? 'selected':''); ?>>Initial</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Text Transform')); ?></label>
                    <select name="h1_heading_font_text-transform" class="form-control select" id="h1_heading_text_transform" onchange="createFontCss('h1_heading')">
                        <option value="" disabled <?php echo e(isset($option_settings['h1_heading_font_text-transform']) ? '':'selected'); ?>><?php echo e(translate('Text Transform')); ?></option>
                        <option value="none" <?php echo e(isset($option_settings['h1_heading_font_text-transform']) && $option_settings['h1_heading_font_text-transform'] == 'none' ? 'selected':''); ?>>None</option>
                        <option value="capitalize" <?php echo e(isset($option_settings['h1_heading_font_text-transform']) && $option_settings['h1_heading_font_text-transform'] == 'capitalize' ? 'selected':''); ?>>Capitalize</option>
                        <option value="uppercase" <?php echo e(isset($option_settings['h1_heading_font_text-transform']) && $option_settings['h1_heading_font_text-transform'] == 'uppercase' ? 'selected':''); ?>>Uppercase</option>
                        <option value="lowercase" <?php echo e(isset($option_settings['h1_heading_font_text-transform']) && $option_settings['h1_heading_font_text-transform'] == 'lowercase' ? 'selected':''); ?>>Lowercase</option>
                        <option value="initial" <?php echo e(isset($option_settings['h1_heading_font_text-transform']) && $option_settings['h1_heading_font_text-transform'] == 'initial' ? 'selected':''); ?>>Initial</option>
                        <option value="inherit" <?php echo e(isset($option_settings['h1_heading_font_text-transform']) && $option_settings['h1_heading_font_text-transform'] == 'inherit' ? 'selected':''); ?>>Inherit</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label><?php echo e(translate('Font Size')); ?></label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h1_heading_font_u_font-size"
                                id="h1_heading_font_size" placeholder="<?php echo e(translate('Size')); ?>" value="<?php echo e(isset($option_settings['h1_heading_font_u_font-size']) ? $option_settings['h1_heading_font_u_font-size']:''); ?>" onkeyup="createFontCss('h1_heading')">
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
                            <input type="number" class="form-control" name="h1_heading_font_u_line-height"
                                id="h1_heading_line_height" placeholder="<?php echo e(translate('Height')); ?>" value="<?php echo e(isset($option_settings['h1_heading_font_u_line-height']) ? $option_settings['h1_heading_font_u_line-height']:''); ?>" onkeyup="createFontCss('h1_heading')">
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
                            <input type="number" class="form-control" name="h1_heading_font_u_word-spacing"
                                id="h1_heading_word_spacing" placeholder="<?php echo e(translate('Word Spacing')); ?>" value="<?php echo e(isset($option_settings['h1_heading_font_u_word-spacing']) ? $option_settings['h1_heading_font_u_word-spacing']:''); ?>" onkeyup="createFontCss('h1_heading')">
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
                            <input type="number" class="form-control" name="h1_heading_font_u_letter-spacing"
                                id="h1_heading_letter_spacing" placeholder="<?php echo e(translate('Letter Spacing')); ?>" value="<?php echo e(isset($option_settings['h1_heading_font_u_letter-spacing']) ? $option_settings['h1_heading_font_u_letter-spacing']:''); ?>" onkeyup="createFontCss('h1_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <label for="h1_heading_font_color"><?php echo e(translate('Select Color')); ?></label>
                    <div class="color justify-content-xl-between w-100">
                        <input type="text" class="form-control" name="h1_heading_font_color"
                            value="<?php echo e(isset($option_settings['h1_heading_font_color']) ? $option_settings['h1_heading_font_color']:''); ?>">
                        <input type="color" class="" id="h1_heading_font_color" value="<?php echo e(isset($option_settings['h1_heading_font_color']) ? $option_settings['h1_heading_font_color']:'#fafafa'); ?>" oninput="createFontCss('h1_heading')">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 border p-4 typography_preview" id="h1_heading_typography_preview">
            <?php echo e(translate('The Quick Brown Fox Jumps Over The Lazy Dog')); ?>

        </div>
    </div>
</div>



<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3 mb-3">
        <label for="" class="font-16 bold black"><?php echo e(translate('(H2) Heading Typography')); ?>

        </label>
        <span class="d-block"><?php echo e(translate('These settings control the typography for all (H2)Heading.')); ?></span>
    </div>
    <div class="col-xl-8 offset-xl-1">
        <input type="hidden" name="h2_heading_typography_google_link_s" id="h2_heading_typography_google_link_s" value="<?php echo e(isset($option_settings['h2_heading_typography_google_link_s']) ? $option_settings['h2_heading_typography_google_link_s']:''); ?>">

        <input type="hidden" name="h2_heading_typography_css_i" id="h2_heading_typography_css" value="<?php echo e(isset($option_settings['h2_heading_typography_css_i']) ? $option_settings['h2_heading_typography_css_i']:''); ?>">

        <input type="hidden" name="h2_heading_font_unit_i" value="px">
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Font Family')); ?></label>
                    <select name="h2_heading_font_font-family" class="form-control select font_family" id="h2_heading_font_family" data-section="h2_heading">
                        <option value="" <?php echo e(isset($option_settings['h2_heading_font_font-family']) ? '':'selected'); ?>><?php echo e(translate('Select  Fonts')); ?></option>
                        <optgroup label="<?php echo e(translate('Custom Fonts')); ?>">
                            <option value="custom-font-1,sans-serif" <?php echo e(isset($option_settings['h2_heading_font_font-family']) && $option_settings['h2_heading_font_font-family'] == 'custom-font-1,sans-serif' ? 'selected':''); ?> data-subsets="" data-variations=""><?php echo e(translate('Custom Font 1')); ?></option>
                            <option value="custom-font-2,sans-serif" <?php echo e(isset($option_settings['h2_heading_font_font-family']) && $option_settings['h2_heading_font_font-family'] == 'custom-font-2,sans-serif' ? 'selected':''); ?> data-subsets="" data-variations=""><?php echo e(translate('Custom Font 2')); ?></option>
                        </optgroup>
                        <optgroup label="<?php echo e(translate('Google Web Fonts')); ?>">
                            <?php $__currentLoopData = $fonts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $font): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($font['family'].',sans-serif'); ?>"
                                    <?php echo e(isset($option_settings['h2_heading_font_font-family']) && $option_settings['h2_heading_font_font-family'] == $font['family'].',sans-serif' ? 'selected':''); ?> 
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
                    <input type="hidden" name="h2_heading_font_font-style" id="h2_heading_font_style" value="<?php echo e(isset($option_settings['h2_heading_font_font-style']) ? $option_settings['h2_heading_font_font-style']:''); ?>">

                    <input type="hidden" name="h2_heading_font_font-weight" id="h2_heading_font_weight" value="<?php echo e(isset($option_settings['h2_heading_font_font-weight']) ? $option_settings['h2_heading_font_font-weight']:''); ?>">

                    <select name="h2_heading_font_weight_style_i" class="form-control select" id="h2_heading_font_weight_style_i" data-value="<?php echo e(isset($option_settings['h2_heading_font_weight_style_i']) ? $option_settings['h2_heading_font_weight_style_i']:null); ?>" onchange="createUrl('h2_heading')">
                        <option value="" <?php echo e(isset($option_settings['h2_heading_font_weight_style_i']) ? '':'selected'); ?>><?php echo e(translate('Select Weight & Style')); ?></option>
                        <option value="400" <?php echo e(isset($option_settings['h2_heading_font_weight_style_i']) && $option_settings['h2_heading_font_weight_style_i'] == '400' ? 'selected':''); ?>>Normal 400</option>
                        <option value="700" <?php echo e(isset($option_settings['h2_heading_font_weight_style_i']) && $option_settings['h2_heading_font_weight_style_i'] == '700' ? 'selected':''); ?>>Bold 700</option>
                        <option value="400italic" <?php echo e(isset($option_settings['h2_heading_font_weight_style_i']) && $option_settings['h2_heading_font_weight_style_i'] == '400italic' ? 'selected':''); ?>>Normal 400 Italic</option>
                        <option value="700italic" <?php echo e(isset($option_settings['h2_heading_font_weight_style_i']) && $option_settings['h2_heading_font_weight_style_i'] == '700italic' ? 'selected':''); ?>>Bold 700 Italic</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Font Subsets')); ?></label>
                    <select name="h2_heading_font_font-subsets_i" class="form-control select" id="h2_heading_font_subsets" data-value="<?php echo e(isset($option_settings['h2_heading_font_font-subsets_i']) ? $option_settings['h2_heading_font_font-subsets_i']:null); ?>"  onchange="createUrl('h2_heading')">
                        <option value="" <?php echo e(isset($option_settings['h2_heading_font_font-subsets_i']) ? '':'selected'); ?>><?php echo e(translate('Select Font Subsets')); ?></option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Text Align')); ?></label>
                    <select name="h2_heading_font_text-align" class="form-control select" id="h2_heading_text_align" onchange="createFontCss('h2_heading')">
                        <option value="" disabled <?php echo e(isset($option_settings['h2_heading_font_text-align']) ? '':'selected'); ?>><?php echo e(translate('Text Align')); ?></option>
                        <option value="inherit" <?php echo e(isset($option_settings['h2_heading_font_text-align']) && $option_settings['h2_heading_font_text-align'] == 'inherit' ? 'selected':''); ?>>Inherit</option>
                        <option value="left" <?php echo e(isset($option_settings['h2_heading_font_text-align']) && $option_settings['h2_heading_font_text-align'] == 'left' ? 'selected':''); ?>>Left</option>
                        <option value="right" <?php echo e(isset($option_settings['h2_heading_font_text-align']) && $option_settings['h2_heading_font_text-align'] == 'right' ? 'selected':''); ?>>Right</option>
                        <option value="center" <?php echo e(isset($option_settings['h2_heading_font_text-align']) && $option_settings['h2_heading_font_text-align'] == 'center' ? 'selected':''); ?>>Center</option>
                        <option value="justify" <?php echo e(isset($option_settings['h2_heading_font_text-align']) && $option_settings['h2_heading_font_text-align'] == 'justify' ? 'selected':''); ?>>Justify</option>
                        <option value="initial" <?php echo e(isset($option_settings['h2_heading_font_text-align']) && $option_settings['h2_heading_font_text-align'] == 'initial' ? 'selected':''); ?>>Initial</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Text Transform')); ?></label>
                    <select name="h2_heading_font_text-transform" class="form-control select" id="h2_heading_text_transform" onchange="createFontCss('h2_heading')">
                        <option value="" disabled <?php echo e(isset($option_settings['h2_heading_font_text-transform']) ? '':'selected'); ?>><?php echo e(translate('Text Transform')); ?></option>
                        <option value="none" <?php echo e(isset($option_settings['h2_heading_font_text-transform']) && $option_settings['h2_heading_font_text-transform'] == 'none' ? 'selected':''); ?>>None</option>
                        <option value="capitalize" <?php echo e(isset($option_settings['h2_heading_font_text-transform']) && $option_settings['h2_heading_font_text-transform'] == 'capitalize' ? 'selected':''); ?>>Capitalize</option>
                        <option value="uppercase" <?php echo e(isset($option_settings['h2_heading_font_text-transform']) && $option_settings['h2_heading_font_text-transform'] == 'uppercase' ? 'selected':''); ?>>Uppercase</option>
                        <option value="lowercase" <?php echo e(isset($option_settings['h2_heading_font_text-transform']) && $option_settings['h2_heading_font_text-transform'] == 'lowercase' ? 'selected':''); ?>>Lowercase</option>
                        <option value="initial" <?php echo e(isset($option_settings['h2_heading_font_text-transform']) && $option_settings['h2_heading_font_text-transform'] == 'initial' ? 'selected':''); ?>>Initial</option>
                        <option value="inherit" <?php echo e(isset($option_settings['h2_heading_font_text-transform']) && $option_settings['h2_heading_font_text-transform'] == 'inherit' ? 'selected':''); ?>>Inherit</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label><?php echo e(translate('Font Size')); ?></label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h2_heading_font_u_font-size"
                                id="h2_heading_font_size" placeholder="<?php echo e(translate('Size')); ?>" value="<?php echo e(isset($option_settings['h2_heading_font_u_font-size']) ? $option_settings['h2_heading_font_u_font-size']:''); ?>" onkeyup="createFontCss('h2_heading')">
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
                            <input type="number" class="form-control" name="h2_heading_font_u_line-height"
                                id="h2_heading_line_height" placeholder="<?php echo e(translate('Height')); ?>" value="<?php echo e(isset($option_settings['h2_heading_font_u_line-height']) ? $option_settings['h2_heading_font_u_line-height']:''); ?>" onkeyup="createFontCss('h2_heading')">
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
                            <input type="number" class="form-control" name="h2_heading_font_u_word-spacing"
                                id="h2_heading_word_spacing" placeholder="<?php echo e(translate('Word Spacing')); ?>" value="<?php echo e(isset($option_settings['h2_heading_font_u_word-spacing']) ? $option_settings['h2_heading_font_u_word-spacing']:''); ?>" onkeyup="createFontCss('h2_heading')">
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
                            <input type="number" class="form-control" name="h2_heading_font_u_letter-spacing"
                                id="h2_heading_letter_spacing" placeholder="<?php echo e(translate('Letter Spacing')); ?>" value="<?php echo e(isset($option_settings['h2_heading_font_u_letter-spacing']) ? $option_settings['h2_heading_font_u_letter-spacing']:''); ?>" onkeyup="createFontCss('h2_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <label for="h2_heading_font_color"><?php echo e(translate('Select Color')); ?></label>
                    <div class="color justify-content-xl-between w-100">
                        <input type="text" class="form-control" name="h2_heading_font_color"
                            value="<?php echo e(isset($option_settings['h2_heading_font_color']) ? $option_settings['h2_heading_font_color']:''); ?>">
                        <input type="color" class="" id="h2_heading_font_color" value="<?php echo e(isset($option_settings['h2_heading_font_color']) ? $option_settings['h2_heading_font_color']:'#fafafa'); ?>" oninput="createFontCss('h2_heading')">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 border p-4 typography_preview" id="h2_heading_typography_preview">
            <?php echo e(translate('The Quick Brown Fox Jumps Over The Lazy Dog')); ?>

        </div>
    </div>
</div>



<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3 mb-3">
        <label for="" class="font-16 bold black"><?php echo e(translate('(H3) Heading Typography')); ?>

        </label>
        <span class="d-block"><?php echo e(translate('These settings control the typography for all (H3)Heading.')); ?></span>
    </div>
    <div class="col-xl-8 offset-xl-1">
        <input type="hidden" name="h3_heading_typography_google_link_s" id="h3_heading_typography_google_link_s" value="<?php echo e(isset($option_settings['h3_heading_typography_google_link_s']) ? $option_settings['h3_heading_typography_google_link_s']:''); ?>">

        <input type="hidden" name="h3_heading_typography_css_i" id="h3_heading_typography_css" value="<?php echo e(isset($option_settings['h3_heading_typography_css_i']) ? $option_settings['h3_heading_typography_css_i']:''); ?>">

        <input type="hidden" name="h3_heading_font_unit_i" value="px">
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Font Family')); ?></label>
                    <select name="h3_heading_font_font-family" class="form-control select font_family" id="h3_heading_font_family" data-section="h3_heading">
                        <option value="" <?php echo e(isset($option_settings['h3_heading_font_font-family']) ? '':'selected'); ?>><?php echo e(translate('Select  Fonts')); ?></option>
                        <optgroup label="<?php echo e(translate('Custom Fonts')); ?>">
                            <option value="custom-font-1,sans-serif" <?php echo e(isset($option_settings['h3_heading_font_font-family']) && $option_settings['h3_heading_font_font-family'] == 'custom-font-1,sans-serif' ? 'selected':''); ?> data-subsets="" data-variations=""><?php echo e(translate('Custom Font 1')); ?></option>

                            <option value="custom-font-2,sans-serif" <?php echo e(isset($option_settings['h3_heading_font_font-family']) && $option_settings['h3_heading_font_font-family'] == 'custom-font-2,sans-serif' ? 'selected':''); ?> data-subsets="" data-variations=""><?php echo e(translate('Custom Font 2')); ?></option>
                        </optgroup>
                        <optgroup label="<?php echo e(translate('Google Web Fonts')); ?>">
                            <?php $__currentLoopData = $fonts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $font): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($font['family'].',sans-serif'); ?>"
                                    <?php echo e(isset($option_settings['h3_heading_font_font-family']) && $option_settings['h3_heading_font_font-family'] == $font['family'].',sans-serif' ? 'selected':''); ?> 
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
                    <input type="hidden" name="h3_heading_font_font-style" id="h3_heading_font_style" value="<?php echo e(isset($option_settings['h3_heading_font_font-style']) ? $option_settings['h3_heading_font_font-style']:''); ?>">

                    <input type="hidden" name="h3_heading_font_font-weight" id="h3_heading_font_weight" value="<?php echo e(isset($option_settings['h3_heading_font_font-weight']) ? $option_settings['h3_heading_font_font-weight']:''); ?>">

                    <select name="h3_heading_font_weight_style_i" class="form-control select" id="h3_heading_font_weight_style_i" data-value="<?php echo e(isset($option_settings['h3_heading_font_weight_style_i']) ? $option_settings['h3_heading_font_weight_style_i']:null); ?>" onchange="createUrl('h3_heading')">
                        <option value="" <?php echo e(isset($option_settings['h3_heading_font_weight_style_i']) ? '':'selected'); ?>><?php echo e(translate('Select Weight & Style')); ?></option>
                        <option value="400" <?php echo e(isset($option_settings['h3_heading_font_weight_style_i']) && $option_settings['h3_heading_font_weight_style_i'] == '400' ? 'selected':''); ?>>Normal 400</option>
                        <option value="700" <?php echo e(isset($option_settings['h3_heading_font_weight_style_i']) && $option_settings['h3_heading_font_weight_style_i'] == '700' ? 'selected':''); ?>>Bold 700</option>
                        <option value="400italic" <?php echo e(isset($option_settings['h3_heading_font_weight_style_i']) && $option_settings['h3_heading_font_weight_style_i'] == '400italic' ? 'selected':''); ?>>Normal 400 Italic</option>
                        <option value="700italic" <?php echo e(isset($option_settings['h3_heading_font_weight_style_i']) && $option_settings['h3_heading_font_weight_style_i'] == '700italic' ? 'selected':''); ?>>Bold 700 Italic</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Font Subsets')); ?></label>
                    <select name="h3_heading_font_font-subsets_i" class="form-control select" id="h3_heading_font_subsets" data-value="<?php echo e(isset($option_settings['h3_heading_font_font-subsets_i']) ? $option_settings['h3_heading_font_font-subsets_i']:null); ?>"  onchange="createUrl('h3_heading')">
                        <option value="" <?php echo e(isset($option_settings['h3_heading_font_font-subsets_i']) ? '':'selected'); ?>><?php echo e(translate('Select Font Subsets')); ?></option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Text Align')); ?></label>
                    <select name="h3_heading_font_text-align" class="form-control select" id="h3_heading_text_align" onchange="createFontCss('h3_heading')">
                        <option value="" disabled <?php echo e(isset($option_settings['h3_heading_font_text-align']) ? '':'selected'); ?>><?php echo e(translate('Text Align')); ?></option>
                        <option value="inherit" <?php echo e(isset($option_settings['h3_heading_font_text-align']) && $option_settings['h3_heading_font_text-align'] == 'inherit' ? 'selected':''); ?>>Inherit</option>
                        <option value="left" <?php echo e(isset($option_settings['h3_heading_font_text-align']) && $option_settings['h3_heading_font_text-align'] == 'left' ? 'selected':''); ?>>Left</option>
                        <option value="right" <?php echo e(isset($option_settings['h3_heading_font_text-align']) && $option_settings['h3_heading_font_text-align'] == 'right' ? 'selected':''); ?>>Right</option>
                        <option value="center" <?php echo e(isset($option_settings['h3_heading_font_text-align']) && $option_settings['h3_heading_font_text-align'] == 'center' ? 'selected':''); ?>>Center</option>
                        <option value="justify" <?php echo e(isset($option_settings['h3_heading_font_text-align']) && $option_settings['h3_heading_font_text-align'] == 'justify' ? 'selected':''); ?>>Justify</option>
                        <option value="initial" <?php echo e(isset($option_settings['h3_heading_font_text-align']) && $option_settings['h3_heading_font_text-align'] == 'initial' ? 'selected':''); ?>>Initial</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Text Transform')); ?></label>
                    <select name="h3_heading_font_text-transform" class="form-control select" id="h3_heading_text_transform" onchange="createFontCss('h3_heading')">
                        <option value="" disabled <?php echo e(isset($option_settings['h3_heading_font_text-transform']) ? '':'selected'); ?>><?php echo e(translate('Text Transform')); ?></option>
                        <option value="none" <?php echo e(isset($option_settings['h3_heading_font_text-transform']) && $option_settings['h3_heading_font_text-transform'] == 'none' ? 'selected':''); ?>>None</option>
                        <option value="capitalize" <?php echo e(isset($option_settings['h3_heading_font_text-transform']) && $option_settings['h3_heading_font_text-transform'] == 'capitalize' ? 'selected':''); ?>>Capitalize</option>
                        <option value="uppercase" <?php echo e(isset($option_settings['h3_heading_font_text-transform']) && $option_settings['h3_heading_font_text-transform'] == 'uppercase' ? 'selected':''); ?>>Uppercase</option>
                        <option value="lowercase" <?php echo e(isset($option_settings['h3_heading_font_text-transform']) && $option_settings['h3_heading_font_text-transform'] == 'lowercase' ? 'selected':''); ?>>Lowercase</option>
                        <option value="initial" <?php echo e(isset($option_settings['h3_heading_font_text-transform']) && $option_settings['h3_heading_font_text-transform'] == 'initial' ? 'selected':''); ?>>Initial</option>
                        <option value="inherit" <?php echo e(isset($option_settings['h3_heading_font_text-transform']) && $option_settings['h3_heading_font_text-transform'] == 'inherit' ? 'selected':''); ?>>Inherit</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label><?php echo e(translate('Font Size')); ?></label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h3_heading_font_u_font-size"
                                id="h3_heading_font_size" placeholder="<?php echo e(translate('Size')); ?>" value="<?php echo e(isset($option_settings['h3_heading_font_u_font-size']) ? $option_settings['h3_heading_font_u_font-size']:''); ?>" onkeyup="createFontCss('h3_heading')">
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
                            <input type="number" class="form-control" name="h3_heading_font_u_line-height"
                                id="h3_heading_line_height" placeholder="<?php echo e(translate('Height')); ?>" value="<?php echo e(isset($option_settings['h3_heading_font_u_line-height']) ? $option_settings['h3_heading_font_u_line-height']:''); ?>" onkeyup="createFontCss('h3_heading')">
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
                            <input type="number" class="form-control" name="h3_heading_font_u_word-spacing"
                                id="h3_heading_word_spacing" placeholder="<?php echo e(translate('Word Spacing')); ?>" value="<?php echo e(isset($option_settings['h3_heading_font_u_word-spacing']) ? $option_settings['h3_heading_font_u_word-spacing']:''); ?>" onkeyup="createFontCss('h3_heading')">
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
                            <input type="number" class="form-control" name="h3_heading_font_u_letter-spacing"
                                id="h3_heading_letter_spacing" placeholder="<?php echo e(translate('Letter Spacing')); ?>" value="<?php echo e(isset($option_settings['h3_heading_font_u_letter-spacing']) ? $option_settings['h3_heading_font_u_letter-spacing']:''); ?>" onkeyup="createFontCss('h3_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <label for="h3_heading_font_color"><?php echo e(translate('Select Color')); ?></label>
                    <div class="color justify-content-xl-between w-100">
                        <input type="text" class="form-control" name="h3_heading_font_color"
                            value="<?php echo e(isset($option_settings['h3_heading_font_color']) ? $option_settings['h3_heading_font_color']:''); ?>">
                        <input type="color" class="" id="h3_heading_font_color" value="<?php echo e(isset($option_settings['h3_heading_font_color']) ? $option_settings['h3_heading_font_color']:'#fafafa'); ?>" oninput="createFontCss('h3_heading')">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 border p-4 typography_preview" id="h3_heading_typography_preview">
            <?php echo e(translate('The Quick Brown Fox Jumps Over The Lazy Dog')); ?>

        </div>
    </div>
</div>



<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3 mb-3">
        <label for="" class="font-16 bold black"><?php echo e(translate('(H4) Heading Typography')); ?>

        </label>
        <span class="d-block"><?php echo e(translate('These settings control the typography for all (H4)Heading.')); ?></span>
    </div>
    <div class="col-xl-8 offset-xl-1">
        <input type="hidden" name="h4_heading_typography_google_link_s" id="h4_heading_typography_google_link_s" value="<?php echo e(isset($option_settings['h4_heading_typography_google_link_s']) ? $option_settings['h4_heading_typography_google_link_s']:''); ?>">

        <input type="hidden" name="h4_heading_typography_css_i" id="h4_heading_typography_css" value="<?php echo e(isset($option_settings['h4_heading_typography_css_i']) ? $option_settings['h4_heading_typography_css_i']:''); ?>">

        <input type="hidden" name="h4_heading_font_unit_i" value="px">
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Font Family')); ?></label>
                    <select name="h4_heading_font_font-family" class="form-control select font_family" id="h4_heading_font_family" data-section="h4_heading">
                        <option value="" <?php echo e(isset($option_settings['h4_heading_font_font-family']) ? '':'selected'); ?>><?php echo e(translate('Select  Fonts')); ?></option>
                        <optgroup label="<?php echo e(translate('Custom Fonts')); ?>">
                            <option value="custom-font-1,sans-serif" <?php echo e(isset($option_settings['h4_heading_font_font-family']) && $option_settings['h4_heading_font_font-family'] == 'custom-font-1,sans-serif' ? 'selected':''); ?> data-subsets="" data-variations=""><?php echo e(translate('Custom Font 1')); ?></option>

                            <option value="custom-font-2,sans-serif" <?php echo e(isset($option_settings['h4_heading_font_font-family']) && $option_settings['h4_heading_font_font-family'] == 'custom-font-2,sans-serif' ? 'selected':''); ?> data-subsets="" data-variations=""><?php echo e(translate('Custom Font 2')); ?></option>
                        </optgroup>
                        <optgroup label="<?php echo e(translate('Google Web Fonts')); ?>">
                            <?php $__currentLoopData = $fonts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $font): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($font['family'].',sans-serif'); ?>"
                                    <?php echo e(isset($option_settings['h4_heading_font_font-family']) && $option_settings['h4_heading_font_font-family'] == $font['family'].',sans-serif' ? 'selected':''); ?> 
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
                    <input type="hidden" name="h4_heading_font_font-style" id="h4_heading_font_style" value="<?php echo e(isset($option_settings['h4_heading_font_font-style']) ? $option_settings['h4_heading_font_font-style']:''); ?>">

                    <input type="hidden" name="h4_heading_font_font-weight" id="h4_heading_font_weight" value="<?php echo e(isset($option_settings['h4_heading_font_font-weight']) ? $option_settings['h4_heading_font_font-weight']:''); ?>">

                    <select name="h4_heading_font_weight_style_i" class="form-control select" id="h4_heading_font_weight_style_i" data-value="<?php echo e(isset($option_settings['h4_heading_font_weight_style_i']) ? $option_settings['h4_heading_font_weight_style_i']:null); ?>" onchange="createUrl('h4_heading')">
                        <option value="" <?php echo e(isset($option_settings['h4_heading_font_weight_style_i']) ? '':'selected'); ?>><?php echo e(translate('Select Weight & Style')); ?></option>
                        <option value="400" <?php echo e(isset($option_settings['h4_heading_font_weight_style_i']) && $option_settings['h4_heading_font_weight_style_i'] == '400' ? 'selected':''); ?>>Normal 400</option>
                        <option value="700" <?php echo e(isset($option_settings['h4_heading_font_weight_style_i']) && $option_settings['h4_heading_font_weight_style_i'] == '700' ? 'selected':''); ?>>Bold 700</option>
                        <option value="400italic" <?php echo e(isset($option_settings['h4_heading_font_weight_style_i']) && $option_settings['h4_heading_font_weight_style_i'] == '400italic' ? 'selected':''); ?>>Normal 400 Italic</option>
                        <option value="700italic" <?php echo e(isset($option_settings['h4_heading_font_weight_style_i']) && $option_settings['h4_heading_font_weight_style_i'] == '700italic' ? 'selected':''); ?>>Bold 700 Italic</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Font Subsets')); ?></label>
                    <select name="h4_heading_font_font-subsets_i" class="form-control select" id="h4_heading_font_subsets" data-value="<?php echo e(isset($option_settings['h4_heading_font_font-subsets_i']) ? $option_settings['h4_heading_font_font-subsets_i']:null); ?>"  onchange="createUrl('h4_heading')">
                        <option value="" <?php echo e(isset($option_settings['h4_heading_font_font-subsets_i']) ? '':'selected'); ?>><?php echo e(translate('Select Font Subsets')); ?></option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Text Align')); ?></label>
                    <select name="h4_heading_font_text-align" class="form-control select" id="h4_heading_text_align" onchange="createFontCss('h4_heading')">
                        <option value="" disabled <?php echo e(isset($option_settings['h4_heading_font_text-align']) ? '':'selected'); ?>><?php echo e(translate('Text Align')); ?></option>
                        <option value="inherit" <?php echo e(isset($option_settings['h4_heading_font_text-align']) && $option_settings['h4_heading_font_text-align'] == 'inherit' ? 'selected':''); ?>>Inherit</option>
                        <option value="left" <?php echo e(isset($option_settings['h4_heading_font_text-align']) && $option_settings['h4_heading_font_text-align'] == 'left' ? 'selected':''); ?>>Left</option>
                        <option value="right" <?php echo e(isset($option_settings['h4_heading_font_text-align']) && $option_settings['h4_heading_font_text-align'] == 'right' ? 'selected':''); ?>>Right</option>
                        <option value="center" <?php echo e(isset($option_settings['h4_heading_font_text-align']) && $option_settings['h4_heading_font_text-align'] == 'center' ? 'selected':''); ?>>Center</option>
                        <option value="justify" <?php echo e(isset($option_settings['h4_heading_font_text-align']) && $option_settings['h4_heading_font_text-align'] == 'justify' ? 'selected':''); ?>>Justify</option>
                        <option value="initial" <?php echo e(isset($option_settings['h4_heading_font_text-align']) && $option_settings['h4_heading_font_text-align'] == 'initial' ? 'selected':''); ?>>Initial</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Text Transform')); ?></label>
                    <select name="h4_heading_font_text-transform" class="form-control select" id="h4_heading_text_transform" onchange="createFontCss('h4_heading')">
                        <option value="" disabled <?php echo e(isset($option_settings['h4_heading_font_text-transform']) ? '':'selected'); ?>><?php echo e(translate('Text Transform')); ?></option>
                        <option value="none" <?php echo e(isset($option_settings['h4_heading_font_text-transform']) && $option_settings['h4_heading_font_text-transform'] == 'none' ? 'selected':''); ?>>None</option>
                        <option value="capitalize" <?php echo e(isset($option_settings['h4_heading_font_text-transform']) && $option_settings['h4_heading_font_text-transform'] == 'capitalize' ? 'selected':''); ?>>Capitalize</option>
                        <option value="uppercase" <?php echo e(isset($option_settings['h4_heading_font_text-transform']) && $option_settings['h4_heading_font_text-transform'] == 'uppercase' ? 'selected':''); ?>>Uppercase</option>
                        <option value="lowercase" <?php echo e(isset($option_settings['h4_heading_font_text-transform']) && $option_settings['h4_heading_font_text-transform'] == 'lowercase' ? 'selected':''); ?>>Lowercase</option>
                        <option value="initial" <?php echo e(isset($option_settings['h4_heading_font_text-transform']) && $option_settings['h4_heading_font_text-transform'] == 'initial' ? 'selected':''); ?>>Initial</option>
                        <option value="inherit" <?php echo e(isset($option_settings['h4_heading_font_text-transform']) && $option_settings['h4_heading_font_text-transform'] == 'inherit' ? 'selected':''); ?>>Inherit</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label><?php echo e(translate('Font Size')); ?></label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h4_heading_font_u_font-size"
                                id="h4_heading_font_size" placeholder="<?php echo e(translate('Size')); ?>" value="<?php echo e(isset($option_settings['h4_heading_font_u_font-size']) ? $option_settings['h4_heading_font_u_font-size']:''); ?>" onkeyup="createFontCss('h4_heading')">
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
                            <input type="number" class="form-control" name="h4_heading_font_u_line-height"
                                id="h4_heading_line_height" placeholder="<?php echo e(translate('Height')); ?>" value="<?php echo e(isset($option_settings['h4_heading_font_u_line-height']) ? $option_settings['h4_heading_font_u_line-height']:''); ?>" onkeyup="createFontCss('h4_heading')">
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
                            <input type="number" class="form-control" name="h4_heading_font_u_word-spacing"
                                id="h4_heading_word_spacing" placeholder="<?php echo e(translate('Word Spacing')); ?>" value="<?php echo e(isset($option_settings['h4_heading_font_u_word-spacing']) ? $option_settings['h4_heading_font_u_word-spacing']:''); ?>" onkeyup="createFontCss('h4_heading')">
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
                            <input type="number" class="form-control" name="h4_heading_font_u_letter-spacing"
                                id="h4_heading_letter_spacing" placeholder="<?php echo e(translate('Letter Spacing')); ?>" value="<?php echo e(isset($option_settings['h4_heading_font_u_letter-spacing']) ? $option_settings['h4_heading_font_u_letter-spacing']:''); ?>" onkeyup="createFontCss('h4_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <label for="h4_heading_font_color"><?php echo e(translate('Select Color')); ?></label>
                    <div class="color justify-content-xl-between w-100">
                        <input type="text" class="form-control" name="h4_heading_font_color"
                            value="<?php echo e(isset($option_settings['h4_heading_font_color']) ? $option_settings['h4_heading_font_color']:''); ?>">
                        <input type="color" class="" id="h4_heading_font_color" value="<?php echo e(isset($option_settings['h4_heading_font_color']) ? $option_settings['h4_heading_font_color']:'#fafafa'); ?>" oninput="createFontCss('h4_heading')">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 border p-4 typography_preview" id="h4_heading_typography_preview">
            <?php echo e(translate('The Quick Brown Fox Jumps Over The Lazy Dog')); ?>

        </div>
    </div>
</div>



<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3 mb-3">
        <label for="" class="font-16 bold black"><?php echo e(translate('(H5) Heading Typography')); ?>

        </label>
        <span class="d-block"><?php echo e(translate('These settings control the typography for all (H5)Heading.')); ?></span>
    </div>
    <div class="col-xl-8 offset-xl-1">
        <input type="hidden" name="h5_heading_typography_google_link_s" id="h5_heading_typography_google_link_s" value="<?php echo e(isset($option_settings['h5_heading_typography_google_link_s']) ? $option_settings['h5_heading_typography_google_link_s']:''); ?>">

        <input type="hidden" name="h5_heading_typography_css_i" id="h5_heading_typography_css" value="<?php echo e(isset($option_settings['h5_heading_typography_css_i']) ? $option_settings['h5_heading_typography_css_i']:''); ?>">

        <input type="hidden" name="h5_heading_font_unit_i" value="px">
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Font Family')); ?></label>
                    <select name="h5_heading_font_font-family" class="form-control select font_family" id="h5_heading_font_family" data-section="h5_heading">
                        <option value="" <?php echo e(isset($option_settings['h5_heading_font_font-family']) ? '':'selected'); ?>><?php echo e(translate('Select  Fonts')); ?></option>
                        <optgroup label="<?php echo e(translate('Custom Fonts')); ?>">
                            <option value="custom-font-1,sans-serif" <?php echo e(isset($option_settings['h5_heading_font_font-family']) && $option_settings['h5_heading_font_font-family'] == 'custom-font-1,sans-serif' ? 'selected':''); ?> data-subsets="" data-variations=""><?php echo e(translate('Custom Font 1')); ?></option>

                            <option value="custom-font-2,sans-serif" <?php echo e(isset($option_settings['h5_heading_font_font-family']) && $option_settings['h5_heading_font_font-family'] == 'custom-font-2,sans-serif' ? 'selected':''); ?> data-subsets="" data-variations=""><?php echo e(translate('Custom Font 2')); ?></option>
                        </optgroup>
                        <optgroup label="<?php echo e(translate('Google Web Fonts')); ?>">
                            <?php $__currentLoopData = $fonts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $font): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($font['family'].',sans-serif'); ?>"
                                    <?php echo e(isset($option_settings['h5_heading_font_font-family']) && $option_settings['h5_heading_font_font-family'] == $font['family'].',sans-serif' ? 'selected':''); ?> 
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
                    <input type="hidden" name="h5_heading_font_font-style" id="h5_heading_font_style" value="<?php echo e(isset($option_settings['h5_heading_font_font-style']) ? $option_settings['h5_heading_font_font-style']:''); ?>">

                    <input type="hidden" name="h5_heading_font_font-weight" id="h5_heading_font_weight" value="<?php echo e(isset($option_settings['h5_heading_font_font-weight']) ? $option_settings['h5_heading_font_font-weight']:''); ?>">

                    <select name="h5_heading_font_weight_style_i" class="form-control select" id="h5_heading_font_weight_style_i" data-value="<?php echo e(isset($option_settings['h5_heading_font_weight_style_i']) ? $option_settings['h5_heading_font_weight_style_i']:null); ?>" onchange="createUrl('h5_heading')">
                        <option value="" <?php echo e(isset($option_settings['h5_heading_font_weight_style_i']) ? '':'selected'); ?>><?php echo e(translate('Select Weight & Style')); ?></option>
                        <option value="400" <?php echo e(isset($option_settings['h5_heading_font_weight_style_i']) && $option_settings['h5_heading_font_weight_style_i'] == '400' ? 'selected':''); ?>>Normal 400</option>
                        <option value="700" <?php echo e(isset($option_settings['h5_heading_font_weight_style_i']) && $option_settings['h5_heading_font_weight_style_i'] == '700' ? 'selected':''); ?>>Bold 700</option>
                        <option value="400italic" <?php echo e(isset($option_settings['h5_heading_font_weight_style_i']) && $option_settings['h5_heading_font_weight_style_i'] == '400italic' ? 'selected':''); ?>>Normal 400 Italic</option>
                        <option value="700italic" <?php echo e(isset($option_settings['h5_heading_font_weight_style_i']) && $option_settings['h5_heading_font_weight_style_i'] == '700italic' ? 'selected':''); ?>>Bold 700 Italic</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Font Subsets')); ?></label>
                    <select name="h5_heading_font_font-subsets_i" class="form-control select" id="h5_heading_font_subsets" data-value="<?php echo e(isset($option_settings['h5_heading_font_font-subsets_i']) ? $option_settings['h5_heading_font_font-subsets_i']:null); ?>"  onchange="createUrl('h5_heading')">
                        <option value="" <?php echo e(isset($option_settings['h5_heading_font_font-subsets_i']) ? '':'selected'); ?>><?php echo e(translate('Select Font Subsets')); ?></option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Text Align')); ?></label>
                    <select name="h5_heading_font_text-align" class="form-control select" id="h5_heading_text_align" onchange="createFontCss('h5_heading')">
                        <option value="" disabled <?php echo e(isset($option_settings['h5_heading_font_text-align']) ? '':'selected'); ?>><?php echo e(translate('Text Align')); ?></option>
                        <option value="inherit" <?php echo e(isset($option_settings['h5_heading_font_text-align']) && $option_settings['h5_heading_font_text-align'] == 'inherit' ? 'selected':''); ?>>Inherit</option>
                        <option value="left" <?php echo e(isset($option_settings['h5_heading_font_text-align']) && $option_settings['h5_heading_font_text-align'] == 'left' ? 'selected':''); ?>>Left</option>
                        <option value="right" <?php echo e(isset($option_settings['h5_heading_font_text-align']) && $option_settings['h5_heading_font_text-align'] == 'right' ? 'selected':''); ?>>Right</option>
                        <option value="center" <?php echo e(isset($option_settings['h5_heading_font_text-align']) && $option_settings['h5_heading_font_text-align'] == 'center' ? 'selected':''); ?>>Center</option>
                        <option value="justify" <?php echo e(isset($option_settings['h5_heading_font_text-align']) && $option_settings['h5_heading_font_text-align'] == 'justify' ? 'selected':''); ?>>Justify</option>
                        <option value="initial" <?php echo e(isset($option_settings['h5_heading_font_text-align']) && $option_settings['h5_heading_font_text-align'] == 'initial' ? 'selected':''); ?>>Initial</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Text Transform')); ?></label>
                    <select name="h5_heading_font_text-transform" class="form-control select" id="h5_heading_text_transform" onchange="createFontCss('h5_heading')">
                        <option value="" disabled <?php echo e(isset($option_settings['h5_heading_font_text-transform']) ? '':'selected'); ?>><?php echo e(translate('Text Transform')); ?></option>
                        <option value="none" <?php echo e(isset($option_settings['h5_heading_font_text-transform']) && $option_settings['h5_heading_font_text-transform'] == 'none' ? 'selected':''); ?>>None</option>
                        <option value="capitalize" <?php echo e(isset($option_settings['h5_heading_font_text-transform']) && $option_settings['h5_heading_font_text-transform'] == 'capitalize' ? 'selected':''); ?>>Capitalize</option>
                        <option value="uppercase" <?php echo e(isset($option_settings['h5_heading_font_text-transform']) && $option_settings['h5_heading_font_text-transform'] == 'uppercase' ? 'selected':''); ?>>Uppercase</option>
                        <option value="lowercase" <?php echo e(isset($option_settings['h5_heading_font_text-transform']) && $option_settings['h5_heading_font_text-transform'] == 'lowercase' ? 'selected':''); ?>>Lowercase</option>
                        <option value="initial" <?php echo e(isset($option_settings['h5_heading_font_text-transform']) && $option_settings['h5_heading_font_text-transform'] == 'initial' ? 'selected':''); ?>>Initial</option>
                        <option value="inherit" <?php echo e(isset($option_settings['h5_heading_font_text-transform']) && $option_settings['h5_heading_font_text-transform'] == 'inherit' ? 'selected':''); ?>>Inherit</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label><?php echo e(translate('Font Size')); ?></label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h5_heading_font_u_font-size"
                                id="h5_heading_font_size" placeholder="<?php echo e(translate('Size')); ?>" value="<?php echo e(isset($option_settings['h5_heading_font_u_font-size']) ? $option_settings['h5_heading_font_u_font-size']:''); ?>" onkeyup="createFontCss('h5_heading')">
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
                            <input type="number" class="form-control" name="h5_heading_font_u_line-height"
                                id="h5_heading_line_height" placeholder="<?php echo e(translate('Height')); ?>" value="<?php echo e(isset($option_settings['h5_heading_font_u_line-height']) ? $option_settings['h5_heading_font_u_line-height']:''); ?>" onkeyup="createFontCss('h5_heading')">
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
                            <input type="number" class="form-control" name="h5_heading_font_u_word-spacing"
                                id="h5_heading_word_spacing" placeholder="<?php echo e(translate('Word Spacing')); ?>" value="<?php echo e(isset($option_settings['h5_heading_font_u_word-spacing']) ? $option_settings['h5_heading_font_u_word-spacing']:''); ?>" onkeyup="createFontCss('h5_heading')">
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
                            <input type="number" class="form-control" name="h5_heading_font_u_letter-spacing"
                                id="h5_heading_letter_spacing" placeholder="<?php echo e(translate('Letter Spacing')); ?>" value="<?php echo e(isset($option_settings['h5_heading_font_u_letter-spacing']) ? $option_settings['h5_heading_font_u_letter-spacing']:''); ?>" onkeyup="createFontCss('h5_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <label for="h5_heading_font_color"><?php echo e(translate('Select Color')); ?></label>
                    <div class="color justify-content-xl-between w-100">
                        <input type="text" class="form-control" name="h5_heading_font_color"
                            value="<?php echo e(isset($option_settings['h5_heading_font_color']) ? $option_settings['h5_heading_font_color']:''); ?>">
                        <input type="color" class="" id="h5_heading_font_color" value="<?php echo e(isset($option_settings['h5_heading_font_color']) ? $option_settings['h5_heading_font_color']:'#fafafa'); ?>" oninput="createFontCss('h5_heading')">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 border p-4 typography_preview" id="h5_heading_typography_preview">
            <?php echo e(translate('The Quick Brown Fox Jumps Over The Lazy Dog')); ?>

        </div>
    </div>
</div>



<div class="form-group row py-4 border-bottom">
    <div class="col-xl-3 mb-3">
        <label for="" class="font-16 bold black"><?php echo e(translate('(H6) Heading Typography')); ?>

        </label>
        <span class="d-block"><?php echo e(translate('These settings control the typography for all (H6)Heading.')); ?></span>
    </div>
    <div class="col-xl-8 offset-xl-1">
        <input type="hidden" name="h6_heading_typography_google_link_s" id="h6_heading_typography_google_link_s" value="<?php echo e(isset($option_settings['h6_heading_typography_google_link_s']) ? $option_settings['h6_heading_typography_google_link_s']:''); ?>">

        <input type="hidden" name="h6_heading_typography_css_i" id="h6_heading_typography_css" value="<?php echo e(isset($option_settings['h6_heading_typography_css_i']) ? $option_settings['h6_heading_typography_css_i']:''); ?>">

        <input type="hidden" name="h6_heading_font_unit_i" value="px">
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Font Family')); ?></label>
                    <select name="h6_heading_font_font-family" class="form-control select font_family" id="h6_heading_font_family" data-section="h6_heading">
                        <option value="" <?php echo e(isset($option_settings['h6_heading_font_font-family']) ? '':'selected'); ?>><?php echo e(translate('Select  Fonts')); ?></option>
                        <optgroup label="<?php echo e(translate('Custom Fonts')); ?>">
                            <option value="custom-font-1,sans-serif" <?php echo e(isset($option_settings['h6_heading_font_font-family']) && $option_settings['h6_heading_font_font-family'] == 'custom-font-1,sans-serif' ? 'selected':''); ?> data-subsets="" data-variations=""><?php echo e(translate('Custom Font 1')); ?></option>

                            <option value="custom-font-2,sans-serif" <?php echo e(isset($option_settings['h6_heading_font_font-family']) && $option_settings['h6_heading_font_font-family'] == 'custom-font-2,sans-serif' ? 'selected':''); ?> data-subsets="" data-variations=""><?php echo e(translate('Custom Font 2')); ?></option>
                        </optgroup>
                        <optgroup label="<?php echo e(translate('Google Web Fonts')); ?>">
                            <?php $__currentLoopData = $fonts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $font): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($font['family'].',sans-serif'); ?>"
                                    <?php echo e(isset($option_settings['h6_heading_font_font-family']) && $option_settings['h6_heading_font_font-family'] == $font['family'].',sans-serif' ? 'selected':''); ?> 
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
                    <input type="hidden" name="h6_heading_font_font-style" id="h6_heading_font_style" value="<?php echo e(isset($option_settings['h6_heading_font_font-style']) ? $option_settings['h6_heading_font_font-style']:''); ?>">

                    <input type="hidden" name="h6_heading_font_font-weight" id="h6_heading_font_weight" value="<?php echo e(isset($option_settings['h6_heading_font_font-weight']) ? $option_settings['h6_heading_font_font-weight']:''); ?>">

                    <select name="h6_heading_font_weight_style_i" class="form-control select" id="h6_heading_font_weight_style_i" data-value="<?php echo e(isset($option_settings['h6_heading_font_weight_style_i']) ? $option_settings['h6_heading_font_weight_style_i']:null); ?>" onchange="createUrl('h6_heading')">
                        <option value="" <?php echo e(isset($option_settings['h6_heading_font_weight_style_i']) ? '':'selected'); ?>><?php echo e(translate('Select Weight & Style')); ?></option>
                        <option value="400" <?php echo e(isset($option_settings['h6_heading_font_weight_style_i']) && $option_settings['h6_heading_font_weight_style_i'] == '400' ? 'selected':''); ?>>Normal 400</option>
                        <option value="700" <?php echo e(isset($option_settings['h6_heading_font_weight_style_i']) && $option_settings['h6_heading_font_weight_style_i'] == '700' ? 'selected':''); ?>>Bold 700</option>
                        <option value="400italic" <?php echo e(isset($option_settings['h6_heading_font_weight_style_i']) && $option_settings['h6_heading_font_weight_style_i'] == '400italic' ? 'selected':''); ?>>Normal 400 Italic</option>
                        <option value="700italic" <?php echo e(isset($option_settings['h6_heading_font_weight_style_i']) && $option_settings['h6_heading_font_weight_style_i'] == '700italic' ? 'selected':''); ?>>Bold 700 Italic</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Font Subsets')); ?></label>
                    <select name="h6_heading_font_font-subsets_i" class="form-control select" id="h6_heading_font_subsets" data-value="<?php echo e(isset($option_settings['h6_heading_font_font-subsets_i']) ? $option_settings['h6_heading_font_font-subsets_i']:null); ?>"  onchange="createUrl('h6_heading')">
                        <option value="" <?php echo e(isset($option_settings['h6_heading_font_font-subsets_i']) ? '':'selected'); ?>><?php echo e(translate('Select Font Subsets')); ?></option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Text Align')); ?></label>
                    <select name="h6_heading_font_text-align" class="form-control select" id="h6_heading_text_align" onchange="createFontCss('h6_heading')">
                        <option value="" disabled <?php echo e(isset($option_settings['h6_heading_font_text-align']) ? '':'selected'); ?>><?php echo e(translate('Text Align')); ?></option>
                        <option value="inherit" <?php echo e(isset($option_settings['h6_heading_font_text-align']) && $option_settings['h6_heading_font_text-align'] == 'inherit' ? 'selected':''); ?>>Inherit</option>
                        <option value="left" <?php echo e(isset($option_settings['h6_heading_font_text-align']) && $option_settings['h6_heading_font_text-align'] == 'left' ? 'selected':''); ?>>Left</option>
                        <option value="right" <?php echo e(isset($option_settings['h6_heading_font_text-align']) && $option_settings['h6_heading_font_text-align'] == 'right' ? 'selected':''); ?>>Right</option>
                        <option value="center" <?php echo e(isset($option_settings['h6_heading_font_text-align']) && $option_settings['h6_heading_font_text-align'] == 'center' ? 'selected':''); ?>>Center</option>
                        <option value="justify" <?php echo e(isset($option_settings['h6_heading_font_text-align']) && $option_settings['h6_heading_font_text-align'] == 'justify' ? 'selected':''); ?>>Justify</option>
                        <option value="initial" <?php echo e(isset($option_settings['h6_heading_font_text-align']) && $option_settings['h6_heading_font_text-align'] == 'initial' ? 'selected':''); ?>>Initial</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group">
                    <label><?php echo e(translate('Text Transform')); ?></label>
                    <select name="h6_heading_font_text-transform" class="form-control select" id="h6_heading_text_transform" onchange="createFontCss('h6_heading')">
                        <option value="" disabled <?php echo e(isset($option_settings['h6_heading_font_text-transform']) ? '':'selected'); ?>><?php echo e(translate('Text Transform')); ?></option>
                        <option value="none" <?php echo e(isset($option_settings['h6_heading_font_text-transform']) && $option_settings['h6_heading_font_text-transform'] == 'none' ? 'selected':''); ?>>None</option>
                        <option value="capitalize" <?php echo e(isset($option_settings['h6_heading_font_text-transform']) && $option_settings['h6_heading_font_text-transform'] == 'capitalize' ? 'selected':''); ?>>Capitalize</option>
                        <option value="uppercase" <?php echo e(isset($option_settings['h6_heading_font_text-transform']) && $option_settings['h6_heading_font_text-transform'] == 'uppercase' ? 'selected':''); ?>>Uppercase</option>
                        <option value="lowercase" <?php echo e(isset($option_settings['h6_heading_font_text-transform']) && $option_settings['h6_heading_font_text-transform'] == 'lowercase' ? 'selected':''); ?>>Lowercase</option>
                        <option value="initial" <?php echo e(isset($option_settings['h6_heading_font_text-transform']) && $option_settings['h6_heading_font_text-transform'] == 'initial' ? 'selected':''); ?>>Initial</option>
                        <option value="inherit" <?php echo e(isset($option_settings['h6_heading_font_text-transform']) && $option_settings['h6_heading_font_text-transform'] == 'inherit' ? 'selected':''); ?>>Inherit</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label><?php echo e(translate('Font Size')); ?></label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="h6_heading_font_u_font-size"
                                id="h6_heading_font_size" placeholder="<?php echo e(translate('Size')); ?>" value="<?php echo e(isset($option_settings['h6_heading_font_u_font-size']) ? $option_settings['h6_heading_font_u_font-size']:''); ?>" onkeyup="createFontCss('h6_heading')">
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
                            <input type="number" class="form-control" name="h6_heading_font_u_line-height"
                                id="h6_heading_line_height" placeholder="<?php echo e(translate('Height')); ?>" value="<?php echo e(isset($option_settings['h6_heading_font_u_line-height']) ? $option_settings['h6_heading_font_u_line-height']:''); ?>" onkeyup="createFontCss('h6_heading')">
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
                            <input type="number" class="form-control" name="h6_heading_font_u_word-spacing"
                                id="h6_heading_word_spacing" placeholder="<?php echo e(translate('Word Spacing')); ?>" value="<?php echo e(isset($option_settings['h6_heading_font_u_word-spacing']) ? $option_settings['h6_heading_font_u_word-spacing']:''); ?>" onkeyup="createFontCss('h6_heading')">
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
                            <input type="number" class="form-control" name="h6_heading_font_u_letter-spacing"
                                id="h6_heading_letter_spacing" placeholder="<?php echo e(translate('Letter Spacing')); ?>" value="<?php echo e(isset($option_settings['h6_heading_font_u_letter-spacing']) ? $option_settings['h6_heading_font_u_letter-spacing']:''); ?>" onkeyup="createFontCss('h6_heading')">
                            <div class="input-group-append">
                                <div class="input-group-text">px</div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4">
                    <label for="h6_heading_font_color"><?php echo e(translate('Select Color')); ?></label>
                    <div class="color justify-content-xl-between w-100">
                        <input type="text" class="form-control" name="h6_heading_font_color"
                            value="<?php echo e(isset($option_settings['h6_heading_font_color']) ? $option_settings['h6_heading_font_color']:''); ?>">
                        <input type="color" class="" id="h6_heading_font_color" value="<?php echo e(isset($option_settings['h6_heading_font_color']) ? $option_settings['h6_heading_font_color']:'#fafafa'); ?>" oninput="createFontCss('h6_heading')">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 border p-4 typography_preview" id="h6_heading_typography_preview">
            <?php echo e(translate('The Quick Brown Fox Jumps Over The Lazy Dog')); ?>

        </div>
    </div>
</div>
<?php /**PATH /home/ahmedalaa/work/fashly/themes/fashion-theme/resources/views/backend/theme/option-form/heading_typography.blade.php ENDPATH**/ ?>