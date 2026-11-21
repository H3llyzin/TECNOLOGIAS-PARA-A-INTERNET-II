<?php


$nome = trim($_POST["nome"] ?? "");
$cpf = trim($_POST["cpf"] ?? "");
$nascimento = trim($_POST["nascimento"] ?? "");
$telefone = trim($_POST["telefone"] ?? "");
$email = trim($_POST["email"] ?? "");
$cargo = trim($_POST["cargo"] ?? "");

if (
    $nome === "" ||
    $cpf === "" ||
    $nascimento === "" ||
    $telefone === "" ||
    $email === "" ||
    $cargo === ""
) {
    echo "Preencha todos os campos.";
    exit;
}

$cpfSomenteNumeros = preg_replace("/\D/", "", $cpf);

if (strlen($cpfSomenteNumeros) != 11) {
    echo "Erro: CPF inválido.";
    exit;
}

// Verifica se todos os números são iguais
if (preg_match('/^(\d)\1{10}$/', $cpfSomenteNumeros)) {
    echo "Erro: CPF inválido.";
    exit;
}

// Primeiro dígito verificador
$soma = 0;

for ($i = 0; $i < 9; $i++) {
    $soma += $cpfSomenteNumeros[$i] * (10 - $i);
}

$resto = $soma % 11;

if ($resto < 2) {
    $digito1 = 0;
} else {
    $digito1 = 11 - $resto;
}

if ($cpfSomenteNumeros[9] != $digito1) {
    echo "Erro: CPF inválido.";
    exit;
}

// Segundo dígito verificador
$soma = 0;

for ($i = 0; $i < 10; $i++) {
    $soma += $cpfSomenteNumeros[$i] * (11 - $i);
}

$resto = $soma % 11;

if ($resto < 2) {
    $digito2 = 0;
} else {
    $digito2 = 11 - $resto;
}

if ($cpfSomenteNumeros[10] != $digito2) {
    echo "Erro: CPF inválido.";
    exit;
}


$dataNascimento = DateTime::createFromFormat("Y-m-d", $nascimento);

if (!$dataNascimento || $dataNascimento->format("Y-m-d") !== $nascimento) {
    echo "Data de nascimento inválida.";
    exit;
}

if ($dataNascimento > new DateTime("today")) {
    echo "A data de nascimento não pode ser futura.";
    exit;
}

$hoje = new DateTime("today");
$idade = $dataNascimento->diff($hoje)->y;

$telefoneSomenteNumeros = preg_replace("/\D/", "", $telefone);

if (strlen($telefoneSomenteNumeros) < 10 || strlen($telefoneSomenteNumeros) > 11) {
    echo "Informe um telefone válido com DDD.";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Informe um e-mail válido.";
    exit;
}


if (strlen($cargo) > 80) {
    echo "O cargo deve possuir no máximo 80 caracteres.";
    exit;
}

echo "Funcionário validado com sucesso!\n";
echo "Nome: " . $nome . "\n";
echo "Cargo: " . $cargo . "\n";
echo "Idade: " . $idade . " anos.";

