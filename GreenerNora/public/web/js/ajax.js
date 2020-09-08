$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function() {
    let success = $('#success_flash_msg').text().trim();
    if (success.length > 0) {
        successMsg("Success", success);
    } else {
        let error = $('#error_flash_msg').text().trim();
        if (error.length > 0) {
            errorMsg("Error", error);
        }
    }
});

$('#commentform').on('submit', function(e) {
    e.preventDefault();
    var formdata = new FormData($(this)[0]);
    var url = $(this).attr('action');
    $.ajax({
        url: url,
        type: 'Post',
        cache: false,
        contentType: false,
        processData: false,
        data: formdata,
        success: function(data) {
            console.log(data);
            if (data.success) {
                getCommentTemplate(data.data);
                successMsg("Success", data.msg);
                $('#comment_text_area').val('');
            } else {
                errorMsg("Error", data.msg);
            }
        }

    });
});


function getCommentTemplate(data) {
    var avatar = data.avatar;
    var name = data.name;
    var date = data.date;
    var comment = data.comment;
    var template = $("#comment_template").clone(true, true);
    template.attr("id", null);
    template.find('#temp_img').attr("src", avatar);
    template.find('#temp_name').text(name);
    template.find('#temp_date').text(date);
    template.find('#temp_comment').html(comment);
    template.removeClass('d-none');
    template.appendTo("#comment_list_body");
}




$('.cart_ajax_form').on('submit', function(e) {
    e.preventDefault();
    var formdata = new FormData($(this)[0]);
    var item_id = $(this).attr('item_id');
    var url = $(this).attr('action');
    var hide = $(this).hasClass('hideItem');
    showSpinner(item_id);

    $.ajax({
        url: url,
        type: 'Post',
        cache: false,
        contentType: false,
        processData: false,
        data: formdata,
        success: function(data) {
            if (data.success) {
                successMsg("Success", data.msg);
                $('.course_cart_input_' + item_id).val(data.item_id);
                $('.cart_btn_text_' + item_id).text(data.title);
                $('.cart_btn_' + item_id).attr('title', data.title);
                $('.cart_form_' + item_id).attr('action', data.action);

                if (hide) {
                    $('.cartItem_' + item_id).addClass('d-none');
                }
            } else {
                errorMsg("Error", data.msg);
            }
            updateCart(data.quantity, data.price, data.discount, data.total);
            hideSpinner(item_id);
        }

    });
});

function updateCart(count, price = 0, discount = 0, total) {
    $('.cart_count').text(count);
    $('#cart_price').text(price);
    $('#cart_discount').text(discount);
    $('#cart_total').text(total);

    if (count < 1) {
        $('#has_cart_items').addClass('d-none');
        $('#no_cart_item').removeClass('d-none');
    }
}

function showSpinner(item_id) {
    $('.cart_btn_' + item_id).attr('disabled', true);
    $('.cart_btn_spinner_' + item_id).removeClass('d-none');
}



function hideSpinner(item_id) {
    $('.cart_btn_' + item_id).removeAttr('disabled');
    $('.cart_btn_spinner_' + item_id).addClass('d-none');
}