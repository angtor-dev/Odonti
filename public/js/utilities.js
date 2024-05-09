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