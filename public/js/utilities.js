/**
 * Script con la logica de los componentes y
 * funciones de utilidades para facilitar la vida
 */

/* Inicializar componentes */
// Acordeones
document.querySelectorAll('.acordeon-toggle').forEach(a => {
    a.addEventListener('click', e =>
        e.currentTarget.parentElement.classList.toggle('show'))
})

// Tooltips
document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(tooltipEl => {
    new bootstrap.Tooltip(tooltipEl)
})

// Validaciones genericas de formularios
const forms = document.querySelectorAll('.needs-validation')

Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')
    }, false)
})