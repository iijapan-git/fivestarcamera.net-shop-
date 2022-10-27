<?php
/**
 * The template for displaying product content in the single-product.php template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

?>

<?php
	if ( post_password_required() ) {
		echo get_the_password_form();
		return;
	}

?>

				<div class="contents-box" <?php //post_class(); ?>>

					<?php do_action( 'woocommerce_before_single_product' ); ?>

					<section id="gallery" class="column">

						<?php get_template_part('product/slider'); ?>

						<?php get_template_part('product/tag'); ?>

						<h1 class="title"><?php the_title(); ?></h1>
					</section>

					<section id="operation" class="column">
						<div class="itemdetail-info">

<?php
if ($product->is_in_stock()) :
?>

							<div class="prices">
<?php if (is_customer()): ?>
								<div class="regular-price">
									<span class="regular-price-label">通常価格:</span><span class="regular-price-value"><?php echo wc_price($product->get_regular_price()) . $product->get_price_suffix(); ?></span>
								</div>
<?php endif; ?>

								<div class="sell-price">
									<span class="sell-price-label">販売価格:</span><?php echo $product->get_price_html();?>
								</div>

<?php if (!is_customer()): ?>
								<div class="member-price">
									<span class="member-price-label">会員特別価格:</span><span class="member-price-value"><?php echo wc_price(get_my_member_price($product->id)) . $product->get_price_suffix(); ?></span>
								</div>
<?php endif; ?>
							</div>


<?php
else :
// 売り切れ表示
?>

							<div class="prices">
								<div class="sell-price">
									<span class="woocommerce-Price-amount amount">SOLD OUT</span>
								</div>
							</div>

<?php
endif;
?>

							<?php echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );  ?>

							<div class="shere-button"><?php if(function_exists("get_my_sns_buttons")){echo get_my_sns_buttons();}?></div>

							<div class="btn"><a target="_blank" href="<?php echo esc_url(home_url()); ?>/contact?productid=<?php the_ID(); ?>">この商品について問い合わせる</a></div>
							<div class="btn"><a target="_blank" href="<?php echo esc_url(home_url()); ?>/guide">ショッピングガイドを見る</a></div>
						</div>
						<div class="itemdetail-form">
							<div class="inner">

								<?php do_action( 'woocommerce_' . $product->product_type . '_add_to_cart' ); ?>

							</div>
						</div>
						<section class="itemdetail-payment">
							<h3 class="ttlLev4">お支払い方法について</h3>
							<p>下記のお支払方法がご利用いただけます。</p>
							<section class="ecollect">
								<h4 class="ttlLev5">■【カード決済可】代金引換（佐川急便 e-コレクト）</h4>
								<p>現金およびクレジットカードでの決済が可能です。別途代引手数料をご負担いただきます。ご注文合計金額によって手数料が異なります。</p>
								<div class="block">
									<h5 class="ttl">代引手数料 （税込）</h5>
									<p>1万円以下：330円 ／ 3万円以下：440円 ／ 10万円以下：660円 ／ 30万円以下：1,100円 ／ 50万円以下：2,200円 ／ 60万円以下：6,600円 ／ 60万円超は10万円増す毎に：1,100円を加算</p>
								</div>
							</section>
							<section class="bank">
								<h4 class="ttlLev5">■銀行振込</h4>
								<p>別途振込手数料をお客様にご負担いただきます。</p>
							</section>
							<div class="btn"><a target="_blank" href="<?php echo esc_url(home_url()); ?>/guide/payment">お支払い方法の詳細はこちら</a></div>
						</section>
					</section>

					<section id="information" class="">
						<h2 class="title"><span>商品詳細</span></h2>

						<p class="description"><?php the_field('product_description'); ?></p>

						<?php echo get_my_product_rank(get_field('product_rank')); ?>

						<?php get_template_part('product/table'); ?>

						<?php echo get_my_product_rank_list(get_field('product_rank')); ?>

						<p class="caution">中古品のため、1点限りの商品となっております。<br>店頭や他サイトにおいても同時に陳列・販売しており、サイト上で「在庫あり」となっておりましても、すでに販売済みの場合がございます。あらかじめご了承下さいますよう、お願い申し上げます。</p>
						<div id="guide-link">
							<ul>
								<li class="payment"><a target="_blank" href="<?php echo esc_url(home_url()); ?>/guide/payment"><span>お支払い方法について</span></a></li>
								<li class="shipping"><a target="_blank" href="<?php echo esc_url(home_url()); ?>/guide/shipping"><span>配送方法・送料について</span></a></li>
								<li class="returns"><a target="_blank" href="<?php echo esc_url(home_url()); ?>/guide/returns"><span>商品の返品・動作保証について</span></a></li>
								<li class="members"><a target="_blank" href="<?php echo esc_url(home_url()); ?>/guide/members"><span>会員・ポイント制度について</span></a></li>
							</ul>
						</div>
					</section>
				</div>
