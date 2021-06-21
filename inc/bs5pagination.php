<?php

function bs5_paginate_links($args = '')
{
    global $wp_query, $wp_rewrite;

    // Setting up default values based on the current URL.
    $pagenum_link = html_entity_decode(get_pagenum_link());
    $url_parts    = explode('?', $pagenum_link);

    // Get max pages and current page out of the current query, if available.
    $total   = isset($wp_query->max_num_pages) ? $wp_query->max_num_pages : 1;
    $current = get_query_var('paged') ? (int) get_query_var('paged') : 1;

    // Append the format placeholder to the base URL.
    $pagenum_link = trailingslashit($url_parts[0]) . '%_%';

    // URL base depends on permalink settings.
    $format  = $wp_rewrite->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged') : '?paged=%#%';

    $defaults = array(
        'base'               => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below).
        'format'             => $format, // ?page=%#% : %#% is replaced by the page number.
        'total'              => $total,
        'current'            => $current,
        'aria_current'       => 'page',
        'show_all'           => false,
        'prev_next'          => true,
        'prev_text'          => __('&laquo; Previous'),
        'next_text'          => __('Next &raquo;'),
        'end_size'           => 1,
        'mid_size'           => 2,
        'type'               => 'list',
        'add_args'           => array(), // Array of query args to add.
        'add_fragment'       => '',
        'before_page_number' => '',
        'after_page_number'  => '',
    );

    $args = wp_parse_args($args, $defaults);

    if (!is_array($args['add_args'])) {
        $args['add_args'] = array();
    }

    // Merge additional query vars found in the original URL into 'add_args' array.
    if (isset($url_parts[1])) {
        // Find the format argument.
        $format       = explode('?', str_replace('%_%', $args['format'], $args['base']));
        $format_query = isset($format[1]) ? $format[1] : '';
        wp_parse_str($format_query, $format_args);

        // Find the query args of the requested URL.
        wp_parse_str($url_parts[1], $url_query_args);

        // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
        foreach ($format_args as $format_arg => $format_arg_value) {
            unset($url_query_args[$format_arg]);
        }

        $args['add_args'] = array_merge($args['add_args'], urlencode_deep($url_query_args));
    }

    // Who knows what else people pass in $args.
    $total = (int) $args['total'];
    if ($total < 2) {
        return;
    }
    $current  = (int) $args['current'];
    $end_size = (int) $args['end_size']; // Out of bounds? Make it the default.
    if ($end_size < 1) {
        $end_size = 1;
    }
    $mid_size = (int) $args['mid_size'];
    if ($mid_size < 0) {
        $mid_size = 2;
    }

    $add_args   = $args['add_args'];
    $r          = '';
    $page_links = array();
    $dots       = false;

    if ($args['prev_next'] && $current && 1 < $current) :
        $link = str_replace('%_%', 2 == $current ? '' : $args['format'], $args['base']);
        $link = str_replace('%#%', $current - 1, $link);
        if ($add_args) {
            $link = add_query_arg($add_args, $link);
        }
        $link .= $args['add_fragment'];

        $page_links[] = sprintf(
            '<a class="prev page-numbers page-link" href="%s">%s</a>',
            /**
             * Filters the paginated links for the given archive pages.
             *
             * @since 3.0.0
             *
             * @param string $link The paginated link URL.
             */
            esc_url(apply_filters('paginate_links', $link)),
            $args['prev_text']
        );
    endif;

    for ($n = 1; $n <= $total; $n++) :
        if ($n == $current) :
            $page_links[] = sprintf(
                '<span aria-current="%s" class="page-numbers current page-link">%s</span>',
                esc_attr($args['aria_current']),
                $args['before_page_number'] . number_format_i18n($n) . $args['after_page_number']
            );

            $dots = true;
        else :
            if ($args['show_all'] || ($n <= $end_size || ($current && $n >= $current - $mid_size && $n <= $current + $mid_size) || $n > $total - $end_size)) :
                $link = str_replace('%_%', 1 == $n ? '' : $args['format'], $args['base']);
                $link = str_replace('%#%', $n, $link);
                if ($add_args) {
                    $link = add_query_arg($add_args, $link);
                }
                $link .= $args['add_fragment'];

                $page_links[] = sprintf(
                    '<a class="page-numbers page-link" href="%s">%s</a>',
                    /** This filter is documented in wp-includes/general-template.php */
                    esc_url(apply_filters('paginate_links', $link)),
                    $args['before_page_number'] . number_format_i18n($n) . $args['after_page_number']
                );

                $dots = true;
            elseif ($dots && !$args['show_all']) :
                $page_links[] = '<span class="page-numbers dots page-link">' . __('&hellip;') . '</span>';

                $dots = false;
            endif;
        endif;
    endfor;

    if ($args['prev_next'] && $current && $current < $total) :
        $link = str_replace('%_%', $args['format'], $args['base']);
        $link = str_replace('%#%', $current + 1, $link);
        if ($add_args) {
            $link = add_query_arg($add_args, $link);
        }
        $link .= $args['add_fragment'];

        $page_links[] = sprintf(
            '<a class="next page-numbers page-link" href="%s">%s</a>',
            /** This filter is documented in wp-includes/general-template.php */
            esc_url(apply_filters('paginate_links', $link)),
            $args['next_text']
        );
    endif;

    switch ($args['type']) {
        case 'array':
            return $page_links;

        case 'list':
            if ($current == 1) {
                $r .= "<ul class='page-numbers pagination'>\n\t<li class='page-item active'>" . $page_links[0];
                for ($i = 1; $i < count($page_links); $i++) {
                    $r .= "</li>\n\t<li class='page-item'>" . $page_links[$i];
                }
            } else {
                $r .= "<ul class='page-numbers pagination'>\n\t<li class='page-item'>" . $page_links[0];
                for ($i = 1; $i < count($page_links); $i++) {
                    if ($i == $current) {
                        $r .= "</li>\n\t<li class='page-item active'>" . $page_links[$i];
                    } else {
                        $r .= "</li>\n\t<li class='page-item'>" . $page_links[$i];
                    }
                }
            }
            // $r .= "<ul class='page-numbers pagination'>\n\t<li class='page-item'>";
            // $r .= implode("</li>\n\t<li class='page-item'>", $page_links);
            $r .= "</li>\n</ul>\n";
            break;

        default:
            $r = implode("\n", $page_links);
            break;
    }

    /**
     * Filters the HTML output of paginated links for archives.
     *
     * @since 5.7.0
     *
     * @param string $r    HTML output.
     * @param array  $args An array of arguments. See paginate_links()
     *                     for information on accepted arguments.
     */
    $r = apply_filters('paginate_links_output', $r, $args);

    return $r;
}


function bs5_get_the_posts_pagination($args = array())
{
    $navigation = '';

    // Don't print empty markup if there's only one page.
    if ($GLOBALS['wp_query']->max_num_pages > 1) {
        // Make sure the nav element has an aria-label attribute: fallback to the screen reader text.
        if (!empty($args['screen_reader_text']) && empty($args['aria_label'])) {
            $args['aria_label'] = $args['screen_reader_text'];
        }

        $args = wp_parse_args(
            $args,
            array(
                'mid_size'           => 1,
                'prev_text'          => _x('Previous', 'previous set of posts'),
                'next_text'          => _x('Next', 'next set of posts'),
                'screen_reader_text' => __('Posts navigation'),
                'aria_label'         => __('Posts'),
                'class'              => '',
            )
        );

        // Make sure we get a string back. Plain is the next best thing.
        if (isset($args['type']) && 'array' === $args['type']) {
            $args['type'] = 'plain';
        }

        // Set up paginated links.
        $links = bs5_paginate_links($args);

        if ($links) {
            $navigation = _navigation_markup($links, $args['class'], $args['screen_reader_text'], $args['aria_label']);
        }
    }

    return $navigation;
}

function bs5_the_posts_pagination($args = array())
{
    echo bs5_get_the_posts_pagination($args);
}
