<?php

function getInput($message){
    echo $message;
    return trim(fgets(STDIN));
}

$inputTags = getInput("Enter Tags for Cats: ");

//Convert the input into an array
$tagsArray = explode(',', $inputTags);

//Trim the values in the Array
$tagsArray = array_map('trim', $tagsArray);


$tagsReponse = file_get_contents('https://cataas.com/api/tags');
$apiTags = json_decode($tagsReponse, true);

$difference = array_diff($tagsArray, $apiTags);


if (empty($difference)) {
    echo "All elements of Array 1 are present in Array 2.\n";
} else {
    echo "Not all elements of Array 1 are present in Array 2.\n";
    echo "Missing elements: " . implode(', ', $difference) . "\n";
}

/* if ($catTagsArray !== null){
    foreach ($catTagsArray as $tag){
        echo $tag . "\n";
    }
}   else {
        echo "Failed to fetch tags from the Catass API. \n";
} */
?>