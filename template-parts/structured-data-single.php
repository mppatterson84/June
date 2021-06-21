<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "BlogPosting",
                "mainEntityOfPage": {
                    "@type": "WebPage",
                    "@id": "<?php the_permalink(); ?>"
                },
                "headline": "<?php the_title(); ?>",
                "image": "<?php the_post_thumbnail_url(); ?>",
                "datePublished": "<?php echo get_the_date(); ?>",
                "dateModified": "<?php echo get_the_modified_date(); ?>",
                "author": {
                    "@type": "Person",
                    "name": "<?php the_author_meta('display_name'); ?>"
                },
                "publisher": {
                    "@type": "Organization",
                    "name": "<?php the_permalink(); ?>",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "<?php echo esc_url(wp_get_attachment_url(get_theme_mod('custom_logo'))); ?>"
                    }
                }
            }
        </script>
    <?php endwhile;
else : ?>
    <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>