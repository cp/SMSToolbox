<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache'); // recommended to prevent caching of event data.

require_once('includes/dbfunc.inc.php');

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
        
        insertChatLine($number, $command, $room);

        // post to stream
    }
}
?>