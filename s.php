<?php
define('protect', '1');
include('./app/includes/config.php');
include('./app/includes/core.php');
include('./app/theme/header.php');
?>

    <?php
$srx = explode("?search=", $_SERVER["REQUEST_URI"]);
if (preg_match("/^[a-zA-Z0-9]+$/i", $srx[1])) {
    $needle = $srx[1];
    
    foreach (glob("./app/files/posts/" . '*.txt') as $filename) {
        foreach (array_unique(file($filename)) as $fli => $fl) {
            if (strpos($fl, $needle) !== false) {
?>
   <div id="post" class="post">
<?php
                if (file_exists($filename)) {
                    $i2           = file_get_contents($filename);
                    $content      = explode("|", $i2);
                    $postid       = $content[1];
                    $posturl      = $content[1];
                    $posttitle    = $content[2];
                    $date         = explode("\n", $content[5]);
                    $postdatedate = $date[0];
                    echo '<a href="./?post=' . $postid . '#' . $posttitle . '">' . $posttitle . "</a> published at <b>" . $postdatedate . "</b><br />";
                }
?>
   </div>
<?php
                
                //die();
            }
        }
    }
} else {
    die("<br />[#ERROR_403]");
}
include('./app/theme/footer.php');
die();
?> 