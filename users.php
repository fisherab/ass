<?php
/**
 * The template for displaying activated users
 *
 * Template Name: users
 */

get_header(); ?>

<div id="primary" class="content-area entry-content">
<main id="main" class="site-main" role="main">
<h1>Members</h1>

<?php
if ( is_user_logged_in()) {
	$blogusers = get_users( array( 
				'fields' => array( 'id', 'display_name','user_email' ) , 
				'meta_key' => 'last_name',
				'orderby' => 'meta_value',
				) );
	foreach ( $blogusers as $user ) {
		if ( get_user_meta ($user->id, 'active', true ) ) {
			$first_name = get_user_meta($user->id, 'first_name', true);
			$last_name = get_user_meta($user->id, 'last_name', true);
			$name = $last_name . ', ' . $first_name;
			$address = get_user_meta($user->id, 'addr1', true);
			$addr2 = get_user_meta($user->id, 'addr2', true);
			if ($addr2 != "") $address = $address . ', ' .  $addr2;
			$address = $address . ', '  . get_user_meta($user->id, 'town', true) . ', '  . get_user_meta($user->id, 'postcode', true);
			$phone_1 = get_user_meta($user->id, 'phone_1', true);  
			$phone_2 = get_user_meta($user->id, 'phone_2', true);
			$phone = $phone_1;
			if ($phone_2 != "") $phone = $phone . ' / ' . $phone_2;
			$img = wp_get_attachment_url(get_user_meta($user-> id, 'photo', true));
			if ($img == "") $img = get_stylesheet_directory_uri() . '/images/question.jpg';
			echo '<p><b><img src="' . $img . '" width="80" height="80" style="float:left; margin-right:20px;">' . esc_html($name ) . '</b> &lt' . esc_html( $user->user_email ) . '&gt<br/>' . $address  . '<br/>Tel: ' . $phone .'</p>';
		}
	}
}?>

</main><!-- .site-main -->

<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
