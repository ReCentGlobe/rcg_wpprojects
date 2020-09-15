<?php

/**
 * Theme helpers.
 */

namespace App;

/**
 * Change src and srcset to data-src and data-srcset, and add class 'lazyload'
 * @param $attributes
 * @return mixed
 */

add_filter('wp_get_attachment_image_attributes', function ($attributes) {

    if (isset($attributes['src'])) {
        $attributes['data-src'] = $attributes['src'];
        $attributes['src'] = ''; //could add default small image or a base64 encoded small image here
    }
    if (isset($attributes['srcset'])) {
        $attributes['data-srcset'] = $attributes['srcset'];
        $attributes['srcset'] = '';
    }
    // Ensure that the <img> doesn't have the data attribute already
    if (! array_key_exists('data-sizes', $attributes)) {
        $attributes['data-sizes'] = 'auto';
    }
    $attributes['class'] .= ' js-lazyload';
    return $attributes;
});
