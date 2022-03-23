const model = document.getElementById('model');
const mark = document.querySelector('#mark');
const deleteBtns = document.querySelectorAll('.btnDelete');
const modelToPreselect = document.getElementById('modelToPreselect').value;

// console.log(document.getElementById('modelToPreselect'));

if(mark.value == 0){
    mark.addEventListener('change', function (e) {
        fetchModelOnValue(e.target.value);

    })
}
else {
    fetchModelOnValue(mark.value);
    mark.addEventListener('change', function (e) {
        fetchModelOnValue(e.target.value);

    })
}

deleteBtns.forEach((btn) => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        if(confirm("Are you sure you want to delete?")) {
            deleteCar(e.target.getAttribute('data-id')).then(response => response.json()).then(data => {
                document.getElementById('message').innerHTML = `
                <div class="alert alert-success">
                        <ul>
                            <li>${data.Message}</li>
                        </ul>
                </div>
                `
                window.scrollTo(0, 0);
                document.getElementById('car-' + e.target.getAttribute('data-id')).remove();
                setTimeout(() => {
                    document.getElementById('message').innerHTML = '';
                }, 2500)
                // window.scrollTo(0, 0);
                // setTimeout(() => {
                //     location.reload();
                // }, 1500);
            }).catch(error => {
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

async function fetchModel(markId){
    const data = await fetch('/models/' + markId);

    return await data.json();
}

function deleteCar(id){
    return fetch('/cars/' + id, {
        headers: {
            "Accept": "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "delete"
    });
}

function fetchModelOnValue(value){
    fetchModel(value).then(data => {
        model.removeAttribute('disabled');
        let html = '<option value="0">Any model</option>'
        data.forEach((option) => {
            html += `
            <option value="${option.id}" ${option.id == modelToPreselect ? "selected" : ""} >${option.model}</option>
            `
        })
        model.innerHTML = html;
    });
}

