<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();

?>

	<main id="main">
		<div id="back"></div>
		<div id="visual" class="box">
			<div id="slider">
				<ul>
					<li class=""><a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url(home_url()); ?>/common/images/slide1.jpg" width="860" height="420" alt="専門家が磨きぬいた極上のヴィンテージカメラ。定番からレア品まで充実のラインナップ"></a></li>
					<li class=""><a href="<?php echo esc_url(home_url()); ?>/guide/shipping"><img src="<?php echo esc_url(home_url()); ?>/common/images/slide2.jpg" width="860" height="420" alt="全国一律 送料無料 ご入金から24時間以内に発送いたします！"></a></li>
					<li class=""><a href="<?php echo esc_url(home_url()); ?>/guide/returns"><img src="<?php echo esc_url(home_url()); ?>/common/images/slide3.jpg" width="860" height="420" alt="安心の返品保証サービス 全品30日間動作保証付 中古品も安心してご購入いただけます"></a></li>
					<li class=""><a href="<?php echo esc_url(home_url()); ?>/guide/members"><img src="<?php echo esc_url(home_url()); ?>/common/images/slide4.jpg" width="860" height="420" alt="会員登録で便利＆お得（会員特別価格、ポイント制、メルマガ登録）"></a></li>
					<li class=""><a href="<?php echo esc_url(home_url()); ?>/purchase"><img src="<?php echo esc_url(home_url()); ?>/common/images/slide5.jpg" width="860" height="420" alt="あなたの大切なカメラ、高く買い取ります 経験豊かなスタッフによる安心査定 どの店よりも高く買い取ります"></a></li>
				</ul>
			</div>
		</div>

		<div class="box">

			<article id="contents">
				<div class="contents-box">

<?php
// トップページバナー
$top_banner_id = get_field('top_banner');
$top_html = get_field('top_html');

if ($top_banner_id || $top_html) :
?>
					<section id="topics" class="column">

<?php
	if ($top_banner_id) {
		$top_banner_src = wp_get_attachment_image_src($top_banner_id, 'full');
		if (isset($top_banner_src[0])) {
			echo '<img src="' . esc_url($top_banner_src[0]) . '">';
		}
	}

	if ($top_html) {
		echo $top_html;
	}
?>

					</section>

<?php
endif;
?>

					<section id="new-arrival" class="column">
						<h2 class="ttlStripe"><span>新入荷商品<span class="en">NEW ARRIVAL</span></span></h2>

<?php
$new_period = function_exists('get_new_product_period') ?  '-' . get_new_product_period() . ' day'  : '-7 day';
$new_args = array(
	'post_type' => 'product',
	'posts_per_page' => 6,
	'orderby' => 'date',
	'date_query' => array(
		array(
			'after' => $new_period
		)
	)
);
$new_query = new WP_Query($new_args);
if ($new_query->have_posts()) :
?>
						<div class="products-list">

<?php
	$loop_type = 'new';

	while ($new_query->have_posts()) : $new_query->the_post();

		get_template_part('products/loop');

	endwhile;
?>
						</div>

<?php
endif;
?>

						<div class="btn-list"><a href="<?php echo esc_url(home_url()); ?>/shop?type=new">新入荷商品一覧を見る</a></div>
					</section>


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

					<section id="recommend" class="column">
						<h2 class="ttlStripe"><span>当店のおすすめ<span class="en">RECOMMEND</span></span></h2>

						<div class="products-list">

<?php
	$loop_type = 'recommend';

	while ($recommend_query->have_posts()) : $recommend_query->the_post();

		get_template_part('products/loop');

	endwhile;
?>

						</div>

						<div class="btn-list"><a href="<?php echo esc_url(home_url()); ?>/shop?type=recommend">おすすめ商品一覧を見る</a></div>
					</section>

<?php
endif;
?>

					<section id="special-column" class="column">
						<div class="inner">
							<h2 class="ttlSpecial"><span>特集・コラム<span class="en">SPECIAL COLUMN</span></span></h2>

							<?php get_template_part('special/tab'); ?>

							<div id="specail-all" class="special-list">

							<?php
							include_once( ABSPATH . WPINC . '/feed.php' );
							$feeduri = 'https://fivestarcamera.net/column/feed/';
							$rss = fetch_feed($feeduri);
							if (!is_wp_error($rss)) {
									$maxitems = $rss->get_item_quantity(5);
									$rss_items = $rss->get_items( 0, $maxitems );
							}
							
							foreach ( $rss_items as $item ) : ?>

								<!-- 記事の最初の画像を表示 -->
								<?php
								$first_img = '';
								if ( preg_match( '/<img.+?src=[\'"]([^\'"]+?)[\'"].*?>/msi', $item->get_content(), $matches ) ) {
									$first_img = $matches[1];
								}
								if ( preg_match( '/^<span>.*?<.span>/' , $item->get_content(), $matches ) ) {
									$category_name = $matches[0];
								}
								?>

								<div class="entry">
									<figure><img src="<?php echo esc_attr( $first_img ); ?>" alt=""></figure>

									<?php echo $new_icon; ?>

									<div class="block">
										<div class="block-box">
										<!-- 記事タイトルを表示 -->
											<?php $title = $item->get_title(); ?>
											<h3 class="title"><a href="<?php echo $item->get_permalink(); ?>"><?php echo $title ;?></a></h3>
											<p><?php //echo $item->get_description(); ?></p>
										</div>
									</div>
									<!-- 投稿日を表示 -->
									<?php 
										$item_date = $item->get_date();
										$date = date('Y/m/d',strtotime( $item_date ));
									?>
									<div class="date"><?php echo $date; ?></div>

									<?php if (isset($category_name)) : ?>
									<div class="info"><span class="category"><?php echo $category_name; ?></span></div>
									<?php endif; ?>
								</div>
							
							<?php
							endforeach;
							wp_reset_postdata();
							?>

							</div>
							<div class="btn-list"><a href="https://fivestarcamera.net/column">特集・コラム一覧を見る</a></div>
						</div>
					</section>


					<div id="voice-news" class="column">
<?php
// お客様の声
$voice_args = array(
	'post_type' => 'voice',
	'posts_per_page' => 2,
);
$voice_query = new WP_Query($voice_args);
if ($voice_query->have_posts()) :
?>
						<section id="voice" class="">
							<h2 class="ttlNormal">お客様の声<span class="en">VOICE</span></h2>
							<div class="btn-box"><a href="<?php echo esc_url(home_url());?>/voice"><span>一覧を見る</span></a></div>

<?php
	while ($voice_query->have_posts()) : $voice_query->the_post();
?>
	<div class="entry">
		<h2 class="ttlLev3"><?php the_title(); ?></h2>

<?php
		if (function_exists('get_voice_star')) :
?>
		<div class="star">★★★★★</div>
<?php
		endif;
?>
		<div class="info"><span class="date"><?php the_time("Y.n.j"); ?></span><span class="customer"><?php the_field('voice_customer'); ?></span></div>
		<p><?php the_excerpt(); ?></p>
		<div class="btn-detail"><a href="<?php echo esc_url(home_url());?>/voice">詳細を見る</a></div>
	</div>

<?php
	endwhile;
?>

						</section>

<?php
endif;
?>

<?php
// お知らせ
$info_args = array(
	'post_type' => 'info',
	'posts_per_page' => 2,
);
$info_query = new WP_Query($info_args);
if ($info_query->have_posts()) :
?>
						<section id="news" class="">
							<h2 class="ttlNormal">お知らせ<span class="en">INFORMATION</span></h2>
							<div class="block">
								<dl>

<?php
	while ($info_query->have_posts()) : $info_query->the_post();
?>
	<dt><?php the_time("Y.n.j"); ?></dt><dd><a href="<?php echo esc_url(home_url());?>/info"><?php the_title(); ?></a></dd>

<?php
	endwhile;
?>

								</dl>
								<div class="btn-box"><a href="<?php echo esc_url(home_url());?>/info"><span>一覧を見る</span></a></div>
							</div>
						</section>
<?php
endif;
?>
					</div>
				</div>

			</article>

			<?php get_sidebar(); ?>

		</div>
	</main>

<?php get_footer(); ?>
