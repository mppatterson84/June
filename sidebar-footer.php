<div id="sidebar-footer" class="sidebar">
    <?php if (is_active_sidebar('footer')) : ?>
        <?php dynamic_sidebar('footer'); ?>
    <?php else : ?>
        <!-- Time to add some widgets! -->
    <?php endif; ?>
</div>