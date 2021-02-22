<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Post Types
    |--------------------------------------------------------------------------
    |
    | Here you may specify the post types to be registered by Poet using the
    | Extended CPTs library. <https://github.com/johnbillion/extended-cpts>
    |
    */

    'post' => [
        'event' => [
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'has_archive' => 'events',
            'show_in_rest' => true,
            'show_in_graphql' => true,
            'graphql_single_name' => 'event',
            'graphql_plural_name' => 'events',
            'menu_icon' => 'dashicons-editor-kitchensink',
            'hierarchical' => false,
            'menu_position' => null,
            'can_export' => true,
            'capability_type' => 'post',
            'rewrite' => [
                'slug' => 'events',
                'with_front' => false,
                'feeds' => true,
                'pages' => true
            ],
            'labels' => [
                'singular' => 'Event',
                'plural' => 'Events',
                'text_domain' => 'sage'
            ]
        ],
        'video' => [
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'has_archive' => 'videos',
            'show_in_rest' => true,
            'show_in_graphql' => true,
            'graphql_single_name' => 'video',
            'graphql_plural_name' => 'video',
            'menu_icon' => 'dashicons-format-video',
            'hierarchical' => false,
            'menu_position' => null,
            'can_export' => true,
            'capability_type' => 'post',
            'supports' => array('title'),
            'rewrite' => [
                'slug' => 'videos',
                'with_front' => false,
                'feeds' => true,
                'pages' => true
            ],
            'labels' => [
                'singular' => 'Video',
                'plural' => 'Videos',
                'text_domain' => 'sage'
            ]
        ],
        'blog' => [
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'has_archive' => 'blog',
            'show_in_graphql' => true,
            'show_in_rest' => true,
            'graphql_single_name' => 'blog-post',
            'graphql_plural_name' => 'blog-posts',
            'hierarchical' => false,
            'menu_icon' => 'dashicons-welcome-write-blog',
            'menu_position' => null,
            'can_export' => true,
            'capability_type' => 'post',
            'rewrite' => [
                'slug' => 'blog',
                'with_front' => false,
                'feeds' => true,
                'pages' => true
            ],
            'labels' => [
                'singular' => 'Blog Post',
                'plural' => 'Blog Posts',
                'text_domain' => 'sage'
            ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Taxonomies
    |--------------------------------------------------------------------------
    |
    | Here you may specify the taxonomies to be registered by Poet using the
    | Extended CPTs library. <https://github.com/johnbillion/extended-cpts>
    |
    */

    'taxonomy' => [
        'event-category' => [
            'links' => ['event'],
            'show_in_graphql' => true,
            'graphql_single_name' => 'eventCategory',
            'graphql_plural_name' => 'eventCategories',
            'show_admin_column' => true,
            'labels' => [
                'singular' => 'Event category',
                'plural' => 'Event categories',
                'text_domain' => 'sage'
            ],
            'show_in_rest' => true,
            'query_var' => true,
            'rewrite' => [
                'slug' => 'event-category',
                'with_front' => true
            ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Blocks
    |--------------------------------------------------------------------------
    |
    | Here you may specify the block types to be registered by Poet and
    | rendered using Blade.
    |
    | Blocks are registered using the `namespace/label` defined when
    | registering the block with the editor. If no namespace is provided,
    | the current theme text domain will be used instead.
    |
    | Given the block `sage/accordion`, your block view would be located at:
    |   ↪ `views/blocks/accordion.blade.php`
    |
    | Block views have the following variables available:
    |   ↪ $data    – An object containing the block data.
    |   ↪ $content – A string containing the InnerBlocks content.
    |                Returns `null` when empty.
    |
    */

    'block' => [
        'sage/accordion' => [
            'attributes' => [
                'title' => [
                    'default' => 'Lorem ipsum',
                    'type' => 'string'
                ],
                'className' => [
                    'default' => 'Lorem ipsum',
                    'type' => 'string'
                ]
            ]
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Block Categories
    |--------------------------------------------------------------------------
    |
    | Here you may specify block categories to be registered by Poet for use
    | in the editor.
    |
    */

    'categories' => [
        // 'cta' => [
        //     'title' => 'Call to Action',
        //     'icon' => 'star-filled',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Editor Palette
    |--------------------------------------------------------------------------
    |
    | Here you may specify the color palette registered in the Gutenberg
    | editor.
    |
    | A color palette can be passed as an array or by passing the filename of
    | a JSON file containing the palette.
    |
    | If a color is passed a value directly, the slug will automatically be
    | converted to Title Case and used as the color name.
    |
    | If the palette is explicitly set to `true` – Poet will attempt to
    | register the palette using the default `palette.json` filename generated
    | by <https://github.com/roots/palette-webpack-plugin>
    |
    */

    'palette' => [
        // 'red' => '#ff0000',
        // 'blue' => '#0000ff',
    ]
];
