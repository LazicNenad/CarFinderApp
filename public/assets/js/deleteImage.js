const imagesToDelete = document.querySelectorAll('.delete-img');

imagesToDelete.forEach((element) => {
    element.addEventListener('click', (e) => {
        e.preventDefault();
        if (confirm("Are you sure you want to delete this picture? You wont be able to recover it after deleting!") == true) {
            deleteImage(e.target.getAttribute('data-id'))
                .then(response => response.json())
                .then(data => {
                    document.getElementById('msg').innerHTML = `
                <div class="alert-success">
                    <p>${data.success}</p>
                </div>
                `
                    element.parentElement.remove();
                })
                .catch(err => {
                    document.getElementById('msg').innerHTML = `
                <div class="alert-success">
                    <p>${err.error}</p>
                </div>
                `
                });
        }

    })
})

async function deleteImage(id) {
    return await fetch('/cars/images/' + id, {
        headers: {
            "Accept": "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "delete"
    })
}
