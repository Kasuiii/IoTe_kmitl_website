<?php
define('servername', 'localhost');
define('username', 'root');
define('password', '');
define('dbname', 'iote_website');

$conn = mysqli_connect(servername, username, password, dbname);
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

$courseYear = isset($_POST['courseYear']) ? intval($_POST['courseYear']) : null;
$courseID = isset($_POST['courseID']) ? trim($_POST['courseID']) : '';
$courseName = isset($_POST['courseName']) ? trim($_POST['courseName']) : '';
$courseCredit = isset($_POST['courseCredit']) ? intval($_POST['courseCredit']) : null;
$courseDescript = isset($_POST['courseDescript']) ? trim($_POST['courseDescript']) : '';

$errors = [];
if ($courseYear === null) $errors[] = 'courseYear is required';
if ($courseID === '') $errors[] = 'courseID is required';
if ($courseName === '') $errors[] = 'courseName is required';
if ($courseCredit === null) $errors[] = 'courseCredit is required';
if (strlen($courseID) > 20) $errors[] = 'courseID must be 20 characters or fewer';
if (strlen($courseName) > 255) $errors[] = 'courseName must be 255 characters or fewer';

if (!empty($errors)) {
    foreach ($errors as $err) {
        echo htmlspecialchars($err) . '<br>';
    }
    mysqli_close($conn);
    exit;
}

$sql = 'INSERT INTO iote_website (courseYear, courseID, courseName, courseCredit, courseDescript) VALUES ('" . $_POST["courseYear"] . "','" . $_POST["courseID"] . "','" . $_POST["courseName"] . "','" . $_POST["courseCredit"] . "','" . $_POST["courseDescription"] . "')";';
$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    echo 'Prepare failed: ' . mysqli_error($conn);
    mysqli_close($conn);
    exit;
}

// Types: i = integer, s = string => courseYear(i), courseID(s), courseName(s), courseCredit(i), courseDescript(s)
mysqli_stmt_bind_param($stmt, 'issis', $courseYear, $courseID, $courseName, $courseCredit, $courseDescript);
$exec = mysqli_stmt_execute($stmt);

if ($exec) {
    echo 'Course added successfully.';
    echo '<br>';
    echo '<a href="/">Return to site</a>';
} else {
    echo 'Insert failed: ' . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>
