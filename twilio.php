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
function getCommand($message, &$app, &$feature, &$command) {
    $args = split(" ", $message);

    $app = $args[0];
    $feature = $args[1];
    $command = "";
    for ($i = 2; $i < sizeof($args); ++$i)
        $command .= $args[$i];
}

/***********************************************************************/
/* Main entry function                                                 */
/***********************************************************************/

/**
 * The main function that does everything
 */
function process() {

    $app = "";
    $feature = "";
    $command = "";
    getCommand($_REQUEST['Body'], $app, $feature, $command);

    header("content-type: text/xml");
    $msg = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

    $response = "";
    switch ($app) {
        case $app:
            $response = ebay::process($feature, $command);
            break;
        default:
            break;
    }

    $msg .= "<Response>
                <Sms>$response</Sms>
             </Response>";
}

process();

?>
