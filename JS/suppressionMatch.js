
function supprimerMatch(numMatch, btn) {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?action=supprimerMatch',true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.responseType = 'json';
    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
            let json = xhr.response;
            if (json.hasOwnProperty('warning')) {
                document.querySelector('#messageSuppressionMatch').textContent = json.warning;
                $(document.querySelector('#alerteSuppressionMatch')).collapse('show');
            }
            else {
                $(document.querySelector('#alerteSuppressionMatch')).collapse('hide');
            }
            btn.parentNode.parentNode.parentNode.removeChild(btn.parentNode.parentNode);

        }
    };
    xhr.send('num=' + numMatch);
}

$(document.querySelector('#fermetureMessageSuppressionMatch')).click(function () {
    $(document.querySelector('#alerteSuppressionMatch')).collapse('hide');
});