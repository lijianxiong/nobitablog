$(function(){
    $(".status").change(function(){
        var status = $('.status input:radio:checked').val();
        if(status == 2){
            $(".password").css({"display":"block"})
        }else{
            $(".password").css({"display":"none"})
        }
    });
    $('.a-more').click(
        function () {
            $('.article-more').toggleClass('show');
            $('.a-mask').toggleClass('show');
        }
    );
    $('.a-mask').click(
        function () {
            $('.article-more').toggleClass('show');
            $('.a-mask').toggleClass('show');
        }
    );
    $('.mark-btn').click(
        function () {
            let id = $(this).data("id");
            let item = $('.article-info .mark-'+id);
            item.toggleClass('show');
        }
    );
    $('.untrash').click(
        function () {
            let id = $(this).data("id");
            let item = $('#item-'+id);
            item.hide(500);
        }
    );
    $('.edit-links').click(
        function () {
            let id = $(this).data("id");
            console.log(id);
            $.post("/admin/links/edit/",{
                'id' :id
            },function (data) {
                console.log(data);
                if (data){
                    $('.link-edit #id').val(data.id);
                    $('.link-edit #title').val(data.title);
                    $('.link-edit #email').val(data.email);
                    $('.link-edit #url').val(data.url);
                    $('.link-edit #description').val(data.description);
                    $('.link-edit #weight').val(data.weight);
                }
                else{
                    showtips('请求出错，请重试!')
                }
            });
        }
    );
    $('.del-links').click(
        function () {
            let id = $(this).data("id");
            $.post("/admin/links/del/",{
                'id' :id
            },function (res) {
                let data = JSON.parse(res);
                if (data.status == 10001) {
                    $('#links-'+id).hide(300);
                }
                else{
                    showtips('请求出错，请重试!')
                }
            });
        }
    );
    $('.comment-edit-btn').click(
        function () {
            let id = $(this).data("id");
            console.log(id);
            $.post("/admin/comment/edit/",{
                'id' :id
            },function (data) {
                console.log(data);
                if (data){
                    $('.comment-edit').addClass('show');
                    $('.comment-edit #id').val(data.id);
                    $('.comment-edit #author').val(data.author);
                    $('.comment-edit #email').val(data.email);
                    $('.comment-edit #content').val(data.content);
                }
                else{
                    showtips('请求出错，请重试!')
                }
            });
        }
    );
    $('.edit-category').click(
        function () {
            let id = $(this).data("id");
            console.log(id);
            $.post("/admin/category/edit/",{
                'id' :id
            },function (data) {
                console.log(data);
                if (data){
                    $('.category-edit #id').val(data.id);
                    $('.category-edit #title').val(data.title);
                    $('.category-edit #slug').val(data.slug);
                    $('.category-edit #thumb').val(data.thumb);
                }
                else{
                    showtips('请求出错，请重试!')
                }
            });
        }
    );
    $('.category-del').click(
        function () {
            let id = $(this).data("id");
            $.post("/admin/category/del/",{
                'id' :id
            },function (data) {
                if (data.status == 10001){
                    $('#item-'+id).hide(300);
                    showtips(data.msg);
                }else{
                    showtips(data.msg);
                }
            });
        }
    );
    $('.remove-edit').click(
        function () {
            $('.comment-edit').removeClass('show');
        }
    );
    $('.comment-submit-btn').click(
        function () {
            let id = $('.comment-edit #id').val();
            let author = $('.comment-edit #author').val();
            let email = $('.comment-edit #email').val();
            let content = $('.comment-edit #content').val();
            $.post("/admin/comment/update/",{
                'id' :id,
                'author':author,
                'email':email,
                'content':content
            },function (data) {
                let dataMsg = data;
                //console.log(dataMsg);return;
                console.log(dataMsg);
                if(dataMsg.status == 10001){
                    $('#item-'+id+' .h4').text(author);
                    $('#item-'+id+' .comment-email').text(email);
                    $('#item-'+id+' .comment-content').text(content);
                    showtips(dataMsg.msg);
                }else{
                    showtips(dataMsg.msg);
                }
            });
        }
    );
    $('.person-base-btn').click(
        function () {
            $.post('/admin/person/updateperson',{
                'nickname':$('.person-form #nickname').val(),
                'password':$('.person-form #password').val(),
                'email':$('.person-form #email').val(),
                'description':$('.person-form #description').val()
            },function (data) {
                if (data.status == 10001){
                    showtips(data.msg);
                } else{
                    showtips(data.msg);
                }
            });
        }
    );
    $('.username-base-btn').click(
        function () {
            $.post('/admin/person/username',{
                'username':$('.person-form #username').val()
            },function (data) {
                if (data.status == 10001){
                    showtips(data.msg);
                } else{
                    showtips(data.msg);
                }
            });
        }
    );
});
function showtips(value) {
    $('.show-message').text(value);
    $('#show-tips').show(500);
    setTimeout(function(){$('#show-tips').hide(500)},2000);
}

function action(url,id,type,dbname) {
    $.post(url,
        {
            'id':id,
            'type':type,
            'model':dbname
        },function (data) {
            let dataMsg = JSON.parse(data);
            //console.log(dataMsg);return;
            console.log(dataMsg);
            if(dataMsg.status == 10001){
                if (type == 'del' || type == 'destroy') {
                    $('#item-'+id).hide(300);
                    showtips(dataMsg.msg);
                }
                else if(type == 'star'){
                    showtips(dataMsg.msg);
                }else if(type == 'status'){
                    showtips(dataMsg.msg);
                    let status = $('#item-'+id+' .comment-status').text();
                    if (status == '已审核') {
                        $('#item-'+id+' .comment-status').text('未审核');
                    }else{
                        $('#item-'+id+' .comment-status').text('已审核');
                    }
                }
                else{
                    showtips(dataMsg.msg);
                }
            }else{
                console.log('操作失败');
                showtips(error);
            }
        }
    );
}