#!/usr/bin/php
<?php

// Specify the number of cat pictures you want
$pictureAmount = (int)readline("How many cat pictures would you like?: ");

// Create a directory to save the cat pictures
$directory = (string)readline('What is the name of the folder you want the pictues in?: ');


if (!is_dir($directory)) {
    mkdir($directory);
} else {
    echo ("This folder already exists, try again!\n");
}


//check if there are any pictures in a directory
$hasFiles = scandir($directory);

if (count($hasFiles) == 0 || count($hasFiles) == 2){
// Grab the amount if cat pictures you want and name them
for ($i = 1; $i <= $pictureAmount; $i++) {
    $imageUrl = "https://cataas.com/cat";
    $imagePath = $directory . '/cat' . $i . '.jpg';
    
    //Grab the contents of the imageUrl
    $imageData = file_get_contents($imageUrl);
    
    //If we have imageData, save the file and let us know
    if ($imageData) {
        file_put_contents($imagePath, $imageData);
        echo "Image saved: $imagePath\n";
    } else {
        echo "Failed to download image: $imageUrl\n";
    }
} 
} else {
    echo ("There are already files in this folder, make a new folder.\n");
    exit;
}

?>