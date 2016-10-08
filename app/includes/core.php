<?php
/*SECURiTY START*/
if (!defined('protect')) {
    die('<h1>Incorrect access</h1><br/>You cannot access this file directly.');
    exit;
}
/*SECURiTY END*/

if (strlen(CRYPT) == 0 or strlen(PWD) == 0) {
    header("Content-type: text/plain");
    die("1, Edit /app/includes/config.php:
-CRYPT
-PWD
-MOD_REWRITE

2, Login to admin panel:
/app/adm/?x=PWD");
}
/*
iN TEMPLATE USAGE: 
<!--div class="post" id="post-$postid$">
    <h4><a href="$posturl$">$posttitle$</a></h4>
    <span class="date">$postdate$</span>
    <div class="post-content">
        $postcontent$    
    </div>    
</div-->

*/
function last_post_id()
{
    return file_get_contents("./app/files/id/id.txt");
}

function secure_get_post($check, $id)
{
    if ($check == 1) {
        $location = "./app/files/posts/post_" . $id . ".txt";
        if (!file_exists($location)) {
            die("<br />[#ERROR] POST DOES NOT EXISTS");
        }
        $x = file_get_contents($location);
        if (strstr($x, CRYPT) == TRUE) {
        } else {
            die("<br />[#ERROR_403]");
        }
    }
}

function post_new($title, $content, $published, $crypt)
{
    $fil = fopen('../files/id/id.txt', "r");
    $dat = fread($fil, filesize('../files/id/id.txt'));
    fclose($fil);
    $fil = fopen('../files/id/id.txt', "w");
    fwrite($fil, $dat + 1);
    $dat_ = $dat + 1;
    $file = fopen("../files/posts/post_" . $dat_ . ".txt", "w");
    fwrite($file, "|" . $dat_ . "|" . str_replace("|", "-", $title) . "|" . str_replace("|", "-", $content) . "|" . $published . "|" . date("d-M-Y h:i") . "\n<!--" . $crypt . "-->");
    fclose($file);
    echo "Posted, you can now view it here: index.php?post=" . $dat_;
    die();
}

function last_post($id)
{
    $config_miniblog_filename = "index.php";
    $id                       = file_get_contents("./app/files/id/id.txt");
    secure_get_post(1, $id);
    $i2            = file_get_contents("./app/files/posts/post_" . $id . ".txt");
    $content       = explode("|", $i2);
    $postid        = $content[1];
    $posturl       = $content[1];
    $posttitle     = $content[2];
    $date          = explode("\n", $content[5]);
    $postdatedate  = $date[0];
    $postcontent   = $content[3];
    $postpublished = $content[4];
    
    if ($postpublished == 1) {
        $vars = array(
            '$postid$' => $postid,
            '$posturl$' => (MOD_REWRITE == 1) ? $posturl . "#" . $posttitle : $config_miniblog_filename . '?post=' . $posturl,
            '$posttitle$' => $posttitle,
            '$postdate$' => $postdatedate,
            '$postcontent$' => $postcontent
        );
        
        $template_vars   = array_keys($vars);
        $template_values = array_values($vars);
        
        $output = file_get_contents('./app/includes/template.html');
        $output = str_replace($template_vars, $template_values, $output);
        
        return str_replace('[ssh-cmd]','<pre style="background-color: black; color: white;padding: 3px;3px; display: inline-block;">',str_replace('[/ssh-cmd]','</pre>',$output));
        
    }
}
function get_post($id)
{
    secure_get_post(1, $id);
    $config_miniblog_filename = "index.php";
    $filename                 = "./app/files/posts/post_" . $_GET["post"] . ".txt";
    
    if (file_exists($filename)) {
        $i2            = file_get_contents("./app/files/posts/post_" . $_GET["post"] . ".txt");
        $content       = explode("|", $i2);
        $postid        = $content[1];
        $posturl       = $content[1];
        $posttitle     = $content[2];
        $date          = explode("\n", $content[5]);
        $postdatedate  = $date[0];
        $postcontent   = $content[3];
        $postpublished = $content[4];
        
        if ($postpublished == 1) {
            $vars = array(
                '$postid$' => $postid,
                '$posturl$' => (MOD_REWRITE == 1) ? $posturl . "#" . $posttitle : $config_miniblog_filename . '?post=' . $posturl,
                '$posttitle$' => $posttitle,
                '$postdate$' => $postdatedate,
                '$postcontent$' => $postcontent
            );
            
            $template_vars   = array_keys($vars);
            $template_values = array_values($vars);
            
            $output = file_get_contents('./app/includes/template.html');
            $output = str_replace($template_vars, $template_values, $output);
            
            $miniblog_posts = str_replace('[ssh-cmd]','<pre style="background-color: black; color: white;padding: 3px;3px; display: inline-block;">',str_replace('[/ssh-cmd]','</pre>',$output));
        } else {
            $vars = array(
                '$postid$' => "",
                '$posturl$' => "",
                '$posttitle$' => "",
                '$postdate$' => "",
                '$postcontent$' => "Post disabled."
            );
            
            $template_vars   = array_keys($vars);
            $template_values = array_values($vars);
            
            $output = file_get_contents('./app/includes/template.html');
            $output = str_replace($template_vars, $template_values, $output);
            
            $miniblog_posts = $output;
        }
    } else {
        $vars = array(
            '$postid$' => "",
            '$posturl$' => "",
            '$posttitle$' => "",
            '$postdate$' => "",
            '$postcontent$' => "Post does not exists."
        );
        
        $template_vars   = array_keys($vars);
        $template_values = array_values($vars);
        
        $output = file_get_contents('./app/includes/template.html');
        $output = str_replace($template_vars, $template_values, $output);

        $miniblog_posts = $output;
    }
    return $miniblog_posts;
}

?>