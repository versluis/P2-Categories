<?php
/*
/* P2 Categories functions
/* @since 1.6
 */
 
function get_cats_with_count( $post, $format = 'list', $before = '', $sep = '', $after = '' ) {
  $postcats = get_the_category($post->ID, 'category' );

  if ( !$postcats )
	  return '';

  foreach ( $postcats as $cat ) {
	  if ( $cat->count > 1 && !is_category($cat->slug) ) {
		  $cat_link = '<a href="' . get_category_link( $cat ) . '" rel="category">' . $cat->name . ' ( ' . number_format_i18n( $cat->count ) . ' )</a>';
	  } else {
		  $cat_link = $cat->name;
	  }

	  if ( $format == 'list' )
		  $cat_link = '<li>' . $cat_link . '</li>';

	  $cat_links[] = $cat_link;
  }

  return apply_filters( 'cats_with_count', $before . join( $sep, $cat_links ) . $after, $post );
}

function cats_with_count( $format = 'list', $before = '', $sep = '', $after = '' ) {
  global $post;
  echo get_cats_with_count( $post, $format, $before, $sep, $after );
}


?>