<?php
/**
 * products/roop
 */

global $post;

// サムネイル
$size = 'column-thumbnail';
$img_url = '';
if (has_post_thumbnail()) {
	$attachment_id = get_post_thumbnail_id();
	$img_src = wp_get_attachment_image_src($attachment_id, $size);
	$img_url = $img_src[0];

// アイキャッチ画像が設定されていない場合に記事の最初の画像を表示する。
} else {
	preg_match('/wp-image-(\d+)/s' , $post->post_content, $thumb);
	if ($thumb) {
		$img_src = wp_get_attachment_image_src($thumb[1], $size);
		$img_url = $img_src[0];
	}
}

if (!$img_url) {
	$img_url = home_url() . "/common/images/noimage.gif";
}

// カテゴリ―名
$category = get_the_category();
if ($category[0]) {
	$category_name = $category[0]->cat_name;
}

// シェア数
$sns_count = 0;
if (function_exists('scc_get_share_total')) {
	$sns_count = scc_get_share_total();
}

?>

	<div class="entry">
		<figure><img src="<?php echo esc_url($img_url); ?>" width="270" height="180" alt=""></figure>
		<div class="block">
			<div class="date"><?php the_time("Y.n.j"); ?></div>
			<h2 class="ttlLev3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p><?php the_excerpt(); ?></p>

<?php
if (isset($category_name)) :
?>
			<div class="info"><span class="category"><?php echo $category_name; ?></span></div>

<?php
endif;
?>

			<div class="sns"><?php echo $sns_count; ?></div>
		</div>
	</div>

