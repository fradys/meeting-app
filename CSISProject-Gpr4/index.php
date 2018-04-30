<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <title>Meeting App - Create, View, Edit All your meetings here!</title>
    <link href="https://fonts.googleapis.com/css?family=Peralta" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
    <style type="text/css" media="screen">
      h1 {
        font-family: 'Peralta', cursive;
        font-size: 2.5em;
        color: #8C1605;
        text-shadow: 3px 3px #E69722;
        margin-top: 0;
      }

      #main-title {
        width: 100%;
        height: 197px;
        float: left;
        text-align: center;
        background-image: url("images/meeting-photo2.jpg");
        background-repeat: no-repeat;
        background-position: top;
        background-blend-mode: soft-light;
      }

      #main-title img {
        width: 80px;
        height: 80px;
        margin-top: -25px;
      }

      #main-title hr {
        border: 0;
        height: 2px;
        width: 95%;
        background-image: linear-gradient(to right, rgba(0, 0, 0, 0),
         rgba(174, 60, 71, 0.85), rgba(0, 0, 0, 0));
      }

      #main-container {
        width: 100%;
        height: 1000px;
        float: left;
        background-color: rgba(242,240,240,0.6);
      }

      #menu-box {
        width: 850px;
        height: 600px;
        margin: 10px 30px;
        float: left;
        background-color: #575c60;
      }

      .inner-container {
        border: 2px solid #033584;
        border-radius: 12px;
      }

      #data-container {
        width: 775px;
        height: 535px;
        border: 2px solid #04510e;
        /*border-radius: 12px;*/
        position: relative;
        top: -417px;
        left: 65px;
        background-color: rgb(242,240,240);
        padding: 0;
        margin: 0;
      }

      iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        padding: 0;
        margin: auto;
        background: rgb(160, 190, 224);
      }

      .icon-container-vertical {
        position: relative;
        top: 100px;
        height: 400px;
        width: 70px;
      }

      .icon-button {
        width: 50px;
        height: 50px;
        position:relative;
        top: 20px;
        left: 5px;
        border: 3px solid #105e1b;
        border-radius: 50%;
        margin-top: 25px;
        display: flow-root;
        background-position: center;
        background-size: contain;
      }

      .icon-button:hover {
        border: 3px solid white;
      }

      .icon-button:active {
        transform: scale(0.8);
      }

      .menu-container {
        width: 750px;
        height: 40px;
        position: relative;
        top: -420px;
        left: 70px;
      }

      .menu-button {
        background-color: inherit;
        color: #021c01;
        font-size: 24px;
        border: none;
        font-family: 'Fredoka One', cursive, sans-serif;
        cursor: pointer;
      }

      .menu-container-items {
        position: relative;
        display: inline-block;
      }

      .dropdown-content {
        display: none;
        font-size: 18px;
        font-family: 'Fredoka One', cursive, sans-serif;
        position: absolute;
        background-color: #002535;
        min-width: 100%;
        overflow: auto;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 999;
        cursor: pointer;
      }

      .dropdown-content button {
        width: 100%;
        height: 100%;
        font-size: 18px;
        color: white;
        font-family: 'Fredoka One', cursive, sans-serif;
        border: 0;
        background-color: #002535;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        padding: 12px 16px;
        display: block;
      }

      .dropdown-content p {
        color: white;
        padding: 12px 16px;
        display: block;
      }

      .dropdown-content p:hover {
        background-color: gray;
      }

      .dropdown-content button:hover {
        background-color: gray;
      }

      .menu-container-items:hover .dropdown-content {
        display: block;
      }

      .menu-button:hover {
        background-color: #002535;
        color: white;
      }

      .dropdown-content p:active {
        transform: scale(0.95);
      }

      .dropdown-content button:active {
        transform: scale(0.95);
      }

      #meeting-display {
          width: 300px;
          height: 600px;
          float: right;
          margin-top: 10px;
          margin-right: 10px;
          background: rgba(211, 211, 0, 0.9);
		  padding:10px;
      }

	  #meeting-display .content{
		  overflow-y: auto;
          width: 300px;
          height: 580px;
	  }

      .clear {
        clear: both;
      }
	  h4,h5,#meeting-display{
		  font-family:verdana,arial;
		  line-height:1.1em;
	  }
	  h4,h5{
		  margin:2px 0;
	  }
	  h5{
		  font-size:12px;
		  margin:5px 0;
	  }
	  #meeting-display p{
		  margin:15px 0 3px 0;
		  font-weight:bold;
		  font-size:14px;
	  }
	  #meeting-display ul{
		  margin:0 10px 5px 10px;
		  padding-left:2px;
		  padding-bottom:5px;
		  border-bottom:1px solid #999;
	  }
	  #meeting-display ul li{
		  list-style-type:none;
	  }

    </style>
	<?php include "meetingdata.php"; ?>
  </head>
  <body>
    <div id="main-title" class="main-title">
        <h1>Canada <br />Plastics</h1>
        <img src="images/can-logo.jpg" alt="Canada Plastics Logo">
        <hr>
    </div>
    <div class="clear"></div>
    <div id="main-container" class="container">
      <div id="menu-box" class="inner-container">
        <!-- Here comes the menu and iframes component -->
        <div class="icon-container-vertical">
          <input type="button" class="icon-button" id="btnSearch" title="Search" style="background-image: url('images/icons/search-btn.png')">
          <input type="button"class="icon-button" id="btnAdd" title="Add a new record" style="background-image: url('images/icons/add-btn.png')">
          <!-- <input type="button" class="icon-button" id="btnEdit" title="Edit current record" style="background-image: url('images/icons/edit-btn.png')"> -->
          <!-- <input type="button" class="icon-button" id="btnDelete" title="Delete selected record" style="background-image: url('images/icons/delete-btn.png')"> -->
        </div>
        <div class="menu-container">
          <button class="menu-button" id="btnMeeting" name="meeting" title="Add/Show Meetings">Meetings</button>
          <button class="menu-button" id="btnMember" name="participant" title="Add/Show Memebrs">Members</button>
          <div class="menu-container-items">
            <button class="menu-button button-dropdown" disabled>Additional &#9662;</button>
            <div class="dropdown-content">
              <button id="btnBranch" name="branch" title="Add/Show Branches">Branch</button>
              <button id="btnRoom" name="room" title="Add/Show Meeting Rooms">Rooms</button>
              <button id="btnResource" name="resource" title="Add/Show Meeting Room Equipments">Resource</button>
            </div>
          </div>
        </div>
        <div id="data-container" class="data-container">
          <iframe src="meeting.php" id="iFramePage" name="iFrameTarget" width="770" height="529" frameborder="0" scrolling="no"></iframe>
        </div>

      </div>
      <div id="meeting-display" class="inner-container">
		<h4>Next Meetings</h4>
	    <div class="content">
			<!-- Here comes the information about the meetings -->
			<?php
				//Populate the list with the meetings
				$meetingData = new MeetingData();
				$dataArr = $meetingData->next_meetings();
				$branch = "";
				$date = "";

				// If user has meetings
				if ($dataArr){
					foreach ($dataArr as $data ) {
						// Print if date has changed
						if ($date!=$data['Meeting_Date']){
							echo "<p>".date("d/m/Y",strtotime($data['Meeting_Date']))."</p>";
							$date = $data['Meeting_Date'];
						}
						// Print if branch has changed
						if ($branch!=$data['Branch']){
							echo "<h5>".$data['Branch']."</h5>";
							$branch = $data['Branch'];
						}
			?>
						<ul>
							<li><?php echo $data['Room_Name']; ?></li>
							<li><?php echo date("h:i A", strtotime($data['Meeting_Start'])); ?> / <?php echo date("h:i A", strtotime($data['Meeting_End'])); ?></li>
							<li><?php echo $data['Meeting_Subject']; ?></li>
							<li><?php echo $data['Total_Participants']; echo $data['Total_Participants']>1 ? " participants" : " participant"; ?></li>
							<li><a href="meeting.php?idValue=<?php echo $data['Meeting_Code']; ?>" target="iFrameTarget">Show</a></li>
						</ul>
			<?php
					}
				} else {
					echo "<p>You don't have meetings.</p>";
				}
			?>
        </div>
	  </div>
    </div>
    <script type="text/javascript">

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

    function createFrame(originID, targetID){
      var url = document.getElementById(originID).name + ".php";
      clearComponent(targetID); //Clear the childs whitin div element

      var target = document.getElementById(targetID);
      var frame = document.createElement("iframe");
      frame.setAttribute("src",url);
      frame.setAttribute("id","iFramePage");
      frame.setAttribute("name","iFrameTarget");
      frame.setAttribute("width","770");
      frame.setAttribute("height","529");
      frame.setAttribute("frameborder","0");
      frame.setAttribute("scrolling","no");
      target.appendChild(frame);

    }

      document.getElementById('btnMeeting').onclick = function(){
        createFrame(this.id, "data-container");
      }

      document.getElementById('btnMember').onclick = function(){
        createFrame(this.id, "data-container");
      }

      document.getElementById('btnBranch').onclick = function(){
        createFrame(this.id, "data-container");
      }

      document.getElementById('btnRoom').onclick = function(){
        createFrame(this.id, "data-container");
      }

      document.getElementById('btnResource').onclick = function(){
        createFrame(this.id, "data-container");
      }

      document.getElementById("btnSearch").onclick = function(){
        var iFrame = document.getElementById("iFramePage");
        var innerPage = iFrame.contentDocument;
        innerPage.getElementById("txtSearch").focus();
      }

      document.getElementById("btnAdd").onclick = function(){
        var iFrame = document.getElementById("iFramePage");
        var innerPage = iFrame.contentDocument;
        innerPage.location.reload(true);
      }
    </script>
  </body>
</html>
