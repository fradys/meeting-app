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
		<!-- Main container-->
		<div class="meeting-container">
			<h2>Meeting Members / Participants</h2>
			<form class="meeting-form" >
				<input type="hidden" id="ID" name="ID" value="">
				<div class="meeting-form-left">
					<h4>Search Members</h4>
					<select id="selSearch" name="selSearchMembers" size="10">
						<?php
							//Populate the list with the names of members
							//<option value="0"></option>
							$meetingData = new MeetingData();
							$dataArr = $meetingData->get_participant("%"); //All participants

							foreach ($dataArr as $data ) {
								echo "<option value='".$data["ID"]."'>".$data["Name"]."</option>";
							}
						?>
					</select>
					<input type="text" id="txtSearch" class="search" name="txtSearch" placeholder="Search Members..." title="Search Members by name">
	          <button type="button" id="btnSearch" name="btnSearch">Search</button>
				</div>
				<div class="meeting-form-right">
					<h4>Name</h4>
					<input type="text" name="txtName" id="txtName">
					<h4>Phone Number</h4>
					<input type="tel" name="txtPhone" id="txtPhone" size="20" placeholder="123-456-7890">
					<h4>Email</h4>
					<input type="email" name="txtEmail" id="txtEmail"><br />
					<input type="checkbox" name="chkEmployee" id="chkEmployee" checked>
					<label for="chkEmployee">Employee</label>
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

			//Participant JSON Object
			var jsonObject = {
				Op:"", //Operation determines which operation the server should do
				table:"participant",
				ParticipantID:0,
			  Name:"",
			  Phone_Number:"",
			  Email:"",
			  Employee:1
			};

			//SPECIFIC
			function clearParticipant(){
				//Clears JSON Object

				jsonObject.Op = "";
				jsonObject.table = "participant";
				jsonObject.ParticipantID = 0,
				jsonObject.Name = "";
				jsonObject.Phone_Number = "";
				jsonObject.Email = "";
				jsonObject.Employee = 1;

			}


			//SPECIFIC
			var searchClicked = function(jsonObj){
					document.getElementById("ID").value = jsonObj[0]["ID"];
					document.getElementById("txtName").value = jsonObj[0]["Name"];
					document.getElementById("txtPhone").value = jsonObj[0]["Phone"];
					document.getElementById("txtEmail").value = jsonObj[0]["Email"];
					document.getElementById("chkEmployee").checked =
					(jsonObj[0]["Employee"] == 1)? true:false;
			}



			//SPECIFIC
			document.getElementById("selSearch").onchange = function(){
				var idValue = document.getElementById("selSearch").value;
				jsonObject.Op = "search";
				jsonObject.ParticipantID = idValue;
				sendData(searchClicked); //searchClicked
			};

			//SPECIFIC - insert
			function save(){

					var proceed = userConfirmation();

					if(proceed){
						clearParticipant();
						jsonObject.Op = "insert";
						jsonObject.ParticipantID = parseInt(document.getElementById("ID").value);
						jsonObject.Name = document.getElementById("txtName").value.trim();
						jsonObject.Phone_Number = document.getElementById("txtPhone").value.trim();
						jsonObject.Email = document.getElementById("txtEmail").value.trim();
						jsonObject.Employee = ((document.getElementById("chkEmployee").checked) ? 1:0);

						sendData(saveTyped);
				}
			}


		</script>
	</body>
</html>
