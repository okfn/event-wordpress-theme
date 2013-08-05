<?php

// shortcodes

// Gallery shortcode

// remove the standard shortcode
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'gallery_shortcode_tbs');

function gallery_shortcode_tbs($attr) {
	global $post, $wp_locale;

	$output = "";

	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID ); 
	$attachments = get_posts($args);
	if ($attachments) {
		$output = '<div class="row"><ul class="thumbnails">';
		foreach ( $attachments as $attachment ) {
			$output .= '<li class="span2">';
			$att_title = apply_filters( 'the_title' , $attachment->post_title );
			$output .= wp_get_attachment_link( $attachment->ID , 'thumbnail', true );
			$output .= '</li>';
		}
		$output .= '</ul></div>';
	}

	return $output;
}



// Buttons
function buttons( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'default', /* primary, default, info, success, danger, warning, inverse */
	'size' => 'default', /* mini, small, default, large */
	'url'  => '',
	'text' => '', 
	), $atts ) );
	
	if($type == "default"){
		$type = "";
	}
	else{ 
		$type = "btn-" . $type;
	}
	
	if($size == "default"){
		$size = "";
	}
	else{
		$size = "btn-" . $size;
	}
	
	$output = '<a href="' . $url . '" class="btn '. $type . ' ' . $size . '">';
	$output .= $text;
	$output .= '</a>';
	
	return $output;
}

add_shortcode('button', 'buttons'); 

// Alerts
function alerts( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= $text . '</div>';
	
	return $output;
}

add_shortcode('alert', 'alerts');

// Block Messages
function block_messages( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-block alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= '<p>' . $text . '</p></div>';
	
	return $output;
}

add_shortcode('block-message', 'block_messages'); 

// Block Messages
function blockquotes( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'float' => '', /* left, right */
	'cite' => '', /* text for cite */
	), $atts ) );
	
	$output = '<blockquote';
	if($float == 'left') {
		$output .= ' class="pull-left"';
	}
	elseif($float == 'right'){
		$output .= ' class="pull-right"';
	}
	$output .= '><p>' . $content . '</p>';
	
	if($cite){
		$output .= '<small>' . $cite . '</small>';
	}
	
	$output .= '</blockquote>';
	
	return $output;
}

add_shortcode('blockquote', 'blockquotes'); 
 

// Row
function row_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'class' => '',
		), $atts ) );
   
	 $output = '<div class="row';
	 if (!empty($class)) {
		 $output .= ' '.$class.'';
	 }
	 $output .= '">' .do_shortcode($content). '</div>';
	 
	 return $output;
} 
add_shortcode( 'row', 'row_shortcode' );


// Speakers
function speakers_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'class' => '',
			'heading' => '',
		), $atts ) );
   
	 $output = '<ul class="speakers thumbnails';
	 if (!empty($class)) {
		 $output .= ' '.$class.'';
	 }
	 if (!empty($heading)) {
		 $output .= '"><h3 class="speakers-heading">'.$heading.'</h3>' .do_shortcode($content). '</ul>';
	 }
	 else {
			$output .= '">' .do_shortcode($content). '</ul>';
		}
	 $output .= '<script>$("body").addClass("speakers-shortcode");</script>';
	 
	 return $output;
} 
add_shortcode( 'speakers', 'speakers_shortcode' );

function speaker_shortcode( $atts, $content = null ) {  
	extract( shortcode_atts( array(
			'image' => '?holder.js/300x185/text:image&nbsp;coming&nbsp;soon',
			'name' => '',
			'featured' => '',
			'link' => '',
			'web' => '',
			'twitter' => '',
			'location' => '',
			'role' => '',
			'class' => '',
		), $atts ) );
		
		$output = '<li class="speaker span';
		if($featured == 'y') {
			$output .= '4 featured';
			}
			else {
				$output .= '3';
			}
		if (!empty($class)) {
			$output .= ' '.$class;
		}
		$output .= '">';
		if (!empty($link)) {
			$output .= '<a href="' .$link. '" class="thumbnail">';
		}
		else {
			$output .= '<div class="thumbnail">';
		}
		$output .= '<span class="image"><span class="holderjs" style="background-image:url(' .$image. ');"></span></span>';
		$output .= '<h6>' .$name. '</h6>';
		if (!empty($role)) {
			$output .= '<span class="role">'.$role.'</span>';
		}
		if (!empty($link)) {
			$output .= '</a>';
		}
		else {
			$output .= '</div>';
		}
		if($featured == 'y') {
			if (!empty($content)) {
				$output .= '<div class="blurb">'.$content.'';
			}
			if ( (!empty($link)) && (!empty($content)) ) {
				$output .= '<a href="' .$link. '" class="more">'.__('more','bonestheme').'</a>';
			}
			if (!empty($content)) {
				$output .= '</div>';
			}
			$output .= '<ul class="links clearfix">';
			if (!empty($web)) {
				$output .= '<li class="web"><a href="'.$web.'">Website</a></li>';
			}
			if (!empty($twitter)) {
				$output .= '<li class="twitter"><a href="'.$twitter.'">Twitter</a></li>';
			}
			if (!empty($location)) {
				$output .= '<li class="location"><a href="'.$link.'">'.$location.'</a></li>';
			}
			$output .= '</ul>';
		}
		$output .= '</li>';
		
		return $output;
}  
add_shortcode('speaker', 'speaker_shortcode');  


// Schedule
function schedule_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'day' => '',
			'class' => '',
		), $atts ) );
   
	 $output = '<div class="schedule';
	 if (!empty($class)) {
		 $output .= ' '.$class.'';
	 }
	 $output .= '"><h3 class="schedule-day">'.$day.'</h3><table class="table">' .do_shortcode($content). '</table></div>';
	 
	 return $output;
} 
add_shortcode( 'schedule', 'schedule_shortcode' );

function slot_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'time' => '',
		), $atts ) );
   
	 $output = '<tr><th scope="row">'.$time.'</th>' .do_shortcode($content). '</tr>';
	 
	 return $output;
} 
add_shortcode( 'slot', 'slot_shortcode' );

function session_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'title' => '',
			'location' => '',
			'colour' => '',
		), $atts ) );
   
	 $output = '<td class="slot"><h4 class="title">'.$title.'</h4>' .do_shortcode($content);
	 if ((!empty($location)) || (!empty($colour))) {
		 $output .= '<span class="details">';
	 }
	 if (!empty($location)) {
		 $output .= '<span class="location">'.$location.'</span>';
	 }
	 if (!empty($colour)) {
		 $output .= '<span class="colour '.$colour.'">'.$colour.'</span>';
	 }
	 if ((!empty($location)) || (!empty($colour))) {
		 $output .= '</span>';
	 }
	 $output .= '</td>';
	 
	 return $output;
} 
add_shortcode( 'session', 'session_shortcode' );


// Promo Link
function promolink_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'class' => 'holderjs',
			'link' => '#',
			'image' => '?holder.js/460x276/text:image&nbsp;coming&nbsp;soon',
		), $atts ) );
   
	 $output = '<a class="promo-link';
	 if (!empty($class)) {
		 $output .= ' '.$class.'';
	 }
	 $output .= '" href="'.$link.'" style="background-image:url('.$image.');"><span class="ribbon ribbon-large"><span class="inner">' .do_shortcode($content). '</span></span></a>';
	 
	 return $output;
} 
add_shortcode( 'promolink', 'promolink_shortcode' );


// Featured Image
function featured_image_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'class' => '',
			'width' => '300',
			'height' => '185',
		), $atts ) );
		if ( has_post_thumbnail() ) {
			$imageurl = event_featured_img_url();
		} else {
			$imageurl = '?holder.js/'.$width.'x'.$height.'/text:image&nbsp;coming&nbsp;soon';
		}
   
	 $output = '<div class="featured '.$class.'"><div class="image holderjs" style="background-image:url('.$imageurl.'); height:'.$height.'px;">';
	 if (!empty($content)) {
			$output .= '<div class="highlight accent">'. $content .'</div>';
	 }
	 $output .= '</div><span class="wp-caption">'.event_featured_img_caption().'</span></div>';
	 
	 return $output;
} 
add_shortcode( 'featured_image', 'featured_image_shortcode' );

?>