<?php
/**
 * sidebar
 */
?>

	<aside id="sidemenu" class="sidemenu">
		<div class="search">
			<form action="<?php echo esc_url(home_url()); ?>" method="get" name="searchform">
				<input type="text" value="" name="s" class="searchbox" placeholder="キーワードで商品を探す" />
				<input type="image" name="submit" class="searchSubmit" src="<?php echo esc_url(home_url()); ?>/common/images/ic_search.gif" alt="検索" onclick="search_back();this.form.submit();return false;"/>
				<input name="post_type" value="product" type="hidden">
			</form>
		</div>
		<nav id="sidenav">

<?php
// カテゴリ―から探す
$arg = array(
	'hide_empty' => 0,
);
$cat_terms = get_terms('product_cat', $arg);
if (is_array($cat_terms)) :
?>
			<div id="category" class="accordion">
				<p class="side-ttl side-ttl-unique">カテゴリから探す</p>
				<ul>

<?php
	foreach ($cat_terms as $term) :
?>
	<li><a href="<?php echo get_term_link($term); ?>"><?php echo esc_attr($term->name); ?></a></li>

<?php
	endforeach;
?>
				</ul>
			</div>
<?php
endif;


// メーカーから探す
$arg = array(
	'hide_empty' => 0,
);
$maker_terms = get_terms('maker', $arg);
if (is_array($maker_terms)) :
?>
			<div id="maker" class="accordion">
				<p class="side-ttl side-ttl-unique">メーカーから探す</p>
				<ul>

<?php
	foreach ($maker_terms as $term) :

		$attachment_id = get_field('maker_logo', $term);
		$img_src = wp_get_attachment_image_src($attachment_id, 'full');

		$img_url = '';
		if (isset($img_src[0])) {
			$img_url = esc_url($img_src[0]);
		}

		$alt = esc_attr($term->name . ' ' . $term->description);

?>
	<li><a href="<?php echo get_term_link($term); ?>"><img src="<?php echo $img_url; ?>" width="85" height="30" alt="<?php echo $alt; ?>"></a></li>

<?php
	endforeach;
?>
				</ul>
			</div>

<?php
endif;
?>


<?php
// スペックから探す
$spec_fields = function_exists('get_spec_fields') ? get_spec_fields() : null;
if (is_array($spec_fields)) :
?>

			<div id="spec" class="accordion">
				<p class="side-ttl side-ttl-unique">スペックから探す</p>
				<ul>
<?php
	foreach($spec_fields as $field) :

		$name = isset($field['name']) ? esc_attr($field['name']) : null;
		if (!$name || substr($name, 0, 5) !== 'spec_') {
			continue;
		}

		$name = (substr($name, 5));
		$label = isset($field['label']) ? esc_attr($field['label']) : null;
?>
					<li><a href="<?php echo esc_url(home_url() . '/shop?spec=' . $name); ?>"><?php echo $label; ?></a></li>

<?php
	endforeach;
?>

				</ul>
			</div>

<?php
endif;
?>


			<div id="price" class="accordion">
				<p class="side-ttl side-ttl-unique">価格帯から探す</p>
				<ul>
					<li><a href="<?php echo esc_url(home_url()); ?>/shop?max_price=10000">¥10,000以下</a></li>
					<li><a href="<?php echo esc_url(home_url()); ?>/shop?min_price=10001&max_price=30000">¥10,001~¥30,000</a></li>
					<li><a href="<?php echo esc_url(home_url()); ?>/shop?min_price=30001&max_price=50000">¥30,001~¥50,000</a></li>
					<li><a href="<?php echo esc_url(home_url()); ?>/shop?min_price=50001&max_price=70000">¥50,001~¥70,000</a></li>
					<li><a href="<?php echo esc_url(home_url()); ?>/shop?min_price=70001&max_price=100000">¥70,001~¥100,000</a></li>
					<li><a href="<?php echo esc_url(home_url()); ?>/shop?min_price=100001&max_price=200000">¥100,001~¥200,000</a></li>
					<li><a href="<?php echo esc_url(home_url()); ?>/shop?min_price=200001">¥200,000以上</a></li>
				</ul>
			</div>
		</nav>
		
		<div id="banners" class="banners">
			<div class="bn"><a href="<?php echo esc_url(home_url()); ?>/guide/shipping"><img src="<?php echo esc_url(home_url()); ?>/common/images/bn_free-shipping.jpg" width="220" height="90" alt=""></a></div>
			<div class="bn"><a href="<?php echo esc_url(home_url()); ?>/guide/returns"><img src="<?php echo esc_url(home_url()); ?>/common/images/bn_returns.gif" width="220" height="90" alt=""></a></div>
			<div class="bn"><a href="https://fivestarcamera.net/" target="_blank"><img src="<?php echo esc_url(home_url()); ?>/common/images/bn_purchase.jpg" width="220" height="90" alt=""></a></div>
		</div>
		
    <div id="sns" class="sns">
			<p class="followus-ttl"><span class="en">FOLLOW US</span></p>
			<div class="facebook"><a href="https://www.facebook.com/fivestarcameranet/" target="_blank"><img src="<?php echo esc_url(home_url()); ?>/common/images/ic_facebook.gif" width="36" height="36" alt=""><span>Facebook</span></a><span></span></div>
			<div class="twitter"><a href="https://twitter.com/fivestarcamera" target="_blank"><img src="<?php echo esc_url(home_url()); ?>/common/images/ic_twitter.gif" width="36" height="36" alt=""><span>Twitter</span></a></div>
		</div>
		
		<div id="calendar" class="calendar">
			<div><img src="<?php echo esc_url(home_url()); ?>/common/images/ttl_calendar.gif" width="220" height="60" alt=""></div>
			<div class="block">
				<?php dynamic_sidebar( 'Widget-BizCalendar' ); echo PHP_EOL; ?>
				<p>営業時間：10:00~20:00</p>
			</div>
		</div>

	</aside>
