<?php
/**
 * The Template for displaying all single products
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<!-- Google 構造化データ マークアップ支援ツールが生成した JSON-LD マークアップです。 -->
<script type="application/ld+json">
{
  "@context" : "http://schema.org",
  "@type" : "Product",
  "name" : "<?php the_title(); ?>",
  "image" : "<?php echo $image_url; ?>",
  "offers" : {
    "@type" : "Offer",
    "price" : "<?php echo $product->regular_price;?>",
		"availability": "InStock"
  }
}
</script>
	<main id="main">
		<div id="back"></div>
		<div class="box">

			<article id="contents">
				<?php if (function_exists('get_my_breadcrumb')) {echo get_my_breadcrumb();} ?>

				<?php while (have_posts()) : the_post(); ?>

					<?php get_template_part('product/content'); ?>

					<?php get_template_part('product/recommend'); ?>

				<?php endwhile; ?>

			</article>

			<?php get_sidebar(); ?>

		</div>
	</main>

<?php
$image_id = get_post_thumbnail_id();
$image_url = wp_get_attachment_image_src($image_id, true);
?>

<?php get_footer(); ?>
