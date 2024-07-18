// expresiones regulares
const regAlfanumerico = /^[A-Za-zá-úÁ-ÚñÑ0-9., ]*$/
const regClave = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/

// validaciones
function validarNombre() {
    const iNombre = document.getElementById('nombre')
    let valor = iNombre.value.trim()
    const elTexto = iNombre.parentElement.querySelector('.form-text')

    if (valor.length <= 0) {
        elTexto.textContent = "Este campo es obligatorio"
        iNombre.classList.add('is-invalid')
        return false
    }
    if (!regAlfanumerico.test(valor)) {
        elTexto.textContent = "Solo puede contener letras y números"
        iNombre.classList.add('is-invalid')
        return false
    }
    iNombre.classList.remove('is-invalid')
    iNombre.classList.add('is-valid')
    return true
}

function validarApellido() {
    const iApellido = document.getElementById('apellido')
    let valor = iApellido.value.trim()
    const elTexto = iApellido.parentElement.querySelector('.form-text')

    if (valor.length <= 0) {
        elTexto.textContent = "Este campo es obligatorio"
        iApellido.classList.add('is-invalid')
        return false
    }
    if (!regAlfanumerico.test(valor)) {
        elTexto.textContent = "Solo puede contener letras y números"
        iApellido.classList.add('is-invalid')
        return false
    }
    iApellido.classList.remove('is-invalid')
    iApellido.classList.add('is-valid')
    return true
}

function agregarValidaciones() {
    // formulario
    const formulario = document.getElementById('form-medico')
    // campos
    const iNombre = document.getElementById('nombre')
    const iApellido = document.getElementById('apellido')
    const iCorreo = document.getElementById('correo')

    // validar al desenfocar campo o al enviar formulario
    iNombre.addEventListener('blur', validarNombre)
    iApellido.addEventListener('blur', validarApellido)
    
    formulario.addEventListener('submit', event => {
        if (!validarNombre() || !validarApellido()) {
            event.preventDefault()
            event.stopPropagation()
        }
    })
}