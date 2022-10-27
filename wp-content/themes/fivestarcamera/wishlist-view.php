<?php
/**
 * Wishlist page template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.12
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly
?>


<?php
if( count( $wishlist_items ) > 0 ) :
?>

	<div id="favorite-list" data-pagination="<?php echo esc_attr( $pagination )?>" data-per-page="<?php echo esc_attr( $per_page )?>" data-page="<?php echo esc_attr( $current_page )?>" data-id="<?php echo ( is_user_logged_in() ) ? esc_attr( $wishlist_meta['ID'] ) : '' ?>" data-token="<?php echo ( ! empty( $wishlist_meta['wishlist_token'] ) && is_user_logged_in() ) ? esc_attr( $wishlist_meta['wishlist_token'] ) : '' ?>">

<?php
	foreach( $wishlist_items as $item ) :
		global $product;
		if( function_exists( 'wc_get_product' ) ) {
			$product = wc_get_product( $item['prod_id'] );
		}
		else{
			$product = get_product( $item['prod_id'] );
		}

		if( $product !== false && $product->exists() ) :
?>

		<div class="product" data-row-id="<?php echo $item['prod_id'] ?>">

<?php
			if( $is_user_owner ):
?>
			<div class="btn-delete"><a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item['prod_id'] ) ) ?>">delete</a></div>
<?php
			endif;
?>


			<a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>">
				<figure><?php echo $product->get_image() ?></figure>
				<h2 class="title"><?php echo apply_filters( 'woocommerce_in_cartproduct_obj_title', $product->get_title(), $product ) ?></h2>
				<div class="price"><?php

			if (!$product->is_in_stock()) {
				echo 'SOLD OUT';
			}
			elseif( is_a( $product, 'WC_Product_Bundle' ) ){
				if( $product->min_price != $product->max_price ){
					echo sprintf( '%s - %s', wc_price( $product->min_price ), wc_price( $product->max_price ) );
				}
				else{
					echo wc_price( $product->min_price );
				}
			}
			elseif( $product->price != '0' ) {
				echo $product->get_price_html();
			}
			// else {
			// 	echo apply_filters( 'yith_free_text', __( 'Free!', 'yith-woocommerce-wishlist' ) );
			// }
			?></div>
			</a>
		</div>

<?php
		endif;
	endforeach;
?>

	</div>

<?php
else :
?>

	<p class="no-favorite-list">お気に入りリストに商品が登録されていません。</p>

<?php
endif;
?>

	<div class="btn-box"><a href="<?php echo esc_url(home_url()); ?>"><span>トップへ戻る</span></a></div>
