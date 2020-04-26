function login() {
    let login_form = document.getElementById('login_form');
    login_form.setAttribute('style','display: inline-block;')

    let reg_form = document.getElementById('registration_form');
    reg_form.setAttribute('style','display: none;')
}
function registr() {
    let login_form = document.getElementById('login_form');
    login_form.setAttribute('style','display: none;')

    let reg_form = document.getElementById('registration_form');
    reg_form.setAttribute('style','display: inline-block;')
}