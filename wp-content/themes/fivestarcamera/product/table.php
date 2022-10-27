<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$product_conditions = get_field('product_conditions', $post->ID);
$product_details = get_field('product_details', $post->ID);
?>

	<table>
<?php
	if (is_array($product_conditions)) :
		foreach ($product_conditions as $row) :

			$rank = '';
			if (isset($row['rank']) && $row['rank']) {
				$rank = '<span class="rank">' . $row['rank'] . '</span>';
			}
?>

		<tr>
			<th><?php echo $row['name']; ?></th>
			<td><?php echo $rank ?><?php echo $row['value']; ?></td>
		</tr>

<?php
		endforeach;
	endif;


	if (is_array($product_details)) :
		foreach ($product_details as $row) :
?>

		<tr>
			<th><?php echo $row['name']; ?></th>
			<td><?php echo $row['value']; ?></td>
		</tr>

<?php
		endforeach;
	endif;
?>
	</table>

