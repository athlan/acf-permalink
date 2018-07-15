<?php
/**
 * Register hooks in WordPress
 *
 * @package WordPress_ACF_Permalink
 */

function wpcfp_acf_support( $post_meta = null, $post = null ) {
  foreach ($post_meta as $key => $values) {
    if ($key[0] == "_") {
      continue;
    }
    
    $new_values = [];
    foreach ($values as $value_key => $value) {
      $value = maybe_unserialize($value);
      
      if (is_array($value)) {
        $value = join('-', $value);
      }
      
      $new_values[$value_key] = $value;
    }
    
    $post_meta[$key] = $new_values;
  }

  return $post_meta;
}

add_filter( 'wpcfp_get_post_metadata', 'wpcfp_acf_support', 1, 2 );
