<?php

class chat {


	public static function process($body) {
        switch($body['feature']) {
            case "cd":
                return chat::cd($body['command']);
				break;
            default:
                return "Room not found!";
                break;
        }
    }

    public static function cd($command) {

    			$number = $_REQUEST['From'];
    			$room = "cd";
    			
	    		$con = mysql_connect("localhost","colbyale_colby","Alaskan1");
				if (!$con)
				  {
				  die('Could not connect: ' . mysql_error());
				  }
				
				mysql_select_db("colbyale_balls", $con);
				
				mysql_query("INSERT INTO chat (number, data, room) VALUES ('$number', '$command', '$room')");
				mysql_close($con);
				
				  return "Success, yes!";
			}
		}

?>