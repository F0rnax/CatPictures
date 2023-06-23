#!/usr/bin/php
<?php

//This function grabs a prompt and user input
function getInput($message){
    echo $message;
    return trim(fgets(STDIN));
}

//This function grabs gets image info and saves it in the path determined
function getImage($url, $path){
    $file = file_get_contents($url);
    if($file) {
        file_put_contents($path, $file);
        echo "Image saved: $path\n";
    } else {
        echo "Failed to download image: $url\n";
    }
}

//Prompt the user for comma-delimited input
$inputTags = getInput("Enter Tags for Cats: ");

//Convert the input into an array
$tagsArray = explode(',', $inputTags);

//Trim the values in the Array
$tagsArray = array_map('trim', $tagsArray);

//Getting a response from the API and decoding the JSON
$tagsReponse = file_get_contents('https://cataas.com/api/tags');
$apiTags = json_decode($tagsReponse, true);

//Checking the user tags with tags from the API to see if they're usable
$difference = array_diff($tagsArray, $apiTags);

if (empty($difference)) {
    echo "Tags look good.\n";
} else {
    echo "Not all tags given can be used.\n";
    echo "Missing elements: " . implode(', ', $difference) . "\n";
    exit;
}

//Promting the user for input of how many pictures they want
$inputAmount = getInput("Enter the number of how many cat pictures you want: ");
//Making sure input is an int
if (!filter_var($inputAmount, FILTER_VALIDATE_INT)) {
    echo "Input must be a number.";
    exit;
}


//Creating the API URL for determining limits and tags
$apiUrl = "https://cataas.com/api/cats?limit=$inputAmount&skip=0&tags=$inputTags";

//Make a request to the API and retrieve the URLs
$response = file_get_contents($apiUrl);
$pictures = json_decode($response, true);

//Prompting the user for the folder name to hold the pictures
$inputFolder = getInput("Enter the folder name for the pictures: ");

//Check if any pictures were recevied
if(!empty($pictures)){
    if (!is_dir($inputFolder)){
        mkdir($inputFolder);
    } else {
        echo "Folder already exists! \n";
    }
}

//Scanning to see if any files are in the folder that was created.
$hasFiles = scandir($inputFolder);

if (count($hasFiles) == 0 || count($hasFiles) == 2){

//Download and store each cat picture
foreach($pictures as $index => $picture){
    $imageUrl = "https://cataas.com/cat/" . $picture['_id'];
    $imagePath = $inputFolder . '/cat' . ($index + 1) . '.jpg';
    getImage($imageUrl, $imagePath);
}
} else {
    echo "This folder already has files in it! \n";
    exit;
}
?>