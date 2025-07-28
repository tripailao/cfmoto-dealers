// Confirm delete user
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.dataset.id;
            const title = this.dataset.title;
            const text = this.dataset.text;
            const confirmButtonText = this.dataset.confbtntxt;

            Swal.fire({
                icon: 'warning',
                title: title,
                text: text,
                showCancelButton: true,
                confirmButtonColor: '#d33',
                //cancelButtonColor: '#3085d6',
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar el formulario
                    document.getElementById(`delete-user-${userId}`).submit();
                }
            });
        });
    });
});
