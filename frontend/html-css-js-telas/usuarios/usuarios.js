var listaRegistros = {
    ultimoIdGerado:0,
    usuarios: [
    ]
}


function desenhar(){
    const tbody = document.getElementById('listaRegistrosBody')
    if(tbody){
        tbody.innerHTML = listaRegistros.usuarios.sort( (a, b ) => {
            return a.nome < b.nome ? -1 : 1
        }).map( usuario => {
            return `<tr>
                        <td>${usuario.rfid}</td>
                        <td>${usuario.nome}</td>
                        <td>${usuario.especi}</td>
                        <td>${usuario.turno}</td>
                    </tr>`
        }).join('')
    }
}

function insertUsuario (rfid, nome, especi, turno){
    const id = listaRegistros.ultimoIdGerado + 1;
    listaRegistros.ultimoIdGerado = id;
    listaRegistros.usuarios.push({
        rfid, nome, especi, turno
    })
    desenhar()
    visualizar('lista')
}

function editUsuario (rfid, nome, especi, turno){

}

function deleteUsuario (rfid){

}

function visualizar(pagina) {
    document.body.setAttribute('page', pagina)
    if(pagina === 'cadastro') {
        document.getElementById('rfid').focus()
    }
}

function submeter(e){
    e.preventDefault()
    const data = {
        rfid: document.getElementById('rfid').value,
        nome: document.getElementById('nome').value,
        especi: document.getElementById('especi').value,
        turno: document.getElementById('turno').value
    }
    if(data.id){
        editUsuario(...data)
    }else{
        insertUsuario(data.rfid, data.nome, data.especi, data.turno)
    }
}

window.addEventListener('load', () => {
    desenhar()

    document.getElementById('cadastroRegistros').addEventListener('submit', submeter)
})