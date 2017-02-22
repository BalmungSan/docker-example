function validate(){
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	if (username == "johan" && password == "123"){
		alert("Bien Campeon");
		window.location = "store.html";
		return false;
	}else{
		alert("Error");
		return false;
	}
}