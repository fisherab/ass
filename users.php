<?php
/**
 * The template for displaying pages
 * Template Name: users
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
                <h1>Members</h1>
<p>Please see <a href="/index.php/information-for-members">Information for Members</a></p>

<?php if ( current_user_can( 'publish_posts' ) ) { //only Author or greater ?>
<p>Please see <a href="/index.php/creating-posts">Creating posts</a></p>
<?php } ?>

		<?php
                $blogusers = get_users( array( 
                     'fields' => array( 'id', 'display_name','user_email' ) , 
                     'meta_key' => 'last_name',
                     'orderby' => 'meta_value',
                ) );
                foreach ( $blogusers as $user ) {
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
                $img = get_cupp_meta($user -> id, 'thumbnail');
		if ($img == "") $img = get_stylesheet_directory_uri() . '/images/question.jpg';
		echo '<p><b><img src="' . $img . '" width="80" height="80" style="float:left; margin-right:20px;">' . esc_html($name ) . '</b> &lt' . esc_html( $user->user_email ) . '&gt<br/>' . $address  . '<br/>Tel: ' . $phone .'</p>';
		}
                ?>


        </main><!-- .site-main -->

        <?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
