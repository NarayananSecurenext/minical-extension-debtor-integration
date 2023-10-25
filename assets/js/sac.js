$(document).ready(function () {
    $('#post_list').DataTable();
    $('#add_sac_button').on('click', function () {
        $('#add_post_model form')[0].reset();
        $('#update_sac').css("display", "none");
        $('#add_post_model').modal('show');
        $(".post-meta").css("display", "");

    });
});

$('#add_sac').on('click', function () {

    var post_data = {
        'post_title': 'Debtor Integration sac',
        'post_type': 'debtor_integration_sac',
        'meta': {
            'sac_code': $('input[id="sac_code"]').val() ?? '',
            'description': $('input[id="description"]').val() ?? '',
            'not_in_use': $('input[id="not_in_use"]').is(":checked") ? 1 : 0,
            'goods_or_services': $('select[id="revenue_type"]').val() ?? '',

        }
    };

    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/add_sac',
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
    $('#add_sac').css("display", "none");
    $('#update_sac').css("display", "");
    $(".post-meta").css("display", "none");
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/get_edit_sac/' + post_id,
        data: {},
        dataType: "json",
        success: function (data) {
            if (data.success) {
                $("#post_id").val(data.post[0].post_id);
                $("#sac_code").val(data.post[0].sac_code);
                $("#description").val(data.post[0].description);
                $("#goods_or_services").val(data.post[0].goods_or_services);
                $("#not_in_use").prop("checked", data.post[0].not_in_use == 1);

                $('#add_post_model').modal('show');
            }
        }
    });
    return false;
});

$('#update_sac').on('click', function () {

    var post_data = {
        'post_id': $('input[id="post_id"]').val(),
        'post_title': 'Debtor Integration sac',
        'post_type': 'debtor_integration_sac',
        'meta': {
            'sac_code': $('input[id="sac_code"]').val() ?? '',
            'description': $('input[id="description"]').val() ?? '',
            'goods_or_services': $('select[id="goods_or_services"]').val() ?? '',
            'not_in_use': $('input[id="not_in_use"]').is(":checked") ? 1 : 0,
        }
    };
    $.ajax({
        type: "POST",
        url: getBaseURL() + 'debtor/update_sac',
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



$(".delete_sac").on('click', function () {
    var post_id = this.id;
    if (confirm("Are you sure to delete this sac head ?")) {
        $.ajax({
            type: "POST",
            url: getBaseURL() + 'debtor/delete_sac/' + post_id,
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
