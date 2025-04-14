<?php
define('SYSPATH', 'objects');

require_once SYSPATH.'/qbrc_cfg.php';
require_once SYSPATH.'/qbrc_func.php';

$jobid='';
$error='';

if (isset($_GET['jobid'])) {
    $jobid = escape($_GET["jobid"]);

    $db = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
    if ($db->connect_error) {
        die('Unable to connect to database: ' . $db->connect_error);
    }

    if ($result2 = $db->prepare("select Mode from BepiParameters where JobID = ?")) {
        $result2->bind_param("s", $jobid);
        $result2->execute();
        $result2->store_result();
        $result2->bind_result($mode);
        $result2->fetch();
        $result2->close();
    } if (!isset($mode)) {
        die('404 Not Found: The resource requested could not be found.');
    }

    if ($mode === 'fasta') {
        $filename = "bepi_" . date('YmdHis') . "_" . substr($jobid, -6) . "prediction_result.zip";
    }
    else {
	$filename = "bepi_" . date('YmdHis') . "_" . substr($jobid, -6) . "prediction_result.txt";
    }

    header('Content-Disposition: attachment; filename=' . $filename);

    if ($result1 = $db->prepare("select Predictions from BepiResults where JobID = ?")) {
        $result1->bind_param("s", $jobid);
        $result1->execute();
        $result1->store_result();
        $result1->bind_result($res_file);
        $result1->fetch();
        echo($res_file);
        $result1->close();
    }
   
    $db->close(); 

} else {
    die('404 Not Found: The resource requested could not be found.');
}

?>
