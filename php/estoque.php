
<?php

$nomeJogo = trim($_POST["nomeJogo"] ?? "");
$quantidade = trim($_POST["quantidade"] ?? "");
$estoqueMinimo = trim($_POST["estoqueMinimo"] ?? "");
$precoCusto = trim($_POST["precoCusto"] ?? "");
$quantidadeReservada = trim($_POST["quantidadeReservada"] ?? "");


// =========================
// CAMPOS OBRIGATÓRIOS
// =========================

if ($nomeJogo === "") {
    echo "Informe o nome do jogo.";
    exit;
}

if ($quantidade === "") {
    echo "Informe a quantidade em estoque.";
    exit;
}

if ($estoqueMinimo === "") {
    echo "Informe o estoque mínimo.";
    exit;
}

if ($precoCusto === "") {
    echo "Informe o preço de custo.";
    exit;
}

if ($quantidadeReservada === "") {
    echo "Informe a quantidade reservada.";
    exit;
}


// =========================
// VALIDAÇÃO DAS QUANTIDADES
// =========================

if (
    !ctype_digit($quantidade) ||
    !ctype_digit($estoqueMinimo) ||
    !ctype_digit($quantidadeReservada)
) {
    echo "As quantidades devem ser números inteiros.";
    exit;
}

$quantidade = (int) $quantidade;
$estoqueMinimo = (int) $estoqueMinimo;
$quantidadeReservada = (int) $quantidadeReservada;


// =========================
// VALIDAÇÃO DAS RESERVAS
// =========================

if ($quantidadeReservada > $quantidade) {
    echo "A quantidade reservada não pode ser maior que o estoque.";
    exit;
}


// =========================
// VALIDAÇÃO DO PREÇO
// =========================

if (!is_numeric($precoCusto) || $precoCusto <= 0) {
    echo "O preço de custo deve ser maior que zero.";
    exit;
}

$precoCusto = (float) $precoCusto;


// =========================
// LÓGICA DO ESTOQUE
// =========================

$quantidadeDisponivel = $quantidade - $quantidadeReservada;

if ($quantidadeDisponivel == 0) {

    $statusEstoque = "Esgotado";

} elseif ($quantidadeDisponivel <= $estoqueMinimo) {

    $statusEstoque = "Estoque baixo";

} else {

    $statusEstoque = "Estoque normal";

}


// =========================
// RESULTADO
// =========================

echo "Estoque cadastrado com sucesso!\n";
echo "Jogo: " . $nomeJogo . "\n";
echo "Quantidade em estoque: " . $quantidade . "\n";
echo "Quantidade reservada: " . $quantidadeReservada . "\n";
echo "Quantidade disponível: " . $quantidadeDisponivel . "\n";
echo "Estoque mínimo: " . $estoqueMinimo . "\n";
echo "Preço de custo: R$ " . number_format($precoCusto, 2, ",", ".") . "\n";
echo "Situação: " . $statusEstoque . ".";

?>
