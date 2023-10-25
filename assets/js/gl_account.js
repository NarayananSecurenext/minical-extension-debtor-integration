$(document).ready(function () {
    $('#post_list').DataTable();
    $('#add_gl_account_button').on('click', function () {
        $('#add_post_model form')[0].reset();
        $('#update_gl_account').css("display", "none");
        $('#add_post_model').modal('show');
        $(".post-meta").css("display", "");

    });
});

$('#add_gl_account').on('click', function () {

    var post_data = {
        'post_title': 'Debtor Integration gl_account',
        'post_type': 'debtor_integration_gl_account',
        'meta': {
            'gl_account_code': $('input[id="gl_account_code"]').val() ?? '',
            'description': $('input[id="description"]').val() ?? '',
            'not_in_use': $('input[id="not_in_use"]').is(":checked") ? 1 : 0,
        }
    };

    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/add_gl_account',
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
    $('#add_gl_account').css("display", "none");
    $('#update_gl_account').css("display", "");
    $(".post-meta").css("display", "none");
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/get_edit_gl_account/' + post_id,
        data: {},
        dataType: "json",
        success: function (data) {
            if (data.success) {
                $("#post_id").val(data.post[0].post_id);
                $("#gl_account_code").val(data.post[0].gl_account_code);
                $("#description").val(data.post[0].description);
                $("#not_in_use").prop("checked", data.post[0].not_in_use == 1);

                $('#add_post_model').modal('show');
            }
        }
    });
    return false;
});

$('#update_gl_account').on('click', function () {

    var post_data = {
        'post_id': $('input[id="post_id"]').val(),
        'post_title': 'Debtor Integration gl_account',
        'post_type': 'debtor_integration_gl_account',
        'meta': {
            'gl_account_code': $('input[id="gl_account_code"]').val() ?? '',
            'description': $('input[id="description"]').val() ?? '',
            'not_in_use': $('input[id="not_in_use"]').is(":checked") ? 1 : 0,
        }
    };
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/update_gl_account',
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



$(".delete_gl_account").on('click', function () {
    var post_id = this.id;
    if (confirm("Are you sure to delete this gl_account head ?")) {
        $.ajax({
            type: "POST",
            url: getBaseURL() + 'debtor/delete_gl_account/' + post_id,
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
