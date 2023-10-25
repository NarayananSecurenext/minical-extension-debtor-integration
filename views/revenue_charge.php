<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-diskette text-success"></i>
            </div>
            <div><?php echo l('Debtor / Revenue Charge'); ?></div>
        </div>
    </div>
</div>

<div class="main-card card">
    <div class="card-body">
        <div>
            <button class="pull-right btn btn-primary" id="add_revenue_charge_button">Add revenue_charges</button>
        </div>
        <br /><br>
        <table id="post_list" class="display" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Department</th>
                    <th class="text-center">Revenue Head</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Default Price</th>
                    <th class="text-center">GL Account</th>
                    <th class="text-center">Accept multiple Currency</th>
                    <th class="text-center">Non Revenue</th>
                    <th class="text-center">Not in use</th>
                    <th class="text-center">SAC Code</th>
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
                        $department_id = isset(get_post_meta($post['post_id'], 'department', true)['meta_value']) ? get_post_meta($post['post_id'], 'department', true)['meta_value'] : '';  
                        if ($department_id && isset($department_id) && $department_id != '') {
                             echo isset(get_post_meta($department_id, 'description', true)['meta_value']) ? get_post_meta($department_id, 'description', true)['meta_value'] : ''; 
                        }
                        ?>

                    </td>
                    <td class="text-center">
                        <?php
                        $revenue_head_id = isset(get_post_meta($post['post_id'], 'revenue_head', true)['meta_value']) ? get_post_meta($post['post_id'], 'revenue_head', true)['meta_value'] : '';  
                        if ($revenue_head_id && isset($revenue_head_id) && $revenue_head_id != '') {
                             echo isset(get_post_meta($revenue_head_id, 'description', true)['meta_value']) ? get_post_meta($revenue_head_id, 'description', true)['meta_value'] : ''; 
                        }
                        ?>

                    </td>


                    <td class="text-center">
                        <?php echo isset(get_post_meta($post['post_id'], 'description', true)['meta_value']) ? get_post_meta($post['post_id'], 'description', true)['meta_value'] : ''; ?>
                    </td>
                    <td class="text-center">
                        <?php echo isset(get_post_meta($post['post_id'], 'default_price', true)['meta_value']) ? get_post_meta($post['post_id'], 'default_price', true)['meta_value'] : ''; ?>
                    </td>
                    <td class="text-center">
                        <?php
                        $gl_account_id = isset(get_post_meta($post['post_id'], 'gl_account', true)['meta_value']) ? get_post_meta($post['post_id'], 'gl_account', true)['meta_value'] : '';  
                        if ($gl_account_id && isset($gl_account_id) && $gl_account_id != '') {
                             echo isset(get_post_meta($gl_account_id, 'gl_account_code', true)['meta_value']) ? get_post_meta($gl_account_id, 'gl_account_code', true)['meta_value'] : ''; 
                        }
                        ?>

                    </td>
                    <td class="text-center" style="width:auto">
                        <input class="form-control" type="checkbox" <?php echo (isset(get_post_meta($post['post_id'], 'multiple_currency', true)['meta_value']) && get_post_meta($post['post_id'], 'multiple_currency', true)['meta_value'] == 1) ? 'checked' : ''; ?> disabled>
                    </td>
                    <td class="text-center" style="width:auto">
                        <input class="form-control" type="checkbox" <?php echo (isset(get_post_meta($post['post_id'], 'non_revenue', true)['meta_value']) && get_post_meta($post['post_id'], 'non_revenue', true)['meta_value'] == 1) ? 'checked' : ''; ?> disabled>
                    </td>
                    <td class="text-center" style="width:auto">
                        <input class="form-control" type="checkbox" <?php echo (isset(get_post_meta($post['post_id'], 'not_in_use', true)['meta_value']) && get_post_meta($post['post_id'], 'not_in_use', true)['meta_value'] == 1) ? 'checked' : ''; ?> disabled>
                    </td>
                    <td class="text-center">
                        <?php
                        $sac_code_id = isset(get_post_meta($post['post_id'], 'sac_code', true)['meta_value']) ? get_post_meta($post['post_id'], 'sac_code', true)['meta_value'] : '';  
                        if ($sac_code_id && isset($sac_code_id) && $sac_code_id != '') {
                             echo isset(get_post_meta($sac_code_id, 'sac_code', true)['meta_value']) ? get_post_meta($sac_code_id, 'sac_code', true)['meta_value'] : ''; 
                        }
                        ?>

                    </td>

                    <td class="text-center">
                        <button class="btn btn-primary edit_post_button" id="<?php echo $post['post_id']; ?>">Edit</button>
                        <button class="btn btn-danger delete_revenue_charge" id="<?php echo $post['post_id']; ?>">Delete</button>
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
                    <td></td>
                    <td class="text-center">
                        <h3><?php echo l('minical-extension-boilerplate/no data', true); ?></h3>
                    </td>
                    <td></td>
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
                <h5 class="modal-title">Add Revenue Charge </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="post_id">

                    <div class="form-group row">
                        <label for="department"
                            class="col-sm-2 col-form-label"><?php echo l('Department');?>*</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="department" placeholder="Enter select Type">
                                    <?php 
                                    if (isset($department_list) && $department_list):
                                    foreach ($department_list as $department):
                                        if (isset($department['post_id'])):
                                        $department_id = $department['post_id'];
                                        $department_description = isset(get_post_meta($department_id, 'description', true)['meta_value'])?get_post_meta($department_id, 'description', true)['meta_value']:'';


                                    ?>
                                    <option value="<?php echo $department_id?>"> <?php echo $department_description ?></option>

                                    <?php
                                    endif;
                                    endforeach;
                                    endif;
                                    ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="type"
                            class="col-sm-2 col-form-label"><?php echo l('Revenue Head');?>*</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="revenue_head" placeholder="Revenue Head">
                                    <?php 
                                    if (isset($revenue_head_list) && $revenue_head_list):
                                    foreach ($revenue_head_list as $revenue_head):
                                        if (isset($revenue_head['post_id'])):
                                        $revenue_head_id = $revenue_head['post_id'];
                                        $revenue_head_description = isset(get_post_meta($revenue_head_id, 'description', true)['meta_value'])?get_post_meta($revenue_head_id, 'description', true)['meta_value']:'';


                                    ?>
                                    <option value="<?php echo $revenue_head_id?>"> <?php echo $revenue_head_description ?></option>

                                    <?php
                                    endif;
                                    endforeach;
                                    endif;
                                    ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description"
                            class="col-sm-2 col-form-label"><?php echo l('Description');?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="description" placeholder="Enter description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="default_price"
                            class="col-sm-2 col-form-label"><?php echo l('Default Price');?></label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="default_price" placeholder="Enter Default Price">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gl_account"
                            class="col-sm-2 col-form-label"><?php echo l('GL Account');?>*</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="gl_account" placeholder="Select GL Account">
                                    <?php 
                                    if (isset($gl_account_list) && $gl_account_list):
                                    foreach ($gl_account_list as $gl_account):
                                        if (isset($gl_account['post_id'])):
                                        $gl_account_id = $gl_account['post_id'];
                                        $gl_account_code = isset(get_post_meta($gl_account_id, 'gl_account_code', true)['meta_value'])?get_post_meta($gl_account_id, 'gl_account_code', true)['meta_value']:'';


                                    ?>
                                    <option value="<?php echo $gl_account_id?>"> <?php echo $gl_account_code ?></option>

                                    <?php
                                    endif;
                                    endforeach;
                                    endif;
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="multiple_currency"
                            class="col-sm-2 col-form-label"><?php echo l('Accept Multiple Currency');?></label>
                        <div class="col-sm-10">
                            <input type="checkbox" class="form-control" id="multiple_currency">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="non_revenue"
                            class="col-sm-2 col-form-label"><?php echo l('Non Revenue');?></label>
                        <div class="col-sm-10">
                            <input type="checkbox" class="form-control" id="non_revenue">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="not_in_use"
                            class="col-sm-2 col-form-label"><?php echo l('Not in use');?></label>
                        <div class="col-sm-10">
                            <input type="checkbox" class="form-control" id="not_in_use">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sac_code"
                            class="col-sm-2 col-form-label"><?php echo l('SAC Code');?>*</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="sac_code" placeholder="Select SAC Code">
                                    <?php 
                                    if (isset($sac_code_list) && $sac_code_list):
                                    foreach ($sac_code_list as $sac_code):
                                        if (isset($sac_code['post_id'])):
                                        $sac_code_id = $sac_code['post_id'];
                                        $sac_code = isset(get_post_meta($sac_code_id, 'sac_code', true)['meta_value'])?get_post_meta($sac_code_id, 'sac_code', true)['meta_value']:'';


                                    ?>
                                    <option value="<?php echo $sac_code_id?>"> <?php echo $sac_code ?></option>

                                    <?php
                                    endif;
                                    endforeach;
                                    endif;
                                    ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    id="add_revenue_charge"><?php echo l('Add Revenue Charge ');?></button>

                <button type="button" class="btn btn-primary"
                    id="update_revenue_charge"><?php echo l('minical-extension-boilerplate/Update Post');?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>