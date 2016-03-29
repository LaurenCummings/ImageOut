<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php _e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?>


	<div class="program_number">
		<h3>PROGRAM NO.</h3>
		<?php echo get_post_meta( get_the_ID(), '_program_number', true ); ?>
	</div>

	<div class="interpreted">
		<?php 	if (get_post_meta( get_the_ID(), '_interpreted', true ) == 'yes') {
					echo '<img src="http://www.outhereinthefield.com/wp-content/uploads/2016/03/interpret-square.gif">';
				} 
		?>
	</div>

	<div class="program_details">
		<strong><?php echo get_post_meta( get_the_ID(), '_date', true ); ?></strong>

		&bull;

		<strong><?php echo get_post_meta( get_the_ID(), '_time', true ); ?></strong>

		<br>

		<?php 	if (get_post_meta( get_the_ID(), '_location', true ) == 'one') {
					echo "LITTLE THEATRE 1";
				}
				else if (get_post_meta( get_the_ID(), '_location', true ) == 'two') {
					echo "DRYDEN THEATRE";
				}
		?>
	</div>

	<div class="ticket_status">
		<?php 	if (get_post_meta( get_the_ID(), '_ticket_status', true ) == 'one') {
					echo "TICKETS AVAILABLE";
				}
				else if (get_post_meta( get_the_ID(), '_ticket_status', true ) == 'two') {
					echo "RUSH ONLY";
				}
				else if (get_post_meta( get_the_ID(), '_ticket_status', true ) == 'three') {
					echo "SOLD OUT";
				}
		?>
	</div>



	<?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
