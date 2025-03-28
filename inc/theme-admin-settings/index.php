<?php
function ds_theme_settings_page(): void
{
    add_menu_page(
        'Theme Settings',
        'Theme Settings',
        'manage_options',
        'theme-settings',
        'ds_theme_settings_page_content',
        'dashicons-admin-generic',
        60
    );
}

add_action('admin_menu', 'ds_theme_settings_page');

function ds_theme_settings_page_content(): void
{
    ?>
    <div class="wrap">
        <h1>Theme Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('theme_settings');
            do_settings_sections('theme-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function ds_theme_register_settings(): void
{
    register_setting('theme_settings', 'theme_settings');

    add_settings_section(
        'theme_general_section',
        '',
        'ds_theme_general_section_callback',
        'theme-settings'
    );

    add_settings_field(
        'logo',
        'Logo',
        'ds_theme_logo_callback',
        'theme-settings',
        'theme_general_section'
    );

    add_settings_field(
        'about_text',
        'About Agency',
        'ds_theme_about_text_callback',
        'theme-settings',
        'theme_general_section'
    );

    add_settings_field(
        'default_post_title_icon',
        'Default icon for headings',
        'ds_theme_default_post_title_icon',
        'theme-settings',
        'theme_general_section'
    );

    add_settings_field(
        'home_menu_icon',
        'Home page icon in the menu',
        'ds_theme_home_menu_icon',
        'theme-settings',
        'theme_general_section'
    );

    add_settings_section(
        'theme_contact_section',
        'Contact data',
        'theme_contact_section_callback',
        'theme-settings'
    );

    add_settings_field(
        'schedule',
        'Schedule',
        'theme_schedule_callback',
        'theme-settings',
        'theme_contact_section'
    );

    add_settings_field(
        'phone',
        'Phone',
        'theme_phone_callback',
        'theme-settings',
        'theme_contact_section'
    );

    add_settings_field(
        'email',
        'Email',
        'theme_email_callback',
        'theme-settings',
        'theme_contact_section'
    );

    add_settings_field(
        'short_text',
        'Short text at the bottom of the contacts section',
        'theme_short_text_callback',
        'theme-settings',
        'theme_contact_section'
    );

    add_settings_field(
        'social_links',
        'Socials',
        'theme_social_links_callback',
        'theme-settings',
        'theme_contact_section'
    );
}

add_action('admin_init', 'ds_theme_register_settings');

// Enqueue media uploader script
function ds_theme_settings_enqueue_scripts($hook): void
{
    if ('toplevel_page_theme-settings' !== $hook) {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script('theme-settings-upload-logo', get_template_directory_uri() . '/inc/theme-admin-settings/js/upload-logo.js', array('jquery'), '1.0', true);
    wp_enqueue_script('theme-settings-upload-default-title-icon', get_template_directory_uri() . '/inc/theme-admin-settings/js/upload-default-title-icon.js', array('jquery'), '1.0', true);
    wp_enqueue_script('theme-settings-home-menu-icon', get_template_directory_uri() . '/inc/theme-admin-settings/js/upload-home-menu-icon.js', array('jquery'), '1.0', true);
    wp_enqueue_script('theme-settings-social-links', get_template_directory_uri() . '/inc/theme-admin-settings/js/social-links.js', array('jquery'), '1.0', true);
}

add_action('admin_enqueue_scripts', 'ds_theme_settings_enqueue_scripts');

require get_template_directory() . '/inc/theme-admin-settings/callbacks/general-settings.php';
require get_template_directory() . '/inc/theme-admin-settings/callbacks/theme-logo.php';
require get_template_directory() . '/inc/theme-admin-settings/callbacks/about-text.php';
require get_template_directory() . '/inc/theme-admin-settings/callbacks/default-title-icon.php';
require get_template_directory() . '/inc/theme-admin-settings/callbacks/contact-settings.php';
require get_template_directory() . '/inc/theme-admin-settings/callbacks/schedule.php';
require get_template_directory() . '/inc/theme-admin-settings/callbacks/phone.php';
require get_template_directory() . '/inc/theme-admin-settings/callbacks/email.php';
require get_template_directory() . '/inc/theme-admin-settings/callbacks/contact-short-text.php';
require get_template_directory() . '/inc/theme-admin-settings/callbacks/social-links.php';
require get_template_directory() . '/inc/theme-admin-settings/callbacks/home-menu-icon.php';
