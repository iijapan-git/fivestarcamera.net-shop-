<?php
/**
 * menu guide
 */

global $post;
$active = substr($post->post_name, 0, 4);

?>

	<div class="guide-menu-s column <?php echo esc_attr($active); ?>">
		<ul>
			<li class="paym"><a href="<?php echo esc_url(home_url()); ?>/guide/payment">お支払い方法について</a></li>
			<li class="ship"><a href="<?php echo esc_url(home_url()); ?>/guide/shipping">配送方法・送料について</a></li>
			<li class="retu"><a href="<?php echo esc_url(home_url()); ?>/guide/returns">商品の返品・動作保証について</a></li>
			<li class="memb"><a href="<?php echo esc_url(home_url()); ?>/guide/members">会員・ポイント制度について</a></li>
			<li class="faq"><a href="<?php echo esc_url(home_url()); ?>/guide/faq">よくあるご質問</a></li>
		</ul>
	</div>
