<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_orders', $has_orders );

function the_myorder($order) {
?>

			<div class="order">
				<div class="order-header">
					<div class="order-status"><?php echo wc_get_order_status_name($order->get_status()); ?></div>
					<div class="order-date">ご注文日：<span class="num"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></span></div>
					<div class="order-num">ご注文番号：<span class="num"><?php echo '#' . $order->get_order_number(); ?></span></div>

				</div>

				<div class="order-products">

<?php
		foreach ($order->get_items() as $item) :

			$img_url = "";
			$attachment_id = get_post_thumbnail_id($item['product_id']);
			if ($attachment_id) {
				$img_src = wp_get_attachment_image_src($attachment_id, 'shop_catalog');
				$img_url = $img_src[0];
			}
?>
					<div class="order-product">
						<?php if ($img_url) : ?><div class="photo"><img src="<?php echo esc_url($img_url); ?>" alt=""></div><?php endif; ?>
						<div class="detail">
							<div class="name"><?php echo esc_html($item['name']); ?></div>
							<div class="price price"><?php echo wc_price((float) $item['line_subtotal'] + (float) $item['line_subtotal_tax']); ?></div>
							<?php if ($item['qty'] > 1) :?><div class="qty">数量：<?php echo $item['qty']; ?></div><?php endif; ?>

							<div class="review">
<?php
			if ($order->get_status() === 'completed') {
				echo '<a href="' . esc_url(home_url()) . '/review?product_id=' . esc_attr($item['product_id']) . '" class="button" target="_blank">レビューを書く</a>';
			}
?>
							</div>
						</div>
					</div>

<?php
		endforeach;
?>
				</div>


<?php
		// 支払方法
		$order_method = '';
		if (isset(wc_get_payment_gateway_by_order($order)->title)) {
			$order_method = wc_get_payment_gateway_by_order($order)->title;
		}
?>
				<div class="order-footer">
					<div class="order-method">支払方法： <span class="method"><?php echo esc_html($order_method); ?></span></div>
					<div class="order-total">合計： <span class="price"><?php echo $order->get_formatted_order_total(); ?></span></div>
					<div class="order-actions">
<?php
		$actions = array(
			'pay'    => array(
				'url'  => $order->get_checkout_payment_url(),
				'name' => __( 'Pay', 'woocommerce' )
			),
			'view'   => array(
				'url'  => $order->get_view_order_url(),
				'name' => __( 'View', 'woocommerce' )
			),
			'cancel' => array(
				'url'  => $order->get_cancel_order_url( wc_get_page_permalink( 'myaccount' ) ),
				'name' => __( 'Cancel', 'woocommerce' )
			)
		);

		if ( ! $order->needs_payment() ) {
			unset( $actions['pay'] );
		}

		if ( ! in_array( $order->get_status(), apply_filters( 'woocommerce_valid_order_statuses_for_cancel', array( 'pending', 'failed' ), $order ) ) ) {
			unset( $actions['cancel'] );
		}

		if ( $actions = apply_filters( 'woocommerce_my_account_my_orders_actions', $actions, $order ) ) {
			foreach ( $actions as $key => $action ) {
				echo '<a href="' . esc_url( $action['url'] ) . '" class="button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
			}
		}
?>
					</div>
				</div>
			</div>
<?php
}
?>


<?php if ($has_orders ) : ?>

<?php
	$before_delivery_orders = array();
	$after_delivery_orders = array();
	foreach ($customer_orders->orders as $customer_order) {
		$order = wc_get_order($customer_order);

		if ($order->get_status() === 'cancelled') {

		} elseif ($order->get_status() === 'completed') {
			$after_delivery_orders[] = $customer_order;

		} else {
			$before_delivery_orders[] = $customer_order;

		}
	}
?>


<?php
if ($before_delivery_orders) :
?>

	<div class="myorders">
		<h2>発送前商品</h2>

		<div class="orders">
<?php
	foreach ($before_delivery_orders as $customer_order) :
		$order = wc_get_order($customer_order);

		the_myorder($order);

	endforeach;
?>

		</div>
	</div>
<?php
endif;
?>


<?php
if ($after_delivery_orders) :
?>

	<div class="myorders">
		<h2>発送済み商品</h2>

		<div class="orders">
<?php
	foreach ($after_delivery_orders as $customer_order) :
		$order = wc_get_order($customer_order);

		the_myorder($order);

	endforeach;
?>

		</div>
	</div>
<?php
endif;
?>


	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php _e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( $current_page !== intval( $customer_orders->max_num_pages ) ) : ?>
				<a class="woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php _e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>

	<div class="woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php _e( 'Go Shop', 'woocommerce' ) ?>
		</a>
		<?php _e( 'No order has been made yet.', 'woocommerce' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>

