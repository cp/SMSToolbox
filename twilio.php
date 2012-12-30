<?php

include_once('includes/dbfunc.inc.php');
/* * ******************************************************************** */
/* Helper functions                                                    */
/* * ******************************************************************** */

/**
 * Automatically loads all classes within the features folder
 * @param type $class_name
 */
function __autoload($class_name) {
    include 'features/' . $class_name . '.php';
}

/**
 * Returns the app, feature and command past in from a sms message
 * @param type $message
 * @param type $app
 * @param type $feature
 * @param type $command
 */
function getCommand($message) {
    $args = explode(" ", $message);

    $num_args = sizeof($args);
    if ($num_args > 2) {

        $command = "";
        for ($i = 2; $i < $num_args; ++$i) {
            $command .= " " . $args[$i];
        }
        $command = trim($command);
        $feature = $args[1];
    } else if ($num_args == 2) {
        $feature = $args[1];
        $command = '';
    }
    $return_args = Array(
        "app" => $args[0],
        "command" => $command,
        "feature" => $feature,
    );

    return $return_args;
}

/* * ******************************************************************** */
/* Main entry function                                                 */
/* * ******************************************************************** */

/**
 * The main function that does everything
 */
function process() {

    $sms = $_REQUEST;
    if($_REQUEST['Body'] == "" || $_REQUEST['Body'] == "help")
    {
        $sms['Body'] = Array("app" => "help");
    }else
    {
        $body = getCommand($_REQUEST['Body']);
        $sms['Body'] = $body;
        // insert the message into the database
        insertMessage($sms);        
    }
    
    
    header("content-type: text/xml");

    $msg = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

    $response = "";
    switch (strtolower($sms["Body"]["app"])) {
        case "ebay":
            $response = ebay::process($sms['Body']);
            break;
        case "weather":
            $response = weather::process($sms['Body']);
            break;
        case "chance":
            $response = chance::process($sms['Body']);
            break;
        case "ascii":
            $response = ascii::process($sms['Body']);
            break;
        case "hangman":
            $response = hangman::process($sms);
            break;
        case "chat":
            $response = chat::process($sms['Body']);
            break;
        case "help":
            $response = "ebay, weather, chance, ascii, hangman, chat";
            break;
        default:
            $response == "Invalid feature request";
            break;
    }

    $msg .= "<Response>
                <Sms>$response</Sms>
             </Response>";

    return $msg;
}

echo process();
?>