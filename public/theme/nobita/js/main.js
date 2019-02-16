var hexcase=0;var b64pad="";var chrsz=8;function hex_md5(s){return binl2hex(core_md5(str2binl(s),s.length*chrsz));}
function b64_md5(s){return binl2b64(core_md5(str2binl(s),s.length*chrsz));}
function str_md5(s){return binl2str(core_md5(str2binl(s),s.length*chrsz));}
function hex_hmac_md5(key,data){return binl2hex(core_hmac_md5(key,data));}
function b64_hmac_md5(key,data){return binl2b64(core_hmac_md5(key,data));}
function str_hmac_md5(key,data){return binl2str(core_hmac_md5(key,data));}
function md5_vm_test()
{return hex_md5("abc")=="900150983cd24fb0d6963f7d28e17f72";}
function core_md5(x,len)
{x[len>>5]|=0x80<<((len)%32);x[(((len+64)>>>9)<<4)+14]=len;var a=1732584193;var b=-271733879;var c=-1732584194;var d=271733878;for(var i=0;i<x.length;i+=16)
{var olda=a;var oldb=b;var oldc=c;var oldd=d;a=md5_ff(a,b,c,d,x[i+0],7,-680876936);d=md5_ff(d,a,b,c,x[i+1],12,-389564586);c=md5_ff(c,d,a,b,x[i+2],17,606105819);b=md5_ff(b,c,d,a,x[i+3],22,-1044525330);a=md5_ff(a,b,c,d,x[i+4],7,-176418897);d=md5_ff(d,a,b,c,x[i+5],12,1200080426);c=md5_ff(c,d,a,b,x[i+6],17,-1473231341);b=md5_ff(b,c,d,a,x[i+7],22,-45705983);a=md5_ff(a,b,c,d,x[i+8],7,1770035416);d=md5_ff(d,a,b,c,x[i+9],12,-1958414417);c=md5_ff(c,d,a,b,x[i+10],17,-42063);b=md5_ff(b,c,d,a,x[i+11],22,-1990404162);a=md5_ff(a,b,c,d,x[i+12],7,1804603682);d=md5_ff(d,a,b,c,x[i+13],12,-40341101);c=md5_ff(c,d,a,b,x[i+14],17,-1502002290);b=md5_ff(b,c,d,a,x[i+15],22,1236535329);a=md5_gg(a,b,c,d,x[i+1],5,-165796510);d=md5_gg(d,a,b,c,x[i+6],9,-1069501632);c=md5_gg(c,d,a,b,x[i+11],14,643717713);b=md5_gg(b,c,d,a,x[i+0],20,-373897302);a=md5_gg(a,b,c,d,x[i+5],5,-701558691);d=md5_gg(d,a,b,c,x[i+10],9,38016083);c=md5_gg(c,d,a,b,x[i+15],14,-660478335);b=md5_gg(b,c,d,a,x[i+4],20,-405537848);a=md5_gg(a,b,c,d,x[i+9],5,568446438);d=md5_gg(d,a,b,c,x[i+14],9,-1019803690);c=md5_gg(c,d,a,b,x[i+3],14,-187363961);b=md5_gg(b,c,d,a,x[i+8],20,1163531501);a=md5_gg(a,b,c,d,x[i+13],5,-1444681467);d=md5_gg(d,a,b,c,x[i+2],9,-51403784);c=md5_gg(c,d,a,b,x[i+7],14,1735328473);b=md5_gg(b,c,d,a,x[i+12],20,-1926607734);a=md5_hh(a,b,c,d,x[i+5],4,-378558);d=md5_hh(d,a,b,c,x[i+8],11,-2022574463);c=md5_hh(c,d,a,b,x[i+11],16,1839030562);b=md5_hh(b,c,d,a,x[i+14],23,-35309556);a=md5_hh(a,b,c,d,x[i+1],4,-1530992060);d=md5_hh(d,a,b,c,x[i+4],11,1272893353);c=md5_hh(c,d,a,b,x[i+7],16,-155497632);b=md5_hh(b,c,d,a,x[i+10],23,-1094730640);a=md5_hh(a,b,c,d,x[i+13],4,681279174);d=md5_hh(d,a,b,c,x[i+0],11,-358537222);c=md5_hh(c,d,a,b,x[i+3],16,-722521979);b=md5_hh(b,c,d,a,x[i+6],23,76029189);a=md5_hh(a,b,c,d,x[i+9],4,-640364487);d=md5_hh(d,a,b,c,x[i+12],11,-421815835);c=md5_hh(c,d,a,b,x[i+15],16,530742520);b=md5_hh(b,c,d,a,x[i+2],23,-995338651);a=md5_ii(a,b,c,d,x[i+0],6,-198630844);d=md5_ii(d,a,b,c,x[i+7],10,1126891415);c=md5_ii(c,d,a,b,x[i+14],15,-1416354905);b=md5_ii(b,c,d,a,x[i+5],21,-57434055);a=md5_ii(a,b,c,d,x[i+12],6,1700485571);d=md5_ii(d,a,b,c,x[i+3],10,-1894986606);c=md5_ii(c,d,a,b,x[i+10],15,-1051523);b=md5_ii(b,c,d,a,x[i+1],21,-2054922799);a=md5_ii(a,b,c,d,x[i+8],6,1873313359);d=md5_ii(d,a,b,c,x[i+15],10,-30611744);c=md5_ii(c,d,a,b,x[i+6],15,-1560198380);b=md5_ii(b,c,d,a,x[i+13],21,1309151649);a=md5_ii(a,b,c,d,x[i+4],6,-145523070);d=md5_ii(d,a,b,c,x[i+11],10,-1120210379);c=md5_ii(c,d,a,b,x[i+2],15,718787259);b=md5_ii(b,c,d,a,x[i+9],21,-343485551);a=safe_add(a,olda);b=safe_add(b,oldb);c=safe_add(c,oldc);d=safe_add(d,oldd);}
    return Array(a,b,c,d);}
function md5_cmn(q,a,b,x,s,t)
{return safe_add(bit_rol(safe_add(safe_add(a,q),safe_add(x,t)),s),b);}
function md5_ff(a,b,c,d,x,s,t)
{return md5_cmn((b&c)|((~b)&d),a,b,x,s,t);}
function md5_gg(a,b,c,d,x,s,t)
{return md5_cmn((b&d)|(c&(~d)),a,b,x,s,t);}
function md5_hh(a,b,c,d,x,s,t)
{return md5_cmn(b^c^d,a,b,x,s,t);}
function md5_ii(a,b,c,d,x,s,t)
{return md5_cmn(c^(b|(~d)),a,b,x,s,t);}
function core_hmac_md5(key,data)
{var bkey=str2binl(key);if(bkey.length>16)bkey=core_md5(bkey,key.length*chrsz);var ipad=Array(16),opad=Array(16);for(var i=0;i<16;i++)
{ipad[i]=bkey[i]^0x36363636;opad[i]=bkey[i]^0x5C5C5C5C;}
    var hash=core_md5(ipad.concat(str2binl(data)),512+data.length*chrsz);return core_md5(opad.concat(hash),512+128);}
function safe_add(x,y)
{var lsw=(x&0xFFFF)+(y&0xFFFF);var msw=(x>>16)+(y>>16)+(lsw>>16);return(msw<<16)|(lsw&0xFFFF);}
function bit_rol(num,cnt)
{return(num<<cnt)|(num>>>(32-cnt));}
function str2binl(str)
{var bin=Array();var mask=(1<<chrsz)-1;for(var i=0;i<str.length*chrsz;i+=chrsz)
    bin[i>>5]|=(str.charCodeAt(i/chrsz)&mask)<<(i%32);return bin;}
function binl2str(bin)
{var str="";var mask=(1<<chrsz)-1;for(var i=0;i<bin.length*32;i+=chrsz)
    str+=String.fromCharCode((bin[i>>5]>>>(i%32))&mask);return str;}
function binl2hex(binarray)
{var hex_tab=hexcase?"0123456789ABCDEF":"0123456789abcdef";var str="";for(var i=0;i<binarray.length*4;i++)
{str+=hex_tab.charAt((binarray[i>>2]>>((i%4)*8+4))&0xF)+
    hex_tab.charAt((binarray[i>>2]>>((i%4)*8))&0xF);}
    return str;}
function binl2b64(binarray)
{var tab="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";var str="";for(var i=0;i<binarray.length*4;i+=3)
{var triplet=(((binarray[i>>2]>>8*(i%4))&0xFF)<<16)|(((binarray[i+1>>2]>>8*((i+1)%4))&0xFF)<<8)|((binarray[i+2>>2]>>8*((i+2)%4))&0xFF);for(var j=0;j<4;j++)
{if(i*8+j*6>binarray.length*32)str+=b64pad;else str+=tab.charAt((triplet>>6*(3-j))&0x3F);}}
    return str;}
$('.want-comment').click(
    function () {
        $('.nobita-send-comment').css('display', 'block');
        $('body').css('overflow', 'hidden')
    }
);

$('.n-close-form').click(
    function () {
        $('body').css('overflow', 'auto');
        $('.nobita-send-comment').hide();
        clearForm();
    }
);
$('.n-edit-from').click(
    function () {
        if ($(".n-comment-form-info").css("display") == "none") {
            $('.n-comment-form-info').show(300);
        } else {
            $('.n-comment-form-info').hide(300);
        }
    }
);
$('.n-comment-reply').click(
    function () {
        $('.nobita-send-comment').css('display', 'block');
        $('body').css('overflow', 'hidden');
        let id = $(this).data('id');
        $("#parent_id").val(id);
        let parent_content = $('.n-comment-content-'+id).text();
        $(".n-comment-form-info .parent_content").val(parent_content);
        let parent_author = $('.n-comment-author-'+id).text();
        $(".n-comment-form-info .parent_author").val(parent_author);
        $('.n-send-header .parent_author').text('@'+parent_author);
    }
);
$('.n-comment-del').click(
    function () {
        let id = $(this).data('id');
        let value = $(".n-comment-form-info .value").val();
        $.post('/admin/comment/del',{
            'id':id,
            'value':value
        },function (res) {
            let data = JSON.parse(res);
            if (data.status == 1001){
                $('#n-comment-item-'+id).hide(300);
                $('.want-comment').text('「'+data.msg+'」');
                setTimeout(function () {
                    $('.want-comment').text('「人生在世，留句话给我吧」')
                }, 3000);
            }else{
                $('.want-comment').text('「'+data.msg+'」');
            }
        });
    }
);
$('.show-link-form').click(
    function () {
        $('.links-form').show(300);
    }
);
$('.links-submit').click(
    function () {
        let title = $(".links-form #title").val();
        let url = $(".links-form #url").val();
        let email = $(".links-form #email").val();
        let description = $(".links-form #description").val();
        $.post('/links/register',{
            'title':title,
            'url':url,
            'email':email,
            'description':description
        },function (res) {
            let data = JSON.parse(res);
            if (data.status == 1001){
                $('.links-msg').text('「'+data.msg+'」');
                $('.links-form').hide(300);
            }else{
                $('.links-msg').text('「'+data.msg+'」');
            }
        });
    }
);
$('.dynamic-submit').click(
    function () {
        let content = $('#dynamic-content').val();
        let nickname = $('.dynamic-form .nickname').val();
        let face_url = $('.dynamic-form .face_url').val();
        if (content == ''){
            $('.n-dynamic').show(300);
            $('.n-dynamic .msg').text('请输入你要发布的动态');
            setTimeout(function () {
                $('.n-dynamic').hide(300);
            }, 3000);
            return false;
        }
        $.post('/admin/dynamic/post',{
            'content':content
        },function (res) {
            console.log(res);
            if (res.status == 1001){
                let content = '<div class="n-dynamic-item"><div class="n-dynamic-gravatar"><img src="'+face_url+'" alt="'+nickname+'"></div><div class="n-dynamic-meta"><p class="content">'+res.content+'</p><p class="n-dynamic-time"><i class="czs-user-l"></i> '+nickname+' <i class="czs-time-l"></i> '+res.create_time+' <a href="/dynamicpost/'+res.id+'" target="_blank"><i class="czs-eye-l"></i> 评论</a></p></div></div>';
                $('.n-dynamic-list').prepend(content);
                $('.n-dynamic').show(300);
                $('.n-dynamic .msg').text(res.msg);
                $('#dynamic-content').val('');
                setTimeout(function () {
                    $('.n-dynamic').hide(300);
                }, 3000);
            }else{
                $('.n-dynamic').show(300);
                $('.n-dynamic .msg').text(res.msg);
                setTimeout(function () {
                    $('.n-dynamic').hide(300);
                }, 3000);
            }
        });
    }
);
$('.user-login-out').click(
    function () {
        setCookie("username", '' + ',' + '' + ',' + '', 300);
        window.location.href="/admin/login/logout";
    }
);
$('.user-login').click(
    function () {
        // setCookie('callBackUrl','callBackUrl'+window.location.href+'#want-comment',300);
        // setCookie("username", '' + ',' + '' + ',' + '', 300);
        // window.location.href="/login";
        $.post('/callBackUrl',{
            'url':window.location.href+'#want-comment'
        },function (res) {
            if (res.status == 1001){
                setCookie("username", '' + ',' + '' + ',' + '', 300);
                window.location.href="/login";
            }else{
                alert(res.msg);
            }
        })

    }
);
$('.dynamic-del').click(
    function () {
        let id = $(this).data('id');
        $.post('/admin/dynamic/del',{
            'id':id
        },function (res) {
            if (res.status == 1001){
                $('#n-dynamic-item-'+id).hide(300);
            }else{
                alert(res.msg);
            }
        })
    }
);
$('.edit-submit').click(
    function () {
        let id = $('.n-user-edit #id').val();
        let nickname = $('.n-user-edit #n-user-edit-nickname').val();
        let email = $('.n-user-edit #n-user-edit-email').val();
        let url = $('.n-user-edit #n-user-edit-url').val();
        let description = $('.n-user-edit #n-user-edit-description').val();
        $.post('/admin/person/profileedit',{
            'id':id,
            'nickname':nickname,
            'email':email,
            'url':url,
            'description':description
        },function (res) {
            if (res.status == 1001){
                $('.n-user-msg').show(300);
                $('#n-user-msg').text(res.msg);
                setCookie("username", '' + ',' + '' + ',' + '', 300);
                setTimeout(function () {
                    $('.n-user-msg').hide(300);
                }, 3000);
            }else{
                alert(res.msg);
            }
        })
    }
);
$('#comment-submit').click(
    function () {
        let parent_id = $("#parent_id").val();
        let parent_content = $(".n-comment-form-info .parent_content").val();
        let parent_author = $(".n-comment-form-info .parent_author").val();
        let type = $(".n-comment-form-info .type").val();
        let value = $(".n-comment-form-info .value").val();
        let user_id = $(".n-comment-form-info .user_id").val();
        let author_id = $(".n-comment-form-info .author_id").val();
        let face_url = $(".n-comment-form-info .face_url").val();
        let author = $(".n-comment-form-info #author").val();
        let email = $(".n-comment-form-info #email").val();
        let url = $(".n-comment-form-info #url").val();
        let title = $(".n-comment-form-info .title").val();
        let content = $("#comment-content").val();
        let myDate = timestampToTime(Date.parse(new Date()));
        if (author == '') {
            $('.n-comment-tips').text('昵称不能为空').show(300);
            setTimeout(function () {
                $('.n-comment-tips').hide(300);
            }, 3000);
            return false;
        }
        if (content == '') {
            $('.n-comment-tips').text('评论内容不能为空').show(300);
            setTimeout(function () {
                $('.n-comment-tips').hide(300);
            }, 3000);
            return false;
        }
        setCookie("username", author + ',' + email + ',' + url, 300);
        let faceGravatar = '/avatar/'+hex_md5(email)+'.jpg?6';
        let gravatar = email?faceGravatar:face_url;
        let commentContent = '<div class="n-comment-item"><div class="n-comment-gravatar"><img src="'+gravatar+'" alt="'+author+'"></div><div class="n-comment-content"><div class="n-comment-meta"><div class="n-comment-author"><a href="'+url+'" title="'+author+'">'+author+'</a></div><div class="n-comment-time">'+myDate+'</div></div><div class="n-comment-content-item"><p>'+content+'</p></div></div></div>';
        // if(parent_id > 0){
        //     $("#n-comment-"+parent_id+' .n-comment-item-children').append(commentContent);
        // }else{
        //     $(".n-comment-list").append(commentContent);
        // }

        $(".n-comment-list").append(commentContent);

        $('.nobita-send-comment').hide(300);
        $('body').css('overflow', 'inherit');
        $('.want-comment').html('「人生在世，正在装逼...请勿离开」');
        $.post("/comment/post", {
            'user_id': user_id,
            'author_id':author_id,
            'parent_id': parent_id,
            'parent_author':parent_author,
            'parent_content':parent_content,
            'type': type,
            'value': value,
            'author': author,
            'email': email,
            'url': url,
            'title': title,
            'content': content,
        }, function (res) {
            //let data = $.parseJSON(res);
            console.log(res);
            if (res.status == 1001){
                $('.want-comment').html('「人生在世，装逼成功」');
            }else{
                $('.want-comment').html('「人生在世，装逼失败」');
            }
            clearForm();
        });
        return false;
    }
);

function setCookie(cname, cvalue, exdays) {
    let d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function clearForm() {
    $("#comment-content").val('');
    $(".n-comment-form-info .parent_content").val('');
    $(".n-comment-form-info .parent_author").val('');
    $(".n-comment-form-info #parent_id").val('');
    $('.n-send-header .parent_author').text('');

}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i].trim();
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

function timestampToTime(timestamp) {
    let date = new Date(timestamp);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
    let Y = date.getFullYear() + '-';
    let M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
    let D = (date.getDate() < 10 ? '0' + (date.getDate()) : date.getDate()) + ' ';
    let h = (date.getHours() < 10 ? '0' + date.getHours() : date.getHours()) + ':';
    let m = (date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes()) + ':';
    let s = (date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds());
    return Y + M + D + h + m + s;
}
function visitor(){
    $.get('/visitor', { url: window.location.href },
        function(data){
            $('.siteview b').html(data);
        });
}
$(document).ready(function () {
    visitor();
    let user = getCookie("username");
    let arr = user.split(',');
    if ($('.n-comment-form-info #author').val()) {
        $('.n-comment-form-info').css('display', 'none');
    }
    if (arr[0] != '') {
        $('.n-comment-form-info #author').val(arr[0]);
        $('.n-comment-form-info #email').val(arr[1]);
        $('.n-comment-form-info #url').val(arr[2]);
        $('.n-comment-form-info').css('display', 'none');

    }
    else {
        $('#comment #author').val('游客');
        $('#comment #url').val('http://');
    }

    //文章图片添加链接
    $('.n-content img').each(function(i){
        if (! this.parentNode.href) {
            $(this).wrap("<a href='"+this.src+"'></a>");
        }
    });
    $('.n-content a').attr("target", "_blank");
});
jQuery(window).scroll(function () {
    jQuery(this).scrollTop() > 100 ? jQuery(".go-top").css({
        bottom: "55px"
    }) : jQuery(".go-top").css({
        bottom: "-110px"
    })
}),
    jQuery(".go-top").click(function () {
        return jQuery("body,html").animate({
                scrollTop: 0
            },
            1000),
            !1
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

$('.sidebar-open').click(
    function () {
        $('.nobita-post-list').toggleClass('hide');
        $('.nobita-menu').toggleClass('show');
    }
);
$('.close-sidebar').click(
    function () {
        $('.nobita-post-list').toggleClass('hide');
        $('.n-sidebar').toggleClass('show');
    }
);

$('.mobile-gravatar').click(
    function () {
        if ($('.nobita-menu').hasClass('show')){
            $('.nobita-menu').removeClass('show');
        }
        if (!$('.nobita-post-list').hasClass('hide')){
            $('.nobita-post-list').toggleClass('hide');
        }
        $('.n-sidebar').toggleClass('show');
    }
);