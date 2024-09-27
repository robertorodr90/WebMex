document.getElementById('task-form').addEventListener('submit', function (event) {
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;

    if (title === '' || description === '') {
        event.preventDefault();
        alert('Por favor, completa todos los campos.');
    }
});