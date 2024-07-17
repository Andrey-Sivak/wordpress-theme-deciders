<?php
/**
 * Create custom post types functions
 *
 * @package ds
 */

function ds_service_create_post_type() {
    $labels = [
        'name'               => 'Услуги',
        'singular_name'      => 'Услуга',
        'add_new'            => 'Добавить услугу',
        'add_new_item'       => 'Добавить новую услугу',
        'edit_item'          => 'Редактировать услугу',
        'new_item'           => 'Новая услуга',
        'view_item'          => 'Смотреть услугу',
        'search_items'       => 'Искать услугу',
        'not_found'          => 'Услуг не найдено',
        'not_found_in_trash' => 'Не найдено услуг в корзине',
        'parent_item_colon'  => '',
        'menu_name'          => 'Услуги',
    ];
    $args   = [
        'labels'        => $labels,
        'has_archive'   => false,
        'public'        => true,
        'hierarchical'  => true,
        'menu_position' => 5,
        'menu_icon'     => 'dashicons-clipboard',
        'show_in_rest'  => true,
        'show_in_nav_menus' => true,
        'supports'      => [
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

function ds_case_create_post_type() {
    $labels = [
        'name'               => 'case',
        'singular_name'      => 'Кейс',
        'add_new'            => 'Добавить кейс',
        'add_new_item'       => 'Добавить новый кейс',
        'edit_item'          => 'Редактировать кейс',
        'new_item'           => 'Новый кейс',
        'view_item'          => 'Смотреть кейс',
        'search_items'       => 'Искать кейс',
        'not_found'          => 'Кейсов не найдено',
        'not_found_in_trash' => 'Не найдено кейсов в корзине',
        'parent_item_colon'  => 'dashicons-book-alt',
        'menu_name'          => 'Кейсы',
    ];
    $args   = [
        'labels'        => $labels,
        'has_archive'   => false,
        'public'        => true,
        'hierarchical'  => true,
        'menu_position' => 6,
        'menu_icon'   => 'dashicons-editor-code',
        'show_in_rest'  => true,
        'show_in_nav_menus' => true,
        'supports'      => [
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
    register_post_type( 'case', $args );
}