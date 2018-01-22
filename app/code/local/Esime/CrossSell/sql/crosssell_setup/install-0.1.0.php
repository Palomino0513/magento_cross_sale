<?php

$installer = $this;
$installer->startSetup();

if($installer->getConnection()->isTableExists($installer->getTable('crosssell_bestsellers'))){
	$installer->getConnection()->dropTable($installer->getTable('crosssell_bestsellers'));
}

$table = $installer->getConnection()
    ->newTable($installer->getTable('crosssell_bestsellers'))
        ->addColumn('id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'identity' => true,
            'nullable' => false,
            'primary' => true,
        ), 'best seller id')
        ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'nullable' => false,
        ))
        ->setComment('Best Sellers Table');

$installer->getConnection()->createTable($table);
$installer->endSetup();
