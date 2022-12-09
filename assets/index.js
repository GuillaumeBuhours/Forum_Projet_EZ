function openInscription() {
  document.getElementById("modal1").style.display = "flex";
}
function closeInscription() {
  document.getElementById("modal1").style.display = "none";
}

function openConnect() {
  document.getElementById("modal2").style.display = "flex";
}
function closeConnect() {
  document.getElementById("modal2").style.display = "none";
}

function openProfil() {
  document.getElementById("modal3").style.display = "flex";
}
function closeProfil() {
  document.getElementById("modal3").style.display = "none";
}

function modifPseudo() {
  document.getElementById("modal4").style.display = "flex";
}
function closemodifPseudo() {
  document.getElementById("modal4").style.display = "none";
}

function modifMdp() {
  document.getElementById("modal5").style.display = "flex";
}
function closemodifMdp() {
  document.getElementById("modal5").style.display = "none";
}

function openCreateTopic() {
  document.getElementById("modal6").style.display = "flex";
}
function closeCreateTopic() {
  document.getElementById("modal6").style.display = "none";
}

function closemodifTopic(){
  document.getElementById("modal7").style.display = "none";
}
function closeCreateMessage() {
  document.getElementById("modal8").style.display = "none";
}
function closemodifMessage(){
  document.getElementById("modal9").style.display = "none";
}
//readall json
document.addEventListener("DOMContentLoaded", function () {
  function getRequest() {
      var xhr;
      if (window.XMLHttpRequest) {
          xhr = new XMLHttpRequest();
      } else if (window.ActiveXObject) {
          xhr = new ActiveXObject("Microsoft.XMLHTTP");
      } else {
          alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
          return false;
      }

      return xhr;
  }
  //affiche tous les topics
  function EzTopicLigne(ezJson) {
      return '<tr id="'+ezJson.id+'">'+
          '<td class="colone1"><div class="tdIcons"><img style="cursor:pointer;" src="./assets/edit.png" alt="edit" onclick=\'modifTopic('+ezJson.id+')\'></div></td>'+
          '<td id="colone2" onclick=\'afficheMessage('+ezJson.topic+')\'">'+ezJson.topic+'</td>'+
          '<td id="colone3">'+ezJson.pseudo+'<span></td>'+
          '<td id="colone4">0</td>'+
          '<td class="colone5">0</td>'+
          '<td style="color:red;cursor:pointer;" onclick="deleteTopic('+ezJson.id+')">X</td>'+
          '</tr>';
  }
  
  function EzTopic(ezJson){
      var html="";
      for (var i=0;i<ezJson.length;i++) {
          html+=EzTopicLigne(ezJson[i]);
      }
      return html;
  }
  var xhr;	
  xhr = getRequest();
  var reponse;
  var json;
  if (xhr != false) {
      xhr.open("POST", "./forum/readall_topic.php", true);
      xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
              reponse = xhr.responseText;
              json = JSON.parse(reponse);
              let htmlStr=EzTopic(json);
              document.getElementById("conteneur").innerHTML+=htmlStr;
          } else {
              reponse = "Problème lors de l'appel AJAX";
          }
          
      };
      xhr.send();
  }
  //affiche les messages lié au topic selectionner






});
function getRequest() {
  var xhr;
  if (window.XMLHttpRequest) {
      xhr = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
      xhr = new ActiveXObject("Microsoft.XMLHTTP");
  } else {
      alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
      return false;
  }

  return xhr;
}
//ouvrir modal + stocker les valeurs de l'id et du contenu de la ligne
function modifTopic(id){
  document.getElementById("modal7").style.display = "flex";
  document.getElementById("recuperationId").value=id;
}
//update topic
function UpdateTopic(){
  var xhr;
let id = document.getElementById("recuperationId").value;
  let modifTopic = document.getElementById('modifTopic').innerText;
  let data = "&id="+id+"&modifTopic="+modifTopic;		
  xhr = getRequest();
  let reponse;
  if (xhr != false) {
      xhr.open("POST", "./forum/update.php", true);
      xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
              reponse = xhr.responseText;
              closemodifTopic();
          }else {
              reponse = "Problème lors de l'appel AJAX";
          }
      };
      xhr.send(data);
  }
}

//delete topic
function deleteTopic(id){
  var xhr;
  let data = "&id="+id;		
  xhr = getRequest();
  var reponse;
  if (xhr != false) {
      xhr.open("POST", "./forum/destroy.php", true);
      xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
              reponse = xhr.responseText;
          } else {
              reponse = "Problème lors de l'appel AJAX";
          }
      };
      xhr.send(data);
  }
  var child = document.getElementById(id);
  child.parentNode.removeChild(child);
}

