<?php
session_start();
$row = 1;
$_SESSION['firstArray']= array();
if (($handle = fopen("testtable.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);

        $row++;
        for ($c=0; $c < $num; $c++) {
            $_SESSION['firstArray'][$row][$c] = $data[$c];
            echo $data[$c] . "<br />\n";
        }
    }
    echo "TEST " . $_SESSION['firstArray'][0][0] . " TEST";
fclose($handle);
    echo "TESTING " . $_SESSION['firstArray'][0][0];
}
?>
