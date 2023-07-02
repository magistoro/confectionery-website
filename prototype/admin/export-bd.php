<?php

//     $host = 'localhost';
//  $dbuser = 'root';
//  $dbpass = '';
//  $db_name='confectionery';



 include('..\..\config\main.php');

 backupDatabaseAllTables($host,  $user, $pass, $db_name);

 function backupDatabaseAllTables($host,$dbusername,$dbpassword,$dbname,$tables = '*'){
    $db = new mysqli($host, $dbusername, $dbpassword, $dbname); 

    if($tables == '*') { 
        $tables = array();
        $result = $db->query("SHOW TABLES");
        while($row = $result->fetch_row()) { 
            $tables[] = $row[0];
        }
    } else { 
        $tables = is_array($tables)?$tables:explode(',',$tables);
    }

    $return = '';

    foreach($tables as $table){
        $result = $db->query("SELECT * FROM `$table`");
        $numColumns = $result->field_count;

        /* $return .= "DROP TABLE $table;"; */
        $result2 = $db->query("SHOW CREATE TABLE `$table`");
        $row2 = $result2->fetch_row();

        $return .= "\n\n".$row2[1].";\n\n";

        for($i = 0; $i < $numColumns; $i++) { 
            while($row = $result->fetch_row()) { 
                $return .= "INSERT INTO $table VALUES(";
                for($j=0; $j < $numColumns; $j++) { 
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = $row[$j];
                    if (isset($row[$j])) { 
                        $return .= '"'.$row[$j].'"' ;
                    } else { 
                        $return .= '""';
                    }
                    if ($j < ($numColumns-1)) {
                        $return.= ',';
                    }
                }
                $return .= ");\n";
            }
        }

        $return .= "\n\n\n";
    }

    $handle = fopen('your_db_'.time().'.sql','w+');
    fwrite($handle,$return);
    fclose($handle);
    echo "Database Export Successfully!";
}

backupDatabaseAllTables('localhost','root','','confectionery');