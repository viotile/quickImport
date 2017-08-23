<?php
/**
 * User: viotile development
 * Date: 22-08-2017
 * Time: 04:53 PM
 */
set_time_limit(0);

include_once('../vendor/autoload.php');
include_once('../src/customHelper.php');

use viotile\excel\customHelper;

$filePath = './sample/FedEx.xlsx';
$ch = new customHelper($filePath);
$data = $ch->import();
array_shift($data);//remove first element

/*
 * Setup Database credential here
 */

$dbhost = "localhost";
$dbname = "test";
$dbusername = "root";
$dbpassword = "";
$tableName = "pincodes";

$link = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$link->beginTransaction();

/*
 * Change Below Fields according to your database
 */
$fields = array(
    'postal_code',
    'city',
    'state',
    'international_services',
    'domestic_services',
    'classification',
    'is_cod_available'
);

$sqlValueArr = array();
for ($i = 0; $i < count($fields); $i++) {
    array_push($sqlValueArr, '?');
}

try {
    $statement = $link->prepare("INSERT INTO " . $tableName . "(" . implode(', ', $fields) . ")
          VALUES(" . implode(', ', $sqlValueArr) . ")");
    foreach ($data as $key => $value) {
        $statement->execute($value);
    }
    $link->commit();
    echo 'Data Imported Successfully !!';

} catch (Exception $e) {
    echo $e->getMessage();
    $pdo->rollBack();
}
