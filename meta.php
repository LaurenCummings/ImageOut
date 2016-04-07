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

  <?php
        $bundled_items = $product->get_bundled_items();
        if ( $bundled_items ) {
            echo '<div class="yith-wcpb-product-bundled-items">';
            foreach ( $bundled_items as $bundled_item ) {
                /**
                 * @var YITH_WC_Bundled_Item $bundled_item
                 */
                $bundled_product = $bundled_item->get_product();
                $bundled_post    = $bundled_product->get_post_data();
                $quantity        = $bundled_item->get_quantity();
                ?>
                <div class="film">
                        <h3><?php echo $bundled_product->get_title() ?></h3>

                        <div class="film_image"><?php echo $bundled_product->get_image() ?></div>

                        <h3><a href="<?php echo $bundled_post->_website; ?>">Official Website</a></h3>

                        <h3><?php echo $bundled_post->_film_details; ?></h3>

                        <iframe src="<?php echo $bundled_post->_trailer; ?>"
   width="560" height="315" frameborder="0" allowfullscreen></iframe>

                        <h3>| Directed by: <?php echo $bundled_post->_director; ?></h3>

                        <h3><?php echo $bundled_post->_language_note; ?></h3>

						<p><?php echo $bundled_post->_description; ?></p>

						<h2>AWARDS/ACCOLADES</h2>

						<p><?php echo $bundled_post->_awards; ?></p>

                        <?php
                        if ( $bundled_product->managing_stock() ) {
                            if ( $bundled_product->has_enough_stock( $quantity ) && $bundled_product->is_in_stock() ) {
                                echo '<div class="yith-wcpb-product-bundled-item-instock">' . __( 'In stock', 'woocommerce' ) . '</div>';
                            } else {
                                echo '<div class="yith-wcpb-product-bundled-item-outofstock">' . __( 'Out of stock', 'woocommerce' ) . '</div>';
                            }
                        }
                        ?>

                </div>
                <?php
            }
            echo '</div>';
        }
        ?>


	<div class="community_partner">
		<h2>COMMUNITY PARTNER</h2>
			<?php echo get_post_meta( get_the_ID(), '_community_partner', true ); ?>
	</div>


	<?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
