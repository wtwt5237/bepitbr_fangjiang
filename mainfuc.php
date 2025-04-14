<?php
define('VIEWPATH', 'template');
define('SYSPATH', 'objects');

require_once SYSPATH . '/qbrc_cfg.php';
require_once SYSPATH . '/qbrc_func.php';

$jobid = "";
$status = 0;
$success = 1; // 1 for succeed 2 for fail
$error = array();

// ##################################################
// ###### Handle the POST request: Submit jobs ######
// ##################################################
if ((isset($_FILES["motif0_file"]) and isset($_FILES["full0_file"])) or isset($_FILES["full0"]) or isset($_FILES["fasta0"])) {
    $phpFileUploadErrors = array(
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    );

    $acceptedFile = array(
//        'text/csv'      => 'csv',
//        'image/gif'      => 'gif',
//        'image/png'      => 'png',
        'text/plain' => 'txt',
//        'application/zip' => 'zip',
    );

    $maxSize = 5 * 1024 * 1024; // 5 MB

    $res = array();

// ####### Receive the form input #######

    $inst = isset($_POST["inst"]) ? escape($_POST["inst"]) : "";
    $email = isset($_POST["email"]) ? escape($_POST["email"]) : "";
    $mode = isset($_POST["mode"]) ? escape($_POST["mode"]) : "";
    $motif0_file = isset($_FILES["motif0_file"]) ? $_FILES["motif0_file"] : "";
    $full0_file = isset($_FILES["full0_file"]) ? $_FILES["full0_file"] : "";
    $full0 = isset($_FILES["full0"]) ? $_FILES["full0"] : "";
    $fasta0 = isset($_FILES["fasta0"]) ? $_FILES["fasta0"] : "";
    $length = 0;
    $thread = 0;

//    print($email.$mode);

// ####### Validate the form input #######
    if (!empty($inst) && !preg_match("/^[a-zA-Z0-9 ]*$/", $inst)) {
        array_push($error, "Institution Name: unrecognized character!");
    }

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($error, "The email address is invalid!");
    }

    if ($mode === 'epitope') {
        $thread = isset($_POST["epitope-thread"]) ? escape($_POST["epitope-thread"]) : 4;

        if ($motif0_file["error"] != 0) {
            array_push($error, "motif0_file input file: No file is uploaded!");
        } else {
            if (!array_key_exists($motif0_file['type'], $acceptedFile)) {
                array_push($error, "motif0_file input file: Invalid input file type!");
            }

            if ($motif0_file['size'] > $maxSize) {
                array_push($error, "motif0_file input file: Maximum file size exceeded!");
            }
        }

        if ($full0_file["error"] != 0) {
            array_push($error, "full0_file input file: No file is uploaded!");
        } else {
            if (!array_key_exists($full0_file['type'], $acceptedFile)) {
                array_push($error, "full0_file input file: Invalid input file type!");
            }

            if ($full0_file['size'] > $maxSize) {
                array_push($error, "full0_file input file: Maximum file size exceeded!");
            }
        }
    } elseif ($mode === 'fullprotein') {
        $thread = isset($_POST["full-thread"]) ? escape($_POST["full-thread"]) : 8;
        $length = isset($_POST["full-length"]) ? escape($_POST["full-length"]) : 15;

        if ($full0["error"] != 0) {
            array_push($error, "full0 input file: No file is uploaded!");
        } else {
            if (!array_key_exists($full0['type'], $acceptedFile)) {
                array_push($error, "full0 input file: Invalid input file type!");
            }

            if ($full0['size'] > $maxSize) {
                array_push($error, "full0 input file: Maximum file size exceeded!");
            }
        }
    } elseif ($mode === 'fasta') {
        $thread = isset($_POST["fasta-thread"]) ? escape($_POST["fasta-thread"]) : 4;
        $length = isset($_POST["fasta-length"]) ? escape($_POST["fasta-length"]) : 15;

        if ($fasta0["error"] != 0) {
            array_push($error, "fasta0 input file: No file is uploaded!");
        } else {
            if (!array_key_exists($fasta0['type'], $acceptedFile)) {
                array_push($error, "fasta0 input file: Invalid input file type!");
            }

            if ($fasta0['size'] > $maxSize) {
                array_push($error, "fasta0 input file: Maximum file size exceeded!");
            }
        }
    }

// Add other input check-in rules ...

// ####### Initialization in Database #######

    if (empty($error)) {
        // open the database connection
        $db = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
        if ($db->connect_error) {
            die('Unable to connect to database: ' . $db->connect_error);
        }
        //     read data
        $jobid = uniqid("", TRUE);

        $software = "bepi";
        $analysis = "bepi";

        $null = NULL;

        $file1Content = "";
        $file2Content = "";
        $file3Content = "";
        $file4Content = "";
        if ($motif0_file['tmp_name'] != "") $file1Content = file_get_contents($motif0_file['tmp_name']);
        if ($full0_file['tmp_name'] != "") $file2Content = file_get_contents($full0_file['tmp_name']);
        if ($full0['tmp_name'] != "") $file3Content = file_get_contents($full0['tmp_name']);
        if ($fasta0['tmp_name'] != "") $file4Content = file_get_contents($fasta0['tmp_name']);

        // set job status as 0. 0 means new job, 1 means job success, 2 means job processing, 9 means job failed.
        if ($result1 = $db->prepare("INSERT INTO Jobs (JobID, Status, Software, Analysis, CreateTime) VALUES (?, 0, ?, ?, now());")) {
            $result1->bind_param("sss", $jobid, $software, $analysis);
            $result1->execute();
            $result1->close();
        }

        if ($result2 = $db->prepare("INSERT INTO BepiParameters(JobID, Inst, Email, Mode, Thread, Length, motif0_file, full0_file, full0, fasta0) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);")) {
//            echo 'connected!!!';
//            print($mode);
//            print($thread);
//            print($length);

            $result2->bind_param("ssssiibbbb", $jobid, $inst, $email, $mode, $thread, $length, $null, $null, $null, $null);

            $result2->send_long_data(6, $file1Content);
            $result2->send_long_data(7, $file2Content);
            $result2->send_long_data(8, $file3Content);
            $result2->send_long_data(9, $file4Content);

            $result2->execute();
            $result2->close();
        } else {
            $log = $result2->error;
        }

        $db->close();

        $success = 1;
    } else {
        $success = 2;
    }
}

// #######################################################################
// ###### Handle the GET request: Monitor progress and view results ######
// #######################################################################

if (isset($_GET['jobid'])) {
    $jobid = escape($_GET["jobid"]);
    if (!empty($jobid)) {

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

            if ($result->num_rows <= 0) {
                $status = '4'; // Job ID is not found
            }

            $result->close();
        } else {
            $status = '5'; // Database connection failed
        }

        $db->close();
    }
}

//include ('./template/temp_index.php');

?>
