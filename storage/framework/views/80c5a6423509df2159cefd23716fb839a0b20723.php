<?php
    $media_file_type = config('settings.media_file_type');
    $year_months = getMonthsForUploadedFiles();
?>

<!-- Media Library -->
<ul class="attachments list-unstyled" id="attachment-list">
    <?php
        $data = json_encode($media_ids);
    ?>
    <?php $__currentLoopData = $all_media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li onclick="nextMediaSlide(event,'<?php echo e($data); ?>','<?php echo e($media->id); ?>')"
            id="list_item_<?php echo e($media->id); ?>">
            <div class="attachment-preview">
                <div class="thumbnail">
                    <?php if($media->file_type == 'pdf'): ?>
                        <img class="lozad" src="<?php echo e(project_asset('/backend/assets/img/pdf-placeholder.png')); ?>"
                            alt="<?php echo e($media->alt); ?>" />
                    <?php elseif($media->file_type == 'zip'): ?>
                        <img class="lozad" src="<?php echo e(project_asset('/backend/assets/img/zip-placeholder.png')); ?>"
                            alt="<?php echo e($media->alt); ?>" />
                    <?php elseif($media->file_type == 'video'): ?>
                        <img class="lozad" src="<?php echo e(project_asset('/backend/assets/img/mp4-placeholder.png')); ?>"
                            alt="<?php echo e($media->alt); ?>" />
                    <?php else: ?>
                        <img class="lozad" src="<?php echo e(getFilePath($media->id), false); ?>" alt="<?php echo e($media->alt); ?>" />
                    <?php endif; ?>
                </div>
            </div>

            <button type="button" class="check" id="check_<?php echo e($media->id); ?>">
                <i class="icofont-check icon-check"></i>
                <i class="icofont-minus icon-minus"></i>
            </button>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<!-- /Media Library -->
<?php /**PATH /home/ahmedalaa/work/fashly/Core/resources/views/base/media/partial/media_library.blade.php ENDPATH**/ ?>