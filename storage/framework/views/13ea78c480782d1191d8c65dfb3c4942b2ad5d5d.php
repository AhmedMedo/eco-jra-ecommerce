<h3 class="black mb-3"><?php echo e(translate('Website Popup')); ?></h3>
<input type="hidden" name="option_name" value="website_popup">

<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4 mb-3">
        <label class="font-16 bold black"><?php echo e(translate('Enable Website Popup')); ?>

        </label>
    </div>
    <div class="col-xl-7">
        <label class="switch success">
            <input type="hidden" name="website_popup_status" value="0">
            <input type="checkbox"
                <?php echo e(isset($option_settings['website_popup_status']) && $option_settings['website_popup_status'] == 1 ? 'checked' : ''); ?>

                name="website_popup_status" id="website_popup_status" value="1">
            <span class="control" id="website_popup_status_switch">
                <span class="switch-off">Disable</span>
                <span class="switch-on">Enable</span>
            </span>
        </label>
    </div>
</div>

<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4 mb-3">
        <label for="website_popup_content" class="font-16 bold black"><?php echo e(translate('Popup content')); ?>

        </label>
    </div>
    <div class="col-xl-7">
        <textarea class="form-control text-editor" name="website_popup_content" id="website_popup_content"> <?php echo e(isset($option_settings['website_popup_content']) ? $option_settings['website_popup_content'] : ''); ?></textarea>
    </div>
</div>

<div class="form-group row py-4 border-bottom">
    <div class="col-xl-4 mb-3">
        <label class="font-16 bold black"><?php echo e(translate('Show Subscriber form?')); ?>

        </label>
    </div>
    <div class="col-xl-7">
        <label class="switch success">
            <input type="hidden" name="website_popup_subscribe_status" value="0">
            <input type="checkbox"
                <?php echo e(isset($option_settings['website_popup_subscribe_status']) && $option_settings['website_popup_subscribe_status'] == 1 ? 'checked' : ''); ?>

                name="website_popup_subscribe_status" id="website_popup_subscribe_status" value="1">
            <span class="control" id="website_popup_subscribe_status_switch">
                <span class="switch-off">Disable</span>
                <span class="switch-on">Enable</span>
            </span>
        </label>
    </div>
</div>
<?php /**PATH /home/ahmedalaa/work/fashly/themes/fashion-theme/resources/views/backend/theme/option-form/website_popup.blade.php ENDPATH**/ ?>