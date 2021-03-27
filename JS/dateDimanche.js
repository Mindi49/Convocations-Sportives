
var today = new Date().toISOString().split('T')[0];
document.querySelector('input[type=date]').setAttribute('min', today);

var date = document.querySelector('input[type=date]');
function weekEnd(e) {
    var jour = new Date(e.target.value).getUTCDay();
    if(jour === 0){
        e.target.setCustomValidity('');

    } else {
        e.target.setCustomValidity('Veuillez choisir une date valide (Dimanche)');
    }
}
date.addEventListener('change',weekEnd);