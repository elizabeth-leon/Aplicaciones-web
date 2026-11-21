// Pedir confirmación antes de borrar un registro.
document.querySelectorAll('form[data-confirm]').forEach(form=>{
    form.addEventListener('submit', event=>{if(!confirm(form.dataset.confirm)) event.preventDefault();});
});
