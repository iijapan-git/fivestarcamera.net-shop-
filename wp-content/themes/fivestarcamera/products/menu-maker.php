<?php
/**
 * menu-maker
 */

$parse_url =  parse_url($_SERVER["REQUEST_URI"]);
$current_url = preg_replace ('#/page/[0-9]+#', '', $parse_url['path']);

$maker_term_slug = get_query_var('maker');

$arg = array(
	'hide_empty' => 0,
);
$maker_terms = get_terms('maker', $arg);
if (is_array($maker_terms)) :

?>

	<section id="maker-menu" class="">
		<h2>メーカーで絞り込む</h2>
		<ul>

<?php
	foreach ($maker_terms as $term) :

		$link_url = esc_url($current_url . '?maker=' . $term->slug);

		$attachment_id = get_field('maker_logo', $term);
		$img_src = wp_get_attachment_image_src($attachment_id, 'full');

		$img_url = '';
		if (isset($img_src[0])) {
			$img_url = esc_url($img_src[0]);
		}

		$alt = esc_attr($term->name . ' ' . $term->description);

		$active = '';
		if ($maker_term_slug && $maker_term_slug === $term->slug) {
			$active = 'class="active"';
		}
?>
			<li <?php echo $active; ?>><a href="<?php echo $link_url; ?>"><img src="<?php echo $img_url; ?>" width="85" height="30" alt="<?php echo $alt; ?>"></a></li>

<?php
	endforeach;
?>

		</ul>
		<div class="btn"><a href="<?php echo esc_url(home_url()); ?>/refine">絞り込み条件から探す</a></div>
	</section>

<?php
endif;
?>