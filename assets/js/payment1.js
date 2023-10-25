$(document).ready(function () {
    $('#post_list').DataTable();
    $('#add_payment1_button').on('click', function () {
        $('#add_post_model form')[0].reset();
        $('#update_payment1').css("display", "none");
        $('#add_post_model').modal('show');
        $(".post-meta").css("display", "");

    });
});

$('#add_payment1').on('click', function () {

    var post_data = {
        'post_title': 'Debtor Integration payment1',
        'post_type': 'debtor_integration_payment1',
        'meta': {
            'payment': $('select[id="payment"]').val() ?? '',
            'charge': $('select[id="charge"]').val() ?? '',
            'payment_mode': $('select[id="payment_mode"]').val() ?? '',
            'transfer_to_debtor': $('input[id="transfer_to_debtor"]').is(":checked") ? 1 : 0,
            'non_room_account': $('select[id="non_room_account"]').val() ?? '',
            'debtor_account': $('select[id="debtor_account"]').val() ?? '',
            'not_in_use': $('input[id="not_in_use"]').is(":checked") ? 1 : 0,
        }
    };
    



    console.log(post_data);
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/add_payment1',
        data: post_data,
        dataType: "json",
        success: function (data) {
            console.log(data);
            if (data.success) {
                alert('Data is added!')
                location.reload();
            } else {
                alert(l(data.error));
                console.log(data);
            }
        }
    });
    return false;
});


$(".edit_post_button").on('click', function () {
    var post_id = this.id;
    // console.log(post_id, bid);
    $('#add_payment1').css("display", "none");
    $('#update_payment1').css("display", "");
    $(".post-meta").css("display", "none");
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/get_edit_payment1/' + post_id,
        data: {},
        dataType: "json",
        success: function (data) {
            if (data.success) {
                $("#post_id").val(data.post[0].post_id);
                $("#payment").val(data.post[0].payment);
                $("#charge").val(data.post[0].charge);
                $("#payment_mode").val(data.post[0].payment_mode);
                $("#transfer_to_debtor").prop("checked", data.post[0].transfer_to_debtor == 1);
                $("#non_room_account").val(data.post[0].non_room_account);
                $("#debtor_account").val(data.post[0].debtor_account);
                $("#not_in_use").prop("checked", data.post[0].not_in_use == 1);

                $('#add_post_model').modal('show');
            }
        }
    });
    return false;
});

$('#update_payment1').on('click', function () {

    var is_deleted = 0;
    if($('input[id="not_in_use"]').is(":checked"))
    {
        is_deleted = 1;
    }
    var post_data = {
        'post_id': $('input[id="post_id"]').val(),
        'post_title': 'Debtor Integration payment1',
        'post_type': 'debtor_integration_payment1',
        'meta': {
            'payment': $('select[id="payment"]').val() ?? '',
            'charge': $('select[id="charge"]').val() ?? '',
            'payment_mode': $('select[id="payment_mode"]').val() ?? '',
            'transfer_to_debtor': $('select[id="transfer_to_debtor"]').is(":checked") ? 1 : 0,
            'non_room_account': $('select[id="non_room_account"]').val() ?? '',
            'debtor_account': $('select[id="debtor_account"]').val() ?? '',
            'not_in_use': $('input[id="not_in_use"]').is(":checked") ? 1 : 0,
        }
    };
    console.log(post_data);
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/update_payment1',
        data: post_data,
        dataType: "json",
        success: function (data) {
            console.log(data);
            if (data.success) {
                alert('Data is updated!')
                location.reload();
            } else {
                alert(l(data.error));
                console.log(data);
            }
        }
    });
    return false;
});



$(".delete_payment1").on('click', function () {
    var post_id = this.id;
    if (confirm("Are you sure to delete this payment1 head ?")) {
        $.ajax({
            type: "POST",
            url: getBaseURL() + 'debtor/delete_payment1/' + post_id,
            data: {},
            dataType: "json",
            success: function (data) {
                console.log(data)
                if (data.success) {
                    alert(data.msg);
                    location.reload();
                } else {
                    alert(l(data.error));
                    console.log(data);
                }
            }
        });
    }
    return false;
});
