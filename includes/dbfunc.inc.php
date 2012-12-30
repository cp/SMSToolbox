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
                        message_body,
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
                    '".DB::escape($body['Body'])."',
                    '".DB::escape($body['Status'])."',
                    '".DB::escape($body['Direction'])."',
                    '".DB::escape($body['Price'])."',
                    '".DB::escape($body['ApiVersion'])."',
                    '".DB::escape($body['Uri'])."',
                    '".DB::escape($body['App'])."',
                    '".DB::escape($body['Feature'])."',
                    '".DB::escape($body['Command'])."'
                    )";
    echo $query;
    
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

?>