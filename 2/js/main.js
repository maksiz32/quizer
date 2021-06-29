window.onload = function() {
    const drpmenu = document.getElementById('dropmenu');
    const submenu = document.querySelector(".my-dropdown-menu");
    drpmenu.addEventListener('click', () => {
        submenu.classList.toggle('hide');
    })

    const forClose = document.querySelector(".navbar-toggler");
    const closed = document.querySelector("#closed");
    forClose.addEventListener('click', () => {
            closed.classList.toggle('navbar-toggler-icon');
            closed.classList.toggle('icon-cancel');
    })
}