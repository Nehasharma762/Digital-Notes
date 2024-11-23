<?php
// Check if a session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['alogin']) || (trim($_SESSION['alogin']) == '')) { ?>
    <script>
        // JavaScript code to redirect to the login page if the session is not valid
        window.location = "index.php";
    </script>
<?php
}

// Store the session id in a variable for use in other scripts
$session_id = $_SESSION['alogin'];
?>
