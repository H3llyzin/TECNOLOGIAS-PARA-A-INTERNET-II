<?php

$nome = trim($_POST["nome"] ?? "");
$descricao = trim($_POST["descricao"] ?? "");
$preco = trim($_POST["preco"] ?? "");
$dataLancamento = trim($_POST["dataLancamento"] ?? "");
$classificacao = trim($_POST["classificacao"] ?? "");
$desenvolvedora = trim($_POST["desenvolvedora"] ?? "");


// =========================
// CAMPOS OBRIGATÓRIOS
// =========================

if ($nome == "") {
    echo "Informe o nome do jogo.";
    exit;
}

if ($descricao == "") {
    echo "Informe a descrição.";
    exit;
}

if ($preco == "") {
    echo "Informe o preço.";
    exit;
}

if ($dataLancamento == "") {
    echo "Informe a data de lançamento.";
    exit;
}

if ($classificacao == "") {
    echo "Informe a classificação.";
    exit;
}

if ($desenvolvedora == "") {
    echo "Informe a desenvolvedora.";
    exit;
}


// =========================
// VALIDAÇÃO DO PREÇO
// =========================

$preco = str_replace(",", ".", $preco);

if (!is_numeric($preco)) {
    echo "O preço deve ser um número.";
    exit;
}

if ($preco <= 0) {
    echo "O preço deve ser maior que zero.";
    exit;
}


// =========================
// VALIDAÇÃO DA DATA
// =========================

$data = DateTime::createFromFormat(
    'Y-m-d',
    $dataLancamento
);

if (!$data || $data->format('Y-m-d') != $dataLancamento) {
    echo "Informe uma data de lançamento válida.";
    exit;
}

$hoje = new DateTime();

if ($data > $hoje) {
    echo "A data de lançamento não pode ser futura.";
    exit;
}


// =========================
// VALIDAÇÃO DA CLASSIFICAÇÃO
// =========================

$classificacoesValidas = [
    "Livre",
    "10",
    "12",
    "14",
    "16",
    "18"
];

if (!in_array($classificacao, $classificacoesValidas)) {
    echo "Classificação indicativa inválida.";
    exit;
}


// =========================
// RESULTADO
// =========================
// =========================
// RESULTADO
// =========================

echo "Jogo cadastrado com sucesso!\n";
echo "Jogo: " . $nome . "\n";

echo "Preço: R$ "
    . number_format($preco, 2, ",", ".")
    . "\n";

echo "Data de lançamento: "
    . $data->format("d/m/Y")
    . "\n";

echo "Classificação: "
    . $classificacao
    . "\n";

// =========================
// PEQUENA LÓGICA
// =========================

if ($preco >= 190) {

    echo "Categoria de preço: jogo premium.";

} else {

    echo "Categoria de preço: jogo padrão.";

}

?>