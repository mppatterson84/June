<article class="col-md-6">
    <!-- image is not resizing here -->
    <?php if (has_post_thumbnail()) : ?>
        <img class="featured" src="<?php the_post_thumbnail_url('medium') ?>" alt="featured image">
    <?php endif; ?>
    <a href="<?php the_permalink(); ?>">
        <h3><?php the_title(); ?></h3>
    </a>
    <p>
        <span><?php the_date(); ?></span>
        <span><?php comments_number(); ?></span>
    </p>

    <?php
    the_excerpt();
    ?>

    <a class="btn btn-primary" href="<?php the_permalink(); ?>">Read More <i class="bi bi-arrow-right"></i></a>

</article>