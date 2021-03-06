<?php

require_once('includes/dbfunc.inc.php');

class hangman {

    static $words = array("abbey","abruptly","affix","askew","axiom","azure","bagpipes","bandwagon","banjo","bayou","bikini","blitz","bookworm","boxcar","boxful","buckaroo","buffalo","buffoon","cobweb","croquet","daiquiri","disavow","duplex","dwarves","equip","exodus","fishhook","fixable","foxglove","galaxy","galvanize","gazebo","gizmo","glowworm","guffaw","haiku","haphazard","hyphen","icebox","injury","ivory","ivy","jaundice","jawbreaker","jaywalk","jazzy","jigsaw","jiujitsu","jockey","jovial","joyful","juicy","jumbo","kazoo","keyhole","khaki","kilobyte","kiosk","kiwifruit","knapsack","larynx","luxury","marquis","megahertz","microwave","mystify","nightclub","nowadays","numbskull","ovary","oxidize","oxygen","pajama","peekaboo","pixel","pizazz","pneumonia","polka","quartz","quiz","quorum","razzmatazz","rhubarb","rickshaw","schizophrenia","sphinx","spritz","squawk","subway","swivel","topaz","unknown","unworthy","unzip","uptown","vaporize","vixen","vodka","vortex","walkway","waltz","wavy","waxy","wheezy","whiskey","whomever","wimpy","wizard","woozy","xylophone","yachtsman","yippee","youthful","zephyr","zigzag","zilch","zodiac","zombie");

    public static function process($body) {
        switch ($body['Body']['feature']) {
            case "start":
                return hangman::start($body['From']);
            case "reset":
                return hangman::reset($body['From']);
            case "":
            case "help":
                return "hangman start, hangman reset, hangman (letter)";
            default:
                return hangman::cont($body['From'], $body['Body']['feature']);
                break;
        }
    }

    private static function start($msgFrom) {
        $numRows = mysql_num_rows(getCurrentGame($msgFrom));
        if( $numRows > 1 )
            quitGame($msgFrom);
        else if($numRows == 1)
            return "Game already started";
        
        $wordIdx = rand() % sizeof(hangman::$words);
        $currentGameWord = hangman::$words[$wordIdx];
        $current_word = preg_replace("/[a-zA-Z]/", "_", $currentGameWord);

        startGame($msgFrom, $currentGameWord, $current_word);
        return $current_word . "\nGuesses Left: 5 / 5";
    }

    /**
     * Loops through the original word, finds the character position and then
     * reveals that letter in the current puzzle
     */
    private static function revealCharacters($current_word, $original, $character) {

        $offset = 0;
        
        $flagInit = true;
        while(true) {
            $offset = strpos($original, $character, $offset);
            if($offset == false && $flagInit != true)
                break;
            
            $flagInit = false;
            $current_word[$offset] = $character;
            $offset++;
        }
        return $current_word;
    }

    private static function reset($msgFrom) {
        quitGame($msgFrom);
        return hangman::start($msgFrom);
    }

    private static function cont($msgFrom, $guess) {
        if(mysql_num_rows(getCurrentGame($msgFrom)) == 0)
            hangman::start ($msgFrom);
        
        $game = mysql_fetch_array(getCurrentGame($msgFrom));
        $guesses = $game['guesses'];
        $current_word = $game['current_word'];
        
        $returnVal = "";
        
        if (strstr($game['word'], $guess) != false) {
            $current_word = hangman::revealCharacters($current_word, $game['word'], $guess);
            updateGame($msgFrom, $current_word, $guesses);
        } else {
            $guesses++;
            if($guesses > 5)
            {
                quitGame ($msgFrom);
                return "Sorry you lost!";
            }
            $returnVal = "\nGuesses Left: ".(5-$guesses)." / 5";
            updateGame($msgFrom, $current_word, $guesses);
        }

        if (strstr($current_word, "_") == false)
        {
            quitGame($msgFrom);
            return "You win!";
        }
        else
            return $current_word.$returnVal;
    }

}

?>
