<?php

if (post_password_required()) {
    return;
}

$june_comment_count = get_comments_number();
?>

<div id="comments" class="comments-area default-max-width <?php echo get_option('show_avatars') ? 'show-avatars' : ''; ?>">

    <?php
    if (have_comments()) :;
    ?>
        <h2 class="comments-title">
            <?php if ('1' === $june_comment_count) : ?>
                <?php esc_html_e('1 comment', 'june'); ?>
            <?php else : ?>
                <?php
                printf(
                    /* translators: %s: Comment count number. */
                    esc_html(_nx('%s comment', '%s comments', $june_comment_count, 'Comments title', 'june')),
                    esc_html(number_format_i18n($june_comment_count))
                );
                ?>
            <?php endif; ?>
        </h2><!-- .comments-title -->

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'avatar_size' => 60,
                    'style'       => 'ol',
                    'short_ping'  => true,
                )
            );
            ?>
        </ol><!-- .comment-list -->

        <?php
        the_comments_pagination(
            array(
                'before_page_number' => esc_html__('Page', 'june') . ' ',
                'mid_size'           => 0,
                'prev_text'          => esc_html__('Previous', 'june'),
                'next_text'          => esc_html__('Next', 'june'),
            )
        );
        ?>

        <?php if (!comments_open()) : ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'june'); ?></p>
        <?php endif; ?>
    <?php endif; ?>

    <?php
    comment_form(
        array(
            'logged_in_as'       => null,
            'title_reply'        => esc_html__('Leave a comment', 'june'),
            'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
            'title_reply_after'  => '</h2>',
        )
    );
    ?>

</div><!-- #comments -->