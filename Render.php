<?php
class Render{
    static function html($content){
        $fileStr = file_get_contents("template.html");
        $html = str_replace("{{content}}",$content,$fileStr);
        echo $html;
    }
}