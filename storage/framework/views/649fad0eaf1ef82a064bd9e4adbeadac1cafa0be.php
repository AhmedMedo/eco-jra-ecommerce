<?php
    if (!empty($data)) {
        $file_details = getFileDetails($data);
        if ($file_details != null) {
            $image_src = getFilePath($file_details->id);
        } else {
            $image_src = getPlaceHolderImagePath();
        }
    } else {
        $image_src = getPlaceHolderImagePath();
    }

    $user_filter = isset($user_filter) && $user_filter == true ? 'true' : 'false';
?>

<input type="hidden" name="<?php echo e($input); ?>" id="<?php echo e($input); ?>_id" value="<?php echo e($data); ?>"
    <?php if(isset($disable) && $disable === true): ?> disabled <?php endif; ?>>
<div class="image-box">
    <div class="d-flex flex-wrap gap-10 mb-3">
        <?php if(isset($data)): ?>
            <div class="preview-image-wrapper">
                <img src="<?php echo e($image_src); ?>" alt="file-input" class="preview_image" id="<?php echo e($input); ?>_preview" />

                <button type="button" title="Remove image" class="remove-btn style--three black 555"
                    id="<?php echo e($input); ?>_remove"
                    onclick="removeSelection('#<?php echo e($input); ?>_preview,#<?php echo e($input); ?>_id,#<?php echo e($input); ?>_remove')">
                    <i class="icofont-close"></i>
                </button>
            </div>
        <?php else: ?>
            <div class="preview-image-wrapper">
                <img src="<?php echo e($image_src); ?>" class="preview_image" alt="file-input"
                    id="<?php echo e($input); ?>_preview" />
                <button type="button" title="Remove image" class="remove-btn style--three black d-none"
                    id="<?php echo e($input); ?>_remove"
                    onclick="removeSelection('#<?php echo e($input); ?>_preview,#<?php echo e($input); ?>_id,#<?php echo e($input); ?>_remove')">
                    <i class="icofont-close"></i>
                </button>
            </div>
        <?php endif; ?>

    </div>
    <div class="image-box-actions">
        <button type="button" class="btn-link" data-toggle="modal" data-target="#mediaUploadModal"
            id="<?php echo e($input); ?>_choose"
            onclick="setDataInsertableIds('#<?php echo e($input); ?>_preview,#<?php echo e($input); ?>_id,#<?php echo e($input); ?>_remove', <?php echo e($user_filter); ?>)">
            <?php echo e(translate('Choose File')); ?>

        </button>
    </div>
</div>
<?php /**PATH /home/ahmedalaa/work/fashly/Core/resources/views/base/includes/media/media_input.blade.php ENDPATH**/ ?>