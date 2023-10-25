$(document).ready(function () {
    $('#post_list').DataTable();
    $('#add_post_model_button').on('click', function () {
        $('#add_post_model form')[0].reset();
        $('#update_revenue').css("display", "none");
        $('#add_post_model').modal('show');
        $(".post-meta").css("display", "");

    });
});

$('#add_revenue').on('click', function () {

    var post_data = {
        'post_title': 'Debtor Integration Revenue',
        'post_type': 'debtor_integration_revenue',
        'meta': {
            'revenue_code': $('input[id="revenue_code"]').val() ?? '',
            'type': $('select[id="type"]').val() ?? '',
            'description': $('input[id="description"]').val() ?? '',
            'gl_code': $('select[id="gl_code"]').val() ?? '',
        }
    };




    console.log(post_data);
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/add_revenue',
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
    $('#add_revenue').css("display", "none");
    $('#update_revenue').css("display", "");
    $(".post-meta").css("display", "none");
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/get_edit_revenue/' + post_id,
        data: {},
        dataType: "json",
        success: function (data) {
            if (data.success) {
                $("#post_id").val(data.post[0].post_id);
                $("#revenue_code").val(data.post[0].revenue_code);
                $("#description").val(data.post[0].description);
                $("#type").val(data.post[0].type);
                $("#gl_code").val(data.post[0].gl_code);

                $('#add_post_model').modal('show');
            }
        }
    });
    return false;
});

$('#update_revenue').on('click', function () {

    var is_deleted = 0;
    if($('input[id="not_in_use"]').is(":checked"))
    {
        is_deleted = 1;
    }
    var post_data = {
        'post_id': $('input[id="post_id"]').val(),
        'post_title': 'Debtor Integration Revenue',
        'post_type': 'debtor_integration_revenue',
        'meta': {
            'revenue_code': $('input[id="revenue_code"]').val() ?? '',
            'type': $('select[id="type"]').val() ?? '',
            'description': $('input[id="description"]').val() ?? '',
            'gl_code': $('select[id="gl_code"]').val() ?? '',
        }
    };
    console.log(post_data);
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/update_revenue',
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



$(".delete_revenue").on('click', function () {
    var post_id = this.id;
    if (confirm("Are you sure to delete this revenue head ?")) {
        $.ajax({
            type: "POST",
            url: getBaseURL() + 'debtor/delete_revenue/' + post_id,
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
