const iNombre = document.getElementById('nombre')
const iDescripcion = document.getElementById('descripcion')
const regAlfanumerico = /^[A-Za-z0-9]+$/

function validarNombre() {
    let valor = iNombre.value.trim()
    const elTexto = iNombre.parentElement.querySelector('.form-text')

    if (valor.length <= 0) {
        return false
    }
    if (!regAlfanumerico.test(valor)) {
        elTexto.textContent = "Solo puede contener letras y números"
        iNombre.classList.add('is-invalid')
        return false
    }
    return true
}

