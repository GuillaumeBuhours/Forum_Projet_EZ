function openInscription(){ document.getElementById("modal1").style.display="flex"; }
function closeInscription(){ document.getElementById("modal1").style.display="none"; }

function openConnect(){ document.getElementById("modal2").style.display="flex"; }
function closeConnect(){ document.getElementById("modal2").style.display="none"; }

function openProfil(){ document.getElementById("modal3").style.display="flex"; }
function closeProfil(){ document.getElementById("modal3").style.display="none"; }

function modifPseudo() {document.getElementById("modal4").style.display="flex"; }
function closemodifPseudo() {document.getElementById("modal4").style.display="none";}

function modifMdp() {document.getElementById("modal5").style.display="flex"; }
function closemodifMdp() {document.getElementById("modal5").style.display="none";}

function openCreateTopic() {document.getElementById("modal6").style.display="flex"; }
function closeCreateTopic() {document.getElementById("modal6").style.display="none";}

document.addEventListener("DOMContentLoaded", function(){

	function getRequest(){
		
		var xhr;			
		if(window.XMLHttpRequest){
			xhr = new XMLHttpRequest();					
		}else if(window.ActiveXObject){
			xhr = new ActiveXObject("Microsoft.XMLHTTP");					
		}else{
		   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
		   return false;
		}			
		
		return xhr;
	}
	function sendInscription(){
		var xhr;	
		
		var titre     = document.getElementById('?').value;
		var auteur    = document.getElementById('?').value;
		var reference = document.getElementById('?').value;				
		
		var data = "&titre="+titre+"&auteur="+auteur+"&reference="+reference;		
	
		xhr = getRequest();
		
		var affiche_retour;
		
		if(xhr != false){
			
			xhr.open("POST", "../forum/readall_topic.php", true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

			xhr.onreadystatechange = function() {
				if(xhr.readyState == 4 && xhr.status == 200){
					
					affiche_retour = xhr.responseText;
				}else{
					
					affiche_retour = "Problème lors de l'appel AJAX";
				}
				document.getElementById('form_ajoute_livre').innerHTML = affiche_retour;
			};
		
			xhr.send(data);

		}			
	}
    sendInscription()
})

