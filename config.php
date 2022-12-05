<?php
session_start();
$hostDatabase = 'localhost:33';
$userDatabase = 'root';
$passwordDatabase = '';
$nameDatabase = 'pizzaria';


try{

    $conn=new PDO("mysql:host={$hostDatabase};dbame={$nameDatabase};",$userDatabase,$passwordDatabase);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}catch(PDOException $e){

    echo "Erro:".$e->getMessage()."</br>";
    
}