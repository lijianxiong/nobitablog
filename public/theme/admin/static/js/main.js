$(function(){
    $(".status").change(function(){
        var status = $('.status input:radio:checked').val();
        if(status == 2){
            $('.input-more').css({'height':'541px'});
            $(".password").css({"display":"block"})
        }else{
            $(".password").css({"display":"none"})
            $('.input-more').css({'height':'411px'});
        }
    });
});

$('.user-info').click(
    function () {
        let dropdownUser = $('.dropdown-user');
        dropdownUser.addClass("show");
        let mask = $('.mask');
        toggleItem(dropdownUser);
        toggleItem(mask);
    }
);
$('.comment-view').click(
    function () {
        let id = $(this).data("id");
        let item = $('#item-'+id+' .item-times');
        item.addClass('comment-show');
    }
);
$('.mobile-nav').click(function () {
    let nav = $('.sidebar');
    toggleItem(nav);
});
$('.c-more').click(
    function () {
        let inputMore = $('.input-more');
        toggleItem(inputMore);
        let mask = $('#write-item .mask');
        toggleItem(mask);
    }
);
$('#write-item .mask').click(
    function () {
        let mask = $('#write-item .mask');
        toggleItem(mask);
        let inputMore = $('.input-more');
        toggleItem(inputMore);
    }
);
$('.more-submit').click(function () {
    let inputMore = $('.input-more');
    toggleItem(inputMore);
});
function toggleItem(item) {
    if (item.css("display") == "none") {
        item.css('display','block');
    }else{
        item.css('display','none');
    }
}
function showtips(value) {
    $('.t-info').text(value);
    $('#tips').show(500);
    setTimeout(function(){$('#tips').hide(500)},2000);
}
function showreload(value) {
    $('.t-info').text(value);
    $('#tips').show(500);
    setTimeout(function(){location.reload();},2000);
}
$('.clear-link').click(function () {
    $('.add-links #id').val('0');
    $('.add-links #title').val('');
    $('.add-links #email').val('');
    $('.add-links #url').val('');
    $('.add-links #description').val('');
    $('.add-links #weight').val('');
    $('.add-links #slug').val('');
});
$('.links-body .item-card').click(function () {
    let id = $(this).data("id");
    console.log(id);
    $.post("/admin/links/edit/",{
        'id' :id
    },function (data) {
        console.log(data);
        if (data){
            $('.add-links #id').val(data.id);
            $('.add-links #title').val(data.title);
            $('.add-links #email').val(data.email);
            $('.add-links #url').val(data.url);
            $('.add-links #description').val(data.description);
            $('.add-links #weight').val(data.weight);
        }
        else{
            showtips('请求出错，请重试!')
        }
    });
});
$('.category-body .item-card').click(function () {
    let id = $(this).data("id");
    console.log(id);
    $.post("/admin/category/edit/",{
        'id' :id
    },function (data) {
        console.log(data);
        if (data){
            $('.add-links #id').val(data.id);
            $('.add-links #title').val(data.title);
            $('.add-links #slug').val(data.slug);
        }
        else{
            showtips('请求出错，请重试!')
        }
    });
});
$('.links-del').click(function () {
    let id = $(this).data("id");
    console.log(id);
    $.post("/admin/links/del/",{
        'id' :id
    },function (data) {
        console.log(data);
        if (data){
            $('.links-id-'+id).hide(300);
            showtips('友链删除成功!');
        }
        else{
            showtips('请求出错，请重试!')
        }
    });
});
$('.category-del').click(function () {
    let id = $(this).data("id");
    console.log(id);
    $.post("/admin/category/del/",{
        'id' :id
    },function (data) {
        console.log(data);
        if (data){
            $('.category-id-'+id).hide(300);
            showtips('分类删除成功!');
        }
        else{
            showtips('请求出错，请重试!')
        }
    });
});
function action(url,id,type,dbname,success,error) {
    $.post(url,
        {
            'id':id,
            'type':type,
            'model':dbname
        },function (data) {
            console.log(data);
            if(data == 1){
                if (type == 'del' || type == 'destroy') {
                    $('#item-'+id).hide(300);
                    showtips(success);
                }
                else if(type == 'star'){
                    showtips(success);
                }else if(type == 'status'){
                    let status = $('#item-'+id+' .comment-status').text();
                    if (status == '已审核') {
                        $('#item-'+id+' .comment-status').text('未审核');
                    }else{
                        $('#item-'+id+' .comment-status').text('已审核');
                    }
                    showtips(success);
                }
                else{
                    showreload(success);
                }
            }else{
                console.log('操作失败');
                showtips(error);
            }
        }
    );
}