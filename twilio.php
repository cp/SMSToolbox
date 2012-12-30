<?php
/***********************************************************************/
/* Helper functions                                                    */
/***********************************************************************/

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
    $args = split(" ", $message);

    $command = "";
    for ($i = 2; $i < sizeof($args); ++$i)
        $command .= $args[$i];

    $return_args = Array(
        "app" =>  $args[0],
        "feature" => $args[1],
        "command" => $command,
    );

    return $return_args;
}

/***********************************************************************/
/* Main entry function                                                 */
/***********************************************************************/

/**
 * The main function that does everything
 */

function process() {

    $body = $getCommand($_REQUEST['Body']);

    header("content-type: text/xml");
    $msg = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

    $response = "";
    switch (strtolower($body["app"])) {
        case "ebay":
            $response = ebay::process($body);
            break;
        case "amazon":
            break;
        default:
            break;
    }

    $msg .= "<Response>
                <Sms>$response</Sms>
             </Response>";

    return $msg;
}

echo process();

?>
