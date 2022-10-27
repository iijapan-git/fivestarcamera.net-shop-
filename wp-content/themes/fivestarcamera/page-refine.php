<?php
/**
 * The template for displaying search page.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();
?>

	<main id="main">
		<div id="back"></div>

		<div class="box">

			<article id="contents">

				<?php if (function_exists('get_my_breadcrumb')) {echo get_my_breadcrumb();} ?>

				<h1 class="ttlLev1">絞り込み検索</h1>

				<div class="contents-box">

					<?php get_template_part('search-form'); ?>

				</div>


			</article>

			<?php get_sidebar(); ?>

		</div>
	</main>

<?php
get_footer();
