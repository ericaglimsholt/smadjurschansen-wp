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

// Register custom SMTP credentials with fallback for forms.
add_action('phpmailer_init', function (PHPMailer $mailer) {
    // Check if this is a form submission - use simpler mail method
    if (isset($_POST['wpforms']) || isset($_GET['wpforms']) || 
        (isset($_POST['action']) && strpos($_POST['action'], 'form') !== false)) {
        
        // Use PHP's built-in mail() function for forms
        $mailer->isMail();
        $mailer->CharSet = 'UTF-8';
        return $mailer;
    }
    
    // Only use SMTP if we have proper credentials
    if (env('MAIL_HOST') && env('MAIL_USERNAME') && env('MAIL_PASSWORD')) {
        $mailer->isSMTP();
        $mailer->SMTPAutoTLS = false;
        $mailer->SMTPAuth = true;
        $mailer->SMTPDebug = env('WP_DEBUG') ? SMTP::DEBUG_SERVER : SMTP::DEBUG_OFF;
        $mailer->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');
        $mailer->Debugoutput = 'error_log';
        $mailer->Host = env('MAIL_HOST');
        $mailer->Port = env('MAIL_PORT', 587);
        $mailer->Username = env('MAIL_USERNAME');
        $mailer->Password = env('MAIL_PASSWORD');
    } else {
        // Fallback to PHP mail if no SMTP credentials
        $mailer->isMail();
        $mailer->CharSet = 'UTF-8';
    }
    
    return $mailer;
});

add_filter('wp_mail_from', fn() => env('MAIL_FROM_ADDRESS', get_option('admin_email', 'noreply@' . $_SERVER['HTTP_HOST'])));
add_filter('wp_mail_from_name', fn() => env('MAIL_FROM_NAME', get_bloginfo('name')));

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

// Ensure WP Form and similar plugins work correctly
add_action('init', function () {
    // Force jQuery to load early for form functionality
    if (is_admin() || (isset($_POST['wpforms']) || isset($_GET['wpforms']))) {
        wp_enqueue_script('jquery');
    }
}, 1);

// Ensure scripts load properly for forms
add_action('wp_enqueue_scripts', function () {
    // Ensure jQuery is available
    wp_enqueue_script('jquery');
    
    // Allow form-related scripts to load without interference
    if (isset($_POST['wpforms']) || isset($_GET['wpforms']) || 
        (is_page() || is_single()) || is_front_page()) {
        
        // Re-enable any scripts that might be needed for forms
        if (!wp_script_is('wp-util', 'enqueued')) {
            wp_enqueue_script('wp-util');
        }
        
        // Ensure WP Forms scripts can load
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    }
}, 1);

// Ensure AJAX functionality works for forms
add_action('wp_ajax_wpforms_submit', '__return_true');
add_action('wp_ajax_nopriv_wpforms_submit', '__return_true');

// Add specific AJAX handlers for WP Forms
add_action('wp_ajax_wpforms_submit', 'wpforms_process_ajax');
add_action('wp_ajax_nopriv_wpforms_submit', 'wpforms_process_ajax');

function wpforms_process_ajax() {
    // Let WP Forms handle its own AJAX if the plugin exists
    if (function_exists('wpforms')) {
        return;
    }
    
    // Basic fallback - log the attempt
    if (defined('WP_DEBUG') && WP_DEBUG && defined('WP_DEBUG_LOG') && WP_DEBUG_LOG) {
        error_log('WP Forms AJAX called but plugin not detected');
        error_log('POST data: ' . print_r($_POST, true));
    }
    
    wp_die();
}

// Fix potential nonce issues with forms
add_filter('wp_nonce_tick', function($nonce_life) {
    // Extend nonce life for form submissions
    if (isset($_POST['wpforms']) || isset($_GET['wpforms'])) {
        return HOUR_IN_SECONDS * 12; // 12 hours
    }
    return $nonce_life;
});

// Fix wp_mail issues for forms
add_filter('wp_mail', function($args) {
    // Ensure proper headers for form emails
    if (isset($_POST['wpforms']) || isset($_GET['wpforms'])) {
        if (!isset($args['headers']) || !is_array($args['headers'])) {
            $args['headers'] = [];
        }
        
        // Add content type if not set
        $has_content_type = false;
        foreach ($args['headers'] as $header) {
            if (stripos($header, 'content-type') !== false) {
                $has_content_type = true;
                break;
            }
        }
        
        if (!$has_content_type) {
            $args['headers'][] = 'Content-Type: text/html; charset=UTF-8';
        }
    }
    
    return $args;
});

// Debug mail issues
add_action('wp_mail_failed', function($wp_error) {
    if (defined('WP_DEBUG') && WP_DEBUG && defined('WP_DEBUG_LOG') && WP_DEBUG_LOG) {
        error_log('Mail failed: ' . $wp_error->get_error_message());
    }
});

// Test email function - can be called to debug email issues
function test_wp_mail() {
    $to = get_option('admin_email');
    $subject = 'Test Email from ' . get_bloginfo('name');
    $message = 'This is a test email to verify email functionality.';
    
    $result = wp_mail($to, $subject, $message);
    
    if ($result) {
        error_log('Test email sent successfully to: ' . $to);
    } else {
        error_log('Test email failed to send to: ' . $to);
    }
    
    return $result;
}

// Add this to wp-admin for debugging
add_action('wp_ajax_test_mail', function() {
    $result = test_wp_mail();
    wp_die($result ? 'Email sent successfully!' : 'Email failed to send!');
});

// Ensure all form-related functionality works
add_action('wp_loaded', function() {
    // Remove any potential conflicts from Headache plugin for forms
    if (isset($_POST['wpforms']) || isset($_GET['wpforms']) || 
        (isset($_POST['action']) && strpos($_POST['action'], 'form') !== false) ||
        (defined('DOING_AJAX') && DOING_AJAX)) {
        
        // Ensure WordPress core functions are available
        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
        
        if (!function_exists('wp_verify_nonce')) {
            require_once(ABSPATH . WPINC . '/pluggable.php');
        }
        
        // Ensure AJAX URL is available
        if (!wp_script_is('wp-util', 'enqueued')) {
            wp_enqueue_script('wp-util');
        }
    }
});

// Make sure admin-ajax.php works properly
add_action('wp_head', function() {
    if (is_front_page() || is_page() || is_single()) {
        ?>
        <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        </script>
        <?php
    }
});
