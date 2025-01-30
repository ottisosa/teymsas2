import server from "./server.js";

export default class userDAO {
    async login(email_user, password_user) {
        let url = server + "/UserController.php?function=login";
        let formData = new FormData();
        formData.append("email_user", email_user);
        formData.append("password_user", password_user);
        let config = {
            method: "POST",
            body: formData
        }
        let response = await fetch(url, config);
        let json = await response.json();

        if (json.success) {
            window.localStorage.setItem("session", true);
            window.localStorage.setItem("userData", JSON.stringify(json.data));
        }

        return json;
    }

    async updatePassword(currentPassword, newPassword){
        let url = server + "/UserController.php?function=updatePassword";
        let formData = new FormData();
        formData.append("current_password", currentPassword);
        formData.append("new_password", newPassword);
        let config = {
            method: "POST",
            body: formData
        }
        let response = await fetch(url, config);
        let json = await response.json();

        return json;
    }

    getLocalSession() {
        let session = window.localStorage.getItem("session");
        if (session) {
            return true;
        } else {
            return false;
        }
    }

    async getSession() {
        let url = server + "/UserController.php?function=getSession";
        let response = await fetch(url);
        let json = await response.json();
        if(!json.success){
            window.localStorage.removeItem("session");
            window.localStorage.removeItem("userData");
        }
    }
    async getSessionAdmin() {
        let url = server + "/UserController.php?function=getSessionAdmin";
        let response = await fetch(url);
        let json = await response.json();
        if(!json.success){
            window.localStorage.removeItem("session");
            window.localStorage.removeItem("userData");
            return false;
        }
        return true;
    }

    async logoutSession() {
        let url = server + "/UserController.php?function=logout";
        let response = await fetch(url);
        let json = await response.json();
        window.localStorage.removeItem("session");
        return json;
    }

}