<article class="pb-3 mb-5 border-bottom border-dark">
    <!-- image is not resizing here -->
    <?php if (has_post_thumbnail()) : ?>
        <img class="featured mb-3" src="<?php the_post_thumbnail_url('medium') ?>" alt="featured image">
    <?php endif; ?>
    <p>
        <a href="<?php the_permalink(); ?>">
            <h3 class="pb-3"><?php the_title(); ?></h3>
        </a>
        <?php the_author_meta('display_name'); ?>
    </p>
    <p>
        <span><?php the_date(); ?></span>
        <span><?php comments_number(); ?></span>
    </p>

    <?php
    the_excerpt();
    ?>

    <a class="btn btn-primary" href="<?php the_permalink(); ?>">Read More <i class="bi bi-arrow-right"></i></a>

</article>