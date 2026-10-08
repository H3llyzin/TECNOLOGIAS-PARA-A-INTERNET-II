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

if (strlen($cpfSomenteNumeros) !== 11) {
    echo "O CPF deve possuir 11 dígitos.";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Informe um e-mail válido.";
    exit;
}

echo "Funcionário validado com sucesso.";
