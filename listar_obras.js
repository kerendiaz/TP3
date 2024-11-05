async function eliminarObra(id) {
    const formData = new FormData();
    formData.append('id', id);

    await fetch('eliminar_obra.php', {
        method: 'POST',
        body: formData
    });
    listarObras(); // Actualizar la lista de obras
}