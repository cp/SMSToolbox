<?php

class chance {

    public static function process($body) {
        switch($body['feature']) {
            case "flip":
                return chance::coinFlip();
            case "roll":
                return chance::rollDice($body['command']);
            case "":
            case "help":
                return "chance flip, chance roll [max], chance roll [min] [max]";
            default:
                echo "Feature not found! Type 'chance help' for assistance.";
                break;
        }
    }

    /**
     * Returns heads or tails for coin flip
     * @return type
     */
    public static function coinFlip() {
		$coinFlipVal = rand(0, 1);
		switch($coinFlipVal) {
			case 0:
				return "heads";
				break;
			case 1:
				return "tails";
				break;
			default:
				// TODO: LOG ERROR
				echo "Error";
				break;
		}
    }
	
	/**
     * Returns a random value 'roll' between 0 or 100.
	 * If diceRanges contains one value, that is new max value. 
	 * If diceRanges contains two values, that is min/max value.
     * @return type
     */
	public static function rollDice($diceRanges) {
		$minVal = 0;
		$maxVal = 100;
                
		
		$ranges = explode(" ", $diceRanges);
		if (sizeof($ranges) == 1) {
			$maxVal = $ranges[0];
		} elseif (sizeof($ranges) > 1) {
			$minVal = $ranges[0];
			$maxVal = $ranges[1];
		}
		
		//if (is_int($minVal) && is_int($maxVal)) {
			return rand($minVal, $maxVal);
		//} else {
			// TODO: LOG ERROR
		//	return "Error";
		//}
	}
}
?>