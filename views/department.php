<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-diskette text-success"></i>
            </div>
            <div><?php echo l('Debtor / Departments'); ?></div>
        </div>
    </div>
</div>

<div class="main-card card">
    <div class="card-body">
        <div>
            <button class="pull-right btn btn-primary" id="add_department_button">Add Departments</button>
        </div>
        <br /><br>
        <table id="post_list" class="display" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Department</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Revenue Type</th>
                    <th class="text-center">Print Seq #</th>
                    <th class="text-center">Show in POS Outlets</th>
                    <th class="text-center">Accept multiple Currency</th>
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
                        <?php echo isset(get_post_meta($post['post_id'], 'department_code', true)['meta_value']) ? get_post_meta($post['post_id'], 'department_code', true)['meta_value'] : ''; ?>
                    </td>
                    <td class="text-center">
                        <?php echo isset(get_post_meta($post['post_id'], 'description', true)['meta_value']) ? get_post_meta($post['post_id'], 'description', true)['meta_value'] : ''; ?>
                    </td>
                    <td class="text-center">
                        <?php
                        $revenue_id = isset(get_post_meta($post['post_id'], 'revenue_type', true)['meta_value']) ? get_post_meta($post['post_id'], 'revenue_type', true)['meta_value'] : '';  
                        if ($revenue_id && isset($revenue_id) && $revenue_id != '') {
                             echo isset(get_post_meta($revenue_id, 'revenue_code', true)['meta_value']) ? get_post_meta($revenue_id, 'revenue_code', true)['meta_value'] : ''; 
                        }
                        ?>

                    </td>

                    <td class="text-center">
                        <?php echo isset(get_post_meta($post['post_id'], 'sequence', true)['meta_value']) ? get_post_meta($post['post_id'], 'sequence', true)['meta_value'] : ''; ?>
                    </td>
                    <td class="text-center" style="width:auto">
                        <input class="form-control" type="checkbox" <?php echo (isset(get_post_meta($post['post_id'], 'show_pos_outlets', true)['meta_value']) && get_post_meta($post['post_id'], 'show_pos_outlets', true)['meta_value'] == 1) ? 'checked' : ''; ?> disabled>
                    </td>
                    <td class="text-center" style="width:auto">
                        <input class="form-control" type="checkbox" <?php echo (isset(get_post_meta($post['post_id'], 'multiple_currency', true)['meta_value']) && get_post_meta($post['post_id'], 'multiple_currency', true)['meta_value'] == 1) ? 'checked' : ''; ?> disabled>
                    </td>
                    <td class="text-center" style="width:auto">
                        <input class="form-control" type="checkbox" <?php echo (isset(get_post_meta($post['post_id'], 'not_in_use', true)['meta_value']) && get_post_meta($post['post_id'], 'not_in_use', true)['meta_value'] == 1) ? 'checked' : ''; ?> disabled>
                    </td>

                    <td class="text-center">
                        <button class="btn btn-primary edit_post_button" id="<?php echo $post['post_id']; ?>">Edit</button>
                        <button class="btn btn-danger delete_department" id="<?php echo $post['post_id']; ?>">Delete</button>
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
                <h5 class="modal-title">Add Departments </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="post_id">
                    <div class="form-group row">
                        <label for="department_code"
                            class="col-sm-2 col-form-label"><?php echo l('Department Code');?>*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="department_code" placeholder="Enter Department Code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description"
                            class="col-sm-2 col-form-label"><?php echo l('Description');?>*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="description" placeholder="Enter Description">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="type"
                            class="col-sm-2 col-form-label"><?php echo l('Type');?>*</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="revenue_type" placeholder="Enter select Type">
                                    <?php 
                                    if (isset($revenue_list) && $revenue_list):
                                    foreach ($revenue_list as $revenue):
                                        if (isset($revenue['post_id'])):
                                        $revenue_id = $revenue['post_id'];
                                        $revenue_code = isset(get_post_meta($revenue_id, 'revenue_code', true)['meta_value'])?get_post_meta($revenue_id, 'revenue_code', true)['meta_value']:'';


                                    ?>
                                    <option value="<?php echo $revenue_id?>"> <?php echo $revenue_code ?></option>

                                    <?php
                                    endif;
                                    endforeach;
                                    endif;
                                    ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sequence"
                            class="col-sm-2 col-form-label"><?php echo l('Print seq #');?></label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="sequence" placeholder="Enter print seq #">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="not_show_pos_outletsin_use"
                            class="col-sm-2 col-form-label"><?php echo l('Show on POS outlets');?></label>
                        <div class="col-sm-10">
                            <input type="checkbox" class="form-control" id="show_pos_outlets">
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
                    id="add_department"><?php echo l('Add Departments ');?></button>

                <button type="button" class="btn btn-primary"
                    id="update_department"><?php echo l('minical-extension-boilerplate/Update Post');?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>