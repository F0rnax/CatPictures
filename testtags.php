<?php

//Make a request for the list of tags from the API
$tagsReponse = file_get_contents('https://cataas.com/api/tags');
$catTagsArray = json_decode($tagsReponse, true);

if ($catTagsArray !== null){
    foreach ($catTagsArray as $tag){
        echo $tag . "\n";
    }
}   else {
        echo "Failed to fetch tags from the Catass API. \n";
}

//Make a request for the list of tags from the API
$tagsReponse = file_get_contents('https://cataas.com/api/tags');
$catTagsArray = json_decode($tagsReponse, true);

//$catTagsArray = explode(',', $catTags);

$intersection = array_intersect($tagsArray, $catTagsArray);

if (empty($intersection)){
    echo "There are no tags matching the ones entered. \n";
}

if ($catTagsArray == null){
    echo "Failed to fetch tags from the Catass API. \n";
    }



?> 