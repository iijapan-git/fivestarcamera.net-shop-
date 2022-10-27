<?php
/**
 * menu-maker
 */

$parse_url =  parse_url($_SERVER["REQUEST_URI"]);
$current_url = preg_replace ('#/page/[0-9]+#', '', $parse_url['path']);

$cat_term_slug = get_query_var('product_cat');


$arg = array(
	'hide_empty' => 0,
);
$cat_terms = get_terms('product_cat', $arg);
if (is_array($cat_terms)) :

?>

	<section id="category-menu" data-active="<?php echo esc_attr($cat_term_slug); ?>">
		<h2>カテゴリで絞り込む</h2>
		<ul>

<?php
	foreach ($cat_terms as $term) :

		$link_url = esc_url($current_url . '?product_cat=' . $term->slug);

		$attachment_id = get_woocommerce_term_meta($term->term_id, 'thumbnail_id', true);
		$img_src = wp_get_attachment_image_src($attachment_id, 'full');

		$img_url = '';
		if (isset($img_src[0])) {
			$img_url = esc_url($img_src[0]);
		}

?>
	<li><a href="<?php echo $link_url; ?>"><img src="<?php echo $img_url; ?>" width="55" height="40" alt=""><span><?php echo esc_attr($term->name); ?></span></a></li>

<?php
	endforeach;
?>

		</ul>
		<div class="btn"><a href="<?php echo esc_url(home_url()); ?>/refine">絞り込み条件から探す</a></div>
	</section>

<?php
endif;