<?php
	
$extension_route['debtor'] = 'debtor_integration/index';
$extension_route['new-debtor'] = 'debtor_integration/update_debtor';
$extension_route['save-debtor'] = 'debtor_integration/save_debtor';
$extension_route['update-debtor/(:any)'] = 'debtor_integration/update_debtor/$1';
$extension_route['status-debtor'] = 'debtor_integration/status_debtor';
$extension_route['save_customer'] = 'debtor_integration/save_customer';

$extension_route['marketing-segment'] = 'debtor_integration/marketing_segment';

$extension_route['new-marketing-segment'] = 'debtor_integration/get_new_marketing_segment_div';


$extension_route['update-marketing-segment'] = 'debtor_integration/update_marketing_segment';

// revenue head start

$extension_route['debtor/revenue_head'] = 'debtor_integration/revenue_head';


$extension_route['debtor/add_revenue_head'] = 'debtor_integration/add_revenue_head';


$extension_route['debtor/get_edit_revenue_head/(:any)'] = 'debtor_integration/get_edit_revenue_head/$1';

$extension_route['debtor/update_revenue_head'] = 'debtor_integration/update_revenue_head';


$extension_route['debtor/delete_revenue_head/(:any)'] = 'debtor_integration/delete_revenue_head/$1';


// revenue head end


// revenue start

$extension_route['debtor/revenue'] = 'debtor_integration/revenue';


$extension_route['debtor/add_revenue'] = 'debtor_integration/add_revenue';


$extension_route['debtor/get_edit_revenue/(:any)'] = 'debtor_integration/get_edit_revenue/$1';

$extension_route['debtor/update_revenue'] = 'debtor_integration/update_revenue';


$extension_route['debtor/delete_revenue/(:any)'] = 'debtor_integration/delete_revenue/$1';


// revenue end

// department start

$extension_route['debtor/department'] = 'debtor_integration/department';


$extension_route['debtor/add_department'] = 'debtor_integration/add_department';


$extension_route['debtor/get_edit_department/(:any)'] = 'debtor_integration/get_edit_department/$1';

$extension_route['debtor/update_department'] = 'debtor_integration/update_department';


$extension_route['debtor/delete_department/(:any)'] = 'debtor_integration/delete_department/$1';


// department end


// gl_account start

$extension_route['debtor/gl_account'] = 'debtor_integration/gl_account';


$extension_route['debtor/add_gl_account'] = 'debtor_integration/add_gl_account';


$extension_route['debtor/get_edit_gl_account/(:any)'] = 'debtor_integration/get_edit_gl_account/$1';

$extension_route['debtor/update_gl_account'] = 'debtor_integration/update_gl_account';


$extension_route['debtor/delete_gl_account/(:any)'] = 'debtor_integration/delete_gl_account/$1';


// gl_account end

// sac start

$extension_route['debtor/sac'] = 'debtor_integration/sac';


$extension_route['debtor/add_sac'] = 'debtor_integration/add_sac';


$extension_route['debtor/get_edit_sac/(:any)'] = 'debtor_integration/get_edit_sac/$1';

$extension_route['debtor/update_sac'] = 'debtor_integration/update_sac';


$extension_route['debtor/delete_sac/(:any)'] = 'debtor_integration/delete_sac/$1';


// sac end

// revenue_charge start

$extension_route['debtor/revenue_charge'] = 'debtor_integration/revenue_charge';


$extension_route['debtor/add_revenue_charge'] = 'debtor_integration/add_revenue_charge';


$extension_route['debtor/get_edit_revenue_charge/(:any)'] = 'debtor_integration/get_edit_revenue_charge/$1';

$extension_route['debtor/update_revenue_charge'] = 'debtor_integration/update_revenue_charge';


$extension_route['debtor/delete_revenue_charge/(:any)'] = 'debtor_integration/delete_revenue_charge/$1';


// revenue_charge end

// payment1 start

$extension_route['debtor/payment1'] = 'debtor_integration/payment1';


$extension_route['debtor/add_payment1'] = 'debtor_integration/add_payment1';


$extension_route['debtor/get_edit_payment1/(:any)'] = 'debtor_integration/get_edit_payment1/$1';

$extension_route['debtor/update_payment1'] = 'debtor_integration/update_payment1';


$extension_route['debtor/delete_payment1/(:any)'] = 'debtor_integration/delete_payment1/$1';


// payment1 end