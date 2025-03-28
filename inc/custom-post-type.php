<?php
/**
 * Create custom post types functions
 *
 * @package ds
 */

function ds_service_create_post_type()
{
    $labels = [
        'name' => 'Services',
        'singular_name' => 'Service',
        'add_new' => 'Add Service',
        'add_new_item' => 'Add New Service',
        'edit_item' => 'Edit Service',
        'new_item' => 'New Service',
        'view_item' => 'View Service',
        'search_items' => 'Search Service',
        'not_found' => 'No Services Found',
        'not_found_in_trash' => 'No Services Found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Services',
    ];
    $args = [
        'labels' => $labels,
        'has_archive' => false,
        'public' => true,
        'hierarchical' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-clipboard',
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
        'supports' => [
            'title',
            'editor',
            'excerpt',
            'custom-fields',
            'thumbnail',
            'page-attributes',
        ],
    ];
    register_post_type('service', $args);
}

function ds_case_create_post_type()
{
    $labels = [
        'name' => 'Cases',
        'singular_name' => 'Case',
        'add_new' => 'Add Case',
        'add_new_item' => 'Add New Case',
        'edit_item' => 'Edit Case',
        'new_item' => 'New Case',
        'view_item' => 'View Case',
        'search_items' => 'Search Case',
        'not_found' => 'No Cases Found',
        'not_found_in_trash' => 'No Cases Found in Trash',
        'parent_item_colon' => 'dashicons-book-alt',
        'menu_name' => 'Cases',
    ];
    $args = [
        'labels' => $labels,
        'has_archive' => true,
        'public' => true,
        'hierarchical' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-editor-code',
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
        'supports' => [
            'title',
            'editor',
            'excerpt',
            'custom-fields',
            'thumbnail',
            'page-attributes',
            'custom-fields',
            'comments',
        ],
    ];
    register_post_type('case', $args);
}