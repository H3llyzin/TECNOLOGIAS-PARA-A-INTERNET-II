<?php

$nome = $_POST["nome"] ?? "";
$descricao = $_POST["descricao"] ?? "";
$genero = $_POST["genero"] ?? "";
$faixaEtaria = $_POST["faixaEtaria"] ?? "";
$status = $_POST["status"] ?? "";


// =========================
// CAMPOS OBRIGATÓRIOS
// =========================

if ($nome == "") {
    echo "Informe o nome.";
    exit;
}

if ($descricao == "") {
    echo "Informe a descrição.";
    exit;
}

if ($genero == "") {
    echo "Informe o gênero.";
    exit;
}

if ($faixaEtaria == "") {
    echo "Informe a faixa etária.";
    exit;
}

if ($status == "") {
    echo "Informe o status.";
    exit;
}


// =========================
// VALIDAÇÃO DA FAIXA ETÁRIA
// =========================

$faixasPermitidas = ["Livre", "10", "12", "14", "16", "18"];

if (!in_array($faixaEtaria, $faixasPermitidas)) {
    echo "Informe uma faixa etária válida.";
    exit;
}


// =========================
// VALIDAÇÃO DO STATUS
// =========================

if ($status != "Ativa" && $status != "Inativa") {
    echo "Informe um status válido.";
    exit;
}


// =========================
// RESULTADO
// =========================

echo "Categoria cadastrada com sucesso!<br>";

echo "Categoria: " . $nome . "<br>";
echo "Gênero: " . $genero . "<br>";
echo "Faixa etária: " . $faixaEtaria . "<br>";
echo "Status: " . $status . "<br>";


// =========================
// PEQUENA LÓGICA
// =========================

if ($status == "Ativa") {
    echo "A categoria está disponível para utilização.";
} else {
    echo "A categoria está desativada.";
}

?>