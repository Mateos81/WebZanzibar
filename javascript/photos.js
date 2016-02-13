function loadXMLDoc(url)
{
	var xmlhttp, txt, x, i, img;
	if (window.XMLHttpRequest) {
		// IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			txt = "<ul>";
			x = xmlhttp.responseXML.documentElement.getElementsByTagName("IMG");			
			for (i = 0; i<x.length; i++) {				
				img = x[i].innerHTML;				
				txt = txt + '<li><img src = "Images/' + img + '" /></li>'; 
			}
			txt = txt + "</ul>";
			document.getElementById('slideshow').innerHTML = txt;			
		}
	}
	xmlhttp.open("GET", url, true);
	xmlhttp.send();
}

function LoadPhotos()
{
	
	
}