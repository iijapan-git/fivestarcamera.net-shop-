<?php
/**
 * Email Order Items (plain)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/plain/email-order-items.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails/Plain
 * @version     2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

[配送方法] 佐川急便
[伝票番号] <?php the_field('delivery_yupack_code', $order->id); ?>

<?php if (get_field('delivery_scheduled_date', $order->id)) : ?>[出荷予定日] <?php echo date('Y年n月j日', strtotime(get_field('delivery_scheduled_date', $order->id))); endif; ?>

<?php if (get_field('delivery_scheduled_time', $order->id)) : ?>[配送予定時間帯] <?php the_field('delivery_scheduled_time', $order->id); endif; ?>

↓↓詳しい配送状況はこちらからご確認ください
http://k2k.sagawa-exp.co.jp/p/web/okurijosearch.do?okurijoNo=<?php the_field('delivery_yupack_code', $order->id); ?>


