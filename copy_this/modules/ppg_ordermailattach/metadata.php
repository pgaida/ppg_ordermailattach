<?php
/**
 * Metadata version
 */
$sMetadataVersion = '1.1';
 
/**
 * Module information
 */
$aModule = array(
    'id'           => 'ppg_ordermailattach',
    'title'        => 'Attachement to customer order mail',
    'description'  => array(
        'de' => 'Die Kunden-Bestellbestätigungsmail wird mit einem festgelegten Anhang (zB. AGB und/oder Widerrufsrecht) verschickt.',
        'en' => 'The customer order mail will be sent with an defined attachemend (f.e. terms and conditions).',
    ),
    'thumbnail'    => '',
    'version'      => '0.1',
    'author'       => 'Paul Gaida',
    'url'          => 'http://www.paramente-gaida.de',
    'email'        => 'info@paramente-gaida.de',
    'extend'       => array(
        'oxemail'     => 'ppg_ordermailattach/ppg_ordermailattach',
    ),
    'settings' => array(
        array('group' => 'ppg_main', 'name' => 'ppgOrderMailAttachementDE', 'type' => 'str',  'value' => 'AGB.pdf'),
    ),
);
?>