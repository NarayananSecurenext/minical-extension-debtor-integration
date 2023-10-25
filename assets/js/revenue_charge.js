$(document).ready(function () {
    $('#post_list').DataTable();
    $('#add_revenue_charge_button').on('click', function () {
        $('#add_post_model form')[0].reset();
        $('#update_revenue_charge').css("display", "none");
        $('#add_post_model').modal('show');
        $(".post-meta").css("display", "");

    });
});

$('#add_revenue_charge').on('click', function () {

    var post_data = {
        'post_title': 'Debtor Integration revenue_charge',
        'post_type': 'debtor_integration_revenue_charge',
        'meta': {
            'department': $('select[id="department"]').val() ?? '',
            'revenue_head': $('select[id="revenue_head"]').val() ?? '',
            'description': $('input[id="description"]').val() ?? '',
            'default_price': $('input[id="default_price"]').val() ?? '',
            'gl_account': $('select[id="gl_account"]').val() ?? '',
            'multiple_currency': $('input[id="multiple_currency"]').is(":checked") ? 1 : 0,
            'non_revenue': $('input[id="non_revenue"]').is(":checked") ? 1 : 0,
            'not_in_use': $('input[id="not_in_use"]').is(":checked") ? 1 : 0,
            'sac_code': $('select[id="sac_code"]').val() ?? '',
        }
    };
    



    console.log(post_data);
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/add_revenue_charge',
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
    $('#add_revenue_charge').css("display", "none");
    $('#update_revenue_charge').css("display", "");
    $(".post-meta").css("display", "none");
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/get_edit_revenue_charge/' + post_id,
        data: {},
        dataType: "json",
        success: function (data) {
            if (data.success) {
                $("#post_id").val(data.post[0].post_id);
                $("#department").val(data.post[0].department);
                $("#revenue_head").val(data.post[0].revenue_head);
                $("#description").val(data.post[0].description);
                $("#default_price").val(data.post[0].default_price);
                $("#gl_account").val(data.post[0].gl_account);
                $("#non_revenue").prop("checked", data.post[0].non_revenue == 1);
                $("#multiple_currency").prop("checked", data.post[0].multiple_currency == 1);
                $("#not_in_use").prop("checked", data.post[0].not_in_use == 1);
                $("#sac_code").val(data.post[0].sac_code);

                $('#add_post_model').modal('show');
            }
        }
    });
    return false;
});

$('#update_revenue_charge').on('click', function () {

    var is_deleted = 0;
    if($('input[id="not_in_use"]').is(":checked"))
    {
        is_deleted = 1;
    }
    var post_data = {
        'post_id': $('input[id="post_id"]').val(),
        'post_title': 'Debtor Integration revenue_charge',
        'post_type': 'debtor_integration_revenue_charge',
        'meta': {
            'department': $('select[id="department"]').val() ?? '',
            'revenue_head': $('select[id="revenue_head"]').val() ?? '',
            'description': $('input[id="description"]').val() ?? '',
            'default_price': $('input[id="default_price"]').val() ?? '',
            'gl_account': $('select[id="gl_account"]').val() ?? '',
            'multiple_currency': $('input[id="multiple_currency"]').is(":checked") ? 1 : 0,
            'non_revenue': $('input[id="non_revenue"]').is(":checked") ? 1 : 0,
            'not_in_use': $('input[id="not_in_use"]').is(":checked") ? 1 : 0,
            'sac_code': $('select[id="sac_code"]').val() ?? '',
        }
    };
    console.log(post_data);
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/update_revenue_charge',
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



$(".delete_revenue_charge").on('click', function () {
    var post_id = this.id;
    if (confirm("Are you sure to delete this revenue_charge head ?")) {
        $.ajax({
            type: "POST",
            url: getBaseURL() + 'debtor/delete_revenue_charge/' + post_id,
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
