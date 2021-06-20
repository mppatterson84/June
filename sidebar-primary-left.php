<div id="sidebar-primary-left" class="sidebar">
    <?php if (is_active_sidebar('primary-left')) : ?>
        <?php dynamic_sidebar('primary-left'); ?>
    <?php else : ?>
        <!-- Time to add some widgets! -->
    <?php endif; ?>
</div>