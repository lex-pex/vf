$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function sbSwap() {
    var sb = document.getElementById("sidebar");
    if (sb !== null) {
        toggle(sb);
    } else {
        sb = document.getElementById("w3_sidebar");
        if (sb !== null) {
            toggle(sb);
        }
    }
}

function toggle(sb) {
    var btn = document.getElementById('sb_btn');
    if (sb.style.display === "block") {
        sb.style.display = "none";
        btn.className = 'fa fa-bars fa-2x';
    } else {
        sb.style.display = "block";
        btn.className = 'fa fa-times fa-2x';
    }
}

$('.vf-calendar').carousel({
    interval: 0
});

/**
 * Comment edit
 * @param id - comment under editing
 * @param author - the fake name of author
 */
function editComment(id, author) {
    if (document.getElementById(id + '_edit_pane').style.display === 'block') {
        document.getElementById(id + '_edit_pane').style.display = 'none';
        document.getElementById(id + '_display').style.display = 'block';
    } else {
        var text = document.getElementById(id + '_txt').textContent;
        document.getElementById(id + '_textarea').value = text; // set the text on text area
        document.getElementById(id + '_edit_pane').style.display = 'block'; // open the edit pane
        document.getElementById(id + '_display').style.display = 'none'; // close the COMMENT on editing
        document.getElementById('author').value = author; // set the input author name
    }
}

/**  - Toggle click on text area of comment ADDING COMMENT */
function open_comment() {
    var input = document.getElementById("input");
    var txt = document.getElementById("txt");
    input.setAttribute('rows', '2');
    txt.style.display = "block";
}

function close_comment() {
    var input = document.getElementById("input");
    var txt = document.getElementById("txt");
    input.value = '';
    input.setAttribute('rows', '1');
    txt.style.display = "none";
}

$(document).ready(function () {
    $(".add-to-cart").click(function () {
        var id = $(this).attr('data_id');
        var token = $(this).attr('token');
        var par = {id : id, _token : token};
        $.post('/shop/cart/add/' + id, par, function (data) {
            $("#cart_count").html(data);
        });
        $('.add-to-cart-picture').fadeIn(1000);
        setTimeout(function () {
            $('.add-to-cart-picture').fadeOut(1000);
        }, 1200);
        return false;
    });

    $(".del-from-cart").click(function () {
        var id = $(this).attr('data_id');
        var token = $(this).attr('token');
        var par = {id : id, _token : token};
        $.post('/shop/cart/del/' + id, par, function (data) {
            var response = JSON.parse(data);
            $('#cart_count').html(response.count);
            document.getElementById(id).style.display = 'none';
            $('#total').html(response.total);
        });
        return false;
    });
});

function amount(id){
    var token = $(".del-from-cart").attr('token');
    var amo = document.getElementById('amount_' + id).value;
    var par = {id : id, amount : amo, _token : token};
    $.post('/shop/cart/amount/' + id + '/' + amo, par, function (data) {
        var response = JSON.parse(data);
        $('#cart_count').html(response.count);
        $('#total').html(response.total);
    });
}

/* iHerb counter */

function ihCount(number) {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.post(
        '/shop/cart/ihcount/' + number,
        {_token : token, number: number},
        function (data) {
            $('#iherb_counter_' + number).html(data);
        });
}

function ihCountReset(number) {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.post(
        '/shop/cart/ihcountreset/' + number,
        {_token : token, number: number},
        function (data) {
            $('#iherb_counter_' + number).html(0);
        });
}

$(document).ready(function () {
    $('#modal_launcher').click();
});

function modalMessageRead() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.post('/shop/cart/message_read', {_token : token });
}


