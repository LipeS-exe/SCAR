var FILTRO = '';
var listaRegistros = [];

// ==========================
// LISTAR DADOS
// ==========================
async function carregarRegistros() {
    try {
        const resposta = await fetch("api/listar.php");
        if (!resposta.ok) throw new Error("Erro ao listar registros");
        listaRegistros = await resposta.json();
        desenhar();
    } catch (err) {
        alert(err.message);
        console.error(err);
    }
}

// ==========================
// PESQUISA
// ==========================
function pesquisar(value) {
    FILTRO = value;
    desenhar();
}

// ==========================
// DESENHAR TABELA
// ==========================
function desenhar() {
    const tbody = document.getElementById("listaRegistrosBody");
    if (!tbody) return;

    let data = listaRegistros;

    if (FILTRO.trim()) {
        const exp = new RegExp(FILTRO.trim(), "i");
        data = data.filter(u => exp.test(u.nome) || exp.test(u.rfid));
    }

    tbody.innerHTML = data.map(usuario => `
        <tr>
            <td>${usuario.rfid}</td>
            <td>${usuario.nome}</td>
            <td>${usuario.especi}</td>
            <td>${usuario.turno}</td>
            <td>
                <button class='editar' onclick='editarRegistro(${usuario.id})'>Editar</button>
                <button class='deletar' onclick='perguntarSeDeleta(${usuario.id})'>Deletar</button>
            </td>
        </tr>
    `).join('');
}

// ==========================
// SALVAR = CADASTRAR OU EDITAR
// ==========================
async function salvarRegistro() {
    const id = document.getElementById("id_edit").value;
    const rfid = document.getElementById("rfid").value.trim();
    const nome = document.getElementById("nome").value.trim();
    const especi = document.getElementById("especi").value;
    const turno = document.getElementById("turno").value;

    if (!rfid || !nome) {
        alert("RFID e Nome são obrigatórios!");
        return;
    }

    const formData = new FormData();
    formData.append("id", id);
    formData.append("rfid", rfid);
    formData.append("nome", nome);
    formData.append("especi", especi);
    formData.append("turno", turno);

    const url = id ? "api/editar.php" : "api/cadastrar.php";

    try {
        const resposta = await fetch(url, { method: "POST", body: formData });
        const data = await resposta.json();

        if (data.status !== "ok") {
            alert("Erro: " + (data.msg || "Não foi possível salvar"));
            return;
        }

        visualizar('lista');
        carregarRegistros();
    } catch (err) {
        alert("Erro ao salvar registro");
        console.error(err);
    }
}

// ==========================
// EDITAR
// ==========================
function editarRegistro(id) {
    const u = listaRegistros.find(x => x.id == id);
    if (!u) return;

    document.body.setAttribute("page", "cadastro");

    document.getElementById("id_edit").value = u.id;
    document.getElementById("rfid").value = u.rfid;
    document.getElementById("nome").value = u.nome;
    document.getElementById("especi").value = u.especi;
    document.getElementById("turno").value = u.turno;
}

// ==========================
// DELETAR
// ==========================
async function perguntarSeDeleta(id) {
    if (!confirm("Deseja deletar o registro ID " + id + "?")) return;

    const formData = new FormData();
    formData.append("id", id);

    try {
        const resposta = await fetch("api/excluir.php", { method: "POST", body: formData });
        const data = await resposta.json();

        if (data.status !== "ok") {
            alert("Erro: " + (data.msg || "Não foi possível deletar"));
            return;
        }

        carregarRegistros();
    } catch (err) {
        alert("Erro ao deletar registro");
        console.error(err);
    }
}

// ==========================
// MOSTRAR TELAS
// ==========================
function visualizar(pagina, novo = false) {
    document.body.setAttribute("page", pagina);

    if (pagina === "cadastro" && novo) {
        document.getElementById("id_edit").value = "";
        document.getElementById("rfid").value = "";
        document.getElementById("nome").value = "";
        document.getElementById("especi").value = "";
        document.getElementById("turno").value = "";
    }
}

// ==========================
// MENU SUPERIOR
// ==========================
function toggleMenu() {
    document.querySelector('.menu').classList.toggle('show');
}

// ==========================
// INICIALIZAÇÃO
// ==========================
window.addEventListener("load", () => {
    carregarRegistros();
    document.getElementById('inputPesquisa').addEventListener('keyup', e => pesquisar(e.target.value));
});
