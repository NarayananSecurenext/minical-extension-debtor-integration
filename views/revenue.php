<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-diskette text-success"></i>
            </div>
            <div><?php echo l('Debtor / Revenue '); ?>

            </div>
        </div>
    </div>
</div>

<div class="main-card card">
    <div class="card-body">
        <div><button class="pull-right btn btn-primary" id="add_post_model_button">Add Revenue </button></div><br /><br>
        <table id="post_list" class="display" style="width:100%">
            <thead>
                <tr>
                    <th class=" text-center">Revenue Code</th>
                    <th class=" text-center">Type</th>
                    <th class=" text-center">Description</th>
                    <th class=" text-center">GL Code</th>
                    <th class=" text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                        if (isset($posts) && $posts):
                        foreach ($posts as $post) : 
                        if (isset($post['post_id'])):
                    ?>

                <tr class=''>
                    <td class="text-center"><?php echo isset(get_post_meta($post['post_id'], 'revenue_code', true)['meta_value'])?get_post_meta($post['post_id'], 'revenue_code', true)['meta_value']:''; ?></td>
                    <td class="text-center"><?php echo isset(get_post_meta($post['post_id'], 'type', true)['meta_value'])?get_post_meta($post['post_id'], 'type', true)['meta_value']:''; ?></td>
                    <td class="text-center"><?php echo isset(get_post_meta($post['post_id'], 'description', true)['meta_value'])?get_post_meta($post['post_id'], 'description', true)['meta_value']:''; ?></td>
                    <td class="text-center"><?php echo isset(get_post_meta($post['post_id'], 'gl_code', true)['meta_value'])?get_post_meta($post['post_id'], 'gl_code', true)['meta_value']:''; ?></td>
                    <td class=" text-center">
                        <button class="btn btn-primary edit_post_button"
                            id="<?php echo $post['post_id']; ?>">Edit</button>
                        <button class="btn btn-danger delete_revenue"
                            id="<?php echo $post['post_id']; ?>">Delete</button>
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
                    <td class="text-center">
                        <h3><?php echo l('minical-extension-boilerplate/no data', true);?></h3>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <?php 
                    endif;
                ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- and post model-->
<div class="modal" id="add_post_model" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Revenue </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="post_id">
                    <div class="form-group row">
                        <label for="revenue_code"
                            class="col-sm-2 col-form-label"><?php echo l('Revenue Code');?>*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="revenue_code" placeholder="Enter Description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type"
                            class="col-sm-2 col-form-label"><?php echo l('Type');?>*</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="type" placeholder="Enter select Type">
                                    <option value="D">D</option>
                                    <option value="C">C</option>
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
                        <label for="gl_code"
                            class="col-sm-2 col-form-label"><?php echo l('GL Code');?></label>
                        <div class="col-sm-10">
                            <select class="form-control" id="gl_code" placeholder="Select Gl Code">
                                    <option value="1">0000</option>
                                    <option value="2">00001</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    id="add_revenue"><?php echo l('Add Revenue ');?></button>

                <button type="button" class="btn btn-primary"
                    id="update_revenue"><?php echo l('minical-extension-boilerplate/Update Post');?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>