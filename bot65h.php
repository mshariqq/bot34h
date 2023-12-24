<?php

// Define the input SQL file and output SQL file
$inputSqlFile = 'C:\Users\shari\ICU\bot34H\SRC\Database\database.sql';
$outputSqlFile = 'C:\Users\shari\ICU\bot34H\NEW_CREATION\DB\db.sql';

// Define the prefix you want to add to table names
$prefix = 'shariqq_';

// Open the input SQL file for reading
$inputHandle = fopen($inputSqlFile, 'r');

if (!$inputHandle) {
    die("Failed to open input SQL file.");
}

// Open the output SQL file for writing
$outputHandle = fopen($outputSqlFile, 'w');

if (!$outputHandle) {
    die("Failed to open output SQL file.");
}

// Loop through each line in the input SQL file
while (!feof($inputHandle)) {
    $line = fgets($inputHandle);

    // Check if the line contains a CREATE TABLE statement
    if (preg_match('/^CREATE TABLE `([^`]*)`/', $line, $matches)) {
        $tableName = $matches[1];
        $modifiedLine = str_replace("`$tableName`", "`$prefix$tableName`", $line);
        fwrite($outputHandle, $modifiedLine);
    } else {
        // If it's not a CREATE TABLE statement, write the line as is
        fwrite($outputHandle, $line);
    }
}

// Close the input and output files
fclose($inputHandle);
fclose($outputHandle);

echo "SQL file with prefix added has been created: $outputSqlFile\n";
