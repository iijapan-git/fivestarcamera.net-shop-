<?php
/**
 * The template for displaying product search form
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$keyword = isset($_GET['s']) ? esc_attr($_GET['s']) : null;
$product_cat = isset($_GET['product_cat']) ? esc_attr($_GET['product_cat']) : null;
$maker = isset($_GET['maker']) ? esc_attr($_GET['maker']) : null;
$specs = isset($_GET['spec']) ? $_GET['spec'] : array();
$min_price = isset($_GET['min_price']) ? esc_attr($_GET['min_price']) : null;
$max_price = isset($_GET['max_price']) ? esc_attr($_GET['max_price']) : null;

?>

	<div id="refine-search">
		<p>さまざまな条件から、ファイブスターカメラの商品をお探しいただけます。<br>希望する条件を指定して、商品をお探しください。</p>

		<form id="refine-form" method="get" action="<?php echo esc_url( home_url()); ?>">
			<input name="post_type" value="product" type="hidden">
			<button id="refine-reset" type="reset" class="refine-reset"><span>条件をクリア</span></button>
			<table>
				<tr>
					<th>キーワード</th>
					<td><input type="text" value="<?php echo $keyword; ?>" name="s" id="key" class="sngl" /></td>
				</tr>
				<tr>
					<th>カテゴリ</th>
					<td>
						<select name="product_cat" data-selected="<?php echo $product_cat; ?>">
							<option value=""></option>
							<option value="film-camera">フィルムカメラ</option>
							<option value="range-finder-camera">レンジファインダーカメラ</option>
							<option value="large-format-camera">中判・大判カメラ</option>
							<option value="digital-slr-camera">デジタル一眼レフカメラ</option>
							<option value="mirrorless-slr-camera">ミラーレス一眼カメラ</option>
							<option value="compact-digital-camera">コンパクトデジタルカメラ</option>
							<option value="camera-lens">交換レンズ</option>
							<option value="accessory">アクセサリー</option>
						</select>
					</td>
				</tr>


				<tr>
					<th>メーカー名</th>
					<td>
						<select name="maker" data-selected="<?php echo $maker; ?>">
							<option value=""></option>
							<option value="nikon">Nikon</option>
							<option value="canon">Canon</option>
							<option value="contax">CONTAX</option>
							<option value="leica">Leica</option>
							<option value="minolta">MINOLTA</option>
							<option value="fujifilm">FUJIFILM</option>
							<option value="pentax">PENTAX</option>
							<option value="mamiya">Mamiya</option>
							<option value="bronica">BRONICA</option>
							<option value="ricoh">RICOH</option>
							<option value="voigtlander">Voigtlander</option>
							<option value="olympus">OLYMPUS</option>
							<option value="sigma">SIGMA</option>
							<option value="tamron">TAMRON</option>
							<option value="panasonic">Panasonic</option>
							<option value="sony">SONY</option>
							<option value="hasselblad">HASSELBLAD</option>
							<option value="others">OTHERS</option>
						</select>
					</td>
				</tr>

<?php
// スペックから探す
$spec_fields = function_exists('get_spec_fields') ? get_spec_fields() : null;
if (is_array($spec_fields)) :
?>
				<tr>
					<th>スペック</th>
					<td>
<?php
	foreach($spec_fields as $field) :

		$name = isset($field['name']) ? esc_attr($field['name']) : null;
		if (!$name || substr($name, 0, 5) !== 'spec_') {
			continue;
		}

		$name = (substr($name, 5));
		$label = isset($field['label']) ? esc_attr($field['label']) : null;

		$checked = '';
		if (in_array($name, $specs)) {
			$checked = 'checked="checked"';
		}

?>

	<div class="checkbox"><label><input type="checkbox" name="spec[]" value="<?php echo $name; ?>" <?php echo $checked; ?> /> <?php echo $label; ?></label></div>

<?php
	endforeach;
?>

					</td>
				</tr>

<?php
endif;
?>

				<tr>
					<th>価格帯</th>
					<td>下限 <input type="text" name="min_price" value="<?php echo $min_price; ?>" class="price" /> ～ 上限 <input type="text" name="max_price" value="<?php echo $max_price; ?>" class="price" /></td>
				</tr>
			</table>
			<button type="submit" id="refine-submit" class="refine-submit"><span>この条件で絞り込む</span></button>
		</form>
	</div>
