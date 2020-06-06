<?php
class EasyStockFeaturedImage {
  public function __construct() {
    if (function_exists('add_theme_support')) {
      add_theme_support('post-thumbnails');
      add_action('new_to_publish', [$this, 'esfi_attach_featured_image']);
      add_action('draft_to_publish', [$this, 'esfi_attach_featured_image']);
      add_action('pending_to_publish', [$this, 'esfi_attach_featured_image']);
      add_action('future_to_publish', [$this, 'esfi_attach_featured_image']);
      add_action('the_post', [$this, 'esfi_attach_featured_image']);
    }

    add_action('admin_notices', [$this, 'esfi_admin_notice']);
    add_action('admin_menu', [$this, 'esfi_settings_page']);
    add_action('admin_init', [$this, 'esfi_settings']);
    add_action('admin_enqueue_scripts', [$this, 'esfi_admin_scripts']);
  }

  public function esfi_attach_featured_image($post) {
    if (get_option('esfi_active') !== 'esfi_active') return;
    if (has_post_thumbnail()) return;

    $esfi_source_url = get_option('esfi_source_url');
    $param_bridge = strpos($esfi_source_url, '?') ? '&' : '?';
    $image_source_url = $esfi_source_url . $param_bridge . 'sig=' . $post->ID;
    $image_data = file_get_contents($image_source_url);
    $file_info = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $file_info->buffer($image_data);
    $upload_dir = wp_upload_dir();
    $upload_path =
      wp_mkdir_p($upload_dir['path']) ?
        $upload_dir['path'] : $upload_dir['basedir'];
    $filename = time() . '-' . uniqid();
    $file_location = $upload_path . '/' . $filename;

    file_put_contents($file_location, $image_data);

    $attachment = [
      'post_mime_type' => $mime_type,
      'post_title' => '',
      'post_content' => '',
      'post_status' => 'inherit'
    ];

    $attachment_id = wp_insert_attachment($attachment, $file_location);
    $attachment_data =
      wp_generate_attachment_metadata($attachment_id, $file_location);

    wp_update_attachment_metadata($attachment_id, $attachment_data);
    add_post_meta($post->ID, '_thumbnail_id', $attachment_id, true);
  }

  public function esfi_admin_notice() {
    if (get_option('esfi_active') === 'esfi_active') return;

    include(ESFI_ROOT_PATH . 'views/esfi_notice.php');
  }

  public function esfi_settings_page() {
    add_options_page(
      'Easy Stock Featured Image', 'Easy Stock Featured Image',
      'manage_options', 'esfi_plugin_settings',
      [$this, 'esfi_option_page_content']
    );
  }

  public function esfi_option_page_content() {
    include(ESFI_ROOT_PATH . 'views/esfi_settings.php');
  }

  public function esfi_settings() {
    $settings = [
      'width', 'height', 'featured', 'keywords', 'image_source', 'active',
      'source_url'
    ];

    foreach ($settings as $setting) {
      register_setting('esfi_plugin_settings', 'esfi_' . $setting);
    }
  }

  public function esfi_admin_scripts() {
    $esfiSettingFileUrl = ESFI_ROOT_URL . 'scripts/esfi-settings.js';

    wp_register_script('esfi-settings', $esfiSettingFileUrl);
    wp_enqueue_script('esfi-settings');
    wp_localize_script('esfi-settings', 'esfiSettingsParams', [
      'base_source_url' => ESFI_BASE_SOURCE_URL
    ]);
  }
}
