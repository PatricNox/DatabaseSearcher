<?php 

$QueryFound = false;
if (isset($_POST['dbs-database'], $_POST['dbs-search']))
{
    $search = $_POST['dbs-search'];
    $QueryFound = dbs_search($search,$_POST['dbs-database']);
}

// Database harvest 
function dbs_search($search, $database){
    include __DIR__."/configs/config.php";
    $mysqli = new mysqli($hostname, $username, $password, $database);
    $results = array();
    $sql = "show tables";
    $rs = $mysqli->query($sql);
    
    if ($rs->num_rows > 0){
        while ($r = $rs->fetch_array()){
            $table = $r[0];
            $columnHeaders = array(); // Storage for headers
            $columnmatches = array(); // Storage for Matches
            $sql_search = "SELECT * FROM ".$table." WHERE ";
            $sql_search_fields = array();
            $sql2 = "SHOW COLUMNS FROM ".$table;
            $rs2 = $mysqli->query($sql2);
            if ($rs2->num_rows > 0) {
                while ($r2 = $rs2->fetch_array()){
                    $column = $r2[0];
                    $sql_search_fields[] = $column." LIKE('%".$search."%')";
                }
                
                $rs2->close();
            }
            
            $sql_search .= implode(" OR ", $sql_search_fields);
            $rs3 = $mysqli->query($sql_search);
        
            if ($rs3->num_rows > 0) {
                foreach ($rs3 as $row) {
                    $columnheaders = array_keys($row);
                    $counter = 0; // Used to count at which field we are

                    foreach ($row as $columnfield) {
                        if (strpos(strtoupper($columnfield), strtoupper($search)) !== false) 
                            $columnmatches[] = $columnheaders[$counter];
                        $counter++;
                    }
                }
                
                // Cleanse array from duplicates
                $columnmatches = array_unique($columnmatches);
                $columnoutput = "";
                
                // Use column for the outputting SELECT-section on page
                foreach ($columnmatches as $columnheader) {
                     $columnoutput .= $columnheader . ' LIKE "%'.$search.'%" OR ';
                }
                            
                $columnoutput = substr($columnoutput, 0, -3); // Remove the last trailing "OR" in the output
                $results[] = array('table' => $table, 'hits' => $rs3->num_rows, 'from' => $columnoutput);
                $rs3->close();
            }
        }

        $rs->close();
    }

    return $results;
}
