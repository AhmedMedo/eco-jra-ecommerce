<nav class="sidebar" data-trigger="scrollbar">
    <!--Search Options-->
    <div class="sidebar-search-bar m-2">
        <div class="input-group addon ov-hidden">
            <input type="text" class="search-input theme-input-style search-in-sidebar text-white"
                placeholder="<?php echo e(translate('Search in Menu')); ?>">
        </div>
    </div>
    <!--End search options-->
    <!-- Sidebar Header -->
    <div class="sidebar-header d-none d-lg-block pt-0">
        <!-- Sidebar Toggle Pin Button -->
        <div class="sidebar-toogle-pin">
            <i class="icofont-tack-pin"></i>
        </div>
        <!-- End Sidebar Toggle Pin Button -->
    </div>
    <!-- End Sidebar Header -->
    <!-- Sidebar Body -->
    <div class="sidebar-body main-side-bar">
        <!-- Nav -->
        <ul class="nav" id="main-nav">
            <?php if(auth()->user()->can('Manage Dashboard')): ?>
                <li class="<?php echo e(Request::routeIs('admin.dashboard') ? 'active ' : ''); ?>">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">
                        <i class="icofont-dashboard"></i>
                        <span class="link-title"><?php echo e(translate('Dashboard')); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->can('Manage Media')): ?>
                <!--Media Module-->
                <li class="<?php echo e(Request::routeIs(['core.media.page']) ? 'active ' : ''); ?>">
                    <a href="<?php echo e(route('core.media.page')); ?>">
                        <i class="icofont-multimedia"></i>
                        <span class="link-title"><?php echo e(translate('Media')); ?></span>
                    </a>

                </li>
                <!--End Media module-->
            <?php endif; ?>
            <!-- Blog & Page-->
            <!--Blog Module-->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Show Blog', 'Create Blog', 'Manage Category', 'Manage Tag', 'Manage Comment'])): ?>
                <li
                    class="<?php echo e(Request::routeIs(['core.blog.category', 'core.add.blog.category', 'core.edit.blog.category', 'core.blog', 'core.add.blog', 'core.edit.blog', 'core.tag', 'core.edit.tag', 'core.add.tag', 'core.blog.comment', 'core.blog.comment.edit', 'core.blog.comment.setting']) ? 'active sub-menu-opened' : ''); ?>">
                    <a href="#">
                        <i class="icofont-blogger"></i>
                        <span class="link-title"><?php echo e(translate('Blog')); ?></span>
                    </a>
                    <ul class="nav sub-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Blog')): ?>
                            <li class="<?php echo e(Request::routeIs('core.add.blog') ? 'active ' : ''); ?>">
                                <a href="<?php echo e(route('core.add.blog')); ?>"><?php echo e(translate('Write New Blog')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Blog')): ?>
                            <li class="<?php echo e(Request::routeIs(['core.blog', 'core.edit.blog']) ? 'active ' : ''); ?>">
                                <a href="<?php echo e(route('core.blog')); ?>"><?php echo e(translate('All Blogs')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Category')): ?>
                            <li
                                class="<?php echo e(Request::routeIs(['core.blog.category', 'core.add.blog.category', 'core.edit.blog.category']) ? 'active ' : ''); ?>">
                                <a href="<?php echo e(route('core.blog.category')); ?>"><?php echo e(translate('Categories')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Tag')): ?>
                            <li class="<?php echo e(Request::routeIs(['core.tag', 'core.add.tag', 'core.edit.tag']) ? 'active ' : ''); ?>">
                                <a href="<?php echo e(route('core.tag')); ?>"><?php echo e(translate('Tags')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Comment')): ?>
                            <li
                                class="<?php echo e(Request::routeIs(['core.blog.comment', 'core.blog.comment.edit']) ? 'active ' : ''); ?>">
                                <a href="<?php echo e(route('core.blog.comment')); ?>"><?php echo e(translate('Comments')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Blog Settings')): ?>
                            <li class="<?php echo e(Request::routeIs(['core.blog.comment.setting']) ? 'active sub-menu-opened' : ''); ?>">
                                <a href="#">
                                    <span class="link-title"><?php echo e(translate('Settings')); ?></span>
                                </a>
                                <ul class="nav sub-menu">
                                    <li class="<?php echo e(Request::routeIs(['core.blog.comment.setting']) ? 'active' : ''); ?>">
                                        <a
                                            href="<?php echo e(route('core.blog.comment.setting')); ?>"><?php echo e(translate('Comment Settings')); ?></a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <!--End Blog module-->

            <!--Page Module-->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Show Page', 'Create Page'])): ?>
                <li
                    class="<?php echo e(Request::routeIs(['core.page', 'core.page.add', 'core.page.edit']) ? 'active sub-menu-opened' : ''); ?>">
                    <a href="#">
                        <i class="icofont-page"></i>
                        <span class="link-title"><?php echo e(translate('Pages')); ?></span>
                    </a>
                    <ul class="nav sub-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Page')): ?>
                            <li class="<?php echo e(Request::routeIs(['core.page', 'core.page.edit']) ? 'active ' : ''); ?>">
                                <a href="<?php echo e(route('core.page')); ?>"><?php echo e(translate('All Pages')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Page')): ?>
                            <li class="<?php echo e(Request::routeIs('core.page.add') ? 'active ' : ''); ?>">
                                <a href="<?php echo e(route('core.page.add')); ?>"><?php echo e(translate('Add New Page')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <!--End Blog module-->
            <!-- Blog & Page -->

            <!--Plugin nabvar options-->
            <?php $__currentLoopData = pluginNavbar(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if ($__env->exists($item)) echo $__env->make($item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!--End Plugin nabvar options-->

            <!--Appearances Modules-->
            <?php if(auth()->user()->can('Manage Themes') ||
                    auth()->user()->can('Manage Menus')): ?>
                <li
                    class="<?php echo e(Request::routeIs(['core.themes.index', 'core.manage.menus']) ? 'active sub-menu-opened' : ''); ?>">
                    <a href="#">
                        <i class="icofont-brand-designfloat"></i>
                        <span class="link-title"><?php echo e(translate('Appearances')); ?></span>
                    </a>
                    <ul class="nav sub-menu">
                        <?php if(auth()->user()->can('Manage Themes')): ?>
                            <li class="<?php echo e(Request::routeIs(['core.themes.index']) ? 'active ' : ''); ?>">
                                <a href="<?php echo e(route('core.themes.index')); ?>"><?php echo e(translate('Themes')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->can('Manage Menus')): ?>
                            <li class="<?php echo e(Request::routeIs(['core.manage.menus']) ? 'active ' : ''); ?>">
                                <a href="<?php echo e(route('core.manage.menus')); ?>"><?php echo e(translate('Menus')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <!--End Appearances Modules-->

            <!--Theme otions-->
            <?php if ($__env->exists(getActiveThemeOptions())) echo $__env->make(getActiveThemeOptions(), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--End Theme options-->

            <?php if(auth()->user()->can('Manage Plugins')): ?>
                <!--Plugins Module-->
                <li class="<?php echo e(Request::routeIs(['core.plugins.index', 'core.plugins.create']) ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('core.plugins.index')); ?>">
                        <i class="icofont-addons"></i>
                        <span class="link-title"><?php echo e(translate('Plugins')); ?></span>
                    </a>
                </li>
                <!--End Plugins module-->
            <?php endif; ?>

            <!--Users Module-->
            <?php if(auth()->user()->can('Show User') ||
                    auth()->user()->can('Show Role') ||
                    auth()->user()->can('Show Permission')): ?>
                <li
                    class="<?php echo e(Request::routeIs(['core.roles', 'core.permissions', 'core.users', 'core.add.user', 'core.edit.user']) ? 'active sub-menu-opened' : ''); ?>">
                    <a href="#">
                        <i class="icofont-users-social"></i>
                        <span class="link-title"><?php echo e(translate('Users')); ?></span>
                    </a>
                    <ul class="nav sub-menu">
                        <?php if(auth()->user()->can('Show User')): ?>
                            <li
                                class="<?php echo e(Request::routeIs(['core.users', 'core.add.user', 'core.edit.user']) ? 'active ' : ''); ?>">
                                <a href="<?php echo e(route('core.users')); ?>"><?php echo e(translate('Users')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('Show Role')): ?>
                            <li class="<?php echo e(Request::routeIs(['core.roles']) ? 'active ' : ''); ?>"><a
                                    href="<?php echo e(route('core.roles')); ?>"><?php echo e(translate('Roles')); ?></a></li>
                        <?php endif; ?>

                        <?php if(auth()->user()->can('Show Permission')): ?>
                            <li class="<?php echo e(Request::routeIs(['core.permissions']) ? 'active ' : ''); ?>">
                                <a href="<?php echo e(route('core.permissions')); ?>"><?php echo e(translate('Permissions')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <!--End users-->
            <!--Business Settings Modules-->
            <?php if(auth()->user()->can('Manage General Settings') ||
                    auth()->user()->can('Manage Email Settings') ||
                    auth()->user()->can('Manage Email Templates') ||
                    auth()->user()->can('Manage Media Settings') ||
                    auth()->user()->can('Manage Seo Settings')): ?>
                <li
                    class="<?php echo e(Request::routeIs(['core.seo.settings', 'core.email.smtp.configuration', 'core.media.settings', 'core.email.templates', 'core.media.settings', 'core.general.settings']) ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('core.general.settings')); ?>">
                        <i class="icofont-settings-alt"></i>
                        <span class="link-title"><?php echo e(translate('Business Settings')); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <!--End Business Settings Modules-->

            <!--System Module--->
            <li
                class="<?php echo e(Request::routeIs(['app.system.license.list', 'core.language.frontend.translations', 'core.language.edit', 'core.language.key.values', 'core.languages', 'core.language.new', 'core.system.update.page', 'core.backup.files.list', 'core.backup.database.list']) ? 'active sub-menu-opened' : ''); ?>">
                <a href="#">
                    <i class="icofont-wrench"></i>
                    <span class="link-title"><?php echo e(translate('System')); ?></span>
                </a>
                <ul class="nav sub-menu">
                    <?php if(auth()->user()->can('Manage Update')): ?>
                        <li class="<?php echo e(Request::routeIs(['core.system.update.page']) ? 'active ' : ''); ?>">
                            <a href="<?php echo e(route('core.system.update.page')); ?>"><?php echo e(translate('Update')); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->can('Manage Backups')): ?>
                        <li
                            class="<?php echo e(Request::routeIs(['core.backup.files.list', 'core.backup.database.list']) ? 'active ' : ''); ?>">
                            <a href="<?php echo e(route('core.backup.files.list')); ?>"><?php echo e(translate('Backups')); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->can('Manage Language')): ?>
                        <li class="<?php echo e(Request::routeIs(['core.languages']) ? 'active ' : ''); ?>">
                            <a href="<?php echo e(route('core.languages')); ?>"><?php echo e(translate('Languages')); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->can('Manage Language')): ?>
                        <li class="<?php echo e(Request::routeIs(['app.system.license.list']) ? 'active ' : ''); ?>">
                            <a href="<?php echo e(route('app.system.license.list')); ?>"><?php echo e(translate('Licenses')); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
            <!--End system Module-->

            <!--Activity Logs Module-->
            <?php if(auth()->user()->can('Manage Login activity')): ?>
                <li
                    class="<?php echo e(Request::routeIs(['core.activity.logs', 'core.get.login.activity']) ? 'active sub-menu-opened' : ''); ?>">
                    <a href="#">
                        <i class="icofont-ui-password"></i>
                        <span class="link-title"><?php echo e(translate('Activity Logs')); ?></span>
                    </a>
                    <ul class="nav sub-menu">
                        <li class="<?php echo e(Request::routeIs(['core.get.login.activity']) ? 'active ' : ''); ?>">
                            <a href="<?php echo e(route('core.get.login.activity')); ?>"><?php echo e(translate('Login activity')); ?></a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <!--Activity Logs Settings Module-->
        </ul>
        <!-- End Nav -->
    </div>
    <!-- End Sidebar Body -->
    <!--Side bar search result-->
    <div class="sidebar-body search-side-bar d-none">
        <!-- Nav -->
        <ul class="nav">
            <li>Hello</li>
        </ul>
    </div>
    <!--End sidebar search result-->
</nav>
<?php /**PATH /home/medo/work/eco-jara/fashly/Core/resources/views/base/layouts/navbar.blade.php ENDPATH**/ ?>