const deleteBtns = document.querySelectorAll('.btnDelete');


deleteBtns.forEach((btn) => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        if(confirm("Are you sure you want to delete?")) {
            deleteCar(e.target.getAttribute('data-id')).then(response => response.json()).then(data => {
                console.log(data);
                document.getElementById('message').innerHTML = `
                <div class="alert alert-success">
                        <ul>
                            <li>${data.Message}</li>
                        </ul>
                </div>
                `
                document.getElementById('car-' + e.target.getAttribute('data-id')).parentElement.parentElement.remove();
                setTimeout(() => {
                    document.getElementById('message').innerHTML = '';
                }, 2500)
            }).catch(error => {
                console.log(error);
                document.getElementById('message').innerHTML = `
                <div class="alert alert-danger">
                        <ul>
                            <li>${error.ErrorMessage}</li>
                        </ul>
                </div>
                `
            });

        }

    })
})

function deleteCar(id){
    return fetch('/cars/' + id, {
        headers: {
            "Accept": "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "delete"
    });
}
