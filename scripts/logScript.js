
function func(){
	var email = document.getElementById('l1').value
	var pass = document.getElementById('l2').value
	if(email == 'shree@gmail.com' && pass == '123'){
		alert("successful")
		window.location = "home.php"
	}
	else{
		alert("invalid entry")
	}
}
	