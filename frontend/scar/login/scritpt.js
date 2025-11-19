function logar() {
    let login = document.getElementById('login').value;
    let senha = document.getElementById('senha').value;
    const msg = document.querySelector(".mensagem")

    if (login == "User" && senha == "123") {
        location.href = ""
    } else {
         msg.textContent = "Senha Incorreta!";
         msg.style.color = "red";
    }
}