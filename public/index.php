<?php

require_once(__DIR__."/../src/app.php");
require_once(__DIR__."/../src/DB.php");

const BASE = "http://localhost/route-app2020";


$app = new App();

$app->get("/data/id",function(){
    echo "From my get-data-id-route";
});

$app->get("/food",function(){
    include("views/header.php");
        var_dump(DB::fetchAll());
    include("views/footer.php");
    
});

$app->get("/create/food",function(){
   
    include("views/newfood.html");

});

$app->post("/food",function(){
    DB::insert($_POST);
    $url = BASE."/food";
    //echo $url;
    header("Location:".$url);
});









// testar lite
$app->get("/fredric",'test');


//$app->show();

$app->listen();


function test(){

    echo "Hello from test function";

}