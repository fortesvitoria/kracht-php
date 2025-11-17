// Menu dropdown
document.addEventListener('DOMContentLoaded', function() {

    const botao = document.getElementById("meuBotao");
    const dropdown = document.getElementById("meuDropdown");
    const body = document.body;


    botao.addEventListener("click", function(event) {
       
        dropdown.classList.toggle("mostrar");
        body.classList.toggle('no-scroll');
        event.stopPropagation();
    });

    window.addEventListener("click", function(event) {
        
        if (dropdown.classList.contains('mostrar')) {
            dropdown.classList.remove('mostrar');
        }
    });
});