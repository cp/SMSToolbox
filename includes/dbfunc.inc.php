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