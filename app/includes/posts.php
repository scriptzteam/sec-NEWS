<?php
/*SECURiTY START*/
if (!defined('protect')) {
    die('<h1>Incorrect access</h1><br/>You cannot access this file directly.');
    exit;
}
/*SECURiTY END*/
if (isset($_GET["post"])) {
    echo get_post($_GET["post"]);
} else {
    echo last_post("x");
}
?>