const formulario = document.getElementById("formPlataforma");

formulario.addEventListener("submit", function(event) {

    event.preventDefault();

    const dados = new FormData(formulario);

    fetch("../php/plataforma.php", {
        method: "POST",
        body: dados
    })
    .then(response => response.text())
    .then(resultado => {

        document.getElementById("resultado").innerHTML = resultado;

    });

});