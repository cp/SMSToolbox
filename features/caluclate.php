<?php

class Caluclate {
    
    public static function process($feature, $command) {
        switch(strtolower($feature)) {
            case "calculate":
                return Calculate::DoMath($command);
            default:
                echo "Feature not found!";
                break;
        }
    }
    public static function DoMath($string) {
        //Remove spaces between actual characters.
        $neoString=str_replace(" ","",$string);
        $charLoc=array();
        $values=array();
        $offset=0;
        $current=0;
        for($i=0;$i<strlen($string);$i++) {
            if(strpos($neoString,"/",$offset)) {return;}
            else{array_push($charLoc,strpos($neoString,"/",$offset));}
            if(strpos($neoString,"*",$offset)) {return;}
            else{array_push($charLoc,strpos($neoString,"*",$offset));}
            if(strpos($neoString,"+",$offset)) {return;}
            else{array_push($charLoc,strpos($neoString,"+",$offset));}
            if(strpos($neoString,"-",$offset)) {return;}
            else{array_push($charLoc,strpos($neoString,"-",$offset));}
            if(strpos($neoString,"(",$offset)) {return;}
            else{array_push($charLoc,strpos($neoString,"(",$offset));}
            if(strpos($neoString,"/",$offset)) {return;}
            else{array_push($charLoc,strpos($neoString,")",$offset));}
            $offset++;
        }
        array_push($values,floatval(substr($neoString,0,current($charLoc))));
        while(key($charLoc)<count($charLoc)) {
            array_push($values,floatval(substr($neoString,(current($charLoc)+1),next($charLoc))));
        }
        array_push($values,floatval(substr($neoString,(end($charLoc)+1),end($neoString))));
        
    }
}

?>