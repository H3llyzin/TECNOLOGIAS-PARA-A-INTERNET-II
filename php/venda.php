<?php

$cliente = trim($_POST["cliente"] ?? "");
$funcionario = trim($_POST["funcionario"] ?? "");
$data = trim($_POST["data_venda"] ?? "");
$pagamento = trim($_POST["pagamento"] ?? "");
$valor = trim($_POST["valor_total"] ?? "");
$status = trim($_POST["status"] ?? "");

if (
    $cliente === "" ||
    $funcionario === "" ||
    $data === "" ||
    $pagamento === "" ||
    $valor === "" ||
    $status === ""
) {
    echo "Preencha todos os campos.";
    exit;
}

if (!is_numeric($valor) || (float)$valor <= 0) {
    echo "O valor da venda deve ser maior que zero.";
    exit;
}

echo "Venda validada com sucesso.";
