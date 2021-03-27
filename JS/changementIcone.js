function changeIcon(e,iconLock) {
    let lock = e.firstChild.classList;
    if(iconLock) {
        lock.replace("fa-unlock", "fa-lock");
        lock.replace("fa-door-open","fa-door-closed");
    }
    else {
        lock.replace("fa-lock","fa-unlock");
        lock.replace("fa-door-closed", "fa-door-open");
    }
}