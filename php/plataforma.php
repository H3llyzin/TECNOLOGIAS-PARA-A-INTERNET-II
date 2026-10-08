<?php

$nome = $_POST["nome"] ?? "";
$fabricante = $_POST["fabricante"] ?? "";
$geracao = $_POST["geracao"] ?? "";
$tipo = $_POST["tipo"] ?? "";
$anoLancamento = $_POST["anoLancamento"] ?? "";
$descricao = $_POST["descricao"] ?? "";


// =========================
// CAMPOS OBRIGATÓRIOS
// =========================

if ($nome == "") {
    echo "Informe o nome.";
    exit;
}

if ($fabricante == "") {
    echo "Informe o fabricante.";
    exit;
}

if ($geracao == "") {
    echo "Informe a geração.";
    exit;
}

if ($tipo == "") {
    echo "Informe o tipo.";
    exit;
}

if ($anoLancamento == "") {
    echo "Informe o ano de lançamento.";
    exit;
}

if ($descricao == "") {
    echo "Informe a descrição.";
    exit;
}


// =========================
// VALIDAÇÃO DO ANO
// =========================

if (!is_numeric($anoLancamento)) {
    echo "O ano de lançamento deve ser um número.";
    exit;
}

$anoLancamento = (int) $anoLancamento;

$anoAtual = date("Y");

if ($anoLancamento > $anoAtual) {
    echo "O ano de lançamento não pode ser futuro.";
    exit;
}

if ($anoLancamento < 1950) {
    echo "Informe um ano de lançamento válido.";
    exit;
}


// =========================
// VALIDAÇÃO DA GERAÇÃO
// =========================

if (!is_numeric($geracao)) {
    echo "A geração deve ser um número.";
    exit;
}

$geracao = (int) $geracao;

if ($geracao <= 0) {
    echo "A geração deve ser maior que zero.";
    exit;
}


// =========================
// RESULTADO
// =========================

echo "Plataforma cadastrada com sucesso!<br>";

echo "Plataforma: " . $nome . "<br>";

echo "Fabricante: " . $fabricante . "<br>";

echo "Geração: " . $geracao . "<br>";

echo "Tipo: " . $tipo . "<br>";

echo "Ano de lançamento: " . $anoLancamento . "<br>";

?>