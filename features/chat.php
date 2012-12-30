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

    public static function cd($command, $body) {

    			$number = $_REQUEST['From'];
    			$room = "cd";
    			
	    		$con = mysql_connect("localhost","root","root");
				if (!$con)
				  {
				  die('Could not connect: ' . mysql_error());
				  }
				
				mysql_select_db("balls", $con);
				
				mysql_query("INSERT INTO chat (number, data, room) VALUES ('$number', '$command', '$room')");
				mysql_close($con);
			}
		}

?>