var buzones = [];
const url = '../back/api/buzon.php';
var buzonseleccionado;
function obtenerbuzones() {
    axios({
        method: 'GET',
        url: url,
        responseType: 'json',
        //params :"" si estamos enviado información
    }).then(res => {
        console.log(res.data);
        this.buzones = res.data;
        llenarTabla();
    }).catch(error => {
        console.error(error);
    });
}

obtenerbuzones();

function llenarTabla() {
    document.querySelector('#tabla-buzon tbody').innerHTML = '';
    for (let i = 0; i < buzones.length; i++) {
        document.querySelector('#tabla-buzon tbody').innerHTML +=
            `<tr>
            <td>${buzones[i].idBuzon}</td>
            <td>${buzones[i].queja}</td>
            <td>${buzones[i].fecha}</td>
            <td>${buzones[i].idColonia}</td>
            <td>${buzones[i].idQueja}</td>
            <td><button type="button" onclick="eliminar(${i})" class="btn btn-danger" btn-lg btn-block">Borrar</button></td>
            <td><button type="button" onclick="seleccionar(${i})" class="btn btn-warning" btn-lg btn-block">Seleccionar</button></td>
        </tr>`;
    }
}

function eliminar(indice) {
    console.log('Eliminar el elemento con el indice ' + indice)
    axios({
        method: 'DELETE',
        url: url + `?id=${indice}`,
        responseType: 'json',
        //params :"" si estamos enviado información
    }).then(res => {
        console.log(res.data);
        this.buzones = res.data;
        obtenerbuzones();
    }).catch(error => {
        console.error(error);
    });
}

function guardar() {
    document.getElementById('btn-guardar').disabled = true;
    document.getElementById('btn-guardar').innerHTML = 'Agregando...';
    let buzon = {
        "queja": document.getElementById('queja').value,
        "idColonia": document.getElementById('idColonia').value,
        "fecha": document.getElementById('fecha').value,
        "idBuzon": document.getElementById('idBuzon').value
    };
    console.log('buzon a guardar', buzon);
    axios({
        method: 'POST',
        url: url,
        responseType: 'json',
        data: buzon
    }).then(res => {
        console.log(res.data);
        limpiar();
        obtenerbuzones();
        document.getElementById('btn-guardar').disabled =false;
        document.getElementById('btn-guardar').innerHTML = 'Agregar';
    }).catch(error => {
        console.error(error);
    });
}

function limpiar() {
    document.getElementById('queja').value = null;
    document.getElementById('fecha').value = null;
    document.getElementById('idColonia').value = null;
    document.getElementById('idBuzon').value = null;
    document.getElementById('btn-guardar').style.display = 'inline';
    document.getElementById('btn-actualizar').style.display = 'none';
}

function actualizar() {
    let buzon = {
        "queja": document.getElementById('queja').value,
        "idColonia": document.getElementById('idColonia').value,
        "fechaNacimiento": document.getElementById('fechaNacimiento').value,
        "idBuzon": document.getElementById('idBuzon').value
    };
    console.log('buzon a actualizar', buzon);
    axios({
        method: 'PUT',
        url: url + `?id=${buzonseleccionado}`,
        responseType: 'json',
        data: buzon
    }).then(res => {
        console.log(res.data);
        limpiar();
        obtenerbuzones();
    }).catch(error => {
        console.error(error);
    });
}

function seleccionar(indice) {
    buzonseleccionado = indice;
    console.log('Se seleccionó el elemento: ' + indice);
    axios({
        method: 'GET',
        url: url + `?id=${indice}`,
        responseType: 'json',
    }).then(res => {
        console.log(res.data);
        document.getElementById('idBuzon') = res.data.idBuzon;
        document.getElementById('queja').value =res.data.queja ;
        document.getElementById('idColonia').value =res.data.idColonia ;
        document.getElementById('fecha').value =res.data.fecha ;
        document.getElementById('idBuzon').value =res.data.idBuzon ;
        document.getElementById('btn-guardar').style.display = 'none';
        document.getElementById('btn-actualizar').style.display = 'inline';
    }).catch(error => {
        console.error(error);
    });
}