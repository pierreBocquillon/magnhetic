<?php

try {
    $conn = new PDO('mysql:dbname=magnhetiqvbdd;host=magnhetiqvbdd.mysql.db', 'magnhetiqvbdd', 'magnHETIC123');
} catch (PDOException $exception) {
    die($exception->getMessage());
}

function errorHandler(PDOStatement $stmt)
{
    if ($stmt->errorCode() !== '00000') {
        var_dump($stmt->errorInfo());
        die();
    }
}