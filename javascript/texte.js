function loadTxtFile(url)
{
	
	var txt, txtF, i, nb;
	
	$.ajax({
		url: "http://localhost/zanzibar/php/texte.php",
		type: "POST",
		async: false,
		success: function(msg){
			txt = msg;
		}
	});			
	txtF = '<p>';	
	nb = txt.split('\n').length;
	for (i = 0; i < nb; i++)
	{
		txtF += txt.split('\n')[i] + '</br>';
	}
	txtF += '</p>';
	document.getElementById('txtAccueil').innerHTML = txtF;		


}

function getTxtFile(url)
{	
	var txt, txtF, i, nb;
	
	$.ajax({
		url: "http://localhost/zanzibar/php/texte.php",
		type: "POST",
		async: false,
		success: function(msg){
			txt = msg;
		}
	});			
	txtF = '<p>';	
	nb = txt.split('\n').length;
	for (i = 0; i < nb; i++)
	{
		txtF += txt.split('\n')[i] + '</br>';
	}
	txtF += '</p>';
	document.getElementByName('ta_txt_accueil').innerHTML = txtF;		


}
