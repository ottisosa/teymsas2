import userDAO from './DAO/userDAO.js';

const user = JSON.parse(window.localStorage.getItem("userData"));
document.querySelector("#complete_name_user").value = user.user_name;
document.querySelector("#email_user").value = user.user_email;
document.querySelector("#phone_user").value = user.user_phone;


document.querySelector("#logout").addEventListener("click", async function (e) {
    e.preventDefault();
    const result = await new userDAO().logoutSession();
    if (result.success) {
        alert(result.message);
        location.href = "http://localhost/teymsas2/public/user/";

    } else {
        alert(result.message);
    }
});


document.querySelector("#changePassword").addEventListener("submit", async function (e) {
    e.preventDefault();
    let currentPassword = document.querySelector("#current_password").value;
    let newPassword =document.querySelector("#new_password").value;
    let confirmPassword =document.querySelector("#confirm_password").value;

    if (newPassword === confirmPassword){
        const result = await new userDAO().updatePassword(currentPassword, newPassword);
        if (result.success) {
            alert(result.message);
            location.href = "http://localhost/teymsas2/public/user/";
        } else {
            alert(result.error);
        }

    } else {
        alert("La confirmacion de contraseñas no coincide")
    }
});
