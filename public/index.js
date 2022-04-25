window.onload = () => {
    let forms = document.querySelectorAll('form');
    let toastContainer = document.createElement('div');
    toastContainer.id = 'toastContainer';
    document.body.appendChild(toastContainer);

    forms.forEach((form) => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();

            fetch(form.getAttribute('action') || '', {
                method: 'POST',
                body: new FormData(form),
            })
                .then((data) => data.json())
                .then((json) => {
                    deployToast(json.message);
                });
        });
    });
};

function deployToast(text, title) {
    let toast = document.createElement('div');
    toast.classList.add('toast');
    toast.innerHTML = text;

    toast.addEventListener('click', (e) => {
        toast.remove();
    });

    document.getElementById('toastContainer').appendChild(toast);
}
