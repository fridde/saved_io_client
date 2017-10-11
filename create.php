<?php

require __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;

$max_number = $_REQUEST["number"] ?? false;
$duration = 10; //in seconds
$file_name = "input/bookmarks.json";

$client = new Client([
    'timeout'  => 2.0
]);

$parameters = parse_ini_file('keys.ini');

$query = ["query" => $parameters];

$bookmarks = json_decode(file_get_contents($file_name), true);

$start = microtime(true);
$counter = 0;
foreach($bookmarks as $index => $row){
    if(substr($row, 0 , 5) !== str_repeat('+', 5)){
        sleep(0.1);
        $title_and_url = explode(str_repeat('+', 5), $row);
        $query["query"]["title"] = $title_and_url[0];
        $query["query"]["url"] = $title_and_url[1];
        
        $response = $client->request('POST', 'http://devapi.saved.io/bookmarks/', $query);
        $bookmarks[$index] = str_repeat('+', 5) . $row;

        $now = microtime(true);        
        if($now - $start > $duration){
            break;
        }
    }
}

file_put_contents($file_name, implode(PHP_EOL, $bookmarks));
