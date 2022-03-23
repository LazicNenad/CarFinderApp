const deleteBtns = document.querySelectorAll('.delete');

deleteBtns.forEach((btn) => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        let idToDelete = e.target.getAttribute('data-delete');

        deleteUser(idToDelete).then(res => res.json()).then(data => location.reload()).catch(error => {
            document.getElementById('message').innerHTML = `
            <div class="alert alert-danger">
                      ${error.message}
            </div>
            `
        });
    })
})


function deleteUser(id) {
    return fetch('/admin/adminUser/' + id, {
        method: "delete",
        headers: {
            "Accept": "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
}
