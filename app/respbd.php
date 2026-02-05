<?php 
function backUpDatasbaseTables($dhHost, $dhUser, $dhPassword, $dbname, $tables='*') {
    $db = new mysqli($dhHost, $dhUser, $dhPassword, $dbname);

    if ($tables == '*') {
        $tables = array();
        $result = $db->query('SHOW TABLES');
        while ($row = $result->fetch_row()) {
            $tables[] = $row[0];
        }
    } else {
        $tables = is_array($tables) ? $tables : array($tables);
    }

    $return = '';

    foreach ($tables as $table) {
        $result = $db->query("SELECT * FROM $table");
        $numColumns = $result->field_count;
        //$return .= "DROP TABLE $table;";

        for ($i = 0; $i < $numColumns; $i++) {
            while ($row = $result->fetch_assoc()) {
                $return .= "INSERT INTO $table VALUES (";
                $numRow=0;
                foreach ($row as $column => $value) {
                    $value = addslashes($value);
                    $value = str_replace("\n", "\\n", $value);

                    if (isset($value)) {
                        $return .= '"' . $value . '"';
                    } else {
                        $return .= '""';
                    }

                    $numRow++;
                    if ($numRow < count($row)) {
                        $return .= ',';
                    }
                }

                $return .= ");\n";
            }
        }

        $return .= "\n\n";
    }

    // Save file
    $handle = fopen('../../resp-tienda/db-backup.sql', 'w+');
    fwrite($handle, $return);
    fclose($handle);
}

backUpDatasbaseTables('localhost', 'root', '', 'tienda');
header("location:../ajustes/ajusteAbonos.php");
?>
