jQuery(document).ready(function() {
  if (!jQuery('#esfi_settings').length) return;

  var $esfiWidth = jQuery('#esfi_width');
  var $esfiHeight = jQuery('#esfi_height');
  var $esfiFeatured = jQuery('#esfi_featured');
  var $esfiKeywords = jQuery('#esfi_keywords');
  var $esfiSourceUrl = jQuery('#esfi_source_url');
  var $esfiSourceSetting = jQuery('input[name="esfi_image_source"]');
  var baseUrl = esfiSettingsParams.base_source_url;

  esfiInitialize();
  $esfiWidth.keyup(esfiInitialize);
  $esfiHeight.keyup(esfiInitialize);
  $esfiFeatured.change(esfiInitialize);
  $esfiKeywords.keyup(esfiInitialize);
  $esfiSourceSetting.change(esfiInitialize);



  function esfiInitialize() {
    var esfiRandomSource = esfiSetRandomSource();
    var esfiSettingsSource = esfiSetSettingsSource();
    var esfiSourceSetting =
      jQuery('input[name="esfi_image_source"]:checked').val();

    esfiSourceSetting === 'esfi_settings' ?
      $esfiSourceUrl.val(esfiSettingsSource) :
      $esfiSourceUrl.val(esfiRandomSource);
  }

  function esfiSetRandomSource() {
    var esfiRandomSource = baseUrl + 'random/' + esfiGetDimensions();

    jQuery('.esfi_random_source').text(esfiRandomSource);

    return esfiRandomSource;
  }

  function esfiSetSettingsSource() {
    var esfiSettingsSource = baseUrl;
    if ($esfiFeatured.is(':checked')) esfiSettingsSource += 'featured/';
    esfiSettingsSource += esfiGetDimensions();
    if ($esfiKeywords.val()) esfiSettingsSource += '?' + $esfiKeywords.val();

    jQuery('.esfi_settings_source').text(esfiSettingsSource);

    return esfiSettingsSource;
  }

  function esfiGetDimensions() {
    return $esfiWidth.val() + 'x' + $esfiHeight.val();
  }
});
