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
			for (i = 0; i < x.length; i++) {				
				img = x[i].innerHTML;				
				txt = txt + '<li><a onclick="loadPhotos(this);"><img src = "Images/' + img + '" /></a></li>'; 
			}
			txt = txt + "</ul>";
			document.getElementById('slideshow').innerHTML = txt;			
		}
	}
	xmlhttp.open("GET", url, true);
	xmlhttp.send();
}

function loadPhotos(element)
{
	var image;
	image = element.childNodes[0].attributes[0].nodeValue;
	document.getElementById('LrgImg').innerHTML = '<img src = "' + image + '" />';
	
}

function loadXMLDocTable(url)
{
	var xmlhttp, txt, x, i, img, j;
	if (window.XMLHttpRequest) {
		// IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			txt = "<table>";
			x = xmlhttp.responseXML.documentElement.getElementsByTagName("IMG");	
			cptImg = 1;
			cptCb = 1;
			for (i = 0; i < x.length; i = i+5) {			
				// Cas où on a l'image
				txt += "<tr>";
				for (j = i; j < i+5 && j < x.length; j++)
				{
					img = x[j].innerHTML;				
					txt += "<td><img id = 'img" + j + "' src = 'Images/" + img + "' /></td>"; 
				}
				txt += "</tr>";
				txt += "<tr>";
				for (j = i; j < i+5 && j < x.length; j++)
				{
					txt += "<td><input type='checkbox' id='cb" + j + "'></td>";  
				}
				txt += "</tr>";
			}
			txt += "</table>";
			document.getElementById('slideshow2').innerHTML = txt;			
		}
	}
	xmlhttp.open("GET", url, true);
	xmlhttp.send();
}

function supprImgs() {
	var cbs, i, verif, nb, img, url;
	
	cbs = document.getElementsByTagName("input");
	for (i = 0; i < cbs.length; i++)
	{
		if (cbs[i].checked) {
			nb = cbs[i].id.substring(2, cbs[i].id.length); 
			img = document.getElementById('img' + nb).src;
			img = img.substr((img.lastIndexOf("/") + 1));
			$.ajax({
				url: "http://localhost/zanzibar/php/photos.php",
				type: "POST",
				async: false,
				data: "img=" + img,
				success: function(msg){
					
				}
			});			
				
		}	
	}			
	
	window.location.reload();
}






