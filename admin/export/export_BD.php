<?php

 backupDatabaseAllTables();

 function backupDatabaseAllTables(){
    include('..\..\config\main.php');
    $tables = '*';

    if($tables == '*') { 
        $tables = array();
        $result = $mysql->query("SHOW TABLES");
        while($row = $result->fetch_row()) { 
            $tables[] = $row[0];
        }
    } else { 
        $tables = is_array($tables)?$tables:explode(',',$tables);
    }

    $return = '';

    foreach($tables as $table){
        $result = $mysql->query("SELECT * FROM `$table`");
        $numColumns = $result->field_count;

        /* $return .= "DROP TABLE $table;"; */
        $result2 = $mysql->query("SHOW CREATE TABLE `$table`");
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

    $handle = fopen('your_mysql_'.time().'.sql','w+');
    fwrite($handle,$return);
    fclose($handle);
    echo "База данных успешно экспортирована!<a href='../'>Выйти</a>";
}

// backupDatabaseAllTables('localhost','root','','confectionery');