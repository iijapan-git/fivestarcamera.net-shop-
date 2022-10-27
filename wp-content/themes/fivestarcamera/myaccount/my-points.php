<?php
/**
 * WooCommerce Points and Rewards
 *
 * @package     WC-Points-Rewards/Templates
 * @author      WooThemes
 * @copyright   Copyright (c) 2013, WooThemes
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * My Account - My Points
 */
?>
	<h2>ご利用可能ポイント</h2>

	<p class="mypoint-total"><span class="en mypoint-num"><?php echo $points_balance; ?></span>ポイント(円)</p>

	<h2>利用履歴</h2>

<?php if ( $events ) : ?>
	<table class="mypoint-table">
	<?php foreach ( $events as $event ) : ?>
		<tr>
			<td class="mypoint-detail">
				<div class="date mypoint-date"><?php echo date('Y/m/d', strtotime($event->date)); ?></div>
				<div class="mypoint-title"><?php echo $event->description; ?></div>
			</td>
			<td class="mypoint-reward">
			<?php if ($event->points > 0) : ?>
				<span class="mypoint-symbol">+</span><span class="mypoint-num en"><?php echo $event->points; ?></span><span class="mypoint-label">ポイント</span>

			<?php else : ?>

				<span class="mypoint-symbol minus">-</span><span class="mypoint-num en minus"><?php echo abs($event->points); ?></span><span class="mypoint-label">ポイント</span>
			<?php endif; ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif;
