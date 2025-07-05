<div class="form-row">
    <div class="col-sm-12">
        <select class="CategorySelect form-control" id="category-select" name="categories[]" multiple
            placeholder="<?php echo e(translate('Select a Category')); ?>">
            <option value="">
                <?php echo e(translate('Select a Category')); ?>

            </option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($blog_category)): ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e(in_array($category->id, $blog_category) ? 'selected' : ''); ?>>
                        <?php echo e($category->translation('name', getLocale())); ?></option>
                <?php else: ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->translation('name', getLocale())); ?></option>
                <?php endif; ?>
                <?php if(count($category->active_childs)): ?>
                    <?php echo $__env->make('core::base.blog.includes.blog_child_category', [
                        'child_category' => $category->active_childs,
                        'label' => 1,
                        'parent' => null,
                        'active_childs' => true,
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <small><?php echo e(translate('Only Active Categories')); ?></small>
    </div>
</div>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Category')): ?>
    <div class="row px-3 d-none category-create-form">
        <h4 class="font-14 my-1"><?php echo e(translate('New Category')); ?></h4>

        <input type="text" name="category" class="form-control col-12 mb-2" id="category_input"
            placeholder="Create Category">
        <select class="parentCategorySelect form-control col-12 mb-2" name="parent"
            placeholder="<?php echo e(translate('Select Parent')); ?>">
            <option value="">
                <?php echo e(translate('Select a Parent Category')); ?>

            </option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>">
                    <?php echo e($category->translation('name', getLocale())); ?>

                </option>
                <?php if(count($category->active_childs)): ?>
                    <?php echo $__env->make('core::base.blog.includes.blog_child_category', [
                        'child_category' => $category->active_childs,
                        'label' => 1,
                        'parent' => null,
                        'active_childs' => true,
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button type="button" class="btn custom-btn mb-2 col-2" id="add_category_button"><?php echo e(translate('Add')); ?></button>
    </div>
    <button type="button" href="#" class="btn sm my-2 w-50"
        id="add_new_category_button"><?php echo e(translate('Add New Category')); ?></button>
<?php endif; ?>

<?php /**PATH /home/medo/work/eco-jara/fashly/Core/resources/views/base/blog/includes/category-select.blade.php ENDPATH**/ ?>