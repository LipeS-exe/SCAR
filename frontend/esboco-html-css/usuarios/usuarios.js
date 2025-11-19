const KEY_BD = '@usuariosestudo'

var listaRegistros = {
    ultimoIdGerado: 0,
    usuarios: []
}

var FILTRO = ''

function gravarBD() {
    localStorage.setItem(KEY_BD, JSON.stringify(listaRegistros))
}

function lerBD() {
    const data = localStorage.getItem(KEY_BD)
    if (data) {
        listaRegistros = JSON.parse(data)
    }
    desenhar()
}

function pesquisar(value) {
    FILTRO = value
    desenhar()
}

function desenhar() {
    const tbody = document.getElementById('listaRegistrosBody')
    if (tbody) {
        let data = listaRegistros.usuarios

        if (FILTRO.trim()) {
            const expReg = new RegExp(FILTRO.trim().replace(/[^\d\w]+/g, '.*'), 'i')
            data = data.filter(usuario => {
                return expReg.test(usuario.nome) || expReg.test(usuario.rfid)
            })
        }

        data = data
            .sort((a, b) => a.nome.localeCompare(b.nome))
            .map(usuario => {
                return `
                    <tr>
                        <td>${usuario.rfid}</td>
                        <td>${usuario.nome}</td>
                        <td>${usuario.especi}</td>
                        <td>${usuario.turno}</td>
                        <td>
                            <button class='editar' onclick='visualizar("cadastro", false, "${usuario.rfid}")'>Editar</button>
                            <button class='deletar' onclick='perguntarSeDeleta("${usuario.rfid}")'>Deletar</button>
                        </td>
                    </tr>`
            })

        tbody.innerHTML = data.join('')
    }
}

function insertUsuario(rfid, nome, especi, turno) {
    const id = listaRegistros.ultimoIdGerado + 1
    listaRegistros.ultimoIdGerado = id
    listaRegistros.usuarios.push({
        rfid, nome, especi, turno
    })
    gravarBD()
    desenhar()
    visualizar('lista')
}

function editUsuario(rfid, nome, especi, turno) {
    const usuario = listaRegistros.usuarios.find(u => u.rfid == rfid)
    if (usuario) {
        usuario.nome = nome
        usuario.especi = especi
        usuario.turno = turno
        gravarBD()
        desenhar()
        visualizar('lista')
    }
}

function deleteUsuario(rfid) {
    listaRegistros.usuarios = listaRegistros.usuarios.filter(u => u.rfid != rfid)
    gravarBD()
    desenhar()
}

function perguntarSeDeleta(rfid) {
    if (confirm('Quer deletar o registro de RFID ' + rfid + '?')) {
        deleteUsuario(rfid)
    }
}

function limparEdicao() {
    document.getElementById('rfid').value = ''
    document.getElementById('nome').value = ''
    document.getElementById('especi').value = ''
    document.getElementById('turno').value = ''
}

function visualizar(pagina, novo = false, rfid = null) {
    document.body.setAttribute('page', pagina)

    if (pagina === 'cadastro') {
        if (novo) limparEdicao()

        if (rfid) {
            const usuario = listaRegistros.usuarios.find(u => u.rfid == rfid)
            if (usuario) {
                document.getElementById('rfid').value = usuario.rfid
                document.getElementById('nome').value = usuario.nome
                document.getElementById('especi').value = usuario.especi
                document.getElementById('turno').value = usuario.turno
            }
        }

        document.getElementById('rfid').focus()
    }
}

function submeter(e) {
    e.preventDefault()
    const data = {
        rfid: document.getElementById('rfid').value,
        nome: document.getElementById('nome').value,
        especi: document.getElementById('especi').value,
        turno: document.getElementById('turno').value,
    }

 
    const usuarioExistente = listaRegistros.usuarios.find(u => u.rfid == data.rfid)

    if (usuarioExistente) {
        editUsuario(data.rfid, data.nome, data.especi, data.turno)
    } else {
        insertUsuario(data.rfid, data.nome, data.especi, data.turno)
    }
}

function toggleMenu() {
  document.querySelector('.menu').classList.toggle('show');
}

window.addEventListener('load', () => {
    lerBD()
    document.getElementById('cadastroRegistros').addEventListener('submit', submeter)
    document.getElementById('inputPesquisa').addEventListener('keyup', e => pesquisar(e.target.value))
})