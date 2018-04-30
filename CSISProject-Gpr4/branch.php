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
			<h2>Branch</h2>
			<form class="meeting-form">
				<input type="hidden" id="ID" name="ID" value="">
				<div class="meeting-form-left">
					<h4>Name *</h4>
					<input type="text" name="txtName" id="txtName">
					<h4>Description</h4>
					<textarea name="txtDescription" id="txtDescription" rows="11"></textarea>
				</div>
				<div class="meeting-form-right">
					<h4>Address</h4>
					<input type="text" name="txtStreet" id="txtStreet" placeholder="Enter Street Name/N&#111;"><br />
					<h4>Country *</h4>
					<select id="selCountry" class="inline">
						<option value="CA">Canada</option>
						<option value="US">United States</option>
					</select>
					<input type="text" class="inline" name="txtEstate" id="txtEstate" placeholder="Estate/Province *">
					<h4>City *</h4>
					<input type="text" class="inline" name="txtcity" id="txtCity">
					<input type="text" class="inline" name="txtPostalCode" id="txtPostalCode" placeholder="Postal Code">

					<!-- Search components -->
					<h4>Search</h4>
					<select id="selSearch" size="4">
						<?php
							//Populate the list with the names of Branches
							//<option value="0"></option>
							$meetingData = new MeetingData();
							$dataArr = $meetingData->get_branch("%"); //All branches

							foreach ($dataArr as $data ) {
								echo "<option value='".$data["ID"]."'>".$data["Name"]."</option>";
							}
						?>
					</select>
					<input type="text" class="search" id="txtSearch" name="txtSearch" placeholder="Search Branch..." title="Search Branch by name" style="width:48%">
	          <button type="button" id="btnSearch" name="btnSearch">Search</button>
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
			table:"branch",
			BranchID:0,
			Name:"",
			Description:"",
			Country:"",
			Estate_Province:"",
			City:"",
			Street_Name:"",
			Postal_Code:""
		};

		function clearBranch(){
			//Clears JSON Object

			jsonObject.Op = "";
			jsonObject.table = "branch";
			jsonObject.BranchID = 0;
			jsonObject.Name = "";
			jsonObject.Description = "";
			jsonObject.Country = "";
			jsonObject.Estate_Province = "";
			jsonObject.City = "";
			jsonObject.Street_Name = "";
			jsonObject.Postal_Code = "";
		}

		var searchClicked = function(jsonObj){
				//Populate fields with info received from server
				document.getElementById("ID").value = jsonObj[0]["ID"];
				document.getElementById("txtName").value = jsonObj[0]["Name"];
				document.getElementById("txtDescription").value = jsonObj[0]["Description"];
				document.getElementById("txtStreet").value = jsonObj[0]["Street_Name"];
				document.getElementById("txtEstate").value = jsonObj[0]["Estate_Province"];
				document.getElementById("txtCity").value = jsonObj[0]["City"];
				document.getElementById("txtPostalCode").value = jsonObj[0]["Postal_Code"];
				var selected = document.getElementById("selCountry");
				if(jsonObj[0]["Country"] == 'US')
					selected.selectedIndex = 1;
				else
					selected.selectedIndex = 0;
		}

		document.getElementById("selSearch").onchange = function(){
			var idValue = document.getElementById("selSearch").value;
			jsonObject.Op = "search";
			jsonObject.BranchID = idValue;
			sendData(searchClicked); //searchClicked
		};

		function save(){

				var proceed = userConfirmation();

				if(proceed){
					clearBranch();
					jsonObject.Op = "insert"; //insert operation
					jsonObject.BranchID = parseInt(document.getElementById("ID").value);
					jsonObject.Name = document.getElementById("txtName").value;
					jsonObject.Description = document.getElementById("txtDescription").value;
					jsonObject.Street_Name = document.getElementById("txtStreet").value;
					jsonObject.Estate_Province = document.getElementById("txtEstate").value;
					jsonObject.City = document.getElementById("txtCity").value;
					jsonObject.Postal_Code = document.getElementById("txtPostalCode").value;
					jsonObject.Country = document.getElementById("selCountry").value;

					sendData(saveTyped);
			}
		}



		</script>
	</body>
</html>
