const formulario = document.getElementById("formCategoria");

formulario.addEventListener("submit", function(event) {

    event.preventDefault();

    const dados = new FormData(formulario);

    fetch("../php/categoria.php", {
        method: "POST",
        body: dados
    })
    .then(response => response.text())
    .then(resultado => {

        document.getElementById("resultado").innerHTML = resultado;

    });

});