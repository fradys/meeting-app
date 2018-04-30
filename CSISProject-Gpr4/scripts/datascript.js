
/*

  This script handle most common functionalities whitin a page, some
  specific methods should be created in order to deal directly with
  data manipulation, but the events and AJAX should be used methods inside
  this script

*/

//Return AJAX Object - if supported
function readyAJAX() {
  try {
    return  new XMLHttpRequest();
  } catch(e) {
      try {
        return  new ActiveXObject("Microsoft.XMLHTTP");
      } catch(err) {
          return false;
        }
    }
}

//Connects with server and send data to it, execute custom function to handle
//data, that function should be created inside a variable in the page
function sendData(func){
  var ajaxObj = readyAJAX();
  var url = "meetinginfo.php";

  if(ajaxObj){
    var dataParam = JSON.stringify(jsonObject);

    ajaxObj.open("POST", url);
    ajaxObj.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajaxObj.send("data=" + dataParam);
    ajaxObj.onreadystatechange = function(){
      if(ajaxObj.readyState == 4 && ajaxObj.status == 200){
          // alert(ajaxObj.responseText); //Debug
        var json = JSON.parse(ajaxObj.responseText);
        if(json == null)
          return;

        func(json);
      }
    };
  }
}


//Simple user confimation
function userConfirmation (){
  var recordID = document.getElementById("ID").value;
  var promptMsg = "Are you sure you want to ";
  if(recordID > 0)
    promptMsg += "UPDATE the selected record?";
  else
    promptMsg += "CREATE a new entry?";

  return confirm(promptMsg);
}

//If nothing was found in search method, this method starts a animation
function notFoundAnimation() {
  document.querySelector(".search").className = "search";
  window.requestAnimationFrame(function(time) {
    window.requestAnimationFrame(function(time) {
      document.querySelector(".search").className = "search notFound";
    });
  });
}


//Search data inside the select component
function search(){
  var list = document.getElementById("selSearch");
  var searchValue = document.getElementById("txtSearch").value.trim();
  var searchReg = new RegExp(searchValue, "i");
  var found = -1;

  for(var i = 0; i < list.length; i++){
    found = list.options[i].innerHTML.search(searchReg);
    if(found >= 0){
      list.options.selectedIndex = i;
      list.dispatchEvent(new Event("change"));
      break;
    }
  }
  if(found < 0){
    notFoundAnimation();
  }
}

var saveTyped = function(jsonObj){
    if(jsonObj != null)
      reset();
}

//Reload the page - not the parent
function reset(){
  location.reload(true);
}

function focusFirstTextBox(){
  var component = document.getElementById("txtName");	//all other pages
  if(component == null || component == undefined)
    component = document.getElementById("txtSubject"); //meeting.php

  component.focus();
}

//Clear all childs of the selected component
function clearComponent(componentID){
  //Clear ALL childs from given componentID
  var component = document.getElementById(componentID);
  if(component != null && component.hasChildNodes){
    var chNode = component.firstChild;
    while(chNode){
      component.removeChild(chNode);
      chNode = component.firstChild;
    }
  }
}


/*Event Handlers*/
document.getElementById("btnSearch").onclick = function(){
  search();
};

document.getElementById("btnCancel").onclick = function(){
  var proceed = confirm("Are you sure you want to return to Initial Page?");
  if(proceed)
    window.parent.location.reload(true);
  else
    focusFirstTextBox();
};

document.getElementById("btnReset").onclick = function(){
  reset();
};

document.getElementById("btnSave").onclick = function(){
  save();
};

//Focus on first text box (txtName or txtSubject) in the page
window.addEventListener("load", focusFirstTextBox, false);
