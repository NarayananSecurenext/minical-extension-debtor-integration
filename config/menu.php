<?php 
$module_menu = array(
	array(
		'label' => 'Debtor',
		'location' => 'SECONDARY',
		'parent_menu'=>'Accounting',
		'link' => ''
	),
	array(
		'label' => 'Marketing Segment',
		'location' => 'SECONDARY',
		'parent_menu'=>'Settings',
		'link' => 'marketing-segment'
	),
	array(
		'label' => 'Debtor Master',
		'location' => 'THIRD',
		'parent_menu'=>'Accounting/Debtor',
		'link' => 'debtor'
	),
	array(
		'label' => 'Revenue',
		'location' => 'THIRD',
		'parent_menu'=>'Accounting/Debtor',
		'link' => 'debtor/revenue'
	),
	array(
		'label' => 'Departments',
		'location' => 'THIRD',
		'parent_menu'=>'Accounting/Debtor',
		'link' => 'debtor/department'
	), 
	array(
		'label' => 'Revenue Head',
		'location' => 'THIRD',
		'parent_menu'=>'Accounting/Debtor',
		'link' => 'debtor/revenue_head'
	), 
	array(
		'label' => 'GL Accounts',
		'location' => 'THIRD',
		'parent_menu'=>'Accounting/Debtor',
		'link' => 'debtor/gl_account'
	),   
	array(
		'label' => 'SAC setup',
		'location' => 'THIRD',
		'parent_menu'=>'Accounting/Debtor',
		'link' => 'debtor/sac'
	),   
	array(
		'label' => 'Revenue Charge',
		'location' => 'THIRD',
		'parent_menu'=>'Accounting/Debtor',
		'link' => 'debtor/revenue_charge'
	),
	array(
		'label' => 'Payment 1',
		'location' => 'THIRD',
		'parent_menu'=>'Accounting/Debtor',
		'link' => 'debtor/payment1'
	),   
);
