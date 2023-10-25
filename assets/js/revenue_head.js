$(document).ready(function () {
    $('#post_list').DataTable();
    $('#add_revenue_head_button').on('click', function () {
        $('#add_post_model form')[0].reset();
        $('#update_revenue_head').css("display", "none");
        $('#add_post_model').modal('show');
        $(".post-meta").css("display", "");

    });
});

$('#add_revenue_head').on('click', function () {
    var is_deleted = 0;
    if($('input[id="not_in_use"]').is(":checked"))
    {
        is_deleted = 1;
    }
    var post_data = {
        'post_title': 'Debtor Integration Revenue Head',
        'post_type': 'debtor_integration_revenue_head',
        'meta': {
            'description': $('input[id="description"]').val() ?? '',
            'sequence_no': $('input[id="sequence_no"]').val() ?? '',
            'not_in_use': $('input[id="not_in_use"]').is(":checked") ? 1 : 0,
        }
    };


    console.log(post_data);
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/add_revenue_head',
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
    $('#add_revenue_head').css("display", "none");
    $('#update_revenue_head').css("display", "");
    $(".post-meta").css("display", "none");
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/get_edit_revenue_head/' + post_id,
        data: {},
        dataType: "json",
        success: function (data) {
            if (data.success) {
                $("#post_id").val(data.post[0].post_id);
                $("#description").val(data.post[0].description);
                $("#sequence_no").val(data.post[0].sequence_no);
                $("#not_in_use").prop("checked", data.post[0].not_in_use == 1);

                $('#add_post_model').modal('show');

            }
        }
    });
    return false;
});

$('#update_revenue_head').on('click', function () {

    var is_deleted = 0;
    if($('input[id="not_in_use"]').is(":checked"))
    {
        is_deleted = 1;
    }

    var post_data = {
        'post_id': $('input[id="post_id"]').val(),
        'post_title': 'Debtor Integration Revenue Head',
        'post_type': 'debtor_integration_revenue_head',
        'meta': {
            'description': $('input[id="description"]').val() ?? '',
            'sequence_no': $('input[id="sequence_no"]').val() ?? '',
            'not_in_use': $('input[id="not_in_use"]').is(":checked") ? 1 : 0,
        }
    };
    console.log(post_data);
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/update_revenue_head',
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



$(".delete_revenue_head").on('click', function () {
    var post_id = this.id;
    if (confirm("Are you sure to delete this revenue head ?")) {
        $.ajax({
            type: "POST",
            url: getBaseURL() + 'debtor/delete_revenue_head/' + post_id,
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
