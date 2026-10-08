document.getElementById("formVenda").addEventListener("submit", async function (event) {
    event.preventDefault();

    const formulario = this;
    const resultado = document.getElementById("resultado");
    const dados = new FormData(formulario);

    resultado.textContent = "Enviando...";

    try {
        const response = await fetch("../php/venda.php", {
            method: "POST",
            body: dados
        });

        const texto = await response.text();
        resultado.textContent = texto;

        if (response.ok && texto.includes("sucesso")) {
            formulario.reset();
        }
    } catch (erro) {
        resultado.textContent = "Não foi possível enviar os dados ao servidor.";
    }
});
