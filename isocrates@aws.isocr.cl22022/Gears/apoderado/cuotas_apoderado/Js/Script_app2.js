// Verifica si existe el formulario 'form-cuotas'
const formCuotas = document.getElementById('form-cuotas');
if (formCuotas) {
    formCuotas.addEventListener('submit', function (e) {
        const checkboxes = document.querySelectorAll('input[name="cuota[]"]:checked');
        if (checkboxes.length === 0) {
            e.preventDefault();
            alert('Debe seleccionar al menos una cuota para continuar con el pago.');
        }
    });
}

// Verifica si existe el formulario 'resumen-pago'
const resumenPago = document.getElementById('resumen-pago');
if (resumenPago) {
    resumenPago.addEventListener('submit', function(e) {
        const pasarelaSeleccionada = document.querySelector('input[name="pasarela"]:checked');
        const montoTotalInput = document.querySelector('input[name="monto_total"]');
        const montoTotal = montoTotalInput ? montoTotalInput.value : '';

        if (!pasarelaSeleccionada) {
            e.preventDefault(); // Detiene el envío del formulario
            alert('Debes seleccionar una Pasarela de Pago para continuar.');
            return;
        }

        const nombrePasarela = pasarelaSeleccionada.nextElementSibling
            ? pasarelaSeleccionada.nextElementSibling.textContent.trim()
            : '';
        const mensaje = '¿Estás seguro que deseas pagar ' + montoTotal + ' utilizando la pasarela ' + nombrePasarela + '?';

        const confirmacion = confirm(mensaje);
        if (!confirmacion) {
            e.preventDefault(); // Detiene el envío si el usuario cancela
        }
    });
}
