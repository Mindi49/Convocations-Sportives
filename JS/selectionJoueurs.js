let selects = document.querySelectorAll('#joueursConvoques select');

selects.forEach(function (select) {
    selects.forEach(function (s) {
        if(s !== select) {
            // suppression de la nouvelle option dans les autres select
            for (let optionsKey in s.options) {
                if (s.options[optionsKey] !== undefined && select.value && s.options[optionsKey].value === select.value) {
                    s.removeChild(s.options[optionsKey]);
                }
            }
        }
    });

    let actualSelectedOption = select.options[select.selectedIndex];

    select.addEventListener('change', function(e) {
        let t = e.target;
        processChange(actualSelectedOption,t.options[t.selectedIndex],t);
        actualSelectedOption = t.options[t.selectedIndex];
    });
});

function processChange(oldValue,newValue,target) {
    selects.forEach(function (s) {
        if (s !== target) {
            // rajout de l'ancienne option dans les autres select
            if(oldValue.value) {
                let optionCloned = oldValue.cloneNode(true);
                optionCloned.removeAttribute('selected');
                s.appendChild(optionCloned);
            }

            // suppression de la nouvelle option dans les autres select
            for (let optionsKey in s.options) {
                if (s.options[optionsKey] !== undefined && newValue.value && s.options[optionsKey].value === newValue.value) {
                    s.removeChild(s.options[optionsKey]);
                }
            }
        }
    });
}