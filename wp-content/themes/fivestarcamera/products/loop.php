<?php
/**
 * products/roop
 */

	global $product, $loop_type;

	$permalink = get_permalink();
	$title = get_the_title();

	//アイキャッチ画像
	//$size = 'shop_thumbnail';
	//$size = 'single_product_large_thumbnail_size';
	$size = 'shop_catalog';

	if (has_post_thumbnail()) {
		$attachment_id = get_post_thumbnail_id();
		$img_src = wp_get_attachment_image_src($attachment_id, $size);
		$img_url = $img_src[0];

	} else {
		$img_url = home_url() . "/common/images/items/noimage_item.gif";
	}

	// 価格
	$price = $product->get_price_html();
	if (!$product->is_in_stock()) {
		$price = '<span class="soldout">SOLD OUT</span>';
	}

	// アイコン
	$icon = "";
	// if ($loop_type === 'new') {
	// 	$icon = '<div class="ic-new"></div>';

	// } elseif ($loop_type === 'recommend') {
	// 	$icon = '<div class="ic-recommend"></div>';

	// } elseif ($product->is_featured()) {
	// 	$icon = '<div class="ic-recommend"></div>';

	// } elseif (is_new_product(get_the_time('U'))) {
	// 	$icon = '<div class="ic-new"></div>';
	// }

	if ($product->is_featured()) {
		$icon = '<div class="ic-recommend"></div>';

	} elseif (is_new_product(get_the_time('U'))) {
		$icon = '<div class="ic-new"></div>';
	}
?>

	<div class="entry">
		<a href="<?php echo $permalink; ?>">
			<figure><img src="<?php echo esc_url($img_url); ?>" width="248" height="167" alt=""></figure>
			<h2 class="title"><?php echo $title; ?></h2>
			<div class="price"><?php echo $price;?></div>
		</a>

		<?php echo $icon; ?>
	</div>
