<div class="settings integrations">
	<div class="page-header">
		<h2>
			<?php echo l('debtor_integration/Debtor Title'); ?>
		</h2>
	</div>

    <div class="panel panel-default ">
        
        <div class="panel-body form-horizontal ">
            <div id="configure-channex" >
            <h4>
			<?php echo l('debtor_integration/Add New Debtor'); ?>
		</h4>

        <div class="form-group rate-group">
		
                  <?php $debtor_type=''; $marketing_segment=''; $booking_source='';  $attach_rate_code=''; ?> 
                    <div class="col-sm-6">
					 <label for="debtor_type" class="control-label">
                        <span alt="debtor_type" title="debtor_type"><?php echo l('debtor_integration/Debtor Type'); ?></span>
                    </label>
                        <select class="form-control" name="debtor_type">
                            <option value=""><?php echo l('debtor_integration/Select Option'); ?></option>
                            <option <?php echo $debtor_type=='Company'?'selected':'' ?> value="Company">Company</option>
                            <option <?php echo $debtor_type=='Travel Agent'?'selected':'' ?> value="Travel Agent">Travel Agent</option>
                            <option <?php echo $debtor_type=='OTA'?'selected':'' ?> value="OTA">OTA</option>
                        </select>
                 </div>
				 <div class="col-sm-6">
					<label for="debtor_id" class="control-label">
                        <span alt="debtor_id" title="debtor_id"><?php echo l('debtor_integration/Debtor Id'); ?></span>
                    </label>
                        <input type="text" name="debtor_code" class="form-control" value="">
                    </div>
                </div>
              
                <div class="form-group rate-group ">
                   
                    <div class="col-sm-6">
					 <label for="debtor_name" class="control-label">
                        <span alt="debtor_name" title="debtor_name"><?php echo l('debtor_integration/Debtor Name'); ?></span>
                    </label>
                        <input type="text" name="debtor_name" class="form-control" value="">
                    </div>
					 <div class="col-sm-6">
					<label for="debtor_description" class="control-label">
                        <span alt="debtor_description" title="debtor_description"><?php echo l('debtor_integration/Debtor Description'); ?></span>
                    </label>
                        <input type="text" name="debtor_description" class="form-control" value="">
                    </div>
                </div>
               
                <div class="form-group rate-group">
                   
                    <div class="col-sm-6">
					 <label for="vat_number" class="control-label">
                        <span alt="vat_number" title="vat_number"><?php echo l('debtor_integration/VAT Number'); ?></span>
                    </label>
                        <input type="text" name="vat_number" class="form-control" value="">
                    </div>
					<div class="col-sm-6">
					<label for="pan_number" class="control-label">
                        <span alt="pan_number" title="pan_number"><?php echo l('debtor_integration/PAN Number'); ?></span>
                    </label>
                        <input type="text" name="pan_number" class="form-control" value="">
                    </div>
                </div> 
               
                <div class="form-group rate-group">
                   
                    <div class="col-sm-6">
					 <label for="gst_number" class="control-label">
                        <span alt="gst_number" title="gst_number"><?php echo l('debtor_integration/GST Number'); ?></span>
                    </label>
                        <input type="text" name="gst_number" class="form-control" value="">
                    </div>
					<div class="col-sm-6">
					<label for="marketing_segment" class="control-label">
                        <span alt="marketing_segment" title="marketing_segment"><?php echo l('debtor_integration/Marketing Segment'); ?></span>
                    </label>
                    <select class="form-control" name="marketing_segment">
                            <option value=""><?php echo l('debtor_integration/Select Option'); ?></option>
							<?php foreach($marketing_segments as $key=>$val){ ?>
							<option <?php echo $marketing_segment==$val['post_id']?'selected':'' ?> value="<?php echo $val['post_id']; ?>"><?php echo isset(get_post_meta($val['post_id'], 'name', true)['meta_value'])?get_post_meta($val['post_id'], 'name', true)['meta_value']:''; ?></option>
							<?php } ?>
                        </select>
                      </div>
                </div>
              
                <div class="form-group rate-group">
                   
                    <div class="col-sm-6">
					 <label for="booking_source" class="control-label">
                        <span alt="booking_source" title="booking_source"><?php echo l('debtor_integration/Booking Source'); ?></span>
                    </label> 
                    <select class="form-control" name="booking_source">
                            <option value=""><?php echo l('debtor_integration/Select Option'); ?></option>
							<?php foreach($booking_sources as $key=>$val){ ?>
							<option <?php echo $booking_source==$val['name']?'selected':'' ?> value="<?php echo $val['name']; ?>"><?php echo $val['name']; ?></option>
							<?php } ?>
                        </select>
                      </div>
					   <div class="col-sm-6">
					<label for="address" class="control-label">
                        <span alt="address" title="address"><?php echo l('debtor_integration/Address'); ?></span>
                    </label>
                        <input type="text" name="address" class="form-control" value="">
                    </div>
                </div>
               
                <div class="form-group rate-group">
                   
                    <div class="col-sm-6">
					 <label for="city" class="control-label">
                        <span alt="city" title="city"><?php echo l('debtor_integration/City'); ?></span>
                    </label>
                        <input type="text" name="city" class="form-control" value="">
                    </div>
					<div class="col-sm-6">
					<label for="state" class="control-label">
                        <span alt="state" title="state"><?php echo l('debtor_integration/State/Province'); ?></span>
                    </label>
                        <input type="text" name="state" class="form-control" value="">
                    </div>
                </div>
                
                <div class="form-group rate-group">
                   
                    <div class="col-sm-6">
					 <label for="country" class="control-label">
                        <span alt="country" title="country"><?php echo l('debtor_integration/Country'); ?></span>
                    </label>
                        <input type="text" name="country" class="form-control" value="">
                    </div>
					 <div class="col-sm-6">
					<label for="credit_limit" class="control-label">
                        <span alt="credit_limit" title="credit_limit"><?php echo l('debtor_integration/Credit Limit'); ?></span>
                    </label>
                        <input type="text" name="credit_limit" class="form-control" value="">
                    </div>
                </div>
				
				 <!-- <div class="form-group rate-group">
                    
                    <div class="col-sm-6">
					<label for="person_name" class="control-label">
                        <span alt="person_name" title="person_name"><?php echo l('debtor_integration/Contact Person Name'); ?></span>
                    </label>
                        <input type="text" name="person_name" class="form-control" value="">
                    </div>
					 <div class="col-sm-6">
					<label for="email" class="control-label">
                        <span alt="email" title="email"><?php echo l('debtor_integration/Email'); ?></span>
                    </label>
                        <input type="text" name="email" class="form-control" value="">
                    </div>
                </div>
				
				 <div class="form-group rate-group">
                    
                    <div class="col-sm-6">
					<label for="phone" class="control-label">
                        <span alt="phone" title="phone"><?php echo l('debtor_integration/Phone'); ?></span>
                    </label>
                        <input type="text" name="phone" class="form-control" value="">
                    </div>
					<div class="col-sm-6">
					 <label for="booker_id" class="control-label">
                        <span alt="booker_id" title="booker_id"><?php echo l('debtor_integration/Booker ID'); ?></span>
                    </label>
                        <input type="text" name="booker_id" class="form-control" value="">
                    </div>
                </div> -->
				
                <div class="form-group rate-group">
                    
                    <div class="col-sm-6">
					<label for="attach_rate_code" class="control-label">
                        <span alt="attach_rate_code" title="attach_rate_code"><?php echo l('debtor_integration/Attach rate Code'); ?></span>
                    </label>
                    <select class="form-control" name="attach_rate_code"  multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="3">
                            <!-- <option value=""><?php echo l('debtor_integration/Select Option'); ?></option> -->
							<?php foreach($rate_plans as $key=>$val){ ?>
							<option <?php echo $attach_rate_code==$val['rate_plan_id']?'selected':'' ?> value="<?php echo $val['rate_plan_id']; ?>"><?php echo $val['rate_plan_name']; ?></option>
							<?php } ?>
                        </select> </div>
                </div>
                <!-- <div class="form-group rate-group text-center">
                    <label for="channex_password" class="col-sm-3 control-label">
                        <span alt="channex_password" title="channex_password"><?php//l("maximojo_integration/Channex Password");?></span>
                    </label>
                    <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" value="<?php// echo isset($channex_data['password']) ? $channex_data['password'] : ''; ?>">
                    </div>
                </div> -->
<input type="hidden" name="debtor_id" class="form-control" value="<?php echo isset($debtor[0]['post_id']) ? $debtor[0]['post_id'] : ''; ?>">
                  
                <div class="text-center">
                    <button type="button" class="btn btn-success settings-debtor" ><?php echo l('debtor_integration/Submit Contact'); ?></button>
                </div>
            </div>
            
        </div>

    </div>
</div>
