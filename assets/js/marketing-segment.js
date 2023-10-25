innGrid.saveAllBookingSource = function () {
	var updatedBookingSources = {};
    // var sort = 0;
    $(".marketing-segment-tr").each(function()
	{

        console.log("marketingSegmentTr",marketingSegmentTr);

		var marketingSegmentTr = $(this);
		var marketingSegmentId = marketingSegmentTr.attr('id');
		var marketingSegmentName = marketingSegmentTr.find('[name="marketing-segment-name"]').val();
		var marketingSegmentDescription = marketingSegmentTr.find('[name="description"]').val();
//        var bookingSourceSortOrder = marketingSegmentTr.find('[name="booking-source-sort-order"]').val();
        // var bookingSourceSortOrder = sort;
        
		var hidden = '0';
        if(marketingSegmentTr.find('[name="marketing-segment-hidden"]').is(":checked"))
        {
            hidden = '1';
        }
		if (marketingSegmentName == 'New Marketing Segment') {
		
            alert(l('Please fill in Marketing Segment name'));
            marketingSegmentTr.find('[name="marketing-segment-name"]').focus();
            return false;
        }

        updatedBookingSources[marketingSegmentId] = {
            id: marketingSegmentId,
            name: marketingSegmentName,
            description: marketingSegmentDescription,
            is_hidden: hidden,
        };
        // sort++;
        // alert(marketingSegmentName);
    });
    console.log("updatedBookingSources",updatedBookingSources);


    $.post(getBaseURL() + 'update-marketing-segment', {
            updated_marketing_segment: updatedBookingSources

        }, function (result) {

            if(result.success)
            {

                alert(l('All marketing segments saved'));
            }
            else
            {
                alert(result.error);
            }
    }, 'json');
}

$(function() {

	// $('#add-marketing-segment-button').click(function () {
	// 	$.post(getBaseURL() + 'new-marketing-segment', function (div){
	// 		console.log(div);
	// 		$('#booking-source').append(div);
	// 	});		
	// });

    $('#add-marketing-segment-button').click(function () {
        $.post(getBaseURL() + 'new-marketing-segment', function (results) {

            console.log("results",results);

            if (results.isSuccess == true){


            // Store the HTML code in new_append_type
            var new_append_type = `
                <tr class="marketing-segment-tr" id="`+results.new_marketing_segment_id+`">
                    <td class="">
                        <span class=""></span>
                        <input name="marketing-segment-name" class="form-control" type="text" value="New Marketing Segment" maxlength="45" style="width:250px"/>
                    </td>
                    <td>
                        <input name="description" class="form-control" type="text" value="" maxlength="45" style="width:200px"/>
                    </td>
                    <td>
                        <div class="checkbox" id="`+results.new_marketing_segment_id+`">
                            <input type="checkbox" class="hide-booking-source-button" style="margin-left: 0px!important;">
                        </div>
                    </td>
                </tr>
            `;
            console.log("new_append_type");

            // Append the HTML code to '#booking-source'
            $('#booking-source').append(new_append_type);

        }

        }, 'json');
    });

	

	$('#save-all-marketing-segment-button').on("click", function () {	
		innGrid.bookingSourceSavedCount = 0;		
		innGrid.saveAllBookingSource();
	});

	// $(document).on('click', '.delete-booking-source-button', function () {		
	// 	var that = this;
	// 	//Set custom buttons for delete dialog
	// 	$("#confirm_delete_dialog")
	// 	.html(l('Are you sure ?'))
	// 	.dialog({
	// 		title:(l('Delete booking Source')),
	// 		buttons: {				
	// 			"Confirm Delete":function() {					
	// 				$.post(getBaseURL() + 'settings/reservations/delete_booking_source', {
	// 					id: $(that).parent().parent().attr('id')
	// 					}, function (results) {							
	// 						if (results.isSuccess == true){
	// 								$(that).parent().parent().remove();  //delete line of X button
    //                         }
    //                         else {
	// 								//alert(results.message);
	// 							}
	// 						}, 'json');
	// 				$(this).dialog("close");
	// 			},
	// 			"Cancel": function() {
	// 				$(this).dialog("close");
	// 			}
	// 		}
	// 	});
		
	// 	$("#confirm_delete_dialog").dialog("open");
	// });
	
    // $(document).on('click', '.hide-booking-source-button', function () {
	// 	var that = this;
    //     var hidden = '0';
    //     if($(that).is(":checked"))
    //     {
    //         hidden = '1';
    //     }
    //     var marketingSegmentTr = $(this).parents('tr.marketing-segment-tr');
    //     var marketingSegmentId = marketingSegmentTr.attr('id');
    //     var marketingSegmentName = marketingSegmentTr.find('[name="marketing-segment-name"]').val();
    //     var bookingSourceSortOrder = marketingSegmentTr.find('[name="booking-source-sort-order"]').val();
    //     var marketingSegmentDescription = marketingSegmentTr.find('[name="description"]').val();
	// 	//Set custom buttons for delete dialog
	// 	$("#confirm_delete_dialog")
	// 	.html(l('Are you sure ?'))
	// 	.dialog({
	// 		title: l('Hide booking Source'),
	// 		buttons: {				
	// 			"Confirm":function() {					
    //                 $.post(getBaseURL() + 'settings/reservations/update_booking_sources', {
    //                         updated_booking_sources: {
    //                             marketingSegmentId: {
    //                                 id: marketingSegmentId,
    //                                 name: marketingSegmentName,
    //                                 description: marketingSegmentDescription,
    //                                 is_hidden: hidden,
    //                                 sort_order: bookingSourceSortOrder
    //                             }
    //                         }
    //                     }, function (result) {
    //                         if(!result.success)
    //                         {
    //                             alert(result.error);
    //                         }
    //                 }, 'json');
	// 				$(this).dialog("close");
	// 			},
	// 			"Cancel": function() {
	// 				$(this).dialog("close");
	// 			}
	// 		}
	// 	});
		
	// 	$("#confirm_delete_dialog").dialog("open");
	// });
    
    // $( "#sortable" ).sortable();  
});
