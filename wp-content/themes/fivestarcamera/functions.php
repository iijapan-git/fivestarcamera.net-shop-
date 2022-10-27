<?php
/**
 * function
 */


add_theme_support( 'woocommerce' );

add_image_size('column', 700, 350, true);
add_image_size('column-thumbnail', 420, 320, true);
/* add_image_size('top-banner', 780, 1024, false); */

$catalog = array(
	'width' 	=> '540',
	'height'	=> '360',
	'crop'		=> 1
);

// update_option( 'shop_catalog_image_size',  $catalog );
// update_option( 'shop_single_image_size',  array(0,0,0) );
// update_option( 'shop_thumbnail_image_size',  array(0,0,0) );


if ( ! isset( $content_width ) ) {
	$content_width = 700; /* pixels */
}

// カレンダーウィジェットの登録
register_sidebar( array(
	'name'        => 'Widget-BizCalendar',
	'id'          => 'Widget-BizCalendar',
	'description' => 'Biz Calendarのウィジットエリアです。',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
) );

// 脆弱なパスワードを許可
function ez_sparrow_remove_password_strength() {
	if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
		wp_dequeue_script( 'wc-password-strength-meter' );
	}
}
add_action( 'wp_print_scripts', 'ez_sparrow_remove_password_strength', 100 );

// 管理バーの項目を非表示
function remove_admin_bar_menu($wp_admin_bar) {
	$wp_admin_bar->remove_menu('wp-logo'); // WordPressシンボルマーク
	//$wp_admin_bar->remove_menu('my-account'); // マイアカウント
}
add_action('admin_bar_menu', 'remove_admin_bar_menu', 70);


// 管理バーのヘルプメニューを非表示にする
function my_admin_head() {
	echo '<style type="text/css">#contextual-help-link-wrap{display:none;}</style>';
}
add_action('admin_head', 'my_admin_head');


// 管理バーにログアウトを追加
function add_new_item_in_admin_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu(array(
		'id' => 'new_item_in_admin_bar',
		'title' => __('ログアウト'),
		'href' => wp_logout_url()
	));
}
add_action('wp_before_admin_bar_render', 'add_new_item_in_admin_bar');

// 管理画面にadmin.cssを追加
function add_admin_style() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo("template_directory").'/css/admin.css">';
  }
  add_action('admin_print_styles', 'add_admin_style');

// ログイン画面にlogin.cssを追加
function login_css() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo("template_directory").'/login/login.css">';
}
add_action('login_head', 'login_css');


function get_my_container_class_name() {
	global $post;
	$class_name = '';
	if (is_front_page()) {
		$class_name .= "home ";
	}
	elseif (is_search() || is_page('refine')) {
		$class_name .= "refi ";
	}
	elseif (is_post_type_archive('product') || is_tax() || is_page('new') || is_page('recommend')) {
		$class_name .= "prod ";
	}
	elseif (is_post_type_archive('voice') || is_singular('voice')) {
		$class_name .= "voic ";
	}
	elseif (is_post_type_archive('info') || is_singular('info')) {
		$class_name .= "info ";
	}
	elseif (is_archive()) {
		$class_name .= "spcl ";
	}
	elseif (is_singular('product')) {
		$class_name .= "prod detail ";
	}
	elseif (is_singular('post')) {
		$class_name .= "spcd ";
	}
	elseif (is_page()) {
		if (is_page('review')) {
			$class_name .= "cont ";
		}

		if (is_page('special')) {
			$class_name .= "spcl ";
		} else {
			$class_name .= substr($post->post_name, 0, 4) . ' ';
		}
		
	}

	return $class_name;
}

// パンくずリスト
function get_my_breadcrumb() {
	$home_title = 'ホーム'; 
	$home_url = home_url();

	// $news_title = 'ニュース イベント情報';
	// $news_url = home_url() . '/news';
	// $news_tax = 'event-category';

	function the_crumb($url, $title) {
		$crumb = '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">'."\n";
		if ($url) {
			$crumb .= '	<a href="'.esc_url($url). '" itemprop="url"><span itemprop="title">'.esc_html($title).'</span></a>'."\n";
			$crumb .= '</li>'."\n";
		} else {
			$crumb .= '	<span itemprop="title">'.esc_html($title).'</span>'."\n";
			$crumb .= '</li>'."\n";
		}
		return $crumb;
	}

	function page_crumb($page, $output = '') {
		if ($page->post_parent) {
			$parent = get_post($page->post_parent);
			$output = the_crumb( home_url().'/'.$parent->post_name, $parent->post_title) . $output;
			return page_crumb($parent, $output);
		} else {
			return $output . the_crumb('', get_the_title());
		}
	}

	$output = "\n" . '<nav id="breadcrumb" class="breadcrumb"><ol>' .  "\n";
	$output .= the_crumb($home_url, $home_title);
	global $post;

	if (is_front_page()) {
		return;
	}

	// 固定ページ
	elseif (is_page()) {
		$output .= page_crumb($post);
	}

	// 商品紹介
	elseif (get_query_var('product_cat') && !get_query_var('maker')) {
		$term = get_queried_object();
		$output .= the_crumb('', $term->name);
	}
	elseif (get_query_var('maker') && !get_query_var('product_cat')) {
		$term = get_queried_object();
		$output .= the_crumb('', $term->name . ' ' . $term->description);
	}
	elseif (get_query_var('maker') && get_query_var('product_cat')) {
		// カテゴリー名
		$cat_term = get_queried_object();
		$output .= the_crumb(get_term_link($cat_term), $cat_term->name);

		// メーカー名
		$maker_term = get_term_by('slug', get_query_var('maker'), 'maker');
		$output .= the_crumb('', $maker_term->name . ' ' . $maker_term->description);
	}
	elseif (is_post_type_archive('product')) {
		$output .= the_crumb('', '商品一覧');
	}
	elseif (is_singular('product')) {
		$cat_terms = get_the_terms($post->ID, 'product_cat');
		if (isset($cat_terms[0])) {
			$output .= the_crumb(get_term_link($cat_terms[0]), $cat_terms[0]->name);
		}

		$maker_terms = get_the_terms($post->ID, 'maker');
		if (isset($maker_terms[0])) {
			$output .= the_crumb(get_term_link($maker_terms[0]), $maker_terms[0]->name . ' ' . $maker_terms[0]->description);
		}

		$post_title = get_the_title();
		if (mb_strlen(strip_tags($post_title)) > 60) {
			$post_title = mb_substr(strip_tags($post_title), 0, 60) . '…';
		} else {
			$post_title = mb_substr(strip_tags($post_title), 0, 60);
		}
		$output .= the_crumb('', $post_title);
	}
	elseif (is_post_type_archive('voice') || is_singular('voice')) {
		$output .= the_crumb('', 'お客様の声');
	}
	elseif (is_post_type_archive('info') || is_singular('info')) {
		$output .= the_crumb('', 'お知らせ');
	}

	elseif (is_singular('post')) {
		$output .= the_crumb(home_url() . "/special", '特集・コラム');

		$post_title = get_the_title();
		if (mb_strlen(strip_tags($post_title)) > 60) {
			$post_title = mb_substr(strip_tags($post_title), 0, 60) . '…';
		} else {
			$post_title = mb_substr(strip_tags($post_title), 0, 60);
		}
		$output .= the_crumb('', $post_title);
	}
	elseif (is_category()) {
		$output .= the_crumb(home_url() . "/special", '特集・コラム');

		$cat = get_queried_object();
		$output .= the_crumb('', $cat->name);
	}

	// 検索結果
	elseif (is_search()) {
		$output .= the_crumb('', '検索結果');
	}

	else {
		$output .= the_crumb('', get_the_title());
	}
	$output .= "</ol></nav>\n";
	return $output;
}

add_action( 'woocommerce_validate_postcode', 'check_postcode', 10, 3);
function check_postcode($valid, $postcode, $country){
	if ($country === 'JP') {
		$valid = (bool) preg_match( '/^([0-9]{3})([-])?([0-9]{4})$/', $postcode );
	}
	return $valid;
}

// 抜粋の文字数調整
function my_excerpt_length($length) {
	return 90;
}
add_filter('excerpt_length', 'my_excerpt_length');

// 抜粋の省略文字
function my_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'my_excerpt_more');

// ビジュアルエディタの自動整形を解除
function override_mce_options($init_array) {
	if (get_post_type() === 'page') {
		global $allowedposttags;
		$init_array['valid_elements']          = '*[*]';
		$init_array['extended_valid_elements'] = '*[*]';
		$init_array['valid_children']          = '+a[' . implode('|', array_keys($allowedposttags)) . ']';
		$init_array['indent']                  = true;
		$init_array['wpautop']                 = false;
	}
	return $init_array;
}
add_filter('tiny_mce_before_init', 'override_mce_options');


//自動生成するpタグやbrタグを固定ページだけ取り除く
remove_filter('the_content','wpautop');
add_filter('the_content','custom_content');
function custom_content($content){
	if (get_post_type() === 'page') {
		return $content;
	}
	return wpautop($content);
}


// if (is_page()) {
// 	remove_filter('the_excerpt', 'wpautop');
// 	remove_filter('the_content', 'wpautop');
// }

// SNSボタン出力
function get_my_sns_buttons() {
	$html = '<ul class="sns-buttons">' . "\n";
	$html .= '<li class="sns-facebook"><div class="fb-like" data-href="' . get_the_permalink() . '" data-layout="button_count" data-show-faces="false" data-share="false" data-send="true"></div></li>' . "\n";
	$html .= '<li class="sns-twitter"><a href="http://twitter.com/share" class="twitter-share-buttoon" data-url="' . get_the_permalink() . '" data-text="'  . get_the_title() . '" data-count="horizontal" data-lang="ja">ツイート</a></li>';

	// if (function_exists('is_multi_device')) {
	// 	if (is_multi_device('smart') || is_multi_device('tablet') || is_multi_device('mobile') || is_multi_device('game')) {
	// 		$html .= '<li class="sns-line"><a href="http://line.me/R/msg/text/?' . get_the_title() . '%0D%0A' . get_the_permalink() . '"><img src="' .  esc_url(home_url()) . '/common/images/line88x20.png" width="88" height="20" alt="LINEで送る" title="LINEで送る"></a></li>'. "\n";
	// 	}
	// }

	$html .=  '</ul>' . "\n";
	return $html;
}

// 商品ページのパーマリンクをIDに変更
add_filter('post_type_link', 'product_post_link', 1, 3);
function product_post_link( $link, $post = 0 ) {
	if ( $post->post_type == 'product' ){
		return home_url( 'product/' . $post->ID );
	} else {
		return $link;
	}
}
add_action( 'init', 'rewrite_product_post_url' );
function rewrite_product_post_url() {
	add_rewrite_rule(
		'product/([0-9]+)?$',
		'index.php?post_type=product&p=$matches[1]',
		'top' );
}

// お知らせページのパーマリンクをIDに変更
add_filter('post_type_link', 'info_post_link', 1, 3);
function info_post_link( $link, $post = 0 ) {
	if ( $post->post_type == 'info' ){
		return home_url( 'info/' . $post->ID );
	} else {
		return $link;
	}
}
add_action( 'init', 'rewrite_info_post_url' );
function rewrite_info_post_url() {
	add_rewrite_rule(
		'info/([0-9]+)?$',
		'index.php?post_type=info&p=$matches[1]',
		'top' 
	);
}

// お客様の声ページのパーマリンクをIDに変更
add_filter('post_type_link', 'voice_post_link', 1, 3);
function voice_post_link( $link, $post = 0 ) {
	if ( $post->post_type == 'voice' ){
		return home_url( 'voice/' . $post->ID );
	} else {
		return $link;
	}
}
add_action( 'init', 'rewrite_voice_post_url' );
function rewrite_voice_post_url() {
	add_rewrite_rule(
		'voice/([0-9]+)?$',
		'index.php?post_type=voice&p=$matches[1]',
		'top'
	);
}



function my_admin_style() {
	wp_enqueue_style( 'my_admin_style', get_template_directory_uri().'/style-admin.css' );
}
add_action( 'admin_enqueue_scripts', 'my_admin_style' );


function get_rank_array() {
	return array(
		'n' => '新品・未使用品',
		's' => '使用感のない、新品に近い状態',
		'a' => '使用感の少ない、非常に良い状態',
		'a2' => '同型中古品として一般的な状態',
		'b' => '使用感があるが、問題なく動作する状態',
		'b2' => '使用感が目立つが、問題なく動作する状態',
		'c' => '一部動作・機能に難がある状態',
		'j' => '動作未確認・故障品',
	);
}

function get_my_product_rank($rank = null) {
	$rank_array = get_rank_array();

	if (!$rank || !isset($rank_array[$rank])) {
		return '';
	}

	$output = '<div id="rank">'. "\n";
	$output .= '<p class="rank-' . $rank . '">' . $rank_array[$rank] . '</p>'. "\n";
	$output .= '</div>'. "\n";

	return $output;
}


function get_my_product_rank_list($rank = null) {
	$rank_array = get_rank_array();

	$output = '<div id="rank-list" class="rank-' . $rank . '">' . "\n";
	$output .= '<ul>'. "\n";

	foreach ($rank_array as $key => $value) {
		$active = '';
		if ($key === $rank) {
			$active = ' active';
		}
		$output .= '<li class="rank-' . $key . $active . '">' . $value . '</li>' . "\n";
	}

	$output .= '</ul>'. "\n";
	$output .= '</div>'. "\n";

	return $output;
}


// 商品コンディション投稿画面
add_filter('acf/load_value/name=product_conditions', 'afc_load_product_conditions_value', 10, 3);
function afc_load_product_conditions_value($value, $post_id, $field) {
	if (get_post_status($post_id) === 'auto-draft' && $value === false) {
		$value = 3;
		add_filter('acf/load_value/key=field_57f616e8449ff', 'afc_load_condition_value', 10);
	}

	return $value;
}

global $condition_counter;
$condition_counter = -1;
function afc_load_condition_value($value) {
	$values = array(
		'外観', '光学', '動作',
	);
	global $condition_counter;
	$condition_counter++;

	return $values[$condition_counter];
}

// 商品詳細投稿画面
add_filter('acf/load_value/name=product_details', 'afc_load_product_details_value', 10, 3);
function afc_load_product_details_value($value, $post_id, $field) {
	if (get_post_status($post_id) === 'auto-draft' && $value === false) {
		$value = 4;
		add_filter('acf/load_value/key=field_57f4add887ddd', 'afc_load_detail_value', 10);
	}

	return $value;
}

global $detail_counter;
$detail_counter = -1;
function afc_load_detail_value($value) {
	$values = array(
		'メーカー', '付属品', 'シリアルナンバー', '備考'
	);
	global $detail_counter;
	$detail_counter++;

	return $values[$detail_counter];
}


// スペックフィールド一覧を取得
function get_spec_fields() {
	$fields = apply_filters('acf/field_group/get_fields', array(), 33);
	return $fields;
}


// query_varsに追加
add_filter('query_vars', 'add_query_vars');
function add_query_vars($query_vars) {
	$query_vars[] = 'spec';
	$query_vars[] = 'type';
	return $query_vars;
}

function pre_get_product_posts($query) {
	if (!is_admin() && $query->is_main_query()) {

		if (isset($query->query_vars['type'])) {
			if (!isset($query->query_vars['post_type']) || $query->query_vars['post_type'] !== 'product') {
				return;
			}

			if ($query->query_vars['type'] === 'new') {
				$new_period = '-' . get_new_product_period() . ' day';
				$date_query[] = array(
					'after' => $new_period
				);
				$query->set('date_query', $date_query);

			} elseif ($query->query_vars['type'] === 'recommend') {
				$meta_query['featured'] = array(
					'key' => '_featured',
					'value' => 'yes',
					'compare' => '='
				);
				$query->set('meta_query', $query->query_vars['meta_query'] + $meta_query);
			}
		}

		// meta_query
		if (isset($query->query_vars['spec'])) {
			if (!isset($query->query_vars['post_type']) || $query->query_vars['post_type'] !== 'product') {
				return;
			}

			$meta_query = array(
				'relation' => 'AND'
			);

			if (is_array($query->query_vars['spec'])) {
				foreach ($query->query_vars['spec'] as $key => $value) {
					$meta_query[$key] = array(
						'key' => esc_attr('spec_' . $value),
						'value' => 'yes',
						'compare' => '=',
					);
				}

			} elseif (is_string($query->query_vars['spec'])) {
				$meta_query[0] = array(
					'key' => esc_attr('spec_' . $query->query_vars['spec']),
					'value' => 'yes',
					'compare' => '=',
				);
			}

			$query->set('meta_query', $query->query_vars['meta_query'] + $meta_query);
		}

		// tax_query
		if (isset($query->query_vars['product_cat']) && isset($query->query_vars['maker']) && $query->query_vars['product_cat'] && $query->query_vars['maker']) {
			$tax_query = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'product_cat',
					'field' => 'slug',
					'terms' => $query->query_vars['product_cat']
				),
				array(
					'taxonomy' => 'maker',
					'field' => 'slug',
					'terms' => $query->query_vars['maker']
				),
			);

			$query->set('tax_query', $tax_query);
		}

		// 検索ソート順カスタマイズ
		if ($query->is_search() || $query->is_post_type_archive('product') || !empty($query->query_vars['product_cat']) || !empty($query->query_vars['maker'])) {
			$stock_meta_query = array(
				'relation' => 'AND',
				'meta._stock_status.value' => array(
					'key' => '_stock_status',
					'compare' => 'EXISTS',
				)
			);
			$query->set('meta_query', $query->query_vars['meta_query'] + $stock_meta_query);

			$orderby = $query->query_vars['orderby'];
			$order = mb_strtolower($query->query_vars['order']);
			if ($orderby === 'meta._price.long date') {
				$query->set('orderby', array('meta._stock_status.value' => 'asc', 'meta._price.long' => $order));

			} elseif ($orderby === 'meta_value_num ID') {
				$query->set('orderby', array('meta._stock_status.value' => 'asc', 'meta_value_num' => $order));

			} elseif ($orderby === 'date' || $orderby === 'date ID') {
				$query->set('orderby', array('meta._stock_status.value' => 'asc', 'date' => $order));

			} else {
				$query->set('orderby', array('meta._stock_status.value' => 'asc', 'date' => 'desc'));
			}
		}

	}
}
add_action('pre_get_posts', 'pre_get_product_posts', 20, 1);



function is_new_product($date_u) {
	$target_u = strtotime('-' . get_new_product_period() . ' day');
	return ($date_u > $target_u);
}

function get_new_product_period() {
	return 7;
}


// お客様の声評価を取得
function get_voice_star($star = 0) {
	$output = '';
	for ($i = 0; $i < $star; $i++) {
		$output .= '★';
	}
	return $output;
}

// contact form7 値引き渡し（レビュー）
function my_form_tag_filter($tag){
	if (!is_array($tag)) {
		return $tag;
	}

	$name = $tag['name'];

	if (is_user_logged_in()) {
		if (isset($_GET['product_id'])) {
			if ($name == 'product_name') {
				$title = get_the_title((int)esc_attr($_GET['product_id']));
				if ($title) {
					$tag['values'] = (array) esc_attr($title);
				}
			}
		}

		$user = wp_get_current_user();
		if ($name == 'login_email') {
			$tag['values'] = (array) $user->get('user_email');
		}
	}

	return $tag;
}
add_filter('wpcf7_form_tag', 'my_form_tag_filter');

// contact form7 値引き渡し（お問い合わせ）
function my_form_tag_filter_inquiry($tag) {
	if (!is_array($tag)) {
		return $tag;
	}

	$name = $tag['name'];

	if (isset($_GET['productid'])) {

		if ($name == 'hidden-url') {
			$url = get_permalink((int)esc_attr($_GET['productid']));
			if ($url) {
				$tag['values'] = (array) esc_attr($url);
			}
		}

		if ($name == 'text-product') {
			$title = get_the_title((int)esc_attr($_GET['productid']));
			if ($title) {
				$tag['values'] = (array) esc_attr($title);
			}
		}
	}
	return $tag;
}
add_filter('wpcf7_form_tag', 'my_form_tag_filter_inquiry');

// customer権限でログインしているかどうか
function is_customer() {
	if (!is_user_logged_in()) {
		return false;
	}

	$roles =  get_user_roles_by_id(get_current_user_id());
	return array_key_exists('customer', $roles);
}

function get_user_roles_by_id($id) {
	$user = new WP_User($id);

	if (empty($user->roles) || !is_array($user->roles)) {
		return array();
	}

	$wp_roles = new WP_Roles;
	$names    = $wp_roles->get_names();
	$out      = array();

	foreach ($user->roles as $role) {
		if (isset($names[$role])) {
			$out[$role] = $names[$role];
		}
	}

	return $out;
}


function get_my_member_price($id = 0) {
	if (!$id) {
		return '';
	}

	$instance = get_price_by_role_instance();
	$product = wc_get_product($id);

	// 割引を無視するにチェックが入っているとき
	if ($instance->isIgnoreDiscountForProduct()) {
		$price = get_product_prices($id);
		if (isset($price['customer']) && $price['customer']) {
			return $price['customer'];
		} else {
			return $product->get_price();
		}
	}


	$settings = $instance->getOptions('settings');
	if (
		isset($settings['discountByRoles']['customer']['value']) &&
		isset($settings['discountByRoles']['customer']['type']) &&
		isset($settings['discountByRoles']['customer']['priceType']) &&
		$settings['discountByRoles']['customer']['type'] === '0' &&
		$settings['discountByRoles']['customer']['priceType'] === 'regular'
	) {

		$discount = $settings['discountByRoles']['customer']['value'];
		return round($product->get_regular_price() * ((100 - $discount) / 100));

	} else {
		return $product->get_price();
	}
}

// 配送完了メールに追跡番号などの情報を追加する
function add_email_delivery_info($order) {

	if ($order->get_status() === 'completed' && get_field('delivery_yupack_code', $order->id)) {
		include get_template_directory() . '/woocommerce/emails/plain/email-delivery-info.php';
	}

}
add_action( 'woocommerce_email_before_order_table', 'add_email_delivery_info');


// 商品投稿ページで在庫数の設定をデフォルトで行う
function wc_default_stock_quantity() {
	global $pagenow, $woocommerce;

	$screen = get_current_screen();

	if ( $pagenow == 'post-new.php' && $screen->post_type == 'product' ) {
		wp_enqueue_script( 'my_admin_script', get_template_directory_uri().'/js/set_default_stock_quantity.js', '', '', true);
	}
}
add_action('admin_enqueue_scripts', 'wc_default_stock_quantity');


/**
 * function to return an undo unsbscribe string for MailPoet newsletters
 * you could place it in the functions.php of your theme
 * @return string
 */
function mpoet_get_undo_unsubscribe(){
	if(class_exists('WYSIJA') && !empty($_REQUEST['wysija-key'])){
		$undo_paramsurl = array(
			'wysija-page' => 1,
			'controller'  => 'confirm',
			'action'      => 'undounsubscribe',
			'wysija-key'  => $_REQUEST['wysija-key']
		);

		$model_config = WYSIJA::get('config','model');
		$link_undo_unsubscribe = WYSIJA::get_permalink($model_config->getValue('confirmation_page'),$undo_paramsurl);
		$undo_unsubscribe = '<a class="button" href="'.$link_undo_unsubscribe.'">配信停止を取り消す</a>';
		return $undo_unsubscribe;
	 }
	return '';
}
add_shortcode('mailpoet_undo_unsubscribe', 'mpoet_get_undo_unsubscribe');


// お届け時間帯指定
function add_delivery_time_form_checkout_page($checkout) {
	include get_template_directory() . '/checkout/form-delivery-time.php';
}
add_action('woocommerce_after_checkout_billing_form', 'add_delivery_time_form_checkout_page', 1, 1);

function save_delivery_time_after_checkout($order_id) {
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $order_id;
	}

	if(isset($_POST['delivery_time']))
	{
		return update_post_meta($order_id, '_delivery_time', $_POST['delivery_time']);
	}
}
add_action('woocommerce_checkout_order_processed', 'save_delivery_time_after_checkout');

function add_delivery_time_after_billing_address() {
	global $post;
	$delivery_time = get_post_meta($post->ID, '_delivery_time' , true);
?>

	<p class="form-row form-row form-row-wide">
		配送希望時間帯：<?php echo esc_html($delivery_time); ?>
	</p>

<?php
}
add_action('woocommerce_admin_order_data_after_billing_address', 'add_delivery_time_after_billing_address');


function my_bizcalendar_options() {
	return 'edit_pages';
}
add_filter( 'option_page_capability_bizcalendar_options', 'my_bizcalendar_options' );
