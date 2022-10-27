<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

// 商品スライド
$attachment_ids = $product->get_gallery_attachment_ids();
if ($attachment_ids) :
?>

						<div id="productslider">
							<div id="bxslider">
								<ul>

<?php
	foreach ($attachment_ids as $attachment_id) :
		$src_full = wp_get_attachment_image_src($attachment_id, 'full');
		$src_tmb = wp_get_attachment_image_src($attachment_id, 'shop_catalog');
?>
									<li><a href="<?php echo esc_url($src_full[0]); ?>" rel="lightbox['photo']"><img class="pslide" src="<?php echo esc_url($src_tmb[0]); ?>" /></a></li>

<?php
	endforeach;
?>
								</ul>
							</div>

							<div id="bxpager">

<?php
	foreach ($attachment_ids as $key => $attachment_id) :
		$src_tmb = wp_get_attachment_image_src($attachment_id, 'shop_catalog');
?>
								<a data-slide-index="<?php echo $key; ?>" href=""><img src="<?php echo esc_url($src_tmb[0]); ?>"></a>

<?php
	endforeach;
?>

							</div>

						</div>

<?php
endif;
?>