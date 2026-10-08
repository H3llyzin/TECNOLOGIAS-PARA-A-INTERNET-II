<?php


$venda = trim($_POST["venda"] ?? "");
$jogo = trim($_POST["jogo"] ?? "");
$quantidade = $_POST["quantidade"] ?? 0;
$preco = $_POST["preco"] ?? 0;
$desconto = $_POST["desconto"] ?? 0;

if (
    $venda === "" ||
    $jogo === "" ||
    !is_numeric($quantidade) ||
    !is_numeric($preco) ||
    !is_numeric($desconto) ||
    (float)$quantidade <= 0 ||
    (float)$preco <= 0 ||
    (float)$desconto < 0
) {
    echo "Preencha os dados do item corretamente.";
    exit;
}

$quantidade = (float)$quantidade;
$preco = (float)$preco;
$desconto = (float)$desconto;

$subtotal = ($quantidade * $preco) - $desconto;

if ($subtotal < 0) {
    echo "O subtotal não pode ser negativo.";
    exit;
}

echo "Item validado. Subtotal: R$ " .
     number_format($subtotal, 2, ",", ".");
