
<?php

  //Connects to meetingdb Database
  require "meetingdb_connect.php";
  global $connection;

  class MeetingData{


    function participant_has_meeting($participantId,$sd,$ed){
	//This function will return a boolean value. True if participant is enrolled to meeting at the same time
	//Participant ID, start date, end date
	$sql =
		"SELECT
			participant_meeting.ParticipantID as ID
		FROM
			participant_meeting, meeting
		WHERE
			participant_meeting.ParticipantID = $participantId AND
			participant_meeting.MeetingID = meeting.MeetingID AND
			(meeting.Start_Date <= '$sd' AND meeting.End_Date >= '$sd'
			 OR
			meeting.Start_Date <= '$ed' AND meeting.End_Date >= '$ed')";

	return count($this->executeSQL($sql))>0 ? true : false;
}

    //Display all availables meetings for today, if none available show
    //at least 5 next meetings
    function next_meetings(){

		$sql =
			"SELECT
			    COUNT(Participant_Meeting.ParticipantID) AS Total_Participants,
			    Meeting.MeetingID AS Meeting_Code,
			    Meeting.Subject AS Meeting_Subject,
			    DATE(Meeting.Start_Date) AS Meeting_Date,
			    TIME(Meeting.Start_Date) AS Meeting_Start,
			    TIME(Meeting.End_Date) AS Meeting_End,
			    Room.RoomID AS Room_Code,
			    Room.Name AS Room_Name,
			    Branch.Name AS Branch
			FROM
			    Meeting
			        INNER JOIN
			    Participant_Meeting ON Meeting.MeetingID = Participant_Meeting.MeetingID
			        LEFT OUTER JOIN
			    Participant ON Participant_Meeting.ParticipantID = Participant.ParticipantID
			        INNER JOIN
			    Room ON Meeting.RoomID = Room.RoomID
			        INNER JOIN
			    Branch ON Branch.BranchID = Room.BranchID
			WHERE
			    Meeting.Start_Date >= NOW()
          AND Meeting.Private = 0
			GROUP BY
			    Meeting.MeetingID,
			    Meeting.Subject ,
			    Room.RoomID,
			    Room.Name ,
			    Branch.Name
			ORDER BY
			    DATE(Meeting.Start_Date),
			    Branch.Name,
			    TIME(Meeting.Start_Date),
			    Room.Name,
			    TIME(Meeting.End_Date)
			LIMIT 10";

			return $this->executeSQL($sql);
    }

//------------------------------------------------------------------
/*

  MEETING

*/

  function get_meeting($meeting, $subject = true){
    $sql =
      "SELECT
         MeetingID AS ID,
         Subject AS Name,
         Description,
         Start_Date,
         End_Date,
         RoomID,
         Private,
         (CONCAT(Subject, ' - ',
           date_format(Start_Date, '%d/%m/%y - %h:%i %p'), ' => ',
           date_format(End_Date, '%h:%i %p'))
         ) AS MeetingInfo
      FROM
        Meeting ";

    $search = "";

    if(is_numeric($meeting)){
      $search = "WHERE Meeting.MeetingID = $meeting";
    } else if($subject) {
      $search = "WHERE Meeting.Subject LIKE '%$meeting%' ORDER BY Meeting.Subject";
    } else {
      $search = "WHERE (Meeting.Start_Date = '%$meeting%' or Meeting.End_Date = '$meeting'
      ORDER BY Meeting.Subject";
    }

    $sql .= $search;

    return $this->executeSQL($sql);
  }

  function get_participant_meeting($meeting = null){
    $sql =
      "SELECT
          Participant.ParticipantID AS ParticipantID,
          Participant.Name AS Participant_Name,
          Participant.Phone_Number AS Participant_Phone,
          Participant.Email AS Participant_Email
      FROM
          Participant
              INNER JOIN
          Participant_Meeting ON Participant.ParticipantID = Participant_Meeting.ParticipantID
              INNER JOIN
          Meeting ON Meeting.MeetingID = Participant_Meeting.MeetingID ";

    $search = "";

    if(is_numeric($meeting))
      $search = "WHERE Meeting.MeetingID = $meeting";
    else
      $search = "WHERE Meeting.Subject LIKE '%$meeting%' ORDER BY Meeting.Subject";

    $sql .= $search;

    return $this->executeSQL($sql);
  }


  function set_meeting($dataArr){
    $sql = "";

    if($dataArr["MeetingID"] == ""){ //Means the ID is empty, therefore is an INSERT

        $sql =
          "INSERT INTO Meeting(
            MeetingID,
            Subject,
            Description,
            Start_Date,
            End_Date,
            RoomID,
            Private,
            ModifiedON)
          VALUES (
            DEFAULT,
            '".$dataArr["Subject"]."',
            '".$dataArr["Description"]."',
            '".$dataArr["Start_Date"]."',
            '".$dataArr["End_Date"]."',
            ".$dataArr["RoomID"].",
            ".$dataArr["Private"].",
            DEFAULT)";

    } else {

      $sql =
        "UPDATE
          Meeting
        SET
          Subject='".$dataArr["Subject"]."',
          Description='".$dataArr["Description"]."',
          Start_Date='".$dataArr["Start_Date"]."',
          End_Date='".$dataArr["End_Date"]."',
          RoomID=".$dataArr["RoomID"].",
          Private=".$dataArr["Private"].",
          ModifiedON=DEFAULT
        WHERE
          Meeting.MeetingID = ".$dataArr["MeetingID"];

    }

    $success = $this->executeCommand($sql);

    if($success){
        if(count($dataArr["ParticipantID"]) > 0)
          $this->set_participant_meeting($dataArr, true);

        return $this->get_meeting($dataArr["Subject"]);
    } else{
        return null;
    }
  }


  private function set_participant_meeting($dataArr, $eraseAll = false){
    $meetingID = -1;
    //Get the most recent roomID, which all resources were erased before the insert
    if($eraseAll)
      $meetingID = $this->delete_all_associated_participant_meeting();
    else
      $meetingID = $this->get_last_modified_meeting();

    //List of ParticipantID to be included into participant_meeting
    $members = $dataArr["ParticipantID"];
    $sql = "";

    for($i = 0; $i < count($members); $i++){
        $sql =
          "INSERT INTO Participant_Meeting(
              Participant_Meeting_ID,
              ParticipantID,
              MeetingID,
              ModifiedON)
          VALUES (
              DEFAULT,
              ".$members[$i].",
              ".$meetingID.",
              DEFAULT)";

        $data = $this->executeCommand($sql);
        // if($data == null)
        //   return false;
    }
    return true;
  }


  private function get_last_modified_meeting(){
    //Get the ID of the last modified meeting (INSERTED or UPDATED)
    $sql =
      "SELECT
        Meeting.MeetingID
      FROM
        Meeting
      WHERE
        Meeting.MeetingID IS NOT NULL
      ORDER BY
        Meeting.ModifiedON DESC
      LIMIT 1";

      return $this->executeSQL($sql);
  }

  private function delete_all_associated_participant_meeting($meetingID = null){
    //Delete all meeting participants, if no $meetingID is
    //specified the function will delete from the last modified record

    if($meetingID == null){
      $data = $this->get_last_modified_meeting();
      $meetingID = $data[0]["MeetingID"];
    }

    $sql =
      "DELETE FROM
        Participant_Meeting
      WHERE
        Participant_Meeting.MeetingID = $meetingID";

    $this->executeCommand($sql);

    return $meetingID;
  }

//------------------------------------------------------------------
/*

  ROOM

*/

function get_room($room = null){
  $sql =
    "SELECT
        RoomID AS ID,
        Name,
        Description,
        Capacity,
        BranchID
    FROM
        Room ";

  $search = "";

  if(is_numeric($room))
    $search = "WHERE Room.RoomID = $room";
  else
    $search = "WHERE Room.Name LIKE '%$room%' ORDER BY Room.Name";

  $sql .= $search;

  return $this->executeSQL($sql);
}


  function get_room_resource($room = null){
    $sql =
      "SELECT
          Resource.ResourceID AS ResourceID,
          Resource.Name AS Resource_Name,
          Resource.Description AS Resource_Description
      FROM
          Room
              INNER JOIN
          Room_Resource ON Room.RoomID = Room_Resource.RoomID
              INNER JOIN
          Resource ON Resource.ResourceID = Room_Resource.ResourceID ";

    $search = "";

    if(is_numeric($room))
      $search = "WHERE Room.RoomID = $room";
    else
      $search = "WHERE Room.Name LIKE '%$room%' ORDER BY Room.Name";

    $sql .= $search;

    return $this->executeSQL($sql);
  }


  function set_room($dataArr){
    $sql = "";

    if($dataArr["RoomID"] == ""){ //Means the ID is empty, therefore is an INSERT

        $sql =
          "INSERT INTO Room(
              RoomID,
              Name,
              Description,
              Capacity,
              BranchID,
              ModifiedON)
          VALUES (
              DEFAULT,
              '".$dataArr["Name"]."',
              '".$dataArr["Description"]."',
              ".$dataArr["Capacity"].",
              ".$dataArr["BranchID"].",
              DEFAULT)";

    } else {

      $sql =
        "UPDATE Room
        SET
          Name='".$dataArr["Name"]."',
          Description='".$dataArr["Description"]."',
          Capacity=".$dataArr["Capacity"].",
          BranchID=".$dataArr["BranchID"].",
          ModifiedON=DEFAULT
        WHERE
            Room.RoomID = ".$dataArr["RoomID"];

    }

    $success = $this->executeCommand($sql);

    if($success){
        if(count($dataArr["ResourceID"]) > 0)
          $this->set_room_resource($dataArr, true);

        return $this->get_room($dataArr["Name"]);
    } else{
        return null;
    }
  }


  private function set_room_resource($dataArr, $eraseAll = false){
    $roomID = -1;
    //Get the most recent roomID, which all resources were erased before the insert
    if($eraseAll)
      $roomID = $this->delete_all_associated_room_resources();
    else
      $roomID = $this->get_last_modified_room();

    //List of ResourceID to be included into room_resource
    $resources = $dataArr["ResourceID"];
    $sql = "";

    for($i = 0; $i < count($resources); $i++){
        $sql =
          "INSERT INTO Room_Resource(
              Room_Resource_ID,
              RoomID,
              ResourceID,
              ModifiedON)
          VALUES (
              DEFAULT,
              ".$roomID.",
              ".$resources[$i].",
              DEFAULT)";

        $data = $this->executeCommand($sql);
        // if($data == null)
        //   return false;
    }
    return true;
  }


  private function get_last_modified_room(){
    //Get the ID of the last modified room (INSERTED or UPDATED)
    $sql =
      "SELECT
        Room.RoomID
      FROM
        Room
      WHERE
        Room.RoomID IS NOT NULL
      ORDER BY
        Room.ModifiedON DESC
      LIMIT 1";

      return $this->executeSQL($sql);
  }

  private function delete_all_associated_room_resources($roomID = null){
    //Delete all associated resources with this particular room, if no roomID is
    //specified the function will delete from the last modified record

    if($roomID == null){
      $data = $this->get_last_modified_room();
      $roomID = $data[0]["RoomID"];
    }

    $sql =
      "DELETE FROM
        Room_Resource
      WHERE
        Room_Resource.RoomID = $roomID";

    $this->executeCommand($sql);

    return $roomID;
  }


//------------------------------------------------------------------
/*

  RESOURCE

*/

    function get_resource($resource = null){
      $sql =
        "SELECT
          ResourceID AS ID,
          Name,
          Description
        FROM
          Resource ";

      $search = "";

      if(is_numeric($resource))
        $search = "WHERE Resource.ResourceID = $resource";
      else
        $search = "WHERE Resource.Name LIKE '%$resource%' ORDER BY Resource.Name";

      $sql .= $search;

      return $this->executeSQL($sql);
    }


    function set_resource($dataArr){
      $sql = "";

      if($dataArr["ResourceID"] == ""){ //Means the ID is empty, therefore is an INSERT

          $sql =
            "INSERT INTO Resource(
                ResourceID,
                Name,
                Description,
                ModifiedON)
            VALUES (
                DEFAULT,
                '".$dataArr["Name"]."',
                '".$dataArr["Description"]."',
                DEFAULT)";

      } else {

        $sql =
        "UPDATE Resource
        SET
            Name='".$dataArr["Name"]."',
            Description='".$dataArr["Description"]."',
            ModifiedON=DEFAULT
        WHERE
            Resource.ResourceID = ".$dataArr["ResourceID"];

      }

      $success = $this->executeCommand($sql);

      if($success)
        return $this->get_resource($dataArr["Name"]);
      else
        return null;
    }

    function del_resource($id){
      //If there are rooms associated with this Resource to prevent deletion
      $data = $this->executeSQL("SELECT 1 AS Exist FROM Room_Resource WHERE RoomID = $id LIMIT 1");
      if($data != null)
        return false;

      $sql =
      "DELETE FROM
          Resource
      WHERE
          Resource.ResourceID = $id";

      return $this->executeCommand($sql);
    }

//-------------------------------------------------------------------
/*

  BRANCH

*/

    function get_branch($branch = null){

      $sql =
  			"SELECT
            BranchID AS ID,
            Name,
            Description,
            Country,
            Estate_Province,
            City,
            Street_Name,
            Postal_Code
        FROM
            Branch ";

  		$search = "";

  		if(is_numeric($branch))
  			$search = "WHERE Branch.BranchID = $branch";
  		else
  			$search = "WHERE Branch.Name LIKE '%$branch%' ORDER BY Branch.Name";

  		$sql .= $search;

  		return $this->executeSQL($sql);
    }


    function set_branch($dataArr){
      $sql = "";

      if($dataArr["BranchID"] == ""){ //Means the ID is empty, therefore is an INSERT
          $sql =
          "INSERT INTO Branch(
              BranchID,
              Name,
              Description,
              Country,
              Estate_Province,
              City,
              Street_Name,
              Postal_Code,
              ModifiedON)
          VALUES (
              DEFAULT,
              '".$dataArr["Name"]."',
              '".$dataArr["Description"]."',
              '".$dataArr["Country"]."',
              '".$dataArr["Estate_Province"]."',
              '".$dataArr["City"]."',
              '".$dataArr["Street_Name"]."',
              '".$dataArr["Postal_Code"]."',
              DEFAULT)";

      } else {

        $sql =
        "UPDATE Branch
        SET
            Name='".$dataArr["Name"]."',
            Description='".$dataArr["Description"]."',
            Country='".$dataArr["Country"]."',
            Estate_Province='".$dataArr["Estate_Province"]."',
            City='".$dataArr["City"]."',
            Street_Name='".$dataArr["Street_Name"]."',
            Postal_Code='".$dataArr["Postal_Code"]."',
            ModifiedON=DEFAULT
        WHERE
            Branch.BranchID = ".$dataArr["BranchID"];

      }

      $success = $this->executeCommand($sql);

      if($success)
        return $this->get_branch($dataArr["Name"]);
      else
        return null;
    }


    function del_branch($id){
      //If there are rooms associated with this Branch prevent deletion
      $data = $this->executeSQL("SELECT 1 AS Exist FROM Room WHERE BranchID = $id LIMIT 1");
      if($data != null)
        return false;

      $sql =
      "DELETE FROM
          Branch
      WHERE
          Branch.BranchID = $id";

      return $this->executeCommand($sql);
    }

//--------------------------------------------------------------------
/*

  PARTICIPANT

*/
    function get_participant($participant = null){

		//This function will return either All participants or just the selected one by
		//name or ID

		$sql =
			"SELECT
			    Participant.ParticipantID AS ID,
			    Participant.Name AS Name,
          Participant.Phone_Number AS Phone,
			    Participant.Email AS Email,
			    Participant.Employee AS Employee
			FROM
			    Participant ";

		$search = "";

		if(is_numeric($participant))
			$search = "WHERE Participant.ParticipantID = $participant";
		else
			$search = "WHERE Participant.Name LIKE '%$participant%' ORDER BY Participant.Name";

		$sql .= $search;

		return $this->executeSQL($sql);
	}

  function set_participant($dataArr){
    $sql = "";

    if($dataArr["ParticipantID"] == ""){ //Means the ID is empty, therefore is an INSERT
        $sql =
        "INSERT INTO Participant(
            ParticipantID,
            Name,
            Phone_Number,
            Email,
            Employee,
            ModifiedON)
        VALUES(
            DEFAULT,
            '".$dataArr["Name"]."',
            '".$dataArr["Phone_Number"]."',
            '".$dataArr["Email"]."',
            ".$dataArr["Employee"].",
            DEFAULT)";

    } else {

      $sql =
      "UPDATE Participant
       SET
          Name='".$dataArr["Name"]."',
          Phone_Number='".$dataArr["Phone_Number"]."',
          Email='".$dataArr["Email"]."',
          Employee=".$dataArr["Employee"].",
          ModifiedON=DEFAULT
       WHERE
          Participant.ParticipantID = ".$dataArr["ParticipantID"];
    }

    $success = $this->executeCommand($sql);

    if($success)
      return $this->get_participant($dataArr["Name"]);
    else
      return null;
  }


//-----------------------------------------------------------------
/*

  PRIVATE Methods to deal with SQL Communication

*/
    private function executeCommand($query){
      global $connection;

      try{
        $connection->exec($query);

        return true;
      } catch(PDOException $er){

        return false;
      }
    }

    //This function executes given query and return the data from database in
    //associative array format
    private function executeSQL($query){
      global $connection;

        $rawData = $connection->prepare($query);
        $rawData->execute();
        if($rawData->rowCount() == 0)
          return null; //Nothing has been returned

        return $rawData->fetchAll(PDO::FETCH_ASSOC);
    }


  }


?>
