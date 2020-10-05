<?php

$content = "";
require_once("Render.php");
require_once("tags.php");

foreach($ as $val){
    $content .= html_tag("h3",$val['title']) . html_img($val['img']). hr();
}
Render::html($content);