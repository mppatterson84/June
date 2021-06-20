<div id="sidebar-primary-right" class="sidebar">
    <?php if (is_active_sidebar('primary-right')) : ?>
        <?php dynamic_sidebar('primary-right'); ?>
    <?php else : ?>
        <!-- Time to add some widgets! -->
    <?php endif; ?>
</div>