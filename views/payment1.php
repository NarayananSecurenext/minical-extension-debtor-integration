<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-diskette text-success"></i>
            </div>
            <div><?php echo l('Debtor / Payment 1'); ?></div>
        </div>
    </div>
</div>

<div class="main-card card">
    <div class="card-body">
        <div>
            <button class="pull-right btn btn-primary" id="add_payment1_button">Add Payment 1</button>
        </div>
        <br /><br>
        <table id="post_list" class="display" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Description</th>
                    <th class="text-center">Charge Code</th>
                    <th class="text-center">Payment mode</th>
                    <th class="text-center">Transfer to debtor</th>
                    <th class="text-center">Non Rooms Account</th>
                    <th class="text-center">Debtor Account</th>
                    <th class="text-center">Not in use</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($posts) && $posts):
                    foreach ($posts as $post):
                        if (isset($post['post_id'])):
                ?>
                <tr class=''>
                    <td class="text-center">
                        <?php
                        $payment_description ='';
                        $payment_id = isset(get_post_meta($post['post_id'], 'payment', true)['meta_value']) ? get_post_meta($post['post_id'], 'payment', true)['meta_value'] : '';  
                        if ($payment_id && isset($payment_id) && $payment_id != '') {


                            if (isset($payment_type_list) && $payment_type_list){
                                $payment_description = $payment_type_list[$payment_id];
                            }

                           

                                
                                echo $payment_description; 
                                // exit;
                        }
                        ?>

                    </td>
                    <td class="text-center">
                    <?php
                        $charge_description ='';
                        $charge_id = isset(get_post_meta($post['post_id'], 'charge', true)['meta_value']) ? get_post_meta($post['post_id'], 'charge', true)['meta_value'] : '';  
                        if ($charge_id && isset($charge_id) && $charge_id != '') {


                            if (isset($charge_list) && $charge_list){
                                $charge_description = $charge_list[$charge_id];
                            }

                           

                                
                                echo $charge_description; 
                                // exit;
                        }
                        ?>

                    </td>


                    <td class="text-center">
                        <?php  
                        
                        
                     $payment_mode =   isset(get_post_meta($post['post_id'], 'payment_mode', true)['meta_value']) ? get_post_meta($post['post_id'], 'payment_mode', true)['meta_value'] : ''; 


                    switch ($payment_mode) {
                        case '1':
                            echo "Cash";
                            break;
                        case '2':
                            echo "Credit Card";
                            break;
                        case '3':
                            echo "Debtor Amount";
                            break;
                        case '4':
                            echo "SV card";
                            break;
                        case '5':
                            echo "Digital payment";
                            break;
                        default:
                            echo "";
                            break;
                    }

                    ?>
                    <td class="text-center" style="width:auto">
                        <input class="form-control" type="checkbox" <?php echo (isset(get_post_meta($post['post_id'], 'transfer_to_debtor', true)['meta_value']) && get_post_meta($post['post_id'], 'transfer_to_debtor', true)['meta_value'] == 1) ? 'checked' : ''; ?> disabled>
                    </td>  
                    <td class="text-center"><?php echo isset(get_post_meta($post['post_id'], 'non_room_account', true)['meta_value'])?get_post_meta($post['post_id'], 'non_room_account', true)['meta_value']:''; ?></td>
                    </td>

                    <td class="text-center">
                        <?php
                        $debtor_id = isset(get_post_meta($post['post_id'], 'debtor_account', true)['meta_value']) ? get_post_meta($post['post_id'], 'debtor_account', true)['meta_value'] : '';  
                        if ($debtor_id && isset($debtor_id) && $debtor_id != '') {
                             echo isset(get_post_meta($debtor_id, 'debtor_code', true)['meta_value']) ? get_post_meta($debtor_id, 'debtor_code', true)['meta_value'] : ''; 
                        }
                        ?>

                    </td>
                    <td class="text-center" style="width:auto">
                        <input class="form-control" type="checkbox" <?php echo (isset(get_post_meta($post['post_id'], 'not_in_use', true)['meta_value']) && get_post_meta($post['post_id'], 'not_in_use', true)['meta_value'] == 1) ? 'checked' : ''; ?> disabled>
                    </td> 

                    <td class="text-center">
                        <button class="btn btn-primary edit_post_button" id="<?php echo $post['post_id']; ?>">Edit</button>
                        <button class="btn btn-danger delete_payment1" id="<?php echo $post['post_id']; ?>">Delete</button>
                    </td>
                </tr>
                <?php
                endif;
                endforeach;
                else:
                ?>
                <tr class='' data-booking-id=''>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-center">
                        <h3><?php echo l('minical-extension-boilerplate/no data', true); ?></h3>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
                endif;
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- and post model-->
<div class="modal" id="add_post_model" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Payment 1 Charge </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="post_id">

                    <div class="form-group row">
                        <label for="payment"
                            class="col-sm-2 col-form-label"><?php echo l('Payment');?>*</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="payment" placeholder="Select payment">
                                    <?php 
                                    if (isset($payment_type_list) && $payment_type_list):

                                    foreach ($payment_type_list as $payment_type_id => $payment_type_name):


                                    ?>
                                    <option value="<?php echo $payment_type_id?>"> <?php echo $payment_type_name ?></option>

                                    <?php
                                    endforeach;
                                    endif;
                                    ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="charge"
                            class="col-sm-2 col-form-label"><?php echo l('Charge');?>*</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="charge" placeholder="Charge">
                                    <?php 
                                    if (isset($charge_list) && $charge_list):

                                    foreach ($charge_list as $charge_id => $charge_name):


                                    ?>
                                    <option value="<?php echo $charge_id?>"> <?php echo $charge_name ?></option>

                                    <?php
                                    endforeach;
                                    endif;
                                    ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="payment_mode"
                            class="col-sm-2 col-form-label"><?php echo l('Payment Mode');?></label>
                        <div class="col-sm-10">
                            <select class="form-control" id="payment_mode" placeholder="Select Payment mode">
                                    <option value="1">Cash</option>
                                    <option value="2">Credit Card</option>
                                    <option value="3">Dentor Account</option>
                                    <option value="4">SV Card</option>
                                    <option value="5">Digital Payment</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="transfer_to_debtor"
                            class="col-sm-2 col-form-label"><?php echo l('Transfer to debtor');?></label>
                        <div class="col-sm-10">
                            <input type="checkbox" class="form-control" id="transfer_to_debtor">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="non_room_account"
                            class="col-sm-2 col-form-label"><?php echo l('Non room account');?></label>
                        <div class="col-sm-10">
                            <select class="form-control" id="non_room_account" placeholder="Select Non room account">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="debtor_account"
                            class="col-sm-2 col-form-label"><?php echo l('Debtor');?>*</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="debtor_account" placeholder="Select Debtor">
                                    <?php 
                                    if (isset($debtor_account_list) && $debtor_account_list):
                                    foreach ($debtor_account_list as $debtor_account):
                                        if (isset($debtor_account['post_id'])):
                                        $debtor_account_id = $debtor_account['post_id'];
                                        $debtor_account_code = isset(get_post_meta($debtor_account_id, 'debtor_code', true)['meta_value'])?get_post_meta($debtor_account_id, 'debtor_code', true)['meta_value']:'';


                                    ?>
                                    <option value="<?php echo $debtor_account_id?>"> <?php echo $debtor_account_code ?></option>

                                    <?php
                                    endif;
                                    endforeach;
                                    endif;
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="not_in_use"
                            class="col-sm-2 col-form-label"><?php echo l('Not in use');?></label>
                        <div class="col-sm-10">
                            <input type="checkbox" class="form-control" id="not_in_use">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    id="add_payment1"><?php echo l('Add Payment 1 Charge ');?></button>

                <button type="button" class="btn btn-primary"
                    id="update_payment1"><?php echo l('minical-extension-boilerplate/Update Post');?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>