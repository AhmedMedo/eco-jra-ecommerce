<div class="form-group row mt-4">
    <div class="col-sm-12">
        <select id="tag-select" class="CategorySelect form-control" name="tags[]" multiple>
            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($blog_tag)): ?>
                    <option value="<?php echo e($tag->id); ?>" <?php echo e(in_array($tag->id, $blog_tag) ? 'selected' : ''); ?>>
                        <?php echo e($tag->translation('name', getLocale())); ?></option>
                <?php else: ?>
                    <option value="<?php echo e($tag->id); ?>" <?php echo e(collect(old('tags'))->contains($tag->id) ? 'selected' : ''); ?>>
                        <?php echo e($tag->translation('name', getLocale())); ?></option>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Tag')): ?>
    <div class="row px-3 d-none tag-create-form">
        <h4 class="font-14 my-1 col-12"><?php echo e(translate('New Tag')); ?></h4>
        <input type="text" name="tag_name" class="form-control col-8" id="tag_input" placeholder="Create Tag">
        <button type="button" class="btn custom-btn mb-2 offset-1 col-2 mx-2 my-1"
            id="add_tag_button"><?php echo e(translate('Add')); ?></button>
    </div>
    <button type="button" class="btn sm btn-primary my-2 w-50"
        id="add_new_tag_button"><?php echo e(translate('Add New Tag')); ?></button>
<?php endif; ?>
<?php /**PATH /home/medo/work/eco-jara/fashly/Core/resources/views/base/blog/includes/tag-select.blade.php ENDPATH**/ ?>