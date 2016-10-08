<?php
/*SECURiTY START*/
if (!defined('protect')) {
    die('<h1>Incorrect access</h1><br/>You cannot access this file directly.');
    exit;
}
/*SECURiTY END*/

if (MOD_REWRITE == 1) {
?>
   <p class="archive">
        <?php
    if (!isset($_GET["post"])) {
?>
           <p class="archive"><a href="<?php
        echo last_post_id() - 1;
?>">&laquo; previous post</a></p>
        <?php
    }
?>
       <?php
    if (isset($_GET["post"])) {
?>
           <p class="archive"><a href="<?php
        echo $_GET["post"] + 1;
?>">next post &raquo;</a></p>
            <p class="archive"><a href="<?php
        echo $_GET["post"] - 1;
?>">&laquo; previous post</a></p>
        <?php
    }
?>
       <div class="clear"></div>
    </p>
    <?php
} else {
?>
       <p class="archive">
        <?php
    if (!isset($_GET["post"])) {
?>
           <p class="archive"><a href="?post=<?php
        echo last_post_id() - 1;
?>">&laquo; previous post</a></p>
        <?php
    }
?>
       <?php
    if (isset($_GET["post"])) {
?>
     
            <a href="?post=<?php
        echo $_GET["post"] - 1;
?>">&laquo; previous post</a>
 | <a href="?post=<?php
        echo $_GET["post"] + 1;
?>">next post &raquo;</a>
        <?php
    }
?>
       <div class="clear"></div>
    </p>
    <?php
}
?>