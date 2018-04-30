    <?php

      //Creating variable data for connection
      $databaseName = "meetingdb";
      $serverName = "localhost";
      $userName = "root";
      $userPassword = "";

      try {
        //Creating the connection instance
        //PDO(<mysql:host=Server;dbname=Database> , <user>, <password>)
        $connection = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $userPassword);

        //Setting error Mode
        // objectInstance -> setAttribute(<ERROR MODE CONSTANT> , <EXCEPTION CONSTANT>)
        $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //If everything went OK, at this point the database is already connected
        // print"<h2 class='success'>The connection was succesfully stablished. Status:</h2>";
        // print"<h3 class='success'>Connected in ".$connection->getAttribute(PDO::ATTR_CONNECTION_STATUS)."</h3>";
        // print"<h3 class='success'>Version: ".$connection->getAttribute(PDO::ATTR_SERVER_VERSION)."</h3>";
      }
      catch(PDOException $e){
        //If anything goes wrong this error message will be printed
        print"An error has occurred:";
        print $e->getMessage();
      }

    ?>
