<?php
/**
 * Author: Shariqq, Chat GPT
 * Date: 23 Sept 2023
 * Version: 3.0
 */


echo "Hey, sit tight, your request is under processing...\n";
echo "\n";
echo "\n";
echo "\n";
echo "\n";
function replicateDirectory($source, $destination) {

    $FC = 1;

    $td = 0;
    $tf = 0;

    echo "#".$FC." | Source: $source\n";
    // Create the destination directory if it doesn't exist
    if (!file_exists($destination)) {
        if(mkdir($destination, 0777, true)){
           
            echo "Destination: $destination\n";
        }else {
            echo "Destination: $destination\n";
            echo "Error: Unable to create directory!\n";
        }

    }

    // Create a RecursiveIteratorIterator to iterate through the source directory
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST);

    foreach ($iterator as $item) {
        if ($item->isDir()) {
            echo "Directory found\n";
            // Create the corresponding directory in the destination
            $dir = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
            if (!file_exists($dir)) {
                echo "Creating Directory $destination \n";
               
                if(mkdir($dir)){
                    echo "Directory created successfully\n";
                    $td++;
                }else{
                    echo "Error: Unable to create directory!\n";
                }
            }
        } elseif ($item->isFile()) {
            // Replicate files with new content
            $destinationFile = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
            echo "File found\n";
            echo "Creating & Writing File $destinationFile \n";
            replicateFileContent($item, $destinationFile);
            $tf++;
        }

        echo "\n";
        echo "\n";
        echo "------------------";
        echo "\n";

        $FC++;
    }

    return [$td, $tf];
}

function replicateFileContent($sourceFile, $destinationFile) {
    // Open the source file for reading
    $sourceFileHandle = fopen($sourceFile, 'r');
    
    // Open the destination file for writing
    $destinationFileHandle = fopen($destinationFile, 'w');

    // Read the content from the source file line by line and write to the destination
    while (($line = fgets($sourceFileHandle)) !== false) {
        fwrite($destinationFileHandle, $line);
    }

    // Close both file handles
    fclose($sourceFileHandle);
    fclose($destinationFileHandle);
}

// Define the source and destination directories
$sourceDirectory = 'C:\Users\shari\ICU\bot34H\SRC';
$destinationDirectory = 'C:\Users\shari\ICU\bot34H\NEW_CREATION';

// Call the function to replicate files and directories recursively
$ddd = replicateDirectory($sourceDirectory, $destinationDirectory);

echo "\n";
echo "\n";
echo "\n";
echo "Files and directories ceated successfully with new content!";
echo "Total Dirs created: ".$ddd[0] . " Total Files created: ".$ddd[1];
?>