<?php
get_header();
?>

<div class="col-md-6">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/content', 'home'); ?>
        <?php endwhile;
    else : ?>
        <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; ?>
</div>

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