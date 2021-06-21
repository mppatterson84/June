<article class="col-md-6">
    <header class="content-header">
        <?php if (has_post_thumbnail()) : ?>
            <img class="featured mb-3" src="<?php the_post_thumbnail_url('medium') ?>" alt="featured image">
        <?php endif; ?>
        <h1 class="pb-3"><?php the_title() ?></h1>
        <div class="meta mb-3">
            <p>
                <?php the_author_meta('display_name'); ?>
            </p>
            <p>
                <span class="date"><?php the_date(); ?></span>
                <span><?php the_tags('<span class="mx-1 btn btn-outline-primary btn-sm"><i class="bi bi-tag"></i>', '</span><span class="mx-1 btn btn-outline-primary btn-sm"><i class="bi bi-tag"></i>', '</span>'); ?></span>
                <span class="comment">
                    <a class="btn btn-outline-info btn-sm" href="#comments">
                        <i class="bi bi-chat-left-text"></i>
                        <?php comments_number(); ?>
                    </a>
                </span>
            </p>
        </div>
    </header>

    <?php
    the_content();
    ?>

    <p>
        <a class="btn btn-primary btn-sm" href="<?php echo get_permalink(get_option('page_for_posts')); ?>">Blog</a>
    </p>

    <?php
    comments_template();
    ?>
</article>