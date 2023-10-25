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
			<?php echo l('debtor_integration/Update Debtor'); ?>
		</h4>

        <div class="form-group rate-group">
		
                  <?php $debtor_type=isset(get_post_meta($post_id, 'debtor_type', true)['meta_value'])?get_post_meta($post_id, 'debtor_type', true)['meta_value']:''; ?> 
                  <?php $marketing_segment=isset(get_post_meta($post_id, 'marketing_segment', true)['meta_value'])?get_post_meta($post_id, 'marketing_segment', true)['meta_value']:''; ?> 
                  <?php $booking_source=isset(get_post_meta($post_id, 'booking_source', true)['meta_value'])?get_post_meta($post_id, 'booking_source', true)['meta_value']:''; ?> 
                  <!-- <?php $attach_rate_code=isset(get_post_meta($post_id, 'attach_rate_code', true)['meta_value'])?get_post_meta($post_id, 'attach_rate_code', true)['meta_value']:''; ?>  -->
                  <?php 
                  $attach_rate_code_arr=get_post_meta($post_id, 'attach_rate_code', false); 
                  $attach_rate_code = array();
                  foreach ($attach_rate_code_arr as $key => $value) {
                    $attach_rate_code[] = $value["meta_value"];
                  }
                  ?>
                  <?php 
                  $customer_id_arr=get_post_meta($post_id, 'customer_id', false); 
                  $customer_id = array();
                  foreach ($customer_id_arr as $key => $value) {
                    $customer_id[] = $value["meta_value"];
                  }



                  ?>


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
                        <input type="text" name="debtor_code" class="form-control" value="<?php echo isset(get_post_meta($post_id, 'debtor_code', true)['meta_value'])?get_post_meta($post_id, 'debtor_code', true)['meta_value']:''; ?>">
                    </div>
                </div>
              
                <div class="form-group rate-group ">
                   
                    <div class="col-sm-6">
					 <label for="debtor_name" class="control-label">
                        <span alt="debtor_name" title="debtor_name"><?php echo l('debtor_integration/Debtor Name'); ?></span>
                    </label>
                        <input type="text" name="debtor_name" class="form-control" value="<?php echo isset($debtor[0]['post_title']) ? $debtor[0]['post_title'] : ''; ?>">
                    </div>
					 <div class="col-sm-6">
					<label for="debtor_description" class="control-label">
                        <span alt="debtor_description" title="debtor_description"><?php echo l('debtor_integration/Debtor Description'); ?></span>
                    </label>
                        <input type="text" name="debtor_description" class="form-control" value="<?php echo isset($debtor[0]['post_content']) ? $debtor[0]['post_content'] : ''; ?>">
                    </div>
                </div>
               
                <div class="form-group rate-group">
                   
                    <div class="col-sm-6">
					 <label for="vat_number" class="control-label">
                        <span alt="vat_number" title="vat_number"><?php echo l('debtor_integration/VAT Number'); ?></span>
                    </label>
                        <input type="text" name="vat_number" class="form-control" value="<?php  echo isset(get_post_meta($post_id, 'vat_number', true)['meta_value'])?get_post_meta($post_id, 'vat_number', true)['meta_value']:''; ?>">
                    </div>
					<div class="col-sm-6">
					<label for="pan_number" class="control-label">
                        <span alt="pan_number" title="pan_number"><?php echo l('debtor_integration/PAN Number'); ?></span>
                    </label>
                        <input type="text" name="pan_number" class="form-control" value="<?php  echo isset(get_post_meta($post_id, 'pan_number', true)['meta_value'])?get_post_meta($post_id, 'pan_number', true)['meta_value']:''; ?>">
                    </div>
                </div> 
               
                <div class="form-group rate-group">
                   
                    <div class="col-sm-6">
					 <label for="gst_number" class="control-label">
                        <span alt="gst_number" title="gst_number"><?php echo l('debtor_integration/GST Number'); ?></span>
                    </label>
                        <input type="text" name="gst_number" class="form-control" value="<?php echo isset(get_post_meta($post_id, 'gst_number', true)['meta_value'])?get_post_meta($post_id, 'gst_number', true)['meta_value']:''; ?>">
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
                        <input type="text" name="address" class="form-control" value="<?php echo isset(get_post_meta($post_id, 'address', true)['meta_value'])?get_post_meta($post_id, 'address', true)['meta_value']:''; ?>">
                    </div>
                </div>
               
                <div class="form-group rate-group">
                   
                    <div class="col-sm-6">
					 <label for="city" class="control-label">
                        <span alt="city" title="city"><?php echo l('debtor_integration/City'); ?></span>
                    </label>
                        <input type="text" name="city" class="form-control" value="<?php echo isset(get_post_meta($post_id, 'city', true)['meta_value'])?get_post_meta($post_id, 'city', true)['meta_value']:''; ?>">
                    </div>
					<div class="col-sm-6">
					<label for="state" class="control-label">
                        <span alt="state" title="state"><?php echo l('debtor_integration/State/Province'); ?></span>
                    </label>
                        <input type="text" name="state" class="form-control" value="<?php echo isset(get_post_meta($post_id, 'state', true)['meta_value'])?get_post_meta($post_id, 'state', true)['meta_value']:''; ?>">
                    </div>
                </div>
                
                <div class="form-group rate-group">
                   
                    <div class="col-sm-6">
					 <label for="country" class="control-label">
                        <span alt="country" title="country"><?php echo l('debtor_integration/Country'); ?></span>
                    </label>
                        <input type="text" name="country" class="form-control" value="<?php echo isset(get_post_meta($post_id, 'country', true)['meta_value'])?get_post_meta($post_id, 'country', true)['meta_value']:''; ?>">
                    </div>
					 <div class="col-sm-6">
					<label for="credit_limit" class="control-label">
                        <span alt="credit_limit" title="credit_limit"><?php echo l('debtor_integration/Credit Limit'); ?></span>
                    </label>
                        <input type="text" name="credit_limit" class="form-control" value="<?php echo isset(get_post_meta($post_id, 'credit_limit', true)['meta_value'])?get_post_meta($post_id, 'credit_limit', true)['meta_value']:''; ?>">
                    </div>
                </div>

                <div class="form-group rate-group">
                    
                    <div class="col-sm-6">
					<label for="attach_rate_code" class="control-label">
                        <span alt="attach_rate_code" title="attach_rate_code"><?php echo l('debtor_integration/Attach rate Code'); ?></span>
                    </label>
                    <select class="form-control" name="attach_rate_code" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="3">
                            <!-- <option value=""><?php echo l('debtor_integration/Select Option'); ?></option> -->
							<?php foreach($rate_plans as $key=>$val){ 

                                $show_selected = '';

                                if(in_array($val['rate_plan_id'],$attach_rate_code)){
                                    $show_selected = 'selected';
                                }
                                ?>
							<option <?php echo $show_selected?> value="<?php echo $val['rate_plan_id']; ?>"><?php echo $val['rate_plan_name']; ?></option>
							<?php } ?>
                    </select> </div>
                </div>
				
				 <!-- <div class="form-group rate-group">
                    
                    <div class="col-sm-6">
					<label for="person_name" class="control-label">
                        <span alt="person_name" title="person_name"><?php echo l('debtor_integration/Contact Person Name'); ?></span>
                    </label>
                        <input type="text" name="person_name" class="form-control" value="<?php echo isset(get_post_meta($post_id, 'person_name', true)['meta_value'])?get_post_meta($post_id, 'person_name', true)['meta_value']:''; ?>">
                    </div>
					 <div class="col-sm-6">
					<label for="email" class="control-label">
                        <span alt="email" title="email"><?php echo l('debtor_integration/Email'); ?></span>
                    </label>
                        <input type="text" name="email" class="form-control" value="<?php echo isset(get_post_meta($post_id, 'email', true)['meta_value'])?get_post_meta($post_id, 'email', true)['meta_value']:''; ?>">
                    </div>
                </div>
				
				 <div class="form-group rate-group">
                    
                    <div class="col-sm-6">
					<label for="phone" class="control-label">
                        <span alt="phone" title="phone"><?php echo l('debtor_integration/Phone'); ?></span>
                    </label>
                        <input type="text" name="phone" class="form-control" value="<?php echo isset(get_post_meta($post_id, 'phone', true)['meta_value'])?get_post_meta($post_id, 'phone', true)['meta_value']:''; ?>">
                    </div>
					<div class="col-sm-6">
					 <label for="booker_id" class="control-label">
                        <span alt="booker_id" title="booker_id"><?php echo l('debtor_integration/Booker ID'); ?></span>
                    </label>
                        <input type="text" name="booker_id" class="form-control" value="<?php echo isset(get_post_meta($post_id, 'booker_id', true)['meta_value'])?get_post_meta($post_id, 'booker_id', true)['meta_value']:''; ?>">
                    </div>
                </div> -->















<!-- Button trigger modal -->



<div class="form-group rate-group">
                   
                   <div class="col-sm-6">
                    <!-- <label for="country" class="control-label">
                       <span alt="country" title="country"><?php echo l('debtor_integration/Country'); ?></span>
                   </label> -->
                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modaladdcustomer">
                    Add Contact
                    </button>                   
                </div>
                    <!-- <div class="col-sm-6">
                   <label for="credit_limit" class="control-label">
                       <span alt="credit_limit" title="credit_limit"><?php echo l('debtor_integration/Credit Limit'); ?></span>
                   </label>
                       <input type="text" name="credit_limit" class="form-control" value="<?php echo isset(get_post_meta($post_id, 'credit_limit', true)['meta_value'])?get_post_meta($post_id, 'credit_limit', true)['meta_value']:''; ?>">
                   </div> -->
               </div>

        <div class="panel-body form-horizontal ">
    <div id="configure-channex" >




<!-- Modal -->
<div class="modal fade" id="Modaladdcustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Contact</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group rate-group">
                        
            <div class="col-sm-6">
            <label for="person_name_new" class="control-label">
                <span alt="person_name" title="person_name"><?php echo l('debtor_integration/Contact Person Name'); ?></span>
            </label>
                <input type="text" name="person_name_new" class="form-control" value="">
            </div>
                <div class="col-sm-6">
            <label for="email_new" class="control-label">
                <span alt="email" title="email"><?php echo l('debtor_integration/Email'); ?></span>
            </label>
                <input type="text" name="email_new" class="form-control" value="">
            </div>
        </div>
        
        <div class="form-group rate-group">
            
            <div class="col-sm-6">
            <label for="phone_new" class="control-label">
                <span alt="phone" title="phone"><?php echo l('debtor_integration/Phone'); ?></span>
            </label>
                <input type="text" name="phone_new" class="form-control" value="">
            </div>
            <div class="col-sm-6">
                <label for="booker_id_new" class="control-label">
                <span alt="booker_id" title="booker_id"><?php echo l('debtor_integration/Booker ID'); ?></span>
            </label>
                <input type="text" name="booker_id_new" class="form-control" value="">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" name="new" class="btn btn-primary save-customer">Add</button>
      </div>
    </div>
  </div>
</div>



<?php








foreach ($customer_id as $key => $value) {

    if($key ==0){
        ?>
            <h4>
            <?php echo l('Contact'); ?>
        </h4>

    <?php }

    ?>




    <div class="form-group rate-group">
        
        <div class="col-sm-6">
        <!-- <label for="person_name" class="control-label">
            <span alt="person_name" title="person_name"><?php echo l('debtor_integration/Contact Person Name'); ?></span>
        </label> -->
            <input type="text" readonly name="person_name" class="form-control" value="<?php echo isset(get_post_meta($value, 'person_name', true)['meta_value'])?get_post_meta($value, 'person_name', true)['meta_value']:''; ?>">
        </div>
            <div class="col-sm-6">
        <!-- <label for="" class="control-label">
            <span alt="" title="email"> &nbsp;</span>
        </label>
        <br> -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modaleditcustomer_<?php echo $value ?>">
            Edit Contact
            </button>
            <!-- <input type="text" name="email" class="form-control" value="<?php echo isset(get_post_meta($post_id, 'email', true)['meta_value'])?get_post_meta($post_id, 'email', true)['meta_value']:''; ?>"> -->
        </div>
    </div>




<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modaleditcustomer">
  Edit Customer
</button> -->

<!-- Modal -->
<!-- <div class="modal fade" id="#Modaleditcustomer_<?php echo $value ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_<?php echo $value ?>" aria-hidden="true"> -->
<div class="modal fade" id="Modaleditcustomer_<?php echo $value ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_<?php echo $value ?>" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel_<?php echo $value ?>">Edit Contact</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group rate-group">
                        
            <div class="col-sm-6">
            <label for="person_name_<?php echo $value ?>" class="control-label">
                <span alt="person_name" title="person_name"><?php echo l('debtor_integration/Contact Person Name'); ?></span>
            </label>
                <input type="text" name="person_name_<?php echo $value ?>" class="form-control" value="<?php echo isset(get_post_meta($value, 'person_name', true)['meta_value'])?get_post_meta($value, 'person_name', true)['meta_value']:''; ?>">
            </div>
                <div class="col-sm-6">
            <label for="email_<?php echo $value ?>" class="control-label">
                <span alt="email" title="email"><?php echo l('debtor_integration/Email'); ?></span>
            </label>
                <input type="text" name="email_<?php echo $value ?>" class="form-control" value="<?php echo isset(get_post_meta($value, 'email', true)['meta_value'])?get_post_meta($value, 'email', true)['meta_value']:''; ?>">
            </div>
        </div>
        
        <div class="form-group rate-group">
            
            <div class="col-sm-6">
            <label for="phone_<?php echo $value ?>" class="control-label">
                <span alt="phone" title="phone"><?php echo l('debtor_integration/Phone'); ?></span>
            </label>
                <input type="text" name="phone_<?php echo $value ?>" class="form-control" value="<?php echo isset(get_post_meta($value, 'phone', true)['meta_value'])?get_post_meta($value, 'phone', true)['meta_value']:''; ?>">
            </div>
            <div class="col-sm-6">
                <label for="booker_id_<?php echo $value ?>" class="control-label">
                <span alt="booker_id" title="booker_id"><?php echo l('debtor_integration/Booker ID'); ?></span>
            </label>
                <input type="text" name="booker_id_<?php echo $value ?>" class="form-control" value="<?php echo isset(get_post_meta($value, 'booker_id', true)['meta_value'])?get_post_meta($value, 'booker_id', true)['meta_value']:''; ?>">
            </div>
        </div>
      </div>
      <div class="modal-footer">
      <input type="hidden" name="contacr_id_<?php echo $value ?>" class="form-control" value="<?php $value ?>">


        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" name="<?php echo $value ?>" class="btn btn-primary save-customer">Save changes</button>
      </div>
    </div>
  </div>
</div>






<?php
}
?>











				

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
                    <button type="button" class="btn btn-success settings-debtor" >Submit</button>
                </div>
            </div>
            
        </div>

    </div>
</div>
