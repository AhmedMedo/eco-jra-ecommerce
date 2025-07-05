<?php $__env->startSection('title'); ?>
    <?php echo e(translate('Wirte New Blog')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_css'); ?>
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo e(asset('web-assets/backend/plugins/select2/select2.min.css')); ?>">
    <!--  End select2  -->
    <!--Editor-->
    <link href="<?php echo e(asset('web-assets/backend/plugins/summernote/summernote-lite.css')); ?>" rel="stylesheet" />
    <!--End editor-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <!-- Main Content -->

    <form class="form-horizontal my-4 mb-4" id="blog_form" action="<?php echo e(route('core.store.blog')); ?>" method="post"
        enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <input type="hidden" id="blog_id" name="id" value="">
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <p class="alert alert-info">You are inserting
                        <strong>"<?php echo e(getLanguageNameByCode(getDefaultLang())); ?>"</strong> version
                    </p>
                </div>
                <div class="card mb-30">
                    <div class="card-header bg-white py-3">
                        <h4><?php echo e(translate('Wirte New Blog')); ?></h4>
                    </div>
                    <div class="card-body">
                        
                        <div class="form-group row my-4">
                            <label for="name" class="col-sm-2 font-14 bold black"><?php echo e(translate('Title')); ?><span
                                    class="text-danger"> * </span>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="name" class="form-control blog_name"
                                    value="<?php echo e(old('name')); ?>" placeholder="<?php echo e(translate('Name')); ?>" required>
                                <input type="hidden" name="permalink" id="permalink_input_field" required
                                    value="<?php echo e(old('permalink')); ?>">
                                <?php if($errors->has('name')): ?>
                                    <p class="text-danger"><?php echo e($errors->first('name')); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!--Permalink-->
                        <div
                            class="form-row my-4 permalink-input-group d-none <?php if($errors->has('permalink')): ?> d-flex <?php endif; ?>">
                            <div class="col-sm-2">
                                <label class="font-14 bold black"><?php echo e(translate('Permalink')); ?> </label>
                            </div>
                            <div class="col-sm-10">
                                <a href="#" onclick="blogPreviewDraft('preview')"><?php echo e(url('')); ?>/blog/<span
                                        id="permalink"><?php echo e(old('permalink')); ?></span><span
                                        class="btn custom-btn ml-1 permalink-edit-btn"><?php echo e(translate('Edit')); ?></span></a>
                                <?php if($errors->has('permalink')): ?>
                                    <div class="invalid-input"><?php echo e($errors->first('permalink')); ?></div>
                                <?php endif; ?>
                                <div class="permalink-editor d-none">
                                    <input type="text" class="theme-input-style" id="permalink-updated-input"
                                        placeholder="<?php echo e(translate('Type here')); ?>" value="<?php echo e(old('permalink')); ?>">
                                    <button type="button" class="btn long mt-2 btn-danger permalink-cancel-btn"
                                        data-dismiss="modal"><?php echo e(translate('Cancel')); ?></button>
                                    <button type="button"
                                        class="btn long mt-2 permalink-save-btn"><?php echo e(translate('Save')); ?></button>
                                </div>
                            </div>
                        </div>
                        <!--Permalink End-->

                        
                        <div class="form-row mt-5">
                            <label for="short_description"
                                class="col-sm-2 font-14 bold black"><?php echo e(translate('Short Description')); ?><span
                                    class="text-danger"> * </span></label>
                            <div class="col-sm-10">
                                <textarea name="short_description" class="theme-input-style h-100" placeholder="<?php echo e(translate('Short Description')); ?>"><?php echo e(old('short_description')); ?></textarea>
                                <?php if($errors->has('short_description')): ?>
                                    <p class="text-danger mb-3"><?php echo e($errors->first('short_description')); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        

                        
                        <div class="form-row mt-5">
                            <label class="col-sm-2 font-14 bold black"><?php echo e(translate('Content')); ?><span class="text-danger">
                                    * </span></label>
                            <div class="col-sm-10">
                                <div class="editor-wrap">
                                    <textarea name="content" id="blog_content"><?php echo e(old('content')); ?></textarea>
                                </div>
                                <?php if($errors->has('content')): ?>
                                    <p class="text-danger"> <?php echo e($errors->first('content')); ?> </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        

                    </div>
                </div>

                
                <div class="card  mb-20">
                    <div class="card-header bg-white py-3">
                        <h4><?php echo e(translate('Blog Seo Meta')); ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-row mb-20">
                            <div class="col-sm-2">
                                <label class="font-14 bold black "><?php echo e(translate('Meta Title')); ?> </label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" name="meta_title" class="theme-input-style"
                                    placeholder="<?php echo e(translate('Type here')); ?>" value="<?php echo e(old('meta_title')); ?>">
                                <?php if($errors->has('meta_title')): ?>
                                    <div class="invalid-input"><?php echo e($errors->first('meta_title')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-row mb-20">
                            <div class="col-sm-2">
                                <label class="font-14 bold black "><?php echo e(translate('Meta Description')); ?> </label>
                            </div>
                            <div class="col-sm-10">
                                <textarea class="theme-input-style" name="meta_description"><?php echo e(old('meta_description')); ?></textarea>
                                <?php if($errors->has('meta_description')): ?>
                                    <div class="invalid-input"><?php echo e($errors->first('meta_description')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-row mb-20">
                            <div class="col-sm-2">
                                <label class="font-14 bold black "><?php echo e(translate('Meta Image')); ?> </label>
                            </div>
                            <div class="col-sm-10">
                                <?php echo $__env->make('core::base.includes.media.media_input', [
                                    'input' => 'meta_image',
                                    'data' => old('meta_image'),
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php if($errors->has('meta_image')): ?>
                                    <div class="invalid-input"><?php echo e($errors->first('meta_image')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>

            
            <div class="col-md-4">
                <div class="row px-3">
                    
                    <div class="card col-12 order-last order-md-first mt-5 mt-md-0 p-0">
                        <div class="card-header bg-white py-3">
                            <h4><?php echo e(translate('Publish')); ?></h4>
                        </div>
                        <div class="card-body">
                            
                            <div class="row my-4 mx-1 justify-content-between ">
                                <div>
                                    <a href="#" class="btn btn-dark sm mr-2"
                                        onclick="blogPreviewDraft('draft')"><?php echo e(translate('Draft')); ?></a>
                                    <a href="#" class="btn btn-info sm mr-2"
                                        onclick="blogPreviewDraft('pending')"><?php echo e(translate('Pending')); ?></a>
                                </div>
                                <a href="#" class="btn sm mr-2"
                                    onclick="blogPreviewDraft('preview')"><?php echo e(translate('Preview')); ?></a>
                            </div>

                            
                            <input type="hidden" name="visibility" id="visibility-radio-public" value="public" />
                            

                            
                            <div class="row my-2 mx-1">
                                <i class="icofont-ui-calendar icofont-1x mt-2"></i>
                                <label for="publish_at" class="font-14 black ml-1 mt-2"><?php echo e(translate('Publish')); ?>

                                    :</label>
                                <input type="datetime-local" name="publish_at" id="publish_at"
                                    class="theme-input-style w-75 ml-2 py-0" value="<?php echo e(old('start_date')); ?>">
                                <?php if($errors->has('publish_at')): ?>
                                    <div class="invalid-input"><?php echo e($errors->first('publish_at')); ?></div>
                                <?php endif; ?>
                            </div>
                            

                            <div class="row mx-1 mt-4">
                                <button type="submit" class="col-sm-4 btn sm"><?php echo e(translate('Publish')); ?></button>
                            </div>
                        </div>

                    </div>
                    

                    
                    <div class="card  mt-md-5 p-0 col-12">
                        <div class="card-header bg-white py-3">
                            <h4><?php echo e(translate('Blog Categories')); ?></h4>
                        </div>
                        <div class="card-body">
                            <div id="category_select_load">
                                
                            </div>
                            <?php if($errors->has('categories')): ?>
                                <div class="invalid-input my-3 px-3"><?php echo e($errors->first('categories')); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    

                    
                    <div class="card  mt-md-5 p-0 col-12">
                        <div class="card-header bg-white py-3">
                            <h4><?php echo e(translate('Tags')); ?></h4>
                        </div>
                        <div class="card-body">
                            <div id="tag_select_load">
                                
                            </div>

                        </div>
                    </div>
                    

                    
                    <div class="card mt-5 p-0 col-12">
                        <div class="card-header bg-white py-3">
                            <h4><?php echo e(translate('Blog Image')); ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <?php echo $__env->make('core::base.includes.media.media_input', [
                                    'input' => 'blog_image',
                                    'data' => old('blog_image'),
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php if($errors->has('blog_image')): ?>
                                    <div class="invalid-input"><?php echo e($errors->first('blog_image')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                    

                    
                    <div class="card mt-5 p-0 col-12">
                        <div class="card-header bg-white py-3">
                            <h4><?php echo e(translate('Featured Blog')); ?></h4>
                        </div>
                        <div class="card-body">
                            
                            <div class="form-group row m-0">
                                <label for="is_featured" class="col-sm-6 font-14 bold black"><?php echo e(translate('Status')); ?>

                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-6">
                                    <label class="switch glow primary medium">
                                        <input type="checkbox" name="is_featured">
                                        <span class="control"></span>
                                    </label>
                                    <?php if($errors->has('is_featured')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('is_featured')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                    
                </div>
            </div>
            

        </div>

    </form>
    <?php echo $__env->make('core::base.media.partial.media_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End Main Content -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('custom_scripts'); ?>
    <!--Select2-->
    <script src="<?php echo e(asset('web-assets/backend/plugins/select2/select2.min.js')); ?>"></script>
    <!--End Select2-->
    <!--Editor-->
    <script src="<?php echo e(asset('web-assets/backend/plugins/summernote/summernote-lite.js')); ?>"></script>
    <!--End Editor-->

    <script>
        (function($) {
            "use strict";
            initDropzone()
            $(document).ready(function() {
                is_for_browse_file = true
                filtermedia()

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                // category load via ajax
                $.ajax({
                    type: "post",
                    url: '<?php echo e(route('core.blog.category.load')); ?>',
                    success: function(res) {
                        $('#category_select_load').html(res.view);
                        selectPlugin('#category-select'); //select plugin add
                        ButtonToggle('#add_new_category_button', '.category-create-form');

                        $('#add_category_button').on('click', function() {
                            saveCategory();
                        });
                    },
                    error: function(data, textStatus, jqXHR) {
                        toastr.error('Category Loading Failed' + data + textStatus + jqXHR,
                            'ERROR!!');
                    }
                });

                // save category via ajax
                function saveCategory() {
                    let category = $('#category_input').val();
                    if (category == '') {
                        return false;
                    }
                    let permalink = string_to_slug(category);
                    let parent = $('.parentCategorySelect option:selected').val();
                    let selected_categories = $('#category-select').val();

                    $.ajax({
                        type: "post",
                        url: '<?php echo e(route('core.blog.category.load')); ?>',
                        data: {
                            category: category,
                            permalink: permalink,
                            parent: parent,
                        },
                        success: function(res) {
                            if (res.error) {
                                toastr.error(res.error, 'ERROR!!');
                            } else {
                                $('#category_select_load').html(res.view);
                                $('.category-create-form').removeClass('d-none');

                                if (res.id != null) {
                                    selected_categories.push(res.id);
                                    $('#category-select').val(selected_categories);
                                    selectPlugin('#category-select'); //select plugin add
                                }

                                $('#add_category_button').on('click', function() {
                                    saveCategory();
                                });
                                ButtonToggle('#add_new_category_button', '.category-create-form');
                            }
                        },
                        error: function(data, textStatus, jqXHR) {
                            toastr.error('Category Loading Failed', 'ERROR!!');
                        }
                    });

                }

                // tag load via ajax
                $.ajax({
                    type: "post",
                    url: '<?php echo e(route('core.blog.tag.load')); ?>',
                    success: function(res) {

                        $('#tag_select_load').html(res.view);
                        selectPlugin('#tag-select'); //select plugin add
                        ButtonToggle('#add_new_tag_button', '.tag-create-form');

                        $('#add_tag_button').on('click', function() {
                            saveTag();
                        });
                    },
                    error: function(data, textStatus, jqXHR) {
                        toastr.error('Tag Loading Failed', 'ERROR!!');
                    }
                });

                // save Tag via ajax
                function saveTag() {
                    let tag = $('#tag_input').val();
                    if (tag == '') {
                        return false;
                    }
                    let permalink = string_to_slug(tag);
                    let selected_tags = $('#tag-select').val();

                    $.ajax({
                        type: "post",
                        url: '<?php echo e(route('core.blog.tag.load')); ?>',
                        data: {
                            tag: tag,
                            permalink: permalink,
                        },
                        success: function(res) {
                            if (res.error) {
                                toastr.error(res.error, 'ERROR!!');
                            } else {
                                $('#tag_select_load').html(res.view);
                                $('.tag-create-form').removeClass('d-none');

                                if (res.id != null) {
                                    selected_tags.push(res.id);
                                    $('#tag-select').val(selected_tags);
                                    selectPlugin('#tag-select'); //select plugin add
                                }

                                $('#add_tag_button').on('click', function() {
                                    saveTag();
                                });
                                ButtonToggle('#add_new_tag_button', '.tag-create-form');
                            }
                        },
                        error: function(data, textStatus, jqXHR) {
                            toastr.error('Tag Loading Failed', 'ERROR!!');
                        }
                    });
                }

                // SUMMERNOTE INIT
                $('#blog_content').summernote({
                    tabsize: 2,
                    height: 200,
                    codeviewIframeFilter: false,
                    codeviewFilter: true,
                    codeviewFilterRegex: /<\/*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|ilayer|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|t(?:itle|extarea)|xml)[^>]*>|on\w+\s*=\s*"[^"]*"|on\w+\s*=\s*'[^']*'|on\w+\s*=\s*[^\s>]+/gi,
                    toolbar: [
                        ["style", ["style"]],
                        ['fontsize', ['fontsize']],
                        ["font", ["bold", "underline", "clear"]],
                        ["color", ["color"]],
                        ["para", ["ul", "ol", "paragraph"]],
                        ["table", ["table"]],
                        ["insert", ["link", "picture", "video"]],
                        ["view", ["fullscreen", "codeview", "help"]],
                    ],
                    placeholder: 'Blog Content',
                    callbacks: {
                        onImageUpload: function(images, editor, welEditable) {
                            sendFile(images[0], editor, welEditable);
                        },
                        onChangeCodeview: function(contents, $editable) {
                            let code = $(this).summernote('code')
                            code = code.replace(
                                /<\/*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|ilayer|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|t(?:itle|extarea)|xml)[^>]*>|on\w+\s*=\s*"[^"]*"|on\w+\s*=\s*'[^']*'|on\w+\s*=\s*[^\s>]+/gi,
                                '')
                            $(this).val(code)
                        }
                    }
                });

            });

            /*Generate permalink*/
            $(".blog_name").change(function(e) {
                e.preventDefault();
                let name = $(".blog_name").val();
                let permalink = string_to_slug(name);
                $("#permalink").html(permalink);
                $("#permalink_input_field").val(permalink);
                $(".permalink-input-group").removeClass("d-none");
                $(".permalink-editor").addClass("d-none");
                $(".permalink-edit-btn").removeClass("d-none");
            });
            /*edit permalink*/
            $(".permalink-edit-btn").on("click", function(e) {
                e.preventDefault();
                let permalink = $("#permalink").html();
                $("#permalink-updated-input").val(permalink);
                $(".permalink-edit-btn").addClass("d-none");
                $(".permalink-editor").removeClass("d-none");
            });
            /*Cancel permalink edit*/
            $(".permalink-cancel-btn").on("click", function(e) {
                e.preventDefault();
                $("#permalink-updated-input").val();
                $(".permalink-editor").addClass("d-none");
                $(".permalink-edit-btn").removeClass("d-none");
            });
            /*Update permalink*/
            $(".permalink-save-btn").on("click", function(e) {
                e.preventDefault();
                let input = $("#permalink-updated-input").val();
                let updated_permalnk = string_to_slug(input);
                $("#permalink_input_field").val(updated_permalnk);
                $("#permalink").html(updated_permalnk);
                $(".permalink-editor").addClass("d-none");
                $(".permalink-edit-btn").removeClass("d-none");
            });
        })(jQuery);

        // select plugin -- function
        function selectPlugin(element) {
            "use strict";
            $(element).select2({
                theme: "classic",
                placeholder: '<?php echo e(translate('No Option Selected')); ?>',
            });
        }

        // add new buttonn toogle -- function
        function ButtonToggle(button, form) {
            "use strict";
            $(button).on('click', function() {
                $(form).toggleClass('d-none');
            });
        }

        // Blog preview and draft
        function blogPreviewDraft(action) {
            "use strict";
            var formData = $('#blog_form').serializeArray();
            formData.push({
                name: "action",
                value: action
            });

            $.ajax({
                method: 'POST',
                url: '<?php echo e(route('core.blog.draft.preview')); ?>',
                dataType: 'json',
                data: formData
            }).done(function(response) {
                if (response.error) {
                    toastr.error(response.error, "Error!");
                } else {
                    switch (action) {
                        case 'draft':
                            $('#blog_id').val(response.id);
                            toastr.success(response.success, "Success!");
                            break;

                        case 'preview':
                            $('#blog_id').val(response.id);
                            window.open('/blog-preview?name=' + response.permalink);
                            break;

                        case 'pending':
                            $('#blog_id').val(response.id);
                            toastr.info(response.success, "Success!");
                            break;

                        default:
                            toastr.error(response.error, "Error!");
                            break;
                    }
                }
            });
        }

        // send file function summernote
        function sendFile(image, editor, welEditable) {
            "use strict";
            let imageUploadUrl = '<?php echo e(route('core.blog.content.image')); ?>';
            let data = new FormData();
            data.append("image", image);

            $.ajax({
                data: data,
                type: "POST",
                url: imageUploadUrl,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {

                    if (data.url) {
                        var image = $('<img>').attr('src', data.url);
                        $('#blog_content').summernote("insertNode", image[0]);
                    } else {
                        toastr.error(data.error, "Error!");
                    }

                },
                error: function(data) {
                    toastr.error('Image Upload Failed', "Error!");
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core::base.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/medo/work/eco-jara/fashly/Core/resources/views/base/blog/add_blog.blade.php ENDPATH**/ ?>