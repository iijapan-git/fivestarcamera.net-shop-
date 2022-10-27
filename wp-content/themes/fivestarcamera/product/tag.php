<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

// おすすめ商品
$featured = '';
if ($product->is_featured()) {
	$featured = '<span class="recommend">当店のおすすめ</span>';
}

// カテゴリ―
$category = '';
$categories = get_the_terms($post, 'product_cat');
if (isset($categories[0])) {
	$category = '<span>' . $categories[0]->name . '</span>';
}

// メーカー名
$maker = '';
$makers = get_the_terms($post, 'maker');
if (isset($makers[0])) {
	$maker = '<span>' . $makers[0]->name . '</span>';
}

// スペック
$spec = '';
$spec_fields = get_spec_fields();
foreach ($spec_fields as $field) {
	if (get_field($field['name']) === 'yes' && isset($field['label'])) {
		$spec .= '<span>' . $field['label'] . '</span>';
	}
}
?>

<div class="tag"><?php echo $featured . $category . $maker . $spec; ?></div>
