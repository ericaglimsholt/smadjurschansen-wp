<?php

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;

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
// add_action('phpmailer_init', function (PHPMailer $mailer) {
//     $mailer->isSMTP();
//     $mailer->SMTPAutoTLS = false;
//     $mailer->SMTPAuth = env('MAIL_USERNAME') && env('MAIL_PASSWORD');
//     $mailer->SMTPDebug = env('WP_DEBUG') ? SMTP::DEBUG_SERVER : SMTP::DEBUG_OFF;
//     $mailer->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');
//     $mailer->Debugoutput = 'error_log';
//     $mailer->Host = env('MAIL_HOST');
//     $mailer->Port = env('MAIL_PORT', 587);
//     $mailer->Username = env('MAIL_USERNAME');
//     $mailer->Password = env('MAIL_PASSWORD');
//     return $mailer;
// });

add_filter('wp_mail_from', fn() => 'info@smadjurschansen.se');
add_filter('wp_mail_from_name', fn() => 'Smådjurschansen');

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

// Send form data from adoption interest form
function send_adoption_form() {
	check_ajax_referer('send_adoption_form', 'security');
    
    // Get fields with fallback sanitization
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $address = isset($_POST['address']) ? sanitize_text_field($_POST['address']) : '';
    $postnumber = isset($_POST['postnumber']) ? sanitize_text_field($_POST['postnumber']) : '';
    $city = isset($_POST['city']) ? sanitize_text_field($_POST['city']) : '';
    $animal_name = isset($_POST['animal_name']) ? sanitize_text_field($_POST['animal_name']) : '';
    
    // Use sanitize_text_field as fallback for older WordPress versions
    $animal_bunny_friend = isset($_POST['animal_bunny_friend']) ? sanitize_text_field($_POST['animal_bunny_friend']) : '';
    
    // For text areas, use custom sanitization if sanitize_textarea_field doesn't exist
    $family_situation = isset($_POST['family_situation']) ? strip_tags($_POST['family_situation']) : '';
    $animal_situation = isset($_POST['animal_situation']) ? strip_tags($_POST['animal_situation']) : '';
    $animal_assemble = isset($_POST['animal_assemble']) ? strip_tags($_POST['animal_assemble']) : '';
    $animal_food = isset($_POST['animal_food']) ? strip_tags($_POST['animal_food']) : '';
    $animal_qualities = isset($_POST['animal_qualities']) ? strip_tags($_POST['animal_qualities']) : '';
    $animal_living = isset($_POST['animal_living']) ? strip_tags($_POST['animal_living']) : '';
    $animal_semester = isset($_POST['animal_semester']) ? strip_tags($_POST['animal_semester']) : '';
    $animal_insurence = isset($_POST['animal_insurence']) ? strip_tags($_POST['animal_insurence']) : '';

    // Validate required fields
    if (!$name || !$email || !$phone || !$address || !$postnumber || !$city || 
        !$animal_name || !$family_situation || !$animal_situation || !$animal_assemble ||
        !$animal_food || !$animal_qualities || !$animal_living || !$animal_semester || !$animal_insurence) {
        wp_send_json_error(array(
            'message' => 'Alla obligatoriska fält måste fyllas i'
        ));
        return;
    }

    if (!is_email($email)) {
        wp_send_json_error(array(
            'message' => 'Ogiltig e-postadress'
        ));
        return;
    }

    // Create email content
    $to = 'erica@ericaglimsholt.com';
    $subject = 'Ny intresseanmälan - ' . $animal_name . ' - ' . $name . ' (' . $email . ')';
    
    $message = "Ny intresseanmälan för adoption har skickats från hemsidan.\n\n";
    $message .= "KONTAKTUPPGIFTER:\n";
    $message .= "Namn: {$name}\n";
    $message .= "E-post: {$email}\n";
    $message .= "Telefon: {$phone}\n";
    $message .= "Adress: {$address}\n";
    $message .= "Postnummer: {$postnumber}\n";
    $message .= "Ort: {$city}\n\n";
    
    $message .= "ADOPTIONSDETALJER:\n";
    $message .= "Djur av intresse: {$animal_name}\n\n";
    
    $message .= "Familjesituation: {$family_situation}\n\n";
    $message .= "Nuvarande djur: {$animal_situation}\n\n";
    $message .= "Ihopsättning: {$animal_assemble}\n\n";
    
    if ($animal_bunny_friend) {
        $message .= "Framtida artfrände: {$animal_bunny_friend}\n\n";
    }
    
    $message .= "Djurets kost: {$animal_food}\n\n";
    $message .= "Önskade egenskaper: {$animal_qualities}\n\n";
    $message .= "Djurets boende: {$animal_living}\n\n";
    $message .= "Semester/krissituation: {$animal_semester}\n\n";
    $message .= "Försäkring: {$animal_insurence}\n\n";

    // Set email headers
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $email . '>'
    );

    // Send email
    $mail_sent = wp_mail($to, $subject, $message, $headers);

    if ($mail_sent) {
        wp_send_json_success(array(
            'message' => 'Intresseanmälan skickad!'
        ));
    } else {
        wp_send_json_error(array(
            'message' => 'E-post kunde inte skickas. Försök igen senare.'
        ));
    }
}

add_action('wp_ajax_send_adoption_form', 'send_adoption_form');
add_action('wp_ajax_nopriv_send_adoption_form', 'send_adoption_form');