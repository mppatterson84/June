<article>
    <header class="content-header">
        <h1><?php the_title() ?></h1>
        <div class="meta mb-3">
            <span class="date"><?php the_date(); ?></span>
            <span><?php the_tags('<span class="mx-1 btn btn-outline-primary btn-sm"><i class="bi bi-tag"></i>', '</span><span class="mx-1 btn btn-outline-primary btn-sm"><i class="bi bi-tag"></i>', '</span>'); ?></span>
            <span class="comment">
                <a class="btn btn-outline-info btn-sm" href="#comments">
                    <i class="bi bi-chat-left-text"></i>
                    <?php comments_number(); ?>
                </a>
            </span>
        </div>
    </header>

    <?php
    the_content();
    ?>

    <?php
    comments_template();
    ?>
</article>