<?php
/**
 * tab-special
 */

$args = array(
	'show_count'         => 0,
	'hide_empty'         => 1,
	'title_li'           => false,
	'echo'               => 0,
);
$categories = wp_list_categories($args);

$active = '';
if (is_page('special')) {
	$active = 'current-cat';
}
?>


	<div id="tab-menu" class="">
		<ul class="cf">

			<li class="<?php echo $active; ?>"><a href="https://fivestarcamera.net/column/">すべての記事</a></li>
			<li class="cat-item cat-item-29"><a href="https://fivestarcamera.net/column/category/knowledge/">カメラ基礎知識</a></li>
			<li class="cat-item cat-item-25"><a href="https://fivestarcamera.net/column/category/technique/">撮影テクニック</a></li>
			<li class="cat-item cat-item-26"><a href="https://fivestarcamera.net/column/category/review/">製品レビュー</a></li>
			<li class="cat-item cat-item-27"><a href="https://fivestarcamera.net/column/category/photo/">投稿フォト紹介</a></li>
			<li class="cat-item cat-item-1"><a href="https://fivestarcamera.net/column/category/others/">その他</a></li></ul>

		</ul>
	</div>
