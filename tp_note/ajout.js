function ajouterLivre() {
    const titre = this.titre;
    const auteur = this.auteur;
    const genre = this.genre;
    let data = new FormData();
    data.append('titre', titre);
    data.append('auteur', auteur);
    data.append('genre', genre);
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '/ajout.php', true);
    xhr.send(data);
    xhr.onload = function () {
        if (xhr.status === 200) {
            $("#message").html("<div class='alert alert-success' role='alert'>  La modification est enregistrée ! <button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span></button></div>");
        } else {
            $("#message").html("<div class='alert alert-danger' role='alert'> Erreur lors de l'enregistrement. Veuillez recommencer <button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span></button></div>");
        }
    };
}