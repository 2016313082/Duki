<?php
class InventariosDoli extends AppModel {
	var $name = 'InventariosDoli';
	var $displayField = 'rowid';
    var $useDbConfig = 'dolibarr';
    public $useTable = 'llxtm_product_stock';
}
?>