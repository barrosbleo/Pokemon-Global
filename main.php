<?php
include('modules/lib.php');

if(isLoggedIn()){redirect('membersarea.php');}

include '_header.php';
include 'pages/login.php';
include 'pages/register.php';
include 'pages/news.php';
include 'pages/chatroom.php';
include 'pages/password_forgot.php';

?>
<script>
var curPage = document.getElementById('loginPage');

function loadPage(pageName){
	var newPage = document.getElementById(pageName+'Page');
	if(curPage != newPage){
		newPage.style.display = "block";
		curPage.style.display = "none";
		curPage = newPage;
	}
}
<?php
//if is registering with referral
if(isset($_GET['refReg'])){
	echo'window.onload = loadPage("register");';
	echo'var refId='.$_GET['refReg'].';';
}
else{
	echo'window.onload = loadPage("news");';
	echo'var refId = 0;';
}
?>
</script>


<script>
//login ajax system
var login = document.getElementById('username');
var password = document.getElementById('password');
var loginBtn = document.getElementById('submit');
var error = document.getElementById('error');
function doLogin(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			if(this.responseText == "success"){
				location.reload();
				//return false;
				//alert(this.responseText);
			}else{
				error.style.display = "block";
				error.innerHTML = this.responseText;
				//alert(this.responseText);
			}
		}
	};
	xhttp.open("POST", "modules/loginfunc.php", true);
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhttp.send("username="+login.value+"&password="+password.value+"&submit=log in");
}

//register ajax system
var regUser = document.getElementById('regUser');
var regPass = document.getElementById('regPass');
var regRePass = document.getElementById('regRePass');
var regMail = document.getElementById('regMail');
var regBtn = document.getElementById('regBtn');
var regError = document.getElementById('regError');

function getRadioValue(){
	var radios = document.getElementsByName('pokemon');
	var i;
	for(i = 0; i < radios.length; i++){
		if(radios[i].checked){
			document.getElementById('pokeName').value = radios[i].value;
		}
	}
};

function doRegister(){
	getRadioValue();
	var regStarter = document.getElementById('pokeName').value;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			if(this.responseText == "success"){
				login = regUser;
				password = regPass;
				doLogin();
				location.reload();
				//location.href = "http://localhost/main.php";
				//alert(this.responseText);
			}else{
				regError.style.display = "block";
				regError.innerHTML = this.responseText;
				window.scrollTo(0,0);
				//alert(this.responseText);
			}
		}
	};
	xhttp.open("POST", "modules/registerfunc.php", true);
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhttp.send("username="+regUser.value+"&password="+regPass.value+"&repass="+regRePass.value+"&regmail="+regMail.value+"&regstarter="+regStarter+"&refid="+refId+"&submit=register");

}
</script>
<?php
include('_footer.php');
?>