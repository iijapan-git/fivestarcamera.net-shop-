jQuery(document).ready(function(){
	if (!jQuery('#_manage_stock').attr('checked')) {
		jQuery('#_manage_stock').attr('checked', 'checked');
	}
	if ('' === jQuery('#_stock').val() || jQuery('#_stock').val() === '0') {
		jQuery('#inventory_product_data .stock_fields').show();
		jQuery('#_stock').val(1); // 在庫数１
	}
	if (!jQuery('#_sold_individually').attr('checked')) {
		jQuery('#_sold_individually').attr('checked', 'checked');
	}
});
