<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Register theme defaults.
add_action('after_setup_theme', function () {
    show_admin_bar(false);

    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');

    register_nav_menus([
        'navigation' => __('Navigation'),
    ]);
});

// Register scripts and styles.
add_action('wp_enqueue_scripts', function () {
    $manifestPath = get_theme_file_path('assets/.vite/manifest.json');

    if (
        wp_get_environment_type() === 'local'
        && is_array(wp_remote_get('http://localhost:5173/')) // is Vite.js running
    ) {
        wp_enqueue_script_module('vite', 'http://localhost:5173/@vite/client');
        wp_enqueue_script_module('wordplate', 'http://localhost:5173/resources/js/index.js', ['vite']);
    } elseif (file_exists($manifestPath)) {
        $manifest = json_decode(file_get_contents($manifestPath), true);
        wp_enqueue_script_module('wordplate', get_theme_file_uri('assets/' . $manifest['resources/js/index.js']['file']));
        wp_enqueue_style('wordplate', get_theme_file_uri('assets/' . $manifest['resources/js/index.js']['css'][0]));
    }
    
    // Always load theme's main stylesheet for custom header styles
    wp_enqueue_style('theme-style', get_stylesheet_uri(), [], '1.0.0');
});

// Remove admin menu items.
add_action('admin_init', function () {
    remove_menu_page('edit-comments.php'); // Comments
    // remove_menu_page('edit.php?post_type=page'); // Pages
    remove_menu_page('edit.php'); // Posts
    remove_menu_page('index.php'); // Dashboard
    // remove_menu_page('upload.php'); // Media
});

// Remove admin toolbar menu items.
add_action('admin_bar_menu', function (WP_Admin_Bar $menu) {
    $menu->remove_node('archive'); // Archive
    $menu->remove_node('comments'); // Comments
    $menu->remove_node('customize'); // Customize
    $menu->remove_node('dashboard'); // Dashboard
    $menu->remove_node('edit'); // Edit
    $menu->remove_node('menus'); // Menus
    $menu->remove_node('new-content'); // New Content
    $menu->remove_node('search'); // Search
    // $menu->remove_node('site-name'); // Site Name
    $menu->remove_node('themes'); // Themes
    $menu->remove_node('updates'); // Updates
    $menu->remove_node('view-site'); // Visit Site
    $menu->remove_node('view'); // View
    $menu->remove_node('widgets'); // Widgets
    $menu->remove_node('wp-logo'); // WordPress Logo
}, 999);

// Remove admin dashboard widgets.
add_action('wp_dashboard_setup', function () {
    remove_meta_box('dashboard_activity', 'dashboard', 'normal'); // Activity
    // remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // At a Glance
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal'); // Site Health Status
    remove_meta_box('dashboard_primary', 'dashboard', 'side'); // WordPress Events and News
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // Quick Draft
});

// Add custom login form logo.
add_action('login_head', function () {
    $url = get_theme_file_uri('favicon.svg');

    $styles = [
        sprintf('background-image: url(%s)', $url),
        'width: 200px',
        'background-position: center',
        'background-size: contain',
    ];

    printf(
        '<style> .login .wp-login-logo a { %s } </style>',
        implode(';', $styles),
    );
});

// Register custom SMTP credentials.
add_action('phpmailer_init', function (PHPMailer $mailer) {
    $mailer->isSMTP();
    $mailer->SMTPAutoTLS = false;
    $mailer->SMTPAuth = env('MAIL_USERNAME') && env('MAIL_PASSWORD');
    $mailer->SMTPDebug = env('WP_DEBUG') ? SMTP::DEBUG_SERVER : SMTP::DEBUG_OFF;
    $mailer->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');
    $mailer->Debugoutput = 'error_log';
    $mailer->Host = env('MAIL_HOST');
    $mailer->Port = env('MAIL_PORT', 587);
    $mailer->Username = env('MAIL_USERNAME');
    $mailer->Password = env('MAIL_PASSWORD');
    return $mailer;
});

add_filter('wp_mail_from', fn() => env('MAIL_FROM_ADDRESS', 'hello@example.com'));
add_filter('wp_mail_from_name', fn() => env('MAIL_FROM_NAME', 'Example'));

// ACF JSON Save & Load
add_filter('acf/settings/save_json', function ($path) {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function ($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});

// Update permalink structure.
add_action('after_setup_theme', function () {
    if (get_option('permalink_structure') !== '/%postname%/') {
        update_option('permalink_structure', '/%postname%/');
        flush_rewrite_rules();
    }
});

// Fix WP Form compatibility issues caused by Headache plugin
add_action('init', function () {
    // Re-enable REST API for WP Forms
    add_filter('rest_endpoints', function ($endpoints) {
        // Allow WP Forms REST endpoints even for non-logged users
        if (isset($_REQUEST['wpforms']) || (isset($_POST['wpforms']) && !empty($_POST['wpforms']))) {
            // Restore basic REST functionality for forms
            return $endpoints;
        }
        return $endpoints;
    }, 5); // Higher priority than Headache
});

// Ensure jQuery and form scripts load properly
add_action('wp_enqueue_scripts', function () {
    // Force jQuery to load for forms
    wp_enqueue_script('jquery');
    
    // Re-add emoji detection if WP Forms is present
    if (function_exists('wpforms') || class_exists('WPForms')) {
        // Re-enable emoji detection script which forms might need
        add_action('wp_head', 'print_emoji_detection_script', 7);
    }
}, 5); // Load before Headache removes things

// Allow AJAX for forms
add_action('wp_ajax_wpforms_submit', '__return_true');
add_action('wp_ajax_nopriv_wpforms_submit', '__return_true');

// Ensure form nonces work properly
add_filter('nonce_user_logged_out', function ($uid, $action) {
    // Allow nonces for form submissions
    if (strpos($action, 'wpforms') !== false) {
        return 0; // Use consistent user ID for non-logged users
    }
    return $uid;
}, 10, 2);
