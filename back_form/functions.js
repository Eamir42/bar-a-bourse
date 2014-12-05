
function objet_XMLHttpRequest()
{
//On déclare une variable "obj" à null
var obj = null;
//Teste si le navigateur prend en charge les XMLHttpRequest
if (window.XMLHttpRequest || window.ActiveXObject){
// Si Internet Explorer alors on utilise les ActiveX
if(window.ActiveXObject){
//On teste IE7 ou supérieur
try{
obj = new ActiveXObject("Msxml2.XMLHTTP");
}
//Si une erreur est levée, alors c'est IE 6 ou inférieur
catch(e){
obj = new ActiveXObject("Microsoft.XMLHTTP");
}
}
//Navigateurs récents (Firefox, Opéra, Chrome, Safari, ...)
else{
obj = new XMLHttpRequest();
}
}
//XMLHttpRequest non supporté par le navigateur
else{
alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
return null;
}
//On retourne l'objet obj
return obj;
}

function teste_ajax(value){
	var obj = objet_XMLHttpRequest();
	// if (value == '') {
	// 	value = 50;
	// }
	// obj.open("GET", "traitementMaxQte.php?id="+value, true);
	// obj.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	// obj.send();

	// obj.onreadystatechange = function(){
	// 	if(obj.readyState == 4){
	// 		if (obj.status == 200) {
	// 			document.getElementById("test").innerHTML=obj.responseText;
	// 			console.log(obj.responseText);
	// 			return obj.responseText;
	// 		};
	// 	}else{
	// 		alert('fail');
	// 	}
	// };
	$.ajax({
		type: "GET",
		url: "traitementMaxQte.php?id="+value,
		data: "quantite="+value,
		dataType: 'json',
		success: function(result){
			return result;
		},
		error: function(jqxhr, textStatus){
			return obj.responseText;
		}
	})
}