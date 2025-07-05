<?php $__env->startSection('title'); ?>
    <?php echo e(translate('Media')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('web-assets/backend/plugins/dropzone/dropzone.min.css')); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content'); ?>
    <div class="border-bottom2 pb-3 mb-4">
        <h4><i class="icofont-multimedia"></i> <?php echo e(translate('Media')); ?> </h4>
    </div>
    <!-- Media List -->
    <div>
        <?php echo $__env->make('core::base.media.partial.media_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- /Media List -->


    <div class="modal fade" id="browseImgPrev" tabindex="-1" role="dialog" aria-labelledby="browseImgPrevLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-full" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <?php echo e(translate('Attachment details')); ?>

                    </h5>
                    <div class="media-nav-wrap d-flex align-items-center" id="media_slide">
                        <span class="media-prev mr-1" onclick=""><i class="icofont-simple-left"></i></span>
                        <span class="media-next" onclick=""><i class="icofont-simple-right"></i></span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="media-img-single-preview">
                        <div class="thumbnail preview-image">
                            <img id='preview_image' class="media_preview_image" src="" alt="" />
                        </div>
                        <div class="attachment-meta-wrap mt-30 mt-md-0">
                            <div class="details mb-3 pb-3 border-bottom2">
                                <div class="word-break">
                                    <span class="font-weight-bolder"><?php echo e(translate('File Name:')); ?> </span>
                                    <span id="file_name"></span>
                                </div>
                                <div class="word-break">
                                    <span class="font-weight-bolder"><?php echo e(translate('File URL:')); ?> </span>
                                    <input class="theme-input-style" id="file_url" type="text" value="" readonly>
                                </div>
                                <div>
                                    <span class="font-weight-bolder"><?php echo e(translate('File Type:')); ?> </span>
                                    <span id="file_type"></span>
                                </div>
                                <div>
                                    <span class="font-weight-bolder"><?php echo e(translate('File Size:')); ?> </span>
                                    <span id="file_size"></span>
                                </div>
                                <div>
                                    <span class="font-weight-bolder"><?php echo e(translate('Uploaded By:')); ?> </span>
                                    <span id="uploaded_by"></span>
                                </div>
                                <div>
                                    <span class="font-weight-bolder"><?php echo e(translate('Created At:')); ?> </span>
                                    <span id="creaated_at"></span>
                                </div>
                                <div>
                                    <span class="font-weight-bolder"><?php echo e(translate('Updated At:')); ?> </span>
                                    <span id="updated_at"></span>
                                </div>
                                <div class="d-flex gap-10 justify-content-end flex-wrap mt-2">
                                    <a type="button" id="download_file" target="_blank" href="" class="btn sm "
                                        data-clipboard-target="#attachment-details-copy-link">
                                        <?php echo e(translate('Download')); ?>

                                    </a>
                                    <button type="button" class="btn sm" id="copy-link-btn">
                                        <?php echo e(translate('Copy URL to clipboard')); ?>

                                    </button>
                                </div>
                            </div>
                            <form>
                                <input type="hidden" name="id" id="media_id">
                                <div class="settings-wrap pb-3 mb-3 border-bottom2">
                                    <span class="setting mb-10 has-description">
                                        <label for="attachment-details-alt-text"
                                            class="name"><?php echo e(translate('Alt
                                                                                                                                                                                                                        Text')); ?></label>
                                        <input type="text" id="attachment-details-alt-text" name="alt"
                                            class="theme-input-style" />
                                        <div class="invalid-input" id="alt_update_error"></div>
                                    </span>
                                    <span class="setting mb-10">
                                        <label for="attachment-details-title"
                                            class="name"><?php echo e(translate('Title')); ?></label>
                                        <input type="text" id="attachment-details-title" name="title"
                                            class="theme-input-style" />
                                        <div class="invalid-input" id="title_update_error"></div>
                                    </span>
                                    <span class="setting mb-10">
                                        <label for="attachment-details-caption"
                                            class="name"><?php echo e(translate('Caption')); ?></label>
                                        <textarea id="attachment-details-caption" name='caption' class="theme-input-style"></textarea>
                                        <div class="invalid-input" id="caption_update_error"></div>
                                    </span>
                                    <span class="setting mb-10">
                                        <label for="attachment-details-description"
                                            class="name"><?php echo e(translate('Description')); ?></label>
                                        <textarea id="attachment-details-description" name="description" class="theme-input-style"></textarea>
                                        <div class="invalid-input" id="description_update_error"></div>
                                    </span>
                                </div>
                                <div class="d-flex gap-10 justify-content-end flex-wrap mt-2">
                                    <button type="button" class="btn sm copy-attachment-url"
                                        data-clipboard-target="#attachment-details-copy-link" onclick="updateMedia()">
                                        <?php echo e(translate('Save')); ?>

                                    </button>
                                    <button type="button" class="btn sm copy-attachment-url btn-danger"
                                        data-clipboard-target="#attachment-details-copy-link" onclick="deleteMediaFile()">
                                        <?php echo e(translate('Delete Permanently')); ?>

                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_scripts'); ?>
    <script src="<?php echo e(asset('web-assets/backend/plugins/moment/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('web-assets/backend/plugins/daterangepicker/daterangepicker.js')); ?>"></script>

    <script>
        (function($) {
            "use strict";
            initDropzone()
            $(document).ready(function() {
                enable_multiple_file_select = true
                filtermedia()
            })
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core::base.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/medo/work/eco-jara/fashly/Core/resources/views/base/media/index.blade.php ENDPATH**/ ?>