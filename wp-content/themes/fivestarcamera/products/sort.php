<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

	<div id="sort-menu">
		<h2>並び替え：</h2>
		<ul>

<?php

$parse_url =  parse_url($_SERVER["REQUEST_URI"]);
$current_url = preg_replace ('#/page/[0-9]+#', '', $parse_url['path']);

$current_orderby_query = isset($_GET['orderby']) ? $_GET['orderby'] : "date";

$queries = array();
if (isset($parse_url['query'])) {
	parse_str($parse_url['query'], $queries);
}

$orderby_array = array(
	"date" => "新着順",
	"price" => "価格の安い順",
	"price-desc" => "価格の高い順"
);

foreach ($orderby_array as $key => $value) :

	$queries['orderby'] = $key;
	$url = $current_url . '?' .  http_build_query($queries);

	$active = '';
	if ($key === $current_orderby_query) {
		$active = 'active';
	}
?>
			<li class="<?php echo $active; ?>"><a href="<?php echo esc_url($url); ?>"><?php echo esc_html($value); ?></a></li>

<?php
endforeach;
?>

		</ul>
	</div>