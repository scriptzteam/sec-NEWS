<?php
define('protect', '1');
include("../includes/config.php");
include("../includes/core.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>miniblog</title>
<style type="text/css">
<!--
*, html {
    margin:0;
    padding:0;
}
body {
    font-family:'Lucida Sans Unicode','Lucida Grande',verdana,sans-serif;
    font-size:0.9em;
    color:#333333;
    margin:0 auto;
    padding:0;
    background-color:#dddddd;
}
a {
    color:#006699;
}
h2 {
    font-weight:normal;
    color:#666666;
    font-size:1.4em;
}
p {
    margin-bottom:10px;
    line-height:1.6em;
}
div.wrapper {
    width:80%;
    padding:5px;
    margin:50px auto 10px auto;
}
div.post {
    background-color:#ffffff;
    border:1px solid #cccccc;
    padding:7px;
    margin:10px 0;
}
span.date {
    color:#666666;
    font-size:0.7em;
    text-transform:uppercase;
}

div.navigation p a {
    font-size:1.2em;
}
div.navigation p.previous-link {
    width:48%;
    float:left;
    text-align:left;
}
div.navigation p.next-link {
    width:48%;
    float:right;
    text-align:right;
}
div.post-content {
    padding-top:4px;
}
div.clear { 
    clear:both;
}
div.footer p {
    padding-top:10px;
    color:#999999;
    font-size:0.9em;
    text-align:center;
}
div.footer p a {
    color:#999999;
}
-->
</style>
</head>                        
<div class="wrapper">
    
    <h1>minblog</h1>
    <h2>admin area</h2>
    
    <div class="post">
<?php
if (!isset($_GET["x"]) or $_GET["x"] != PWD) {
    die("<pre> 
|---------------------------------------|
|        Password required              |
|---------------------------------------|
        \   ^__^
         \  (oo)\_______
            (__)\       )\/\
                ||----w |
                ||     ||</pre>");
}
if (isset($_GET["x"]) && $_GET["x"] == PWD) {
    if (isset($_POST["post__post_title"])) {
        post_new($_POST["post__post_title"], $_POST["post__post_content"], $_POST["post__published"], CRYPT);
    }
?>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
  <div class="post-content">
        <form action="" method="post">
    <p>
        <label for="title">Post title:</label><br />
        <input type="text" size="80" id="title" name="post__post_title" value="" />
    </p>
    
    <p>
        <label for="content">Post content:</label><br />
        <textarea cols="77" rows="10" id="content" name="post__post_content"></textarea><br />
    </p>
    
    
    <p>
        <label for="status">Post status:</label><br />
        <select id="status" name="post__published">
            <option value='1' selected="selected">Published</option>
            <option value='0' selected="selected">Unpublished</option>
        </select>
    </p>
    
    <p>
        <input class="button" type="submit" name="miniblog_PostBack" value="Post it!" />
    </p>
    
    </div>    
</div>    
<body>
</body>
</html>
<?php
}
?>