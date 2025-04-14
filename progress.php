<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
    // Code that will run if this file called via AJAX request

    define('SYSPATH', 'objects');

    require_once SYSPATH.'/qbrc_cfg.php';
    require_once SYSPATH.'/qbrc_func.php';

    $jobid='';
    $error='';

    if (isset($_GET['jobid'])) {
        $jobid = escape($_GET["jobid"]);
    }

// ################################
// ### STATUS:
// ###      0:New *
// ###      1:Done *
// ###      2:Running *
// ###      3:Jobid empty
// ###      4:Job ID is not found
// ###      5:Database connection failed
// ###      9:Failed *
// ################################

    $status=3; // Empty Job ID by default

    if(!empty($jobid)){
        // open the database connection
        $db = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
        if ($db->connect_error) {
            die('Unable to connect to database: ' . $db->connect_error);
        }

        if ($result = $db->prepare("SELECT Status FROM Jobs WHERE JobID = ?;")) {
            $result->bind_param("s", $jobid);
            $result->execute();
            $result->store_result();
            $result->bind_result($status);
            $result->fetch();

            if ($result->num_rows <= 0) $status=4; // Job ID is not found

            $result->close();
        } else {
            $status=5; //error 3: Database connection failed
        }

        $db->close();
    }

    echo json_encode(array('status'=>$status, 'jobid'=>$jobid));
} else {
    die('Access Denied');
}

?>