const formulario = document.getElementById("formJogo");

formulario.addEventListener("submit", function(event) {

    event.preventDefault();

    const dados = new FormData(formulario);

    fetch("../php/jogo.php", {
        method: "POST",
        body: dados
    })
    .then(response => response.text())
    .then(resultado => {

        document.getElementById("resultado").innerHTML = resultado;

    });

});