<?php

require_once('includes/db.inc.php');

############################################
################# GENERAL ##################
############################################

function insertSomeTable($someArgs) {

    $insertQuery = " INSERT INTO 
                            <table>
                            (<column>, <column2>) values('', '')";

    DB::query($insertQuery);
}

function insertMessage($body){
    $query = "INSERT INTO 
                        message
                    (
                        sid, 
                        date_created,
                        date_updated,
                        date_sent,
                        account_sid,
                        message_from,
                        message_to,
                        status,
                        direction,
                        price,
                        api_version,
                        uri,
                        app,
                        feature,
                        command
                    ) VALUES
                    (
                    '".DB::escape($body['Sid'])."',
                    '".DB::escape($body['DateCreated'])."',
                    '".DB::escape($body['DateUpdated'])."',
                    '".DB::escape($body['DateSent'])."',
                    '".DB::escape($body['AccountSid'])."',
                    '".DB::escape($body['From'])."',
                    '".DB::escape($body['To'])."',
                    '".DB::escape($body['Status'])."',
                    '".DB::escape($body['Direction'])."',
                    '".DB::escape($body['Price'])."',
                    '".DB::escape($body['ApiVersion'])."',
                    '".DB::escape($body['Uri'])."',
                    '".DB::escape($body['Body']['app'])."',
                    '".DB::escape($body['Body']['feature'])."',
                    '".DB::escape($body['Body']['command'])."'
                    
                    )";
    
    DB::connect();
    DB::query($query);
    DB::close();
    
}
/**
 * probably shouldn't use this.....
 * @param type $obj
 * @param type $table
 * @param type $whereClause
 */
function update($obj, $table, $whereClause) {
    DB::connect();
    $query = "update " . $table . " set ";

    foreach (get_object_vars($obj) as $key => $val) {
        if ($key != $table . "_id") {
            $query .= $key . " = '" . DB::escape($val) . "', ";
        }
    }

    // remove last comma
    $query = substr($query, 0, strlen($query) - 2);
    $query .= " where " . $whereClause;
    DB::query($query);
    DB::close();
}


/****************************************************************/
/* Hangman code                                                 */
/****************************************************************/
function startGame($msgFrom, $word, $current_word ) {
    $query = "insert into hangman(message_from, guesses, word, current_word)
            values('$msgFrom', 0, '$word', '$current_word')";
    
    DB::connect();
    DB::query($query);
    DB::close();
}

function quitGame($msgFrom) {
    $query = "delete from hangman where message_from = '$msgFrom'";
    DB::connect();
    DB::query($query);
    DB::close();
}

function getCurrentGame($msgFrom) {
    $query = "select * from hangman where message_from = '$msgFrom'";
    DB::connect();
    $result = DB::query($query);
    DB::close();
    
    return $result;
}

function updateGame($msgFrom, $current_word, $guesses)
{
    $query = "update hangman 
            set 
                message_from = '$msgFrom',
                current_word = '$current_word',
                guesses = '$guesses'";
    DB::connect();
    DB::query($query);
    DB::close();
}
?>