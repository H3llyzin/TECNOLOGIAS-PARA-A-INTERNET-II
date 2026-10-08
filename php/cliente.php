<?php

$nome = $_POST["nome"] ?? "";
$cpf = $_POST["cpf"] ?? "";
$dataNascimento = $_POST["dataNascimento"] ?? "";
$telefone = $_POST["telefone"] ?? "";
$email = $_POST["email"] ?? "";
$endereco = $_POST["endereco"] ?? "";


// =========================
// VALIDAÇÕES
// =========================

if ($nome == "") {
    echo "Erro: informe o nome.";
    exit;
}


// CPF

if ($cpf == "") {
    echo "Erro: informe o CPF.";
    exit;
}

// Remove pontos e traço
$cpf = preg_replace('/[^0-9]/', '', $cpf);

// Verifica se possui 11 números
if (strlen($cpf) != 11) {
    echo "Erro: CPF inválido.";
    exit;
}

// Verifica se todos os números são iguais
if (preg_match('/^(\d)\1{10}$/', $cpf)) {
    echo "Erro: CPF inválido.";
    exit;
}

// Primeiro dígito verificador
$soma = 0;

for ($i = 0; $i < 9; $i++) {
    $soma += $cpf[$i] * (10 - $i);
}

$resto = $soma % 11;

if ($resto < 2) {
    $digito1 = 0;
} else {
    $digito1 = 11 - $resto;
}

if ($cpf[9] != $digito1) {
    echo "Erro: CPF inválido.";
    exit;
}


// Segundo dígito verificador
$soma = 0;

for ($i = 0; $i < 10; $i++) {
    $soma += $cpf[$i] * (11 - $i);
}

$resto = $soma % 11;

if ($resto < 2) {
    $digito2 = 0;
} else {
    $digito2 = 11 - $resto;
}

if ($cpf[10] != $digito2) {
    echo "Erro: CPF inválido.";
    exit;
}


// DATA DE NASCIMENTO

if ($dataNascimento == "") {
    echo "Erro: informe a data de nascimento.";
    exit;
}

$data = DateTime::createFromFormat('Y-m-d', $dataNascimento);

if (!$data || $data->format('Y-m-d') != $dataNascimento) {
    echo "Erro: informe uma data válida.";
    exit;
}

$hoje = new DateTime();

// Não pode nascer no futuro
if ($data > $hoje) {
    echo "Erro: a data de nascimento não pode ser futura.";
    exit;
}

// Calcula idade
$idade = $hoje->diff($data)->y;

// Exemplo: não aceitar idade acima de 120 anos
if ($idade > 120) {
    echo "Erro: informe uma data de nascimento válida.";
    exit;
}


// TELEFONE

if ($telefone == "") {
    echo "Erro: informe o telefone.";
    exit;
}


// E-MAIL

if ($email == "") {
    echo "Erro: informe o e-mail.";
    exit;
}


// ENDEREÇO

if ($endereco == "") {
    echo "Erro: informe o endereço.";
    exit;
}


// =========================
// RESULTADO
// =========================

echo "Cliente cadastrado com sucesso!<br>";
echo "Nome: " . $nome . "<br>";
echo "CPF: " . $cpf . "<br>";
echo "Idade: " . $idade . " anos<br>";

if ($idade < 18) {
    echo "Cliente menor de idade.";
} else {
    echo "Cliente maior de idade.";
}

?>