<?php

class eBay {

    public static function process($feature, $command) {
        switch($feature) {
            case "avg"
                return eBay::getAvgPrice($command);
            default:
                echo "Feature not found!";
                break;
        }
    }
    /**
     * Returns the average price for a list of keywords
     * @param type $keywords
     * @return type
     */
    public static function getAvgPrice($keywords) {
        $endpoint = 'http://svcs.ebay.com/services/search/FindingService/v1';  // URL to call
        $appid = 'QuintinC-6db3-4c4f-a824-e6dfbc49a102';  // You will need to supply your own AppID
        $version = '1.0.0';  // API version supported by your application

        $globalid = 'EBAY-US';

        $safequery = urlencode($keywords);  // Make the query URL-friendly
        // Construct getMostWatchedItems call with maxResults and categoryId as input
        $apicalla = "$endpoint?";
        $apicalla .= "OPERATION-NAME=findItemsByKeywords";
        $apicalla .= "&SERVICE-VERSION=$version";
        $apicalla .= "&SECURITY-APPNAME=$appid";
        $apicalla .= "&GLOBAL-ID=$globalid";
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
            $retna .= "Call used was: $apicalla";
        }  // End if response exists
        // Return the function's value
        return $retna;
    }

}
?>