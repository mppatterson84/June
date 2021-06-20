<?php
get_header();
?>

<aside class="col-md-3 order-2 order-md-first">
    <?php get_sidebar('primary-left') ?>
</aside>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php get_template_part('template-parts/content', 'home'); ?>
    <?php endwhile;
else : ?>
    <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<aside class="col-md-3 order-3">
    <?php get_sidebar('primary-right') ?>
</aside>

<div class="row order-4">
    <div class="col md-4"></div>
    <div class="col md-4">
        <?php bs5_the_posts_pagination(
            array(
                'type' => 'list'
            )
        )
        ?>
    </div>
    <div class="col md-4"></div>
</div>


<?php
get_footer();
?>