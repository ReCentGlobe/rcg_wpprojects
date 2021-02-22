<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class VideoArchive extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = ['components.video-archive'];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'title' => $this->title(),
            'videos' => $this->queryVideos()
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


    public function queryVideos(): \WP_Query
    {
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        return new \WP_Query(array(
            'post_type' => 'video',
            'orderby' => 'publish_date',
            'order' => 'DESC',
            'paged' => $paged
        ));
    }

}
