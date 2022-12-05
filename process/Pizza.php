<?php

include_once('../config.php');

$metodo = $_SERVER["REQUEST_METHOD"];

if($metodo === "GET"){

    $queryBordas = $conn->query('SELECT  * FROM pizzaria.bordas;');
    $bordas = $queryBordas->fetchAll();

    $queryMassas = $conn->query('SELECT * FROM pizzaria.massas');
    $massas = $queryMassas->fetchAll();

    $querySabores = $conn->query('SELECT * FROM pizzaria.sabores');
    $sabores = $querySabores->fetchALl();

}elseif($metodo === "POST"){

    $borda = $_POST['borda'];
    $massa = $_POST['massa'];
    $sabores = $_POST['sabores'];
        //inserindo borda e massa da pizza
        $query = $conn->query('INSERT INTO pizzaria.pizzas (borda_id, massa_id) VALUES (
            '.$borda.',
            '.$massa.'
        )');

        //resgatando id da ultima pizza inserida

        $pizzaId = $conn->lastInsertId();

        //Inserindo sabor da pizza

        $query = $conn->prepare('INSERT INTO pizzaria.pizza_sabor (pizza_id, sabor_id) VALUES (
            :pizza, :sabor
        )');
        //inserindo pedido
        $statusId = 1;
        $query = $conn->query('INSERT INTO pizzaria.pedidos (pizza_id, status_id) VALUES (
            '.$pizzaId.',
            '.$statusId.'
        )');

        //mensagem de sucesso e voltar para pedidos
        $_SESSION["msg"]="Pedido registrado com sucesso!";
        $_SESSION["status"]="success";
        header('Location:../public/pedido.php');
    
}