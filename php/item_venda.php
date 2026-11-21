<?php

$venda = trim($_POST["venda"] ?? "");
$jogo = trim($_POST["jogo"] ?? "");
$quantidade = $_POST["quantidade"] ?? "";
$preco = $_POST["preco"] ?? "";
$desconto = $_POST["desconto"] ?? 0;

// 1. Verificação dos campos
if (
    $venda === "" ||
    $jogo === "" ||
    !is_numeric($quantidade) ||
    !is_numeric($preco) ||
    !is_numeric($desconto)
) {
    echo "Preencha os dados do item corretamente.";
    exit;
}

// 2. Conversão dos valores
$quantidade = (float)$quantidade;
$preco = (float)$preco;
$desconto = (float)$desconto;

// 3. Validação dos valores
if (
    $quantidade <= 0 ||
    $preco <= 0 ||
    $desconto < 0
) {
    echo "Os valores informados são inválidos.";
    exit;
}

// 4. Quantidade deve ser inteira
if ($quantidade != floor($quantidade)) {
    echo "A quantidade deve ser um número inteiro.";
    exit;
}

// 5. Cálculo do valor bruto
$subtotalBruto = $quantidade * $preco;

// 6. Desconto não pode ultrapassar o valor bruto
if ($desconto > $subtotalBruto) {
    echo "O desconto não pode ser maior que o valor dos produtos.";
    exit;
}

// 7. Limite máximo de desconto de 50%
if ($desconto > ($subtotalBruto * 0.5)) {
    echo "O desconto não pode ultrapassar 50% do valor dos produtos.";
    exit;
}

// 8. Cálculo do subtotal final
$subtotal = $subtotalBruto - $desconto;

// 9. Retorno
echo "Item validado. Subtotal: R$ " .
     number_format($subtotal, 2, ",", ".");