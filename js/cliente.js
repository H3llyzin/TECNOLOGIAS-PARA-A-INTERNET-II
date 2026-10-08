const formulario = document.getElementById("formCliente");

formulario.addEventListener("submit", function(event) {

    event.preventDefault();

    const dados = new FormData(formulario);

    fetch("../php/cliente.php", {
        method: "POST",
        body: dados
    })
    .then(response => response.text())
    .then(resultado => {

        document.getElementById("resultado").innerHTML = resultado;

    })
    .catch(erro => {

        console.error(erro);

    });

});
