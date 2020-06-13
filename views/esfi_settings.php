<div class='wrap'>
  <h1>Easy Stock Featured Image Settings</h1>

  <form id='esfi_settings' method='post' action='options.php'>
    <?php settings_fields('esfi_plugin_settings'); ?>
    <input type='hidden' name='esfi_source_url' id='esfi_source_url' value='<?php echo get_option('esfi_source_url'); ?>'>

    <table class='form-table'>
      <tr>
        <th><label for='esfi_width'>Width</label></th>
        <td>
          <?php $esfi_width = get_option('esfi_width') ?: ESFI_WIDTH ?>
          <input name='esfi_width' type='number' step='1' min='1' id='esfi_width' value='<?php echo $esfi_width; ?>' class='regular-text'>
        </td>
      </tr>

      <tr>
        <th><label for='esfi_height'>Height</label></th>
        <td>
          <?php $esfi_height = get_option('esfi_height') ?: ESFI_HEIGHT ?>
          <input name='esfi_height' type='number' step='1' min='1' id='esfi_height' value='<?php echo $esfi_height; ?>' class='regular-text'>
        </td>
      </tr>

      <tr>
        <th><label for='esfi_featured'>Featured</label></th>
        <td>
          <label for='esfi_featured'>
            <?php $esfi_featured = get_option('esfi_featured') === 'esfi_featured' ? 'checked="checked"' : ''; ?>
            <input name='esfi_featured' type='checkbox' id='esfi_featured' value='esfi_featured' <?php echo $esfi_featured; ?>> Use only featured photos
          </label>
          <p class='description'>If you'd like to limit the results to only those photos included in our curated collections, simply select this checkbox.</p>
        </td>
      </tr>

      <tr>
        <th><label for='esfi_keywords'>Keywords</label></th>
        <td>
          <input name='esfi_keywords' type='text' id='esfi_keywords' value='<?php echo get_option('esfi_keywords'); ?>' class='regular-text'>
          <p class='description'>You can narrow the selection of a random photo even further by supplying a list of comma-separated search terms.</p>
          <p class='description'>Eg. <code>nature,water</code></p>
        </td>
      </tr>

      <tr>
        <th>Image Source</th>
        <td>
          <?php
            $esfi_random = get_option('esfi_image_source') === 'esfi_random' ? 'checked=""' : '';
            $esfi_settings = get_option('esfi_image_source') === 'esfi_settings' ? 'checked=""' : '';
          ?>
          <label>
            <input type='radio' name='esfi_image_source' value='esfi_random' <?php echo $esfi_random; ?>>Use completely random photos
          </label>
          <p class='description'>This will use the endpoint: <code class='esfi_random_source'></code></p>
          <br>
          <label>
            <input type='radio' name='esfi_image_source' value='esfi_settings' <?php echo $esfi_settings; ?>> Use filtered photos using the settings above
          </label>
          <p class='description'>This will use the endpoint: <code class='esfi_settings_source'></code></p>
        </td>
      </tr>

      <tr>
        <th><label for='esfi_active'>Activate this Plugin</label></th>
        <td>
          <label for='esfi_active'>
            <?php $esfi_active = get_option('esfi_active') === 'esfi_active' ? 'checked=""' : ''; ?>
            <input name='esfi_active' type='checkbox' id='esfi_active' value='esfi_active' <?php echo $esfi_active; ?>> Use this plugin now
          </label>
          <p class='description'>By selecting this checkbox, once someone viewed your post, it will automatically add featured photos on posts that doesn't have one based on the settings above.</p>
          <p class='description'><strong>Once this plugin adds featured images, it cannot be undone. Use it carefully.</strong></p>
        </td>
      </tr>
    </table>

    <p>
      <strong>For more info:</strong>
      <a href='https://source.unsplash.com/' target='_blank'>https://source.unsplash.com/</a>
    </p>

    <?php submit_button(); ?>
  </form>
</div>
