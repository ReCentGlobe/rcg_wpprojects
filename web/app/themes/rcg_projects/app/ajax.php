<?php

namespace App;

/**
 * AJAX Filter for Events
 */

add_action('wp_ajax_get_events', __NAMESPACE__ . '\\get_events');
add_action('wp_ajax_nopriv_get_events', __NAMESPACE__ . '\\get_events');

function get_events()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], 'rcgproject_nonce')) {
        exit('There has been an error. Please reload the page.');
    }

    /**
     * Query Arguments
     */
    if ($_REQUEST['paged']) {
        $dataPaged = (int) $_REQUEST['paged'];
    } else {
        $dataPaged = get_query_var('paged') ?: 1;
    }
    $today = date('Ymd', mktime(0, 0, 0, date('m'), date('d') + 30, date('Y')));

    $meta_query = array('relation' => 'AND');
    $meta_query[] = array(
        'key' => 'event_startdate',
        'value' => $today,
        'type' => 'DATETIME',
        'compare' => '<'
    );

    //$year = '2017';

    if (isset($_REQUEST['year']) && !empty($_REQUEST['year'])) {
        $year = sanitize_text_field($_REQUEST['year']);
        $meta_query[] = array(
            'key' => 'event_startdate',
            'value' => array($year . '-01 00:00:01', $year . '-31 23:59:59'),
            'compare' => 'BETWEEN',
            'type' => 'DATETIME'
        );
    }

    $search_value = $_REQUEST['search'] ?: false;
    $category_terms = $_REQUEST['categories'] ?: false;

    $tax_query = $category_terms
        ? array(
            array(
                'taxonomy' => 'event-category',
                'field' => 'term_id',
                'terms' => $category_terms
            )
        )
        : false;

    $args = array(
        'post_type' => 'event',
        'posts_per_page' => 20,
        's' => $search_value,
        'tax_query' => $tax_query,
        'status' => 'publish',
        'orderby' => 'meta_value_num',
        'meta_key' => 'event_startdate',
        'meta_query' => $meta_query,
        'paged' => $dataPaged,
        'order' => 'DESC'
    );

    // The Query
    $ajaxposts = new \WP_Query($args);
    $response = '';

    // The Query
    if ($ajaxposts->have_posts()) :
        while ($ajaxposts->have_posts()) :
            $ajaxposts->the_post();
            echo \Roots\View('components.event-tile');
        endwhile;
        wp_reset_postdata();

        $big = 999999999; // need an unlikely integer
        $paginate_links = paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, $dataPaged),
            'prev_next' => true,
            'prev_text' => 'Prev',
            'next_text' => 'Next',
            'show_all' => false,
            'mid_size' => 2,
            'end_size' => 2,
            'total' => $ajaxposts->max_num_pages,
            'type' => 'array'
        ));

        echo \Roots\View('components.ajax-pagination', [
            'pagination' => $paginate_links
        ]);
    else :
        echo 'No events found';
    endif;

    die();
}
