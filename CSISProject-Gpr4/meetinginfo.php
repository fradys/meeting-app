<?php
/*
  This script controls the data between index and meeting class
*/



  require "meetingdata.php";
  $meetingData = new MeetingData();
  global $meetingData;

  extract($_REQUEST);

  if($data != null){

    $dataMember = json_decode($data);

    switch ($dataMember->table) {
      case 'participant':
        participant($dataMember);
      break;

      case 'branch':
        branch($dataMember);
      break;

      case 'resource':
        resource($dataMember);
      break;

      case 'room':
        room($dataMember);
      break;

      case 'meeting':
        meeting($dataMember);
      break;
    }
  }


//------------------------------------------------------

    function meeting($jsonData){

      switch($jsonData->Op){
        case "insert":
          insertMeeting($jsonData);
        break;
        case "search":
          $value = ($jsonData->MeetingID > 0)?
          $jsonData->MeetingID: $jsonData->Name;
          searchMeeting($value);
        break;
        case "delete":
          deleteMeeting($jsonData->BranchID);
        break;
      }
    }

    function searchMeeting($value){
      global $meetingData;
      $dataArr = $meetingData->get_meeting($value);
      $members = array();

      //Get the equipments from that room
      $dataTemp = $meetingData->get_participant_meeting($value);
      if($dataTemp != null){
        foreach ($dataTemp as $data) {
             $info = [$data["ParticipantID"],
             $data["Participant_Name"]." [".$data["Participant_Email"]."]"
           ];
            array_push($members, $info);
        }
        array_push($dataArr, $members);
      }

      print json_encode($dataArr);
    }


    function insertMeeting($json){
      global $meetingData;

      $dataArr = array(
        "MeetingID"=>$json->MeetingID,
        "Subject"=>$json->Subject,
        "Description"=>$json->Description,
        "Start_Date"=>$json->Start_Date,
        "End_Date"=>$json->End_Date,
        "Private"=>$json->Private,
        "RoomID"=>$json->RoomID,
        "ParticipantID"=>$json->ParticipantID
      );

      $result = $meetingData->set_meeting($dataArr);
      print json_encode($result);
    }


//------------------------------------------------------

  function room($jsonData){

    switch($jsonData->Op){
      case "insert":
        insertRoom($jsonData);
      break;
      case "search":
        $value = ($jsonData->RoomID > 0)?
        $jsonData->RoomID: $jsonData->Name;
        searchRoom($value);
      break;
      case "delete":
        deleteRoom($jsonData->RoomID);
      break;
    }
  }

  function searchRoom($value){
    global $meetingData;
    $dataArr = $meetingData->get_room($value);
    $resources = array();

    //Get the equipments from that room
    $dataTemp = $meetingData->get_room_resource($value);
    if($dataTemp != null){
      foreach ($dataTemp as $data) {
           $info = [$data["ResourceID"], $data["Resource_Name"]];
          array_push($resources, $info);
      }
      array_push($dataArr, $resources);
    }

    print json_encode($dataArr);
  }


  function insertRoom($json){
    global $meetingData;

    $dataArr = array(
      "RoomID"=>$json->RoomID,
      "Name"=>$json->Name,
      "Description"=>$json->Description,
      "Capacity"=>$json->Capacity,
      "BranchID"=>$json->BranchID,
      "ResourceID"=>$json->ResourceID
    );

    $result = $meetingData->set_room($dataArr);
    print json_encode($result);
  }



//------------------------------------------------------

  function resource($jsonData){

    switch($jsonData->Op){
      case "insert":
        insertResource($jsonData);
      break;
      case "search":
        $value = ($jsonData->ResourceID > 0)?
        $jsonData->ResourceID: $jsonData->Name;
        searchResource($value);
      break;
      case "delete":
        deleteResource($jsonData->BranchID);
      break;
    }
  }

  function searchResource($value){
    global $meetingData;
    $dataArr = $meetingData->get_resource($value);

    print json_encode($dataArr);
  }

  function insertResource($json){
    global $meetingData;

    $dataArr = array(
      "ResourceID"=>$json->ResourceID,
      "Name"=>$json->Name,
      "Description"=>$json->Description
    );

    $result = $meetingData->set_resource($dataArr);
    print json_encode($result);
  }

  function deleteResource($id){
    global $meetingData;
    $dataArr = new stdClass();

    $dataArr->erased = $meetingData->del_resource($id);

    print json_encode($dataArr);
  }


//------------------------------------------------------
  function branch($jsonData){

    switch($jsonData->Op){
      case "insert":
        insertBranch($jsonData);
      break;
      case "search":
        $value = ($jsonData->BranchID > 0)?
        $jsonData->BranchID: $jsonData->Name;
        searchBranch($value);
      break;
      case "delete":
        deleteBranch($jsonData->BranchID);
      break;
    }
  }


  function searchBranch($value){
    global $meetingData;
    $dataArr = $meetingData->get_branch($value);

    print json_encode($dataArr);
  }

  function insertBranch($json){
    global $meetingData;

    $dataArr = array(
      "BranchID"=>$json->BranchID,
      "Name"=>$json->Name,
			"Description"=>$json->Description,
			"Country"=>$json->Country,
			"Estate_Province"=>$json->Estate_Province,
			"City"=>$json->City,
			"Street_Name"=>$json->Street_Name,
			"Postal_Code"=>$json->Postal_Code
    );

    $result = $meetingData->set_branch($dataArr);
    print json_encode($result);
  }

  function deleteBranch($id){
    global $meetingData;
    $dataArr = new stdClass();

    $dataArr->erased = $meetingData->del_branch($id);

    print json_encode($dataArr);
  }

//-------------------------------------------------------
  function participant($jsonData){

    switch($jsonData->Op){
      case "insert":
        insertParticipant($jsonData);
      break;
      case "search":
        $value = ($jsonData->ParticipantID > 0)?
        $jsonData->ParticipantID: $jsonData->Name;
        searchParticipant($value);
      break;
    }
  }


  function searchParticipant($value){
    global $meetingData;
    $dataArr = $meetingData->get_participant($value);

    print json_encode($dataArr);
  }


  function insertParticipant($json){
    global $meetingData;
    $dataArr = array(
      "ParticipantID"=>$json->ParticipantID,
      "Name"=>$json->Name,
      "Phone_Number"=>$json->Phone_Number,
      "Email"=>$json->Email,
      "Employee"=>$json->Employee
    );
    $result = $meetingData->set_participant($dataArr);
    print json_encode($result);
  }

//------------------------------------------------------------------



?>
