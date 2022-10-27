
<?php
$recommend_args = array(
	'post_type' => 'product',
	'posts_per_page' => 6,
	'orderby' => 'date',
	'meta_query' => array(
		array(
			'key' => '_featured',
			'value' => 'yes',
			'compare' => '='
		)
	)
);
$recommend_query = new WP_Query($recommend_args);
if ($recommend_query->have_posts()) :
?>

				<aside id="products-bottom">
					<section id="recommend">
						<h2 class="ttlStripe"><span>当店のおすすめ<span class="en">RECCOMEND</span></span></h2>

						<div class="products-list">

<?php
	$loop_type = 'recommend';

	while ($recommend_query->have_posts()) : $recommend_query->the_post();

		get_template_part('products/loop');

	endwhile;
?>

						</div>

					</section>
				</aside>

<?php
endif;
?>
