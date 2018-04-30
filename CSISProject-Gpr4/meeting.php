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

      .search-type {
        width: 35%;
        height: 50px;
        position: relative;
        top: -10px;
      }

      .search-type-title {
        font-size: 14px !important;
        margin-right: 2px;
        position: relative;
        display: inline;
        left: 7px;
        font-weight: bold;
      }

      .search-type label {
        font-size: 13px;
        text-align: left;
        display: inline-block;
        margin-left: 10px;
      }

      .search-type input[type="radio"]{
        display: inline-block;
        margin-left: 25px;
      }

		</style>
    <script type="text/javascript">
      var searchID = -1;
    </script>
		<?php include "meetingdata.php";
    if(count($_REQUEST) > 0){
      extract($_REQUEST);
      echo "<script>searchID = ".$idValue."</script>";
      $idValue = -1;
    }
    ?>
  </head>
  <body onload="viewMeetingDetails()">
    <div class="meeting-container">
      <h2>Meeting</h2>
      <form class="meeting-form">
        <input type="hidden" id="ID" name="ID" value="">

        <div class="meeting-form-left">
          <h4>Subject *</h4>
          <input type="text" id="txtSubject" name="txtSubject"><br />
          <h4>Description</h4>
          <textarea id="txtDescription" name="txtDescription" rows="5" cols="30" maxlength="500"></textarea><br />
          <h4>Select Conference Room *</h4>
          <select id="selRoom" name="selRoom" style="width:70%;margin-right:10px">
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
          <input type="checkbox" id="chkPrivate" name="chkPrivate">
          <label for="chkPrivate" title="A Private meeting does not appear in Next Meeting billboard">Private</label>
          <select id="selSearch" name="selSearch" size="3">
            <?php
              //Populate the list with the names of Equipments
              //<option value="0"></option>
              $meetingData = new MeetingData();
              $dataArr = $meetingData->get_meeting("%"); //All resources/equipments

              foreach ($dataArr as $data ) {
                echo "<option value='".$data["ID"]."'>".$data["MeetingInfo"]."</option>";
              }
            ?>
          </select>
          <input type="text" class="search" id="txtSearch" name="txtSearch" placeholder="Search Meetings..." title="Search Meetings by subject" style="width:48%;">
          <button type="button" id="btnSearch" name="btnSearch" >Search</button>
          <!-- <div class="search-type">
            <label class="search-type-title">Search Type</label>
            <input type="radio" id="radioSearchDate" name="radioSearchType" value="1">
            <input type="radio" id="radioSearchSubject" name="radioSearchType" value="0" checked>
            <label for="radioSearchDate" title="Search for a specific date/time,
            if only a date is provided then the first meeting in that day is displayed.
            If date and time is provided the first meeting within that date and Start or
            End time match the provided time.">Date</label>
            <label for="radioSearchSubject" title="Search for subject will return the first meeting with provided subject.
            Only future meetings are displayed.">Subject</label>
          </div> -->
        </div>
        <div class="vertical-divisor"></div>
        <div class="meeting-form-right">
          <!-- Right side of the form -->
          <h4>Meeting Start / End Datetime*</h4>
          <input class="inline" type="date" id="dateStart" name="dateStart" title="Start Meeting date, format: mm/dd/yyy">
          <input class="inline" type="time" id="timeStart" name="timeStart" title="Start Meeting hour, format: hh:mm AM/PM">
          <input class="inline" type="date" id="dateEnd" name="dateEnd" title="End Meeting date, format: mm/dd/yyy">
          <input class="inline" type="time" id="timeEnd" name="timeEnd" title="End Meeting hour, format:hh:mm AM/PM">
          <h4>Select Participants</h4>
          <select id="selMembers" name="" size="3" multiple>
            <?php
              //Populate the list with the names of members
              //<option value="0"></option>
              $meetingData = new MeetingData();
              $dataArr = $meetingData->get_participant("%"); //All participants

              foreach ($dataArr as $data ) {
                echo "<option value='".$data["ID"]."'>".$data["Name"]." [".$data["Email"]."]"."</option>";
              }
            ?>
          </select>
          <button type="button" id="btnAddMember" name="button">Add Member</button>
          <input type="text" class="searchMember" id="txtSearchMember" name="txtSearchMember" placeholder="Search Members..." title="Search Members by name" style="width:48%;location:relative;left:10px;">
          <button type="button" class="location" id="btnSearchMember" name="btnSearchMembers">Search</button>

          <div class="selected-memebers-container">
            <h4>Meeting Selected Participants</h4>
            <select id="selSelectedMembers" name="selSelectedMembers" size="3"></select>
            <button type="button" class="location" id="btnRemoveMember" name="button" style="location:relative;top:-8px;">Remove</button>
          </div>
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
      table:"meeting",
      MeetingID:0,
      Subject:"",
      Description:"",
      Start_Date:"",
      End_Date:"",
      RoomID:0,
      Private:0,
      ParticipantID: []
    };

    function clearMeeting(){
      //Clears JSON Object

      jsonObject.Op = "";
      jsonObject.table = "meeting";
      jsonObject.MeetingID = 0;
      jsonObject.Subject = "";
      jsonObject.Description = "";
      jsonObject.Start_Date = "";
      jsonObject.End_Date = "";
      jsonObject.RoomID = 0;
      jsonObject.Private = 0;
      jsonObject.ParticipantID = [];
    }

    var searchClicked = function(jsonObj){
        //Populate fields with info received from server
        document.getElementById("ID").value = jsonObj[0]["ID"];
        document.getElementById("txtSubject").value = jsonObj[0]["Name"];
        document.getElementById("txtDescription").value = jsonObj[0]["Description"];
        document.getElementById("chkPrivate").selected = ((jsonObj[0]["Private"] == 1) ? true:false) ;

        //Getting Dates
        var temp = jsonObj[0]["Start_Date"];
        var dataArr = temp.split(" ");
        document.getElementById("dateStart").value = dataArr[0];
        document.getElementById("timeStart").value = dataArr[1];
        temp = jsonObj[0]["End_Date"];
        dataArr = temp.split(" ");
        document.getElementById("dateEnd").value = dataArr[0];
        document.getElementById("timeEnd").value = dataArr[1];

        //Get the selected meeting room
        var selectRoom = document.getElementById("selRoom");
        var roomID = jsonObj[0]["RoomID"];

        for(var i = 1; i < selectRoom.length; i++){
          if(selectRoom[i].value == roomID){
              selectRoom[i].setAttribute("selected", true);
          } else {
            //Walk in the whole list removing selected attribute from previous selection
            selectRoom[i].removeAttribute("selected");
          }
        }

        //Populate All selected meeting participants
        clearComponent("selSelectedMembers"); //Clear the component before
        var data = jsonObj[1];
        if(data == null || data == undefined)
          return;

        for(var row = 0; row < data.length; row++){
            addMember(data[row][0], data[row][1]);
        }
    }

    function addMember(memberID, memberName){
      var selectedMembers = document.getElementById("selSelectedMembers");
      var option = document.createElement("option");
      option.setAttribute("value", memberID); //MemeberID
      option.appendChild(document.createTextNode(memberName)); //Name
      selectedMembers.appendChild(option);
    }

    document.getElementById("selSearch").onchange = function(){
      var idValue = document.getElementById("selSearch").value;
      jsonObject.Op = "search";
      jsonObject.MeetingID = idValue;
      sendData(searchClicked); //searchClicked
    };

    function save(){

        var proceed = userConfirmation();

        if(proceed){
          clearMeeting();
          jsonObject.Op = "insert"; //insert operation
          jsonObject.MeetingID = parseInt(document.getElementById("ID").value);
          jsonObject.Subject = document.getElementById("txtSubject").value;
          jsonObject.Description = document.getElementById("txtDescription").value;
          jsonObject.Private = (document.getElementById("chkPrivate").checked) ? 1:0;

          //Get selected ROOM
          var selectRoom = document.getElementById("selRoom");
          jsonObject.RoomID = parseInt(selectRoom[selectRoom.selectedIndex].value);

          //Get Start/End Datetime
          var date = document.getElementById("dateStart").value;
          var time = document.getElementById("timeStart").value;
          jsonObject.Start_Date = (date + " " + time);

          date = document.getElementById("dateEnd").value;
          time = document.getElementById("timeEnd").value;
          jsonObject.End_Date = (date + " " + time);

          //Get selected members
          var selectMember = document.getElementById("selSelectedMembers");
          for(var i = 0; i < selectMember.length; i++)
            jsonObject.ParticipantID.push(selectMember[i].value);

          sendData(saveTyped);
      }
    }

    //Add/Remove Participants
    document.getElementById("btnAddMember").onclick = function(){
        addParticipantToMeeting();
    };

    document.getElementById("btnRemoveMember").onclick = function(){
      removeParticipantFromMeeting();
    };

    function removeParticipantFromMeeting(){
        var selSelected = document.getElementById("selSelectedMembers");

        if(selSelected.hasChildNodes){
          for(var i = 0; i < selSelected.length; i++){
            if(selSelected[i].selected){
              selSelected.removeChild(selSelected.options[i]);
            }
          }
        }
    }

    function searchMembers(){
      var list = document.getElementById("selMembers");
      var searchValue = document.getElementById("txtSearchMember").value.trim();
      var searchReg = new RegExp(searchValue, "i");
      var found = -1;

      for(var i = 0; i < list.length; i++){
        found = list.options[i].innerHTML.search(searchReg);
        if(found >= 0){
          list.options.selectedIndex = i;

          break;
        }
      }
      if(found < 0){
        notFoundMemberAnimation();
      }
    }

  function notFoundMemberAnimation() {
    document.querySelector(".searchMember").className = "searchMember";
    window.requestAnimationFrame(function(time) {
      window.requestAnimationFrame(function(time) {
        document.querySelector(".searchMember").className = "searchMember notFound";
      });
    });
  }

    function addParticipantToMeeting(){
      var selMembers = document.getElementById("selMembers");
      var selSelected = document.getElementById("selSelectedMembers");

      for(var i = 0; i < selMembers.length; i++){
          var alreadySelected = false;
          if(selMembers[i].selected){
            for(var j = 0; j < selSelected.length; j++){
              if(selMembers[i].innerHTML == selSelected[j].innerHTML)
                alreadySelected = true;
            }
            if(!alreadySelected)
              addMember(selMembers[i].value, selMembers[i].innerHTML);
          }
      }
    }

    document.getElementById("btnSearchMember").onclick = function(){
      searchMembers();
    };

    function viewMeetingDetails(){

      if(searchID > 0){
        var list = document.getElementById("selSearch");

        for(var i = 0; i < list.length; i++){
          if(found = list.options[i].value == searchID){
            list.options.selectedIndex = i;
            list.dispatchEvent(new Event("change"));
            break;
          }
        }
      }
      searchID = -1;
    }


    // document.getElementById("radioSearchDate").onchange = function(){
    //     document.getElementById("txtSearch").placeholder = "dd/mm/yyyy hh:mm";
    // };
    //
    // document.getElementById("radioSearchSubject").onchange = function(){
    //     document.getElementById("txtSearch").placeholder = "Search Meetings...";
    // };

    </script>
  </body>
</html>
