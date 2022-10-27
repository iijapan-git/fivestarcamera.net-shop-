<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

$has_row    = false;
$attributes = $product->get_attributes();

ob_start();

foreach ($attributes as $attribute) :
	if (empty($attribute['is_visible']) || ($attribute['is_taxonomy'] && !taxonomy_exists($attribute['name']))) {
		continue;
	} else {
		$has_row = true;
	}
?>

			<dt><?php echo wc_attribute_label($attribute['name']); ?></dt>
			<dd><?php
				if ( $attribute['is_taxonomy'] ) {

					$values = wc_get_product_terms( $product->id, $attribute['name'], array('fields' => 'names'));
					echo apply_filters('woocommerce_attribute', wpautop(wptexturize(implode('、', $values ))), $attribute, $values);

				} else {

					// Convert pipes to commas and display values
					$values = array_map( 'trim', explode( WC_DELIMITER, $attribute['value'] ) );
					echo apply_filters('woocommerce_attribute', wpautop(wptexturize(implode('、', $values ))), $attribute, $values);

				}
			?></dd>

<?php
endforeach;

if ($has_row) {
	echo ob_get_clean();
} else {
	ob_end_clean();
}
