<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/*
 * Disable Gutenberg for CPT
 */

add_filter('use_block_editor_for_post_type', function ($use_block_editor, $post_type) {
    if ('video' === $post_type) {
        return false;
    }
    return $use_block_editor;
}, 10, 2);
