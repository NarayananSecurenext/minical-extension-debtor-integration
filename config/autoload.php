<?php 
$config['js-files'] = array(
    array(
        "file" => 'assets/js/debtor.js',
         "location" => array(
           "debtor_integration/index",
           "debtor_integration/update_debtor",
		   
        )
         ),
    array(
    "file" => 'assets/js/multiselect-dropdown/multiselect-dropdown.js',
        "location" => array(
        "debtor_integration/update_debtor",
        "debtor_integration/new-debtor",
        )
        ),
    array(
        "file" => 'https://nightly.datatables.net/js/jquery.dataTables.js',
        "location" => array(
            "debtor_integration/revenue_head",
            "debtor_integration/revenue",
            "debtor_integration/department",
            "debtor_integration/gl_account",
            "debtor_integration/sac",
            "debtor_integration/revenue_charge",
            "debtor_integration/payment1",
        ),
    ),
    array(
        "file" => 'assets/js/revenue_head.js',
        "location" => array(
            "debtor_integration/revenue_head",
        ),
    ),
    array(
        "file" => 'assets/js/revenue.js',
        "location" => array(
            "debtor_integration/revenue",
        ),
    ),
    array(
        "file" => 'assets/js/department.js',
        "location" => array(
            "debtor_integration/department",
        ),
    ),
    array(
        "file" => 'assets/js/gl_account.js',
        "location" => array(
            "debtor_integration/gl_account",
        ),
    ),
    array(
        "file" => 'assets/js/sac.js',
        "location" => array(
            "debtor_integration/sac",
        ),
    ),
    array(
        "file" => 'assets/js/revenue_charge.js',
        "location" => array(
            "debtor_integration/revenue_charge",
        ),
    ),
    array(
        "file" => 'assets/js/payment1.js',
        "location" => array(
            "debtor_integration/payment1",
        ),
    ),
);

$config['css-files'] = array(
    array(
        "file" => 'https://nightly.datatables.net/css/jquery.dataTables.css',
        "location" => array(
            "debtor_integration/revenue_head",
            "debtor_integration/revenue",
            "debtor_integration/department",
            "debtor_integration/gl_account",
            "debtor_integration/sac",
            "debtor_integration/revenue_charge",
            "debtor_integration/payment1",
         ),
    ),
);