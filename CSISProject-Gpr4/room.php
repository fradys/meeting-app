<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="css/reset.css" rel="stylesheet">
		<link href="css/forms-style.css" rel="stylesheet">
		<style type="text/css" media="screen">

			@keyframes notFound {
			 0%   {background: rgba(242,240,240, 0.6);}
			 15%  {background: rgba(229, 153, 153, 0.6);}
			 30%  {background: rgba(229, 98, 98, 0.6);}
			 45%  {background: rgba(221, 42, 42, 0.6);}
			 55%  {background: rgba(219, 4, 4, 0.6);}
			 65%  {background: rgba(221, 42, 42, 0.6);}
			 80%  {background: rgba(229, 98, 98, 0.6);}
			 90%  {background: rgba(229, 153, 153, 0.6);}
			 100% {background: rgba(242,240,240,0.6);}
			}

			.notFound {
			 background: rgba(242,240,240,0.6);
			 -webkit-animation-name: notFound;
			 -webkit-animation-duration: 0.5s;
			 -moz-animation-name: notFound;
			 -moz-animation-duration: 0.5s;
			 animation-name: notFound;
			 animation-duration: 0.5s;
			}
		</style>

		<?php include "meetingdata.php"; ?>
  </head>
  <body>
    <div class="meeting-container">
      <h2>Room</h2>
      <form class="meeting-form">
        <input type="hidden" id="ID" name="ID" value="">
        <div class="meeting-form-left">
          <h4>Name *</h4>
          <input type="text" id="txtName" name="txtName">
          <h4>Description</h4>
          <textarea id="txtDescription" name="txtDescription" rows="6"></textarea>
          <h4>Search Meeting Rooms</h4>
          <select id="selSearch" name="selSearch" size="3">
            <?php
              //Populate the list with the names of Equipments
              //<option value="0"></option>
              $meetingData = new MeetingData();
              $dataArr = $meetingData->get_room("%"); //All resources/equipments

              foreach ($dataArr as $data ) {
                echo "<option value='".$data["ID"]."'>".$data["Name"]."</option>";
              }
            ?>
          </select>
          <input type="text" class="search" id="txtSearch" name="txtSearch" placeholder="Search Rooms..." title="Search Rooms by name" style="width:48%">
	        <button type="button" id="btnSearch" name="btnSearch">Search</button>
        </div>
        <div class="meeting-form-right">
          <h4>Branch *&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;# Seats</h4>
          <select id="selBranch" class="inline" name="selBranch">
            <?php
              //Populate the list with all Branches
              //<option value="0"></option>
              $meetingData = new MeetingData();
              $dataArr = $meetingData->get_branch("%"); //All resources/equipments

              foreach ($dataArr as $data ) {
                echo "<option value='".$data["ID"]."'>".$data["Name"]."</option>";
              }
            ?>
          </select>
          <input type="number" class="inline" id="txtCapacity" name="txtCapacity" value="0" min="0">
          <h4>All Available Equipments</h4>
          <select id="selEquipments" name="selEquipments" size="4" title="Select which equipment this room has" multiple>
            <?php
              //Populate the list with the names of Equipments
              //<option value="0"></option>
              $meetingData = new MeetingData();
              $dataArr = $meetingData->get_resource("%"); //All resources/equipments

              foreach ($dataArr as $data ) {
                echo "<option value='".$data["ID"]."'>".$data["Name"]."</option>";
              }
            ?>
          </select>
          <button type="button" id="btnSelectEquipment" class="location" name="btnSelectEquipment" style="margin-bottom:15px">Add to Room</button>
          <h4>Meeting Room Equipments</h4>
          <select id="selSelectedEquipments" name="selSelectedEquipments" size="4" title="This room has all these equipments at your disposal">
          </select>
          <button type="button" class="location" id="btnRemoveEquipment" name="btnRemoveEquipment">Remove from Room</button>
        </div>
        <div class="meeting-form-bottom">
          <!-- Bottom part of the form, common buttons -->
          <button type="button" class="btnBottomForm" id="btnCancel" name="btnCancel">Cancel</button>
          <button type="button" class="btnBottomForm" id="btnReset" name="btnReset">Reset</button>
          <button type="button" class="btnBottomForm" id="btnSave" name="btnSave">Save</button>
		    </div>
    </form>
    </div>
    <script type="text/javascript" src="scripts/datascript.js"></script>
		<script type="text/javascript">

		//Branch JSON Object
		var jsonObject = {
			Op:"", //Operation determines which operation the server should do
			table:"room",
			RoomID:0,
			Name:"",
			Description:"",
      Capacity:0,
      BranchID:0,
      ResourceID: []
		};

		function clearRoom(){
			//Clears JSON Object

			jsonObject.Op = "";
			jsonObject.table = "room";
			jsonObject.RoomID = 0;
			jsonObject.Name = "";
			jsonObject.Description = "";
      jsonObject.Capacity = 0;
      jsonObject.BranchID = 0;
      jsonObject.ResourceID = [];
		}

		var searchClicked = function(jsonObj){
				//Populate fields with info received from server
				document.getElementById("ID").value = jsonObj[0]["ID"];
				document.getElementById("txtName").value = jsonObj[0]["Name"];
				document.getElementById("txtDescription").value = jsonObj[0]["Description"];
        document.getElementById("txtCapacity").value = jsonObj[0]["Capacity"];

        //Set selected the branch
        var selectBranch = document.getElementById("selBranch");
        var branchID = jsonObj[0]["BranchID"];

        for(var i = 1; i < selectBranch.length; i++){
          if(selectBranch[i].value == branchID){
              selectBranch[i].setAttribute("selected", true);
          } else {
            //Walk in the whole list removing selected attribute from previous selection
            selectBranch[i].removeAttribute("selected");
          }
        }

        //Populate All equipments in this room
        clearComponent("selSelectedEquipments"); //Clear the component before
        var data = jsonObj[1];
        if(data == null || data == undefined)
          return;

        for(var row = 0; row < data.length; row++){
            addEquipment(data[row][0], data[row][1]);
        }
		}

    function addEquipment(equipmentID, equipmentName){
      var selectEquipments = document.getElementById("selSelectedEquipments");
      var option = document.createElement("option");
      option.setAttribute("value", equipmentID); //ResourceID
      option.appendChild(document.createTextNode(equipmentName)); //Name
      selectEquipments.appendChild(option);
    }

		document.getElementById("selSearch").onchange = function(){
			var idValue = document.getElementById("selSearch").value;
			jsonObject.Op = "search";
			jsonObject.RoomID = idValue;
			sendData(searchClicked); //searchClicked
		};

		function save(){

				var proceed = userConfirmation();

				if(proceed){
					clearRoom();
					jsonObject.Op = "insert"; //insert operation
					jsonObject.RoomID = parseInt(document.getElementById("ID").value);
					jsonObject.Name = document.getElementById("txtName").value;
					jsonObject.Description = document.getElementById("txtDescription").value;
          jsonObject.Capacity = parseInt(document.getElementById("txtCapacity").value);
          //Get the selected branch
          var selectBranch = document.getElementById("selBranch");
          jsonObject.BranchID = parseInt(selectBranch[selectBranch.selectedIndex].value);

          //Get All selected Resources/Equipments
          var selectResource = document.getElementById("selSelectedEquipments");
          for(var i = 0; i < selectResource.length; i++)
            jsonObject.ResourceID.push(selectResource[i].value);

          //Send data
					sendData(saveTyped);
			}
		}

    document.getElementById("btnSelectEquipment").onclick = function(){
        addEquipmentToRoom();
    };

    document.getElementById("btnRemoveEquipment").onclick = function(){
      removeEquipmentFromRoom();
    };

    function removeEquipmentFromRoom(){
        var selSelected = document.getElementById("selSelectedEquipments");

        if(selSelected.hasChildNodes){
          for(var i = 0; i < selSelected.length; i++){
            if(selSelected[i].selected){
              selSelected.removeChild(selSelected.options[i]);
            }
          }
        }
    }

    function addEquipmentToRoom(){
      var selEquipments = document.getElementById("selEquipments");
      var selSelected = document.getElementById("selSelectedEquipments");

      for(var i = 0; i < selEquipments.length; i++){
          var alreadySelected = false;
          if(selEquipments[i].selected){
            for(var j = 0; j < selSelected.length; j++){
              if(selEquipments[i].innerHTML == selSelected[j].innerHTML)
                alreadySelected = true;
            }
            if(!alreadySelected)
              addEquipment(selEquipments[i].value, selEquipments[i].innerHTML);
          }
      }
    }


		</script>
  </body>
</html>
