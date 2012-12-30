<?php
include_once("utils.php");

class ebay {
    static $endpoint = 'http://svcs.ebay.com/services/search/FindingService/v1';  // URL to call
    static $appid = 'QuintinC-6db3-4c4f-a824-e6dfbc49a102';  // You will need to supply your own AppID
    static $version = '1.0.0';  // API version supported by your application
    static $globalid = 'EBAY-US';
        
    public static function process($body) {
        switch($body['feature']) {
            case "avg":
                return ebay::getAvgPrice($body['command']);
            case "search":
                return ebay::getSearchResults($body['command']);
            case "":
            case "help":
                return "ebay avg item, ebay search item";
            default:
                return "Feature not found! Type 'ebay help' for assistance.";
                break;
        }
    }
    /**
     * Returns the average price for a list of keywords
     * @param type $keywords
     * @return type
     */
    public static function getAvgPrice($keywords) {
       
        $safequery = urlencode($keywords);  // Make the query URL-friendly
        // Construct getMostWatchedItems call with maxResults and categoryId as input
        $apicalla = ebay::$endpoint."?";
        $apicalla .= "OPERATION-NAME=findItemsByKeywords";
        $apicalla .= "&SERVICE-VERSION=".ebay::$version;
        $apicalla .= "&SECURITY-APPNAME=".ebay::$appid;
        $apicalla .= "&GLOBAL-ID=".ebay::$globalid;
        $apicalla .= "&keywords=$safequery";
        $apicalla .= "&paginationInput.entriesPerPage=20";

        // Load the call and capture the document returned by eBay API
        $resp = simplexml_load_file($apicalla);

        // Check to see if the response was loaded, else print an error
        if ($resp) {
            // Set return value for the function to null
            $retna = '';

            // Verify whether call was successful
            if ($resp->ack == "Success") {

                // If there were no errors, build the return response for the function

                $results = "";
                $avg = 0;
                $itemCount = 0;
                foreach ($resp->searchResult->item as $item) {
                    // print_r($item);
                    // $link = $item->viewItemURL;
                    // $title = $item->title;
                    $price = $item->sellingStatus->currentPrice;

                    // echo $title . "<br />" . $price . "<br />";
                    $avg += $price;
                    $itemCount++;
                }
                return $avg / $itemCount;
            }
        } else {
            $retna = "Call used was: $apicalla";
        }  // End if response exists
        // Return the function's value
        return $retna;
    }
    
    public static function getSearchResults($keywords) {
        $safequery = urlencode($keywords);  // Make the query URL-friendly
        // Construct getMostWatchedItems call with maxResults and categoryId as input
        $apicalla = ebay::$endpoint."?";
        $apicalla .= "OPERATION-NAME=findItemsByKeywords";
        $apicalla .= "&SERVICE-VERSION=".ebay::$version;
        $apicalla .= "&SECURITY-APPNAME=".ebay::$appid;
        $apicalla .= "&GLOBAL-ID=".ebay::$globalid;
        $apicalla .= "&keywords=$safequery";
        $apicalla .= "&paginationInput.entriesPerPage=1";

         // Load the call and capture the document returned by eBay API
        $resp = simplexml_load_file($apicalla);

        // Check to see if the response was loaded, else print an error
        if ($resp) {
            // Set return value for the function to null
            $retna = '';

            // Verify whether call was successful
            if ($resp->ack == "Success") {

                // If there were no errors, build the return response for the function

                $results = "";
                $avg = 0;
                $itemCount = 0;
                foreach ($resp->searchResult->item as $item) {
                    // print_r($item);
                    // $link = $item->viewItemURL;
                    $title = $item->title;
                    $results .= "$title - ".shortenurl($item->viewItemURL);
                }
                return $results;
            }
        } else {
            $retna = "Call used was: $apicalla";
        }  // End if response exists
        // Return the function's value
        return $retna;
    }

}
?>