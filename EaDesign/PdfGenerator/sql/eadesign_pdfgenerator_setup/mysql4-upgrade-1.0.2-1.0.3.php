<?php

$installer = $this;

$installer->startSetup();
/**
 * General fileds
 */
$installer->getConnection()->addColumn($installer->getTable('eadesign/pdfgenerator'), 'pdft_is_active', array(
    'type' => Varien_Db_Ddl_Table::TYPE_SMALLINT,
    'unsigned' => true,
    'nullable' => false,
    'default' => '0',
    'comment' => 'Active setting'
));

$installer->getConnection()->addColumn($installer->getTable('eadesign/pdfgenerator'), 'pdft_default', array(
    'type' => Varien_Db_Ddl_Table::TYPE_SMALLINT,
    'unsigned' => true,
    'nullable' => false,
    'default' => '0',
    'comment' => 'Default setting'
));
/**
 * Header fields
 */
$installer->getConnection()->addColumn($installer->getTable('eadesign/pdfgenerator'), 'pdfth_header', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'unsigned' => true,
    'nullable' => false,
    'default' => '',
    'comment' => 'Header body'
));


/**
 * Footer fields
 */
$installer->getConnection()->addColumn($installer->getTable('eadesign/pdfgenerator'), 'pdftf_footer', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'unsigned' => true,
    'nullable' => false,
    'default' => '',
    'comment' => 'Footer body'
));


/**
 * Css fileds
 */
$installer->getConnection()->addColumn($installer->getTable('eadesign/pdfgenerator'), 'pdft_css', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'unsigned' => true,
    'nullable' => false,
    'default' => '',
    'comment' => 'Css body'
));

/**
 * Settings fields
 */
$installer->getConnection()->addColumn($installer->getTable('eadesign/pdfgenerator'), 'pdftc_customchek', array(
    'type' => Varien_Db_Ddl_Table::TYPE_SMALLINT,
    'unsigned' => true,
    'nullable' => false,
    'default' => '0',
    'comment' => 'Paper custom check'
));

$installer->getConnection()->addColumn($installer->getTable('eadesign/pdfgenerator'), 'pdft_customwidth', array(
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale' => 4,
    'precision' => 12,
    'nullable' => false,
    'default' => '0.0000',
    'comment' => 'Paper custom Width'
));

$installer->getConnection()->addColumn($installer->getTable('eadesign/pdfgenerator'), 'pdft_customheight', array(
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale' => 4,
    'precision' => 12,
    'nullable' => false,
    'default' => '0.0000',
    'comment' => 'Paper custom Height'
));


$installer->getConnection()->addColumn($installer->getTable('eadesign/pdfgenerator'), 'pdftm_top', array(
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale' => 4,
    'precision' => 12,
    'nullable' => false,
    'default' => '0.0000',
    'comment' => 'Paper margins top'
));

$installer->getConnection()->addColumn($installer->getTable('eadesign/pdfgenerator'), 'pdftm_bottom', array(
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale' => 4,
    'precision' => 12,
    'nullable' => false,
    'default' => '0.0000',
    'comment' => 'Paper margins bottom'
));

$installer->getConnection()->addColumn($installer->getTable('eadesign/pdfgenerator'), 'pdftm_left', array(
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale' => 4,
    'precision' => 12,
    'nullable' => false,
    'default' => '0.0000',
    'comment' => 'Paper margins left'
));

$installer->getConnection()->addColumn($installer->getTable('eadesign/pdfgenerator'), 'pdftm_right', array(
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale' => 4,
    'precision' => 12,
    'nullable' => false,
    'default' => '0.0000',
    'comment' => 'Paper margins right'
));


$installer->endSetup();



