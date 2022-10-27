<?php
/**
 * spmenu
 */
?>

	<div id="spmenu">
		<div id="uppernav2">
			<ul>
				<li class="newm"><a href="<?php echo esc_url(home_url()); ?>/myaccount">新規会員登録</a></li>
				<li class="memb"><a href="<?php echo esc_url(home_url()); ?>/myaccount">マイページ・ログイン</a></li>

			</ul>
		</div>
		<div class="freedial"><img src="<?php echo esc_url(home_url()); ?>/common/images/freedial.gif" width="170" height="19" alt="フリーダイヤル 0120-027-740"><span>営業時間 10:00~20:00</span></div>
		<div class="btn-contact"><a href="<?php echo esc_url(home_url()); ?>/contact">メールでのお問い合わせ</a></div>
		<nav id="gnav2">
			<ul>
				<li class="home"><a href="<?php echo esc_url(home_url()); ?>">TOP</a></li>
				<li class="abou"><a href="<?php echo esc_url(home_url()); ?>/about">当店について</a></li>
				<li class="guid"><a href="<?php echo esc_url(home_url()); ?>/guide">ショッピングガイド</a></li>
				<li class="purc"><a href="<?php echo esc_url(home_url()); ?>/purchase">買取サービス</a></li>
				<li class="voic"><a href="<?php echo esc_url(home_url()); ?>/voice">お客様の声</a></li>
				<!-- <li class="spcl"><a href="<?php echo esc_url(home_url()); ?>/special">特集・コラム</a></li> -->
				<li class="spcl"><a href="https://fivestarcamera.net/column">特集・コラム</a></li>
			</ul>
		</nav>
		<aside id="sidemenu2" class="sidemenu">
			<div class="search">
				<form action="<?php echo esc_url(home_url()); ?>" method="get" name="searchform">
					<input type="text" value="" name="Search" class="searchbox" placeholder="キーワードで商品を探す" />
					<input type="image" name="submit" class="searchSubmit" src="<?php echo esc_url(home_url()); ?>/common/images/ic_search.gif" alt="検索" onclick="search_back();this.form.submit();return false;"/>
				</form>
			</div>
			<nav id="sidenav2">

<?php
// カテゴリ―から探す
$arg = array(
	'hide_empty' => 0,
);
$cat_terms = get_terms('product_cat', $arg);
if (is_array($cat_terms)) :
?>
			<div id="category2" class="accordion">
				<h2 class="side-ttl">カテゴリから探す</h2>
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
				<div id="maker2" class="accordion">
					<h2 class="side-ttl">メーカーから探す</h2>
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

				<div id="spec2" class="accordion">
					<h2 class="side-ttl">スペックから探す</h2>
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
				<div id="price2" class="accordion">
					<h2 class="side-ttl">価格帯から探す</h2>
					<ul>
						<li><a href="<?php echo esc_url(home_url()); ?>/products_price">¥10,000以下</a></li>
						<li><a href="#">¥10,001~¥30,000</a></li>
						<li><a href="#">¥30,001~¥50,000</a></li>
						<li><a href="#">¥50,001~¥70,000</a></li>
						<li><a href="#">¥70,001~¥100,000</a></li>
						<li><a href="#">¥100,001~¥200,000</a></li>
						<li><a href="#">¥200,000以上</a></li>
					</ul>
				</div>
			</nav>
			<div id="banners2" class="banners">
				<div class="bn"><a href="<?php echo esc_url(home_url()); ?>/shipping"><img src="<?php echo esc_url(home_url()); ?>/common/images/bn_free-shipping.jpg" width="220" height="90" alt=""></a></div>
				<div class="bn"><a href="<?php echo esc_url(home_url()); ?>/returns"><img src="<?php echo esc_url(home_url()); ?>/common/images/bn_returns.gif" width="220" height="90" alt=""></a></div>
				<div class="bn"><a href="https://fivestarcamera.net/" target="_blank"><img src="<?php echo esc_url(home_url()); ?>/common/images/bn_purchase.jpg" width="220" height="90" alt=""></a></div>
			</div>
			<div id="sns2" class="sns">
				<h2><span class="en">FOLLOW US</span></h2>
				<div class="facebook"><a href="https://www.facebook.com/fivestarcameranet/" target="_blank"><img src="<?php echo esc_url(home_url()); ?>/common/images/ic_facebook.gif" width="36" height="36" alt=""><span>Facebook</span></a><span></span></div>
				<div class="twitter"><a href="https://twitter.com/fivestarcamera" target="_blank"><img src="<?php echo esc_url(home_url()); ?>/common/images/ic_twitter.gif" width="36" height="36" alt=""><span>Twitter</span></a></div>
			</div>
		</aside>
	</div>
