window.onload = resizeall;
window.onresize = resizeall;

var url = location.href;
var decoupe = url.match(/\/([^\/]*)(?=\.php)/);
if (!decoupe){
	decoupe = ["index", "index"];
}

function resizemenu(){
	var menuElem = document.getElementById('menu');
	var photosElem = document.getElementById('photoarea');
	var larg = window.innerWidth;

	if (larg < 1024){
		photosElem.style.width = "85vw";
		menuElem.style.display = "none";
	}
	else
	{
		photosElem.style.width = "60vw";
		menuElem.style.display = "inline-block";
	}
}

function resizeall(){

	if (decoupe[1] == "index")
		resizemenu();

	var menuicon = document.getElementById('menuicon');
	var faqicon = document.getElementById('faqicon');
	var loginicon = document.getElementById('loginicon');
	var searchicon = document.getElementById('searchicon');
	var largeur = window.innerWidth;

	if (largeur < 1024){
		faqicon.style.display="none";
		searchicon.style.display="none";
		loginicon.style.display="none";
		menuicon.style.display="inline-block";
		if (largeur < 240)
			document.getElementById('photoicon').style.display='none';
		else
			document.getElementById('photoicon').style.display='inline-block';
	}
	else{
		menuicon.style.display="none";
		faqicon.style.display="inline-block";
		searchicon.style.display="inline-block";
		loginicon.style.display="inline-block";
	}
}
