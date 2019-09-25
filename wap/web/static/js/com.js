function setCookie(c_name,value,expiredays)
{
    var exdate=new Date()
    exdate.setDate(exdate.getDate()+expiredays)
    document.cookie=c_name+ "=" +escape(value)+
        ((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
}

function getCookie(c_name)
{
    if (document.cookie.length>0)
    {
        c_start=document.cookie.indexOf(c_name + "=")
        if (c_start!=-1)
        {
            c_start=c_start + c_name.length+1
            c_end=document.cookie.indexOf(";",c_start)
            if (c_end==-1) c_end=document.cookie.length
            return unescape(document.cookie.substring(c_start,c_end))
        }
    }
    return ""
}

function ajaxGet(url,data,successFunction) {
    $.ajax({
        url:url,
        type:'GET',
		data:data,
        dataType:"json",
        success:successFunction
		,error:function (data) {
            mui.toast("服务器错误");
        }
    });
}

function ajaxPost(url,data,successFunction) {
    $.ajax({
        url:url,
        type:'post',
        data:data,
        dataType:"json",
        success:successFunction
        ,error:function (data) {
            mui.toast("服务器错误");
        }
    });
}

// 发送验证码倒计时
function get_code (mobile) {
    $.ajax({
        url:'/site/verify?mobile='+mobile,
        type:'GET',
		dataType:"json",
        success:function (data) {
        	if (data.code == 200) {
                $('.get_code').addClass("on");
                var time = 60;
                $('.get_code').attr("disabled", true);
                var timer = setInterval(function() {
                    if (time == 0) {
                        clearInterval(timer);
                        $('.get_code').attr("disabled", false);
                        $('.get_code').val("获取验证码");
                        $('.get_code').removeClass("on");
                    } else {
                        $('.get_code').val(time + "秒");
                        time--;
                    }
                }, 1000);
            }
            mui.toast(data.message);
        },error:function (data) {
            mui.toast("服务器错误");
        }
    });

}



function openIndex() {
    var result = {"action":"index"}
    var ua = navigator.userAgent.toLowerCase();
    if (/iphone|ipad|ipod/.test(ua)) {
        webkit.messageHandlers.b2b1818lao.postMessage(JSON.stringify(result));
    }else if(/android/.test(ua)) {
        window.jsObj.HtmlcallJava(JSON.stringify(result));
    }
}

function openBonus() {
    var result = {"action":"bonus"}
    var ua = navigator.userAgent.toLowerCase();
    if (/iphone|ipad|ipod/.test(ua)) {
        webkit.messageHandlers.b2b1818lao.postMessage(JSON.stringify(result));
    }else if(/android/.test(ua)) {
        window.jsObj.HtmlcallJava(JSON.stringify(result));
    }
}

function openAccount() {
    var result = {"action":"account"}
    var ua = navigator.userAgent.toLowerCase();
    if (/iphone|ipad|ipod/.test(ua)) {
        webkit.messageHandlers.b2b1818lao.postMessage(JSON.stringify(result));
    }else if(/android/.test(ua)) {
        window.jsObj.HtmlcallJava(JSON.stringify(result));
    }
}