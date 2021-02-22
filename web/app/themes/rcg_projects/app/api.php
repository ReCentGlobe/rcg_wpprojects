<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Countries sorted API Endpoint
 */
function videos_endpoint($data)
{
    $grouped_data = array();
    // get all taxonomies

    $post_data_all = array();
    $grouped_data = array();

    /**
     * All Posts
     */
    $post_data = array();

    $posts_list = get_posts(array(
        'type' => 'post',
        'post_type' => 'video',
        'numberposts' => -1
    ));
    foreach ($posts_list as $posts) {
        $post_data[] = array(
            'id' => $posts->ID,
            'permalink' => get_the_permalink($posts->ID),
            'title' => get_field('video_author', $posts->ID),
            'affiliation' => get_field('video_affiliation', $posts->ID),
            'country' => get_field('video_country', $posts->ID),
            'video' => get_field('video_embed', $posts->ID),
        );
    }

    $collection = array_merge_recursive(...$post_data);
    $collection['count'] = array_count_values(
        array_filter($collection['country'], function ($x) {
            return !empty($x);
        })
    );
    $collection['countries'] = array_unique(
        array_filter($collection['country'], function ($x) {
            return !empty($x);
        })
    );

    $grouped_data[] = array(
        'name' => 'All',
        'id' => 'All',
        'counts' => $collection['count'],
        'countries' => $collection['countries'],
        'data' => $post_data
    );
    wp_reset_postdata();

    return rest_ensure_response($grouped_data);
}

add_action('rest_api_init', function () {
    register_rest_route('rcg', 'videos', array(
        'methods' => 'GET',
        'callback' => __NAMESPACE__ . '\\videos_endpoint',
        'args' => array(
            'cat' => array(
                'validate_callback' => function ($param, $request, $key) {
                    return is_numeric($param);
                }
            )
        )
    ));
});

/**
 * Videos by Country API Endpoint
 */
function country_endpoint($data)
{
    $grouped_data = array();
    $args = array(
        'type' => 'post',
        'post_type' => 'video',
        'numberposts' => -1,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'video_country',
                'value' => $data['country'],
                'compare' => 'LIKE'
            )
        )
    );
    // get all taxonomies
    $post_list = get_posts($args);

    function getYTURL($posts)
    {
        $iframe = get_field('video_embed', $posts->ID);
        preg_match('/src="(.+?)"/', $iframe, $matches);
        return $matches[1];
    }
    function getYTID($posts)
    {
        $iframe = get_field('video_embed', $posts->ID);
        preg_match('/^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/', $iframe, $matches);
        return $matches[1];
    }

    foreach ($post_list as $posts) {
        $grouped_data[] = array(
            'id' => $posts->ID,
            'permalink' => get_the_permalink($posts->ID),
            'title' => get_field('video_author', $posts->ID),
            'affiliation' => get_field('video_affiliation', $posts->ID),
            'country' => get_field('video_country', $posts->ID),
            'video' => get_field('video_embed', $posts->ID),
            'ytsrc' => getYTURL($posts),
            'ytid' => getYTID($posts),
        );
    }

    wp_reset_postdata();

    return rest_ensure_response($grouped_data);
}

add_action('rest_api_init', function () {
    register_rest_route(
        'rcg',
        'country/(?P<country>[A-Z]+)(?:/(?P<cat>\d+))?',
        array(
            'methods' => 'GET',
            'callback' => __NAMESPACE__ . '\\country_endpoint',
            'args' => array(
                'country' => array(
                    'validate_callback' => function ($param, $request, $key) {
                        return is_string($param);
                    }
                )
            )
        )
    );
});
