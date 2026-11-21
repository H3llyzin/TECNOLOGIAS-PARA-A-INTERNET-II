
const formulario = document.getElementById("formEstoque");

console.log(formulario);

formulario.addEventListener("submit", async function(event) {

    event.preventDefault();

    const dados = new FormData(formulario);
    const resultado = document.getElementById("resultado");

    resultado.textContent = "Enviando...";

    try {

        const response = await fetch("../php/estoque.php", {
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
