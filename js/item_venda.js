const formularioItem = document.getElementById("formItemVenda");
const quantidade = document.getElementById("quantidade");
const preco = document.getElementById("preco");
const desconto = document.getElementById("desconto");
const subtotal = document.getElementById("subtotal");
const resultado = document.getElementById("resultado");

function atualizarSubtotal() {
    const qtd = Number(quantidade.value) || 0;
    const valorUnitario = Number(preco.value) || 0;
    const valorDesconto = Number(desconto.value) || 0;

    const valorSubtotal = (qtd * valorUnitario) - valorDesconto;

    subtotal.value = valorSubtotal >= 0
        ? valorSubtotal.toLocaleString("pt-BR", {
            style: "currency",
            currency: "BRL"
        })
        : "Valor inválido";
}

quantidade.addEventListener("input", atualizarSubtotal);
preco.addEventListener("input", atualizarSubtotal);
desconto.addEventListener("input", atualizarSubtotal);

formularioItem.addEventListener("submit", async function (event) {
    event.preventDefault();

    const dados = new FormData(this);
    resultado.textContent = "Enviando...";

    try {
        const response = await fetch("../php/item_venda.php", {
            method: "POST",
            body: dados
        });

        const texto = await response.text();
        resultado.textContent = texto;

        if (response.ok && texto.includes("Item validado")) {
            formularioItem.reset();
            subtotal.value = "R$ 0,00";
        }
    } catch (erro) {
        resultado.textContent = "Não foi possível enviar os dados ao servidor.";
    }
});
