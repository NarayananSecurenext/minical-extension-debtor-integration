$(document).ready(function(){



    $('body').on('click','.save-customer',function(){


        var contact_id = $(this).attr('name');



        var person_name = $('input[name="person_name_'+contact_id+'"]').val();
        var email = $('input[name="email_'+contact_id+'"]').val();
        var phone = $('input[name="phone_'+contact_id+'"]').val();
        var booker_id = $('input[name="booker_id_'+contact_id+'"]').val();
        var debtor_id = $('input[name="debtor_id"]').val();



        if(person_name == ''){
            alert(l('Please enter name', true));
        }
          else {
            $.ajax({
                type    : "POST",
                dataType: 'json',
                url     : getBaseURL() + 'save_customer',
                data: {
					person_name : person_name,
					email : email,
					phone : phone,
					booker_id : booker_id,
                    debtor_id : debtor_id,
                    customer_id : contact_id,
				},
                success: function( data ) {
                    if(data.success){
						alert(l('Contact saved successfully!'));
                        window.location.href = getBaseURL() + 'update-debtor/'+debtor_id;
                    } else {
                        alert(data.msg);
                    }
                }
            });
        }
    });


    $('body').on('click','.settings-debtor',function(){
        var debtor_type = $('select[name="debtor_type"]').val();
        var debtor_code = $('input[name="debtor_code"]').val();
        var debtor_name = $('input[name="debtor_name"]').val();
        var debtor_description = $('input[name="debtor_description"]').val();
        var vat_number = $('input[name="vat_number"]').val();
        var pan_number = $('input[name="pan_number"]').val();
        var gst_number = $('input[name="gst_number"]').val();
        var marketing_segment = $('select[name="marketing_segment"]').val();
        var booking_source = $('select[name="booking_source"]').val();
        var address = $('input[name="address"]').val();
        var city = $('input[name="city"]').val();
        var state = $('input[name="state"]').val();
        var country = $('input[name="country"]').val();
        var credit_limit = $('input[name="credit_limit"]').val();
        var person_name = $('input[name="person_name"]').val();
        var email = $('input[name="email"]').val();
        var phone = $('input[name="phone"]').val();
        var booker_id = $('input[name="booker_id"]').val();
        var attach_rate_code = $('select[name="attach_rate_code"]').val();
        var debtor_id = $('input[name="debtor_id"]').val();
        
        if(debtor_type == ''){
            alert(l('Please enter Debtor Type', true));
        }
          else {
            $.ajax({
                type    : "POST",
                dataType: 'json',
                url     : getBaseURL() + 'save-debtor',
                data: {
					debtor_type : debtor_type,
					debtor_code : debtor_code,
					debtor_name : debtor_name,
					debtor_description : debtor_description,
					vat_number : vat_number,
					pan_number : pan_number,
					gst_number : gst_number,
					marketing_segment : marketing_segment,
					booking_source : booking_source,
					address : address,
					city : city,
					state : state,
					country : country,
					credit_limit : credit_limit,
					person_name : person_name,
					email : email,
					phone : phone,
					booker_id : booker_id,
					attach_rate_code : attach_rate_code,
					debtor_id : debtor_id,
				},
                success: function( data ) {
                    if(data.success){
						alert(l('Debtor save successfully!'));
                    if(debtor_id ==""){
                        window.location.href = getBaseURL() + 'update-debtor/'+data.debtor_id;
                    }else{
                        window.location.href = getBaseURL() + 'debtor'
                    }

                    } else {
                        alert(data.msg);
                    }
                }
            });
        }
    });

   
    
});

function EnableDisable (debtor_id, dstatus){
	let text = "Are you sure you want to "+dstatus;
   if (confirm(text) == true) {
    $.ajax({
                type    : "POST",
                dataType: 'json',
                url     : getBaseURL() + 'status-debtor',
                data: {
					is_disable : dstatus,
					debtor_id : debtor_id,
				},
                success: function( data ) {
                    if(data.success){
						alert(l('This Debtor '+dstatus+' successfully!'));
                        window.location.href = getBaseURL() + 'debtor'
                    } else {
                        alert(data.msg);
                    }
                }
            });
  } else {
    text = "You canceled!";
  }
}

