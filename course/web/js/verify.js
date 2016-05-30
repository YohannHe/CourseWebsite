/**
 * Created by Yohan on 2015/8/9.
 */

function reflsh(){
    document.getElementById("verify").src="verify.php?t="+new Date().getTime();
    return false;
}
function checkText(){
    if(document.getElementById("check_text").value=='' || document.getElementById("passwd").value==''||document.getElementById("username").value==''){
        alert("请填写完整信息！")
        return false;
    }else{
        document.getElementById("submit_btn").click();
    }
}
function Regcheck(){
    if(document.getElementById("username").value=='' || document.getElementById("password").value==''||document.getElementById("password2").value==''||document.getElementById("name").value==''||document.getElementById("age").value==''){
        alert("请填写完整信息！")
        return false;
    }else if(document.getElementById("password").value!=document.getElementById("password2").value){
        alert('两次密码不一致！')
        return false;
    }else{
        document.getElementById("reg_btn").click();
    }
}