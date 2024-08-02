<?php
/**
 * Deciders functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Deciders
 */

if ( ! defined( 'DS_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'DS_VERSION', '1.0.2' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ds_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Deciders, use a find and replace
		* to change 'ds' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'ds', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'ds' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'ds_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

    add_theme_support('custom-spacing');
    add_theme_support('custom-line-height');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'ds_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ds_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ds_content_width', 640 );
}
add_action( 'after_setup_theme', 'ds_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ds_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'ds' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ds' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'ds_widgets_init' );

/**
 * Get ajax url
 *
 * @return string
 */
function ds_get_ajax_url(): string
{
    return get_template_directory_uri() . '/front-ajaxs.php';
}

/**
 * Enqueue scripts and styles.
 */
function ds_scripts() {
    $ajax_url = ds_get_ajax_url();

    $options = [
        'ajax_url' => $ajax_url,
        'home_url' => get_home_url(),
    ];

    wp_dequeue_style('select2');
    wp_dequeue_script('select2');
    wp_deregister_script('select2');
//    wp_dequeue_script('jquery');
//    wp_deregister_script('jquery');

    wp_enqueue_script('masonry');
    wp_enqueue_script('imagesloaded');

	wp_enqueue_style( 'ds-style', get_stylesheet_uri(), array(), DS_VERSION );
    wp_enqueue_style('main-style', get_template_directory_uri() . '/dist/css/style.min.css', [], DS_VERSION);
    wp_enqueue_style('fonts-style', get_template_directory_uri() . '/fonts/ds-fonts.css', [], DS_VERSION);



    if (is_archive()) {
        wp_enqueue_script(
            'archive-script',
            get_template_directory_uri() . '/dist/js/archive.min.js',
            [
                'jquery',
                'masonry',
                'imagesloaded'
            ],
            DS_VERSION,
            true
        );

        wp_localize_script('archive-script', 'options', $options);
    } else {
        wp_enqueue_script(
            'main-script',
            get_template_directory_uri() . '/dist/js/app.min.js',
            [
                'jquery',
                'masonry',
                'imagesloaded'
            ],
            DS_VERSION,
            true
        );

        wp_localize_script('main-script', 'options', $options);
    }
}
add_action( 'wp_enqueue_scripts', 'ds_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_action('init', 'ds_service_create_post_type');
add_action('init', 'ds_case_create_post_type');
require get_template_directory() . '/inc/custom-post-type.php';

require get_template_directory() . '/inc/case-service-relationship.php';
require get_template_directory() . '/inc/service-icon-metabox.php';
require get_template_directory() . '/inc/case-gallery-admin/index.php';

require get_template_directory() . '/inc/theme-admin-settings/index.php';

/**
 * @param array $options
 * $options['args'] | array - arguments for query
 * $options['exclude_posts'] | array - posts to exclude
 * @return array
 */
function ds_get_unified_post_types_array(array $options = array()): array
{
    $is_exclude_posts = isset($options['exclude_posts']);
    $defaults = array(
        'post_count' => -1,
        'case_count' => -1,
        'service_count' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'service_id' => null
    );

    $args = wp_parse_args($options['args'], $defaults);

    $unified_array = array();

    if (!$is_exclude_posts || !in_array('post', $options['exclude_posts'])) {
        $posts = get_posts(array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $args['post_count'],
            'orderby' => $args['orderby'],
            'order' => $args['order']
        ));

        // Get posts
        foreach ($posts as $post) {
            $unified_array[] = array(
                'id' => $post->ID,
                'title' => $post->post_title,
                'type' => 'post',
                'permalink' => get_permalink($post->ID),
                'excerpt' => get_the_excerpt($post),
//            'date' => $post->post_date,
            );
        }
    }

    if (!$is_exclude_posts || !in_array('case', $options['exclude_posts'])) {
        // Get cases
        $case_args = array(
            'post_type' => 'case',
            'post_status' => 'publish',
            'posts_per_page' => $args['case_count'],
            'orderby' => $args['orderby'],
            'order' => $args['order']
        );

        // If a service ID is provided, add a meta query to filter cases
        if ($args['service_id']) {
            $case_args['meta_query'] = array(
                array(
                    'key' => '_associated_service',
                    'value' => $args['service_id'],
                    'compare' => '='
                )
            );
        }

        $cases = get_posts($case_args);

        foreach ($cases as $case) {
//        $associated_service = get_post_meta($case->ID, '_associated_service', true);
            $unified_array[] = array(
                'id' => $case->ID,
                'title' => $case->post_title,
                'type' => 'case',
                'permalink' => get_permalink($case->ID),
                'excerpt' => get_the_excerpt($case),
//            'date' => $case->post_date,
//            'associated_service' => $associated_service ? get_the_title($associated_service) : '',
            );
        }
    }

    if (!$is_exclude_posts || !in_array('service', $options['exclude_posts'])) {
        $services = get_posts(array(
            'post_type' => 'service',
            'post_status' => 'publish',
            'posts_per_page' => $args['service_count'],
            'orderby' => $args['orderby'],
            'order' => $args['order']
        ));

        foreach ($services as $service) {
            $icon_id = get_post_meta($service->ID, '_service_icon_id', true);
            $unified_array[] = array(
                'id' => $service->ID,
                'title' => $service->post_title,
                'type' => 'service',
                'excerpt' => get_the_excerpt($service),
                'permalink' => get_permalink($service->ID),
                'icon_url' => $icon_id ? wp_get_attachment_image_url($icon_id, 'thumbnail') : '',
//            'date' => $service->post_date,
            );
        }
    }

    if ($args['orderby'] === 'date') {
        usort($unified_array, function ($a, $b) use ($args) {
            $order = ($args['order'] === 'DESC') ? -1 : 1;
            return $order * (strtotime($b['date']) - strtotime($a['date']));
        });
    }

    if ($is_exclude_posts && in_array('service', $options['exclude_posts'])) {
        return $unified_array;
    }

    // Separate services from other content
    $services = array_values(array_filter($unified_array, function ($item) {
        return $item['type'] === 'service';
    }));
    $other_content = array_values(array_filter($unified_array, function ($item) {
        return $item['type'] !== 'service';
    }));

    // Reorder the array to place services every 3 items, starting from the 4th position
    $result = array();
    $service_index = 0;
    $other_index = 0;

    for ($i = 0; $i < count($unified_array); $i++) {
        if ($i > 3 && ($i + 1) % 3 === 1 && $service_index < count($services)) {
            $result[] = $services[$service_index];
            $service_index++;
        } elseif ($other_index < count($other_content)) {
            $result[] = $other_content[$other_index];
            $other_index++;
        } elseif ($service_index < count($services)) {
            $result[] = $services[$service_index];
            $service_index++;
        }
    }

    return $result;
}

add_action('wp_ajax_ds_filter_cases_handler', 'ds_filter_cases_handler');
add_action('wp_ajax_nopriv_ds_filter_cases_handler', 'ds_filter_cases_handler');

function ds_filter_cases_handler(): void
{
    $service_id = isset($_POST['service_id']) ? sanitize_text_field($_POST['service_id']) : 'all';
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args = array(
        'post_type' => 'case',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'paged' => $page,
    );

    if ($service_id !== 'all') {
        $args['meta_query'] = array(
            array(
                'key' => '_associated_service',
                'value' => $service_id,
            ),
        );
    }

    $cases_query = new WP_Query($args);
    $cases = $cases_query->posts;

    $response = array();

    foreach ($cases as $case) {
        $thumbnail_id = get_post_thumbnail_id($case->ID);
        $thumbnail_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'large') : '';

        $response[] = array(
            'title' => $case->post_title,
            'id' => $case->ID,
            'permalink' => get_permalink($case->ID),
            'thumbnail_url' => $thumbnail_url,
        );
    }

    wp_send_json(array(
        'cases' => $response,
        'has_more' => $cases_query->max_num_pages > $page,
    ));
}
