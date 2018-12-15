
// document.getElementById('modal-delete-button').innerHTML = "Supprimer";
// document.getElementsByClassName('action-save').style.backgroundColor="red";
// "Cette action est irréversible."
// "Suppression des données"
// document.getElementsByClassName('action-save').innerHTML = "Ajouter";

$(document).ready(function(){

    $('.action-save').html('Ajouter');
    $('.modal-footer .btn').html('Annuler');
    $('.modal-footer #modal-delete-button').html('Supprimer');
    $('.modal-body h4').html('Supprimer définitivement');
    $('.modal-body p').html(' ');

});