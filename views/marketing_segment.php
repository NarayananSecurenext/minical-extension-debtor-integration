<!-- Hidden delete dialog-->		
<div id="confirm_delete_dialog" ></div>


<!-- Hidden delete dialog-->
<div id="confirm_delete_dialog" ></div>

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-notebook text-success"></i>
            </div>
            <?php echo l('Marketing segment'); ?>
        </div>
    </div>
</div>

<div class="main-card card">
    <div class="card-body">


    <div class="table-responsive">
<table id="booking-source" class="table booking_source">
    <thead>
        <tr>
            <th> <?php echo l('Marketing segment Name', true); ?></th>
            <th> <?php echo l('Description', true); ?></th>
            <!--<th> Sort Order</th>-->
            <th> <?php echo l('Hide', true); ?></th>
        </tr>
    </thead>
    <tbody id="sortable" >
	<?php if(isset($rows)): 

// print_r($rows);
?>

	<?php 	foreach($rows as $marketing_segment) :


         ?>
				<tr class="marketing-segment-tr" id="<?php echo $marketing_segment['post_id'] ?>">
                    <td class=""><span class=""></span>
						<input name="marketing-segment-name" class="form-control" type="text"
                               value="<?php echo isset(get_post_meta($marketing_segment['post_id'], 'name', true)['meta_value'])?get_post_meta($marketing_segment['post_id'], 'name', true)['meta_value']:''; ?>" maxlength="45" style="width:250px"/>
					</td>
<!--					<td>
						<div class="delete-booking-source-button btn btn-default">X</div>
					</td>-->
					<td>
						<input name="description" class="form-control" type="text" value="<?php echo isset(get_post_meta($marketing_segment['post_id'], 'description', true)['meta_value'])?get_post_meta($marketing_segment['post_id'], 'description', true)['meta_value']:''; ?>" maxlength="45" style="width:200px"/>
					</td>
<!--                    <td>
                        <input type="text" name="booking-source-sort-order" class="form-control" value="<?=$marketing_segment['sort_order'];?>" maxlength="3" style="width:100px">
					</td>-->
                    <td>
                        <div class="checkbox">
                            <input type="checkbox" name="marketing-segment-hidden" class="hide-booking-source-button" <?php if( (isset(get_post_meta($marketing_segment['post_id'], 'is_enable', true)['meta_value'])?get_post_meta($marketing_segment['post_id'], 'is_enable', true)['meta_value']:'0')  == '1') { ?> checked <?php } ?> style="margin-left: 0px!important;">
                        </div>
					</td> 
				</tr>
	<?php endforeach; ?>
    </tbody>
	<?php else : ?>	
	<h3><?php echo l('No Marketing segment(s) have been found.', true); ?></h3>
	<?php endif; ?>
</table>
    </div>
<br />
<button id="add-marketing-segment-button" class="btn btn-light"><?php echo l('Add Marketing Segment', true); ?></button>
<button id="save-all-marketing-segment-button" class="btn btn-primary"><?php echo l('save_all', true); ?></button>
</div></div>