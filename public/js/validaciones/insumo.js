// formulario
const formulario = document.getElementById('form-insumo')
// campos
const iDescripcion = document.getElementById('descripcion')
const iCodigo = document.getElementById('codigo')

// expresiones regulares
const regAlfanumerico = /^[A-Za-zá-úÁ-ÚñÑ0-9., ]*$/

// validaciones
function validarDescripcion() {
    let valor = iDescripcion.value.trim()
    const elTexto = iDescripcion.parentElement.querySelector('.form-text')

    if (valor.length <= 0) {
        elTexto.textContent = "Este campo es obligatorio"
        iDescripcion.classList.add('is-invalid')
        return false
    }
    if (!regAlfanumerico.test(valor)) {
        elTexto.textContent = "Solo puede contener letras y números"
        iDescripcion.classList.add('is-invalid')
        return false
    }
    iDescripcion.classList.remove('is-invalid')
    iDescripcion.classList.add('is-valid')
    return true
}

function validarCodigo() {
    let valor = iCodigo.value.trim()
    const elTexto = iCodigo.parentElement.querySelector('.form-text')

    if (!regAlfanumerico.test(valor)) {
        elTexto.textContent = "Solo puede contener letras y números"
        iCodigo.classList.add('is-invalid')
        return false
    }
    iCodigo.classList.remove('is-invalid')
    iCodigo.classList.add('is-valid')
    return true
}

// validar al desenfocar campo o al enviar formulario
iDescripcion.addEventListener('blur', validarDescripcion)
iCodigo.addEventListener('blur', validarCodigo)

formulario.addEventListener('submit', event => {
    if (!validarDescripcion() || !validarCodigo()) {
        event.preventDefault()
        event.stopPropagation()
    }
})