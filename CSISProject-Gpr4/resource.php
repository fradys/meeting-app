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
      <h2>Resources / Equipments</h2>
      <form class="meeting-form">
        <input type="hidden" id="ID" name="ID" value="">
        <div class="meeting-form-left">
          <h4>Search Equipments</h4>
          <select id="selSearch" name="selSearch" size="8">
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
          <input type="text" class="search" id="txtSearch" name="txtSearch" placeholder="Search Equipments..." title="Search Equipments by name">
	        <button type="button" id="btnSearch" name="btnSearch">Search</button>
        </div>
        <div class="meeting-form-right">
          <h4>Name *</h4>
          <input type="text" id="txtName" name="txtName">
          <h4>Description</h4>
          <textarea id="txtDescription" name="txtDescription" rows="6"></textarea>
          <br />
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
			table:"resource",
			ResourceID:0,
			Name:"",
			Description:""
		};

		function clearResource(){
			//Clears JSON Object

			jsonObject.Op = "";
			jsonObject.table = "resource";
			jsonObject.ResourceID = 0;
			jsonObject.Name = "";
			jsonObject.Description = "";
		}

		var searchClicked = function(jsonObj){
				//Populate fields with info received from server
				document.getElementById("ID").value = jsonObj[0]["ID"];
				document.getElementById("txtName").value = jsonObj[0]["Name"];
				document.getElementById("txtDescription").value = jsonObj[0]["Description"];
		}

		document.getElementById("selSearch").onchange = function(){
			var idValue = document.getElementById("selSearch").value;
			jsonObject.Op = "search";
			jsonObject.ResourceID = idValue;
			sendData(searchClicked); //searchClicked
		};

		function save(){

				var proceed = userConfirmation();

				if(proceed){
					clearResource();
					jsonObject.Op = "insert"; //insert operation
					jsonObject.ResourceID = parseInt(document.getElementById("ID").value);
					jsonObject.Name = document.getElementById("txtName").value;
					jsonObject.Description = document.getElementById("txtDescription").value;

					sendData(saveTyped);
			}
		}



		</script>
  </body>
</html>
