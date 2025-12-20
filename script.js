document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("form");
    if (!form) return;

    const userErr = document.getElementById("err_username");
    const passErr = document.getElementById("err_password");
    const confirmErr = document.getElementById("err_confirm");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        userErr.textContent = "";
        passErr.textContent = "";
        confirmErr.textContent = "";

        let isValid = true;

        const username = form.querySelector("input[name='username']");
        const password = form.querySelector("input[name='password']");
        const confirmPwd = form.querySelector("input[name='confirm_password']");

        if (username.value.length < 3) {
            userErr.textContent = "Le nom d'utilisateur doit contenir au moins 3 caractères.";
            isValid = false;
        }

        if (password.value.length < 6) {
            passErr.textContent = "Le mot de passe doit contenir au moins 6 caractères.";
            isValid = false;
        }

        if (password.value !== confirmPwd.value) {
            confirmErr.textContent = "Les mots de passe ne correspondent pas.";
            isValid = false;
        }

        if (isValid) form.submit();
    });

});
