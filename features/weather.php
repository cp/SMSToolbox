<?php

class eBay {

    public static function process($feature, $command) {
        switch($feature) {
            case "avg":
                return eBay::getAvgPrice($command);
            default:
                echo "Feature not found!";
                break;
        }
    }
    public static function getAverage($keywords) {
	    //GET THE DATA
    }
    
?>