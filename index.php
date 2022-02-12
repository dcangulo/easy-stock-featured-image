<?php
/*
  Plugin Name: Easy Stock Featured Image
  Plugin URI: https://github.com/dcangulo/easy-stock-featured-image
  Description: Automatically attach stock photos as featured image to your posts without featured image.
  Version: 1.0.0
  Author: David Angulo
  Author URI: https://www.davidangulo.xyz/
  Requires at least: 5.4
  Tested Up to: 5.9.0
  License: GPL2
*/

/*
  Copyright © 2022 David Angulo (email: hello@davidangulo.xyz)
  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
*/

require_once(ABSPATH . 'wp-admin/includes/image.php');
require_once('constants.php');
require_once('classes/easy_stock_featured_image.php');

$easy_stock_feature_image = new EasyStockFeaturedImage;
