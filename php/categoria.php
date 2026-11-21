<?php

$nome = trim($_POST["nome"] ?? "");
$descricao = trim($_POST["descricao"] ?? "");
$genero = trim($_POST["genero"] ?? "");
$faixaEtaria = trim($_POST["faixaEtaria"] ?? "");
$status = trim($_POST["status"] ?? "");


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

echo "Categoria cadastrada com sucesso!\n";
echo "Categoria: " . $nome . "\n";
echo "Gênero: " . $genero . "\n";
echo "Faixa etária: " . $faixaEtaria . "\n";
echo "Status: " . $status . "\n";

// =========================
// PEQUENA LÓGICA
// =========================

if ($status == "Ativa") {
    echo "A categoria está disponível para utilização.";
} else {
    echo "A categoria está desativada.";
}

?>