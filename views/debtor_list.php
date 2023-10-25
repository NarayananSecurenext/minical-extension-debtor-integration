<div class="settings integrations">
	<div class="page-header">
		<h2>
			<?php echo l('debtor_integration/Debtor Title'); ?>
		</h2>
	</div>

    <div class="panel panel-default ">
        
        <div class="panel-body form-horizontal ">
            <div id="configure-channex" >
            <h4 style="text-align:center">
			<?php echo l('debtor_integration/Debtor List'); ?>
		</h4>
<div class="page-title-actions">
        	<a href="<?php echo base_url().'new-debtor'; ?>" class="btn btn-primary"><?php echo l('debtor_integration/Add New Debtor'); ?></a>
        </div>
     <div class="table-responsive">

<table class="table table-hover">
	<tr>
		<th><?php echo l('id'); ?></th>				
		<th ><?php echo l('debtor_integration/Debtor Name'); ?></th>				
		<th><?php echo l('debtor_integration/Contact Person Name'); ?></th>
       <th><?php echo l('debtor_integration/Phone'); ?></th>
		<th><?php echo l('debtor_integration/Debtor Id'); ?></th>	
		<th><?php echo l('debtor_integration/PAN Number'); ?></th>	
		<th><?php echo l('debtor_integration/VAT Number'); ?></th>	
		<th><?php echo l('debtor_integration/Debtor Type'); ?></th>	
		<th></th>
	</tr>

	<?php 
		if(isset($rows)) 
			foreach ($rows as $r) : 

			$contact = 	isset(get_post_meta($r['post_id'], 'customer_id', true)['meta_value'])?get_post_meta($r['post_id'], 'customer_id', true)['meta_value']:'0';
				
	?>
				<tr class='customer-tr' name='<?php echo $r['post_id']; ?>'>
					<td>
						<?php
							echo $r['post_id'];									
						?>
					
					</td>
					<td>
						
							<?php
								echo $r['post_title'];					
							?>
						
						
					</td>
					<td>
						<?php echo isset(get_post_meta($contact, 'person_name', true)['meta_value'])?get_post_meta($contact, 'person_name', true)['meta_value']:''; ?>
					</td>
                    <td>
					<?php echo isset(get_post_meta($contact, 'phone', true)['meta_value'])?get_post_meta($contact, 'phone', true)['meta_value']:''; ?>
			
					</td>
					<td>
					<?php echo isset(get_post_meta($r['post_id'], 'debtor_code', true)['meta_value'])?get_post_meta($r['post_id'], 'debtor_code', true)['meta_value']:''; ?>
					</td>
					<td>
					<?php echo isset(get_post_meta($r['post_id'], 'pan_number', true)['meta_value'])?get_post_meta($r['post_id'], 'pan_number', true)['meta_value']:''; ?>
					</td>
					<td>
					<?php echo isset(get_post_meta($r['post_id'], 'vat_number', true)['meta_value'])?get_post_meta($r['post_id'], 'vat_number', true)['meta_value']:''; ?>
					</td>
					<td>
					<?php echo isset(get_post_meta($r['post_id'], 'debtor_type', true)['meta_value'])?get_post_meta($r['post_id'], 'debtor_type', true)['meta_value']:''; ?>
					</td>
					<td class="center delete-td">
						<div class="dropdown pull-right">
							<button class="btn btn-light btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
							<!-- 	<span class="caret"></span> -->
							</button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
								<li role="presentation">
									<a role="menuitem" tabindex="-1" class="customer-profile" id="<?php echo $r['post_id']; ?>" href="<?php echo base_url().'update-debtor/'.$r['post_id']; ?>">
										<?php echo l('debtor_integration/Edit'); ?>
									</a>
								</li><li role="presentation">
								<?php if($r['is_deleted']==0){ ?>
									<a role="menuitem" style="color:red;" tabindex="-1" onclick="EnableDisable('<?php echo $r['post_id']; ?>', 'disable')" href="javascript:void(0);">
										<?php echo l('debtor_integration/Disable'); ?>
									</a>
								<?php } if($r['is_deleted']==1){ ?>
									<a role="menuitem" style="color:green;" tabindex="-1" onclick="EnableDisable('<?php echo $r['post_id']; ?>', 'enable')" href="javascript:void(0);">
										<?php echo l('debtor_integration/Enable'); ?>
									</a>
									<?php } ?>
								</li>
								
							</ul>
						</div>
					</td>	
				</tr>
	<?php 
			endforeach;				
	?> 
                
</table>
</div>

<div class="panel panel-default">
	<div class="panel-body text-center">
		<h4>
			<?php echo $this->pagination->create_links(); ?>
		</h4>
		<br/>
		</div>
</div>
   </div>
            
        </div>

    </div>
</div>
