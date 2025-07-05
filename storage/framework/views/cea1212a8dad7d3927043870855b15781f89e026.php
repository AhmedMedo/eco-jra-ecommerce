
<h3 class="black mb-3"><?php echo e(translate('Single Blog Page')); ?></h3>
<input type="hidden" name="option_name" value="single_blog_page">


<div class="form-group row py-4 border-bottom">
    <div class="col-xl-5 mb-3">
        <label class="font-16 bold black"><?php echo e(translate('Custom Single Blog Page Style')); ?>

        </label>
        <span class="d-block"><?php echo e(translate('Switch on for custom single blog page style.')); ?></span>
    </div>
    <div class="col-xl-6 offset-xl-1">
        <label class="switch success">
            <input type="hidden" name="custom_blog_page" value="0">
            <input type="checkbox"
                <?php echo e(isset($option_settings['custom_blog_page']) && $option_settings['custom_blog_page'] == 1 ? 'checked' : ''); ?>

                name="custom_blog_page" id="custom_blog_page" value="1">
            <span class="control" id="custom_blog_page_switch">
                <span class="switch-off">Disable</span>
                <span class="switch-on">Enable</span>
            </span>
        </label>
    </div>
</div>



<div id="custom_blog_page_switch_on_field">
    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Layout')); ?>

            </label>
            <span
                class="d-block"><?php echo e(translate('Choose blog single page layout from here. If you use this option then you will able to change three type of blog single page layout ( Default Right Sidebar Layout ).')); ?></span>
        </div>
        <div class="col-xl-6 offset-xl-1 row" id="single_blog_page_layout_image_field">
            <div class="col-4">
                <div class="input-group my-2  col-xl-5">
                    <input type="radio"
                        <?php echo e(isset($option_settings['single_blog_page_layout']) && $option_settings['single_blog_page_layout'] == 'full_layout' ? 'checked' : ''); ?>

                        class="d-none" name="single_blog_page_layout" id="full_layout" value="full_layout">
                    <label for="full_layout">
                        <img src="<?php echo e(asset('/themes/fashion-themeblog/images/layout/no-sideber.png')); ?>"
                            title="no sidebar" alt="no sidebar" class="layout_img">
                    </label>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group my-2  col-xl-5">
                    <input type="radio"
                        <?php echo e(isset($option_settings['single_blog_page_layout']) && $option_settings['single_blog_page_layout'] == 'left_sidebar' ? 'checked' : ''); ?>

                        class="d-none" name="single_blog_page_layout" id="left_sidebar" value="left_sidebar">
                    <label for="left_sidebar">
                        <img src="<?php echo e(asset('/themes/fashion-themeblog/images/layout/left-sideber.png')); ?>"
                            title="left sidebar" alt="left sidebar" class="layout_img">
                    </label>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group my-2  col-xl-5">
                    <input type="radio"
                        <?php echo e(isset($option_settings['single_blog_page_layout']) && $option_settings['single_blog_page_layout'] == 'right_sidebar' ? 'checked' : ''); ?>

                        class="d-none" name="single_blog_page_layout" id="right_sidebar" value="right_sidebar">
                    <label for="right_sidebar">
                        <img src="<?php echo e(asset('/themes/fashion-themeblog/images/layout/right-sideber.png')); ?>"
                            title="right sidebar" alt="right sidebar" class="layout_img">
                    </label>
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Blog Post Title Position')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Control blog post title position from here.')); ?></span>
            <span>on header / below thumbnail</span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="blog_post_title_position" value="on_header">
                <input type="checkbox"
                    <?php echo e(isset($option_settings['blog_post_title_position']) && $option_settings['blog_post_title_position'] == 'below_thumbnail' ? 'checked' : ''); ?>

                    name="blog_post_title_position" id="blog_post_title_position" value="below_thumbnail">
                <span class="control" id="blog_post_title_position_switch">
                    <span class="switch-off">On Header</span>
                    <span class="switch-on">Below Thumbnail</span>
                </span>
            </label>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Author')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Switch On to Display Author.')); ?></span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="author" value="0">
                <input type="checkbox"
                    <?php echo e(isset($option_settings['author']) && $option_settings['author'] == 1 ? 'checked' : ''); ?>

                    name="author" id="author" value="1">
                <span class="control" id="author_switch">
                    <span class="switch-off">Disable</span>
                    <span class="switch-on">Enable</span>
                </span>
            </label>
        </div>
    </div>
    

    
    <div class="form-group row py-4 border-bottom">
        <div class="col-xl-5 mb-3">
            <label class="font-16 bold black"><?php echo e(translate('Date')); ?>

            </label>
            <span class="d-block"><?php echo e(translate('Switch On to Display Date.')); ?></span>
        </div>
        <div class="col-xl-6 offset-xl-1">
            <label class="switch success">
                <input type="hidden" name="date" value="0">
                <input type="checkbox"
                    <?php echo e(isset($option_settings['date']) && $option_settings['date'] == 1 ? 'checked' : ''); ?>

                    name="date" id="date" value="1">
                <span class="control" id="date_switch">
                    <span class="switch-off">Disable</span>
                    <span class="switch-on">Enable</span>
                </span>
            </label>
        </div>
    </div>
    
</div>

<?php /**PATH /home/ahmedalaa/work/fashly/themes/fashion-theme/resources/views/backend/theme/option-form/single_blog_page.blade.php ENDPATH**/ ?>