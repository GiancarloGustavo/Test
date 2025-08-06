function toggleForm(){
    const form = document.querySelector('.insert');
    form.classList.toggle('active');
}

function showUpdateForm(button) {
    const formUpdate = button.nextElementSibling;

    // Vérifie si c'est bien le formulaire attendu
    if (formUpdate && formUpdate.classList.contains('update-div')) {
        formUpdate.classList.toggle('affiche');
    }
}
