<?php

function getUrl() {
  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
  $url .= ( $_SERVER["SERVER_PORT"] !== "80" ) ? ":".$_SERVER["SERVER_PORT"] : "";
  $url .= $_SERVER["REQUEST_URI"];
  return $url;
}

function listFolders()
{
    $result = array();
    $root = scandir(__DIR__);

    $exclude_folders = array('..','.','.git','.idea');

    foreach ($root as $folder) {
        if (in_array($folder, $exclude_folders)) continue;
        if (is_file("$root/$folder")) continue;
        $result[$folder] = $folder;
    }

    return $result;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Localhost</title>

    <style type="text/css">
        * {font-family: "Trebuchet MS", Helvetica, sans-serif;}
        body {background-color: #000; color: #FF6600;}
        .content {width: 800px; margin: 0 auto;}
        .toolbar ul {list-style: none; padding: 0; margin: 0 auto; font-weight: bold; font-size: 13px;}
        .toolbar ul li {position: relative; display: inline-block; border: 1px solid #FFF;
            border-collapse: collapse; float: left; padding: 0px; margin: 3px 3px; -webkit-border-radius: 5px;
            -moz-border-radius: 5px; border-radius: 5px; border-color: #FF6600; color: #FFF; min-width: 152px;}
        .toolbar ul li:hover {color: #FF6600; background-color: #FFF;}
        li a {display: block; padding: 10px; margin-left: 5px;}
        .toolbar li a {display: block; text-decoration: none; color: #FFF;}
        .toolbar li a:hover {color:#FF6600;}
        hr {border: 0; height: 0; border-top: 1px solid rgba(0, 0, 0, 0.1); border-bottom: 1px solid rgba(255, 255, 255, 0.3);}
    </style>
</head>
<body>
    <div class="content">
        <h1>Localhost</h1>
        <p>
            Your localhost more organized.
        </p>
        <hr/>
        <div class="toolbar">
            <ul>
                <?php foreach (listFolders() as $link => $name): ?>
                <li>
                    <a href="<?php echo $link; ?>" target="_blank"><?php echo $name; ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>
