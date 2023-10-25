$(document).ready(function () {
    $('#post_list').DataTable();
    $('#add_department_button').on('click', function () {
        $('#add_post_model form')[0].reset();
        $('#update_department').css("display", "none");
        $('#add_post_model').modal('show');
        $(".post-meta").css("display", "");

    });
});

$('#add_department').on('click', function () {

    var post_data = {
        'post_title': 'Debtor Integration department',
        'post_type': 'debtor_integration_department',
        'meta': {
            'department_code': $('input[id="department_code"]').val() ?? '',
            'description': $('input[id="description"]').val() ?? '',
            'revenue_type': $('select[id="revenue_type"]').val() ?? '',
            'sequence': $('input[id="sequence"]').val() ?? '',
            'show_pos_outlets': $('input[id="show_pos_outlets"]').is(":checked") ? 1 : 0,
            'multiple_currency': $('input[id="multiple_currency"]').is(":checked") ? 1 : 0,
            'not_in_use': $('input[id="not_in_use"]').is(":checked") ? 1 : 0,
        }
    };
    



    console.log(post_data);
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/add_department',
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
    $('#add_department').css("display", "none");
    $('#update_department').css("display", "");
    $(".post-meta").css("display", "none");
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/get_edit_department/' + post_id,
        data: {},
        dataType: "json",
        success: function (data) {
            if (data.success) {
                $("#post_id").val(data.post[0].post_id);
                $("#department_code").val(data.post[0].department_code);
                $("#description").val(data.post[0].description);
                $("#sequence").val(data.post[0].sequence);
                $("#show_pos_outlets").prop("checked", data.post[0].show_pos_outlets == 1);
                $("#multiple_currency").prop("checked", data.post[0].multiple_currency == 1);
                $("#not_in_use").prop("checked", data.post[0].not_in_use == 1);
// console.log("eee",data);

                $('#add_post_model').modal('show');
            }
        }
    });
    return false;
});

$('#update_department').on('click', function () {

    var is_deleted = 0;
    if($('input[id="not_in_use"]').is(":checked"))
    {
        is_deleted = 1;
    }
    var post_data = {
        'post_id': $('input[id="post_id"]').val(),
        'post_title': 'Debtor Integration department',
        'post_type': 'debtor_integration_department',
        'meta': {
            'department_code': $('input[id="department_code"]').val() ?? '',
            'description': $('input[id="description"]').val() ?? '',
            'revenue_type': $('select[id="revenue_type"]').val() ?? '',
            'sequence': $('input[id="sequence"]').val() ?? '',
            'show_pos_outlets': $('input[id="show_pos_outlets"]').is(":checked") ? 1 : 0,
            'multiple_currency': $('input[id="multiple_currency"]').is(":checked") ? 1 : 0,
            'not_in_use': $('input[id="not_in_use"]').is(":checked") ? 1 : 0,
        }
    };
    console.log(post_data);
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/update_department',
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



$(".delete_department").on('click', function () {
    var post_id = this.id;
    if (confirm("Are you sure to delete this department head ?")) {
        $.ajax({
            type: "POST",
            url: getBaseURL() + 'debtor/delete_department/' + post_id,
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
