<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class EventArchive extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = ['components.event-archive'];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'title' => $this->title(),
            'sections' => $this->query_taxsection(),
            'categories' => $this->query_eventcategory(),
            'events' => $this->query_events(),
            'currentPage' => $this->currentPage()
        ];
    }

    /**
     * Returns the post title.
     *
     * @return string
     */
    public function title()
    {
        if ($this->view->name() !== 'partials.page-header') {
            return get_the_title();
        }

        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }

            return __('Latest Posts', 'sage');
        }

        if (is_archive()) {
            return get_the_archive_title();
        }

        if (is_search()) {
            /* translators: %s is replaced with the search query */
            return sprintf(
                __('Search Results for %s', 'sage'),
                get_search_query()
            );
        }

        if (is_404()) {
            return __('Not Found', 'sage');
        }

        return get_the_title();
    }

    public function query_eventcategory()
    {
        return new \WP_Term_Query(array(
            'taxonomy' => 'event-category',
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ));
    }


    public function query_taxsection()
    {
        $ids_to_exclude = array();
        $get_terms_to_exclude = get_terms(array(
            'fields' => 'ids',
            'slug' => array(
                'central-project',
                'integrated-research-training-group',
                'thematic-working-groups'
            ),
            'taxonomy' => 'project-section'
        ));

        if (!is_wp_error($get_terms_to_exclude) &&
            count($get_terms_to_exclude) > 0
        ) {
            $ids_to_exclude = $get_terms_to_exclude;
        }

        return new \WP_Term_Query(array(
            'taxonomy' => 'project-section',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'exclude' => $ids_to_exclude
        ));
    }

    public function currentPage()
    {
        $page = get_query_var('paged', 1);

        if ($page === 0) {
            $page = 1;
        }

        return $page;
    }

    public function query_events(): \WP_Query
    {
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $today = date(
            'Ymd',
            mktime(0, 0, 0, date('m') + 2, date('d') + 14, date('Y'))
        );

        $meta_query = array('relation' => 'AND');
        $meta_query[] = array(
            'key' => 'event_startdate',
            'value' => $today,
            'type' => 'DATETIME',
            'compare' => '<'
        );

        return new \WP_Query(array(
            'post_type' => 'event',
            'status' => 'publish',
            'orderby' => 'meta_value',
            'meta_key' => 'event_startdate',
            'meta_query' => $meta_query,
            'order' => 'DESC',
            'paged' => $paged
        ));
    }
}
