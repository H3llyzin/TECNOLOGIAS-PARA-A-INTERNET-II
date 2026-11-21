<?php

$cliente = trim($_POST["cliente"] ?? "");
$funcionario = trim($_POST["funcionario"] ?? "");
$data = trim($_POST["data_venda"] ?? "");
$pagamento = trim($_POST["pagamento"] ?? "");
$valor = $_POST["valor_total"] ?? "";
$status = trim($_POST["status"] ?? "");

// 1. Verificação dos campos obrigatórios
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

// 2. Validação do valor
if (!is_numeric($valor) || (float)$valor <= 0) {
    echo "O valor da venda deve ser maior que zero.";
    exit;
}

// 3. Validação da data
$dataObjeto = DateTime::createFromFormat('Y-m-d', $data);

if (
    !$dataObjeto ||
    $dataObjeto->format('Y-m-d') !== $data
) {
    echo "Data da venda inválida.";
    exit;
}

if ($dataObjeto > new DateTime('today')) {
    echo "A data da venda não pode ser futura.";
    exit;
}

// 4. Formas de pagamento permitidas
$pagamentosPermitidos = [
    "Dinheiro",
    "Pix",
    "Cartão de Crédito",
    "Cartão de Débito"
];

if (!in_array($pagamento, $pagamentosPermitidos, true)) {
    echo "Forma de pagamento inválida.";
    exit;
}

// 5. Status permitidos
$statusPermitidos = [
    "Pendente",
    "Concluída",
    "Cancelada"
];

if (!in_array($status, $statusPermitidos, true)) {
    echo "Status da venda inválido.";
    exit;
}

// 6. Confirmação
echo "Venda validada com sucesso.";