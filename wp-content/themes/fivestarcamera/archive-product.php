<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if (is_search() || is_array(get_query_var('spec'))) {
	get_template_part('search');
	exit;
}


get_header();


$archive_title = "";

// get_product_archive_title();

$cat_term_slug = get_query_var('product_cat');
if ($cat_term_slug) {
	$cat_term = get_term_by('slug', $cat_term_slug, 'product_cat');
	if ($cat_term->name) {
		$archive_title .= $cat_term->name . " ";
	}
}

$maker_term_slug = get_query_var('maker');
if ($maker_term_slug) {
	$maker_term = get_term_by('slug', $maker_term_slug, 'maker');
	if ($maker_term->name) {
		$archive_title .= $maker_term->name . " " . $maker_term->description;
	}
}

$spec_var = get_query_var('spec');
if ($spec_var) {
	$spec_title = '';
	$spec_fields = get_spec_fields();
	foreach ($spec_fields as $field) {
		if (isset($field['name']) && $field['name'] === ('spec_' . $spec_var)) {
			$spec_title .= $field['label'];
		}
	}
	$archive_title .= $spec_title ? $spec_title : 'スペック：' . $spec_var;
}

if (isset($_GET['min_price']) && isset($_GET['max_price']) && is_numeric($_GET['min_price']) && is_numeric($_GET['max_price'])) {
	$archive_title =  '¥' .  number_format(esc_attr($_GET['min_price'])) . '~' . '¥' .  number_format(esc_attr($_GET['max_price']));
} elseif (isset($_GET['min_price']) && is_numeric($_GET['min_price'])) {
	$archive_title =  '¥' .  number_format(esc_attr($_GET['min_price'])) . '以上';
} elseif (isset($_GET['max_price']) && is_numeric($_GET['max_price'])) {
	$archive_title =  '¥' .  number_format(esc_attr($_GET['max_price'])) . '以下';
}


$type_var = get_query_var('type');
if ($type_var) {
	if ($type_var === 'new') {
		$archive_title = '新入荷商品';
	} elseif ($type_var === 'recommend') {
		$archive_title = 'おすすめ商品';
	}
}


if (!$archive_title) {
	$archive_title = '商品一覧';
}


?>

	<main id="main">
		<div id="back"></div>

		<div class="box">

			<article id="contents">
				<?php if (function_exists('get_my_breadcrumb')) {echo get_my_breadcrumb();} ?>

				<h1 class="ttlLev1"><?php echo esc_html($archive_title); ?></h1>

				<div class="contents-box">

<?php
	if (have_posts()) :


		if ($cat_term_slug) {
			get_template_part('products/menu-maker');

		} elseif ($maker_term_slug) {
			get_template_part('products/menu-product_cat');

		}
?>

					<?php get_template_part('products/sort'); ?>

					<?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>

					<section class="products-list column">

<?php
		while (have_posts()) : the_post();

				get_template_part('products/loop');

		endwhile;
?>

					</section>

					<?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>

<?php
	else : 
?>

	<div class="product-notfound">
		<p>商品が見つかりませんでした。</p>
	</div>

	<?php get_template_part('product/recommend'); ?>

<?php
	endif;
?>

				</div>
			</article>

			<?php get_sidebar(); ?>

		</div>
	</main>

<?php get_footer(); ?>
