class User {

    getUsers(action) {
        fetch(action)
            .then(response => response.json())
            .then(data => {
                let posts = "";
                let errorElementFindByCity = document.getElementById('errorFindByCity');
                errorElementFindByCity.classList.add('msgSearch');
                errorElementFindByCity.style.display = "block";
                if (data == "errorNoResults") {
                    errorElementFindByCity.innerText = "V zadanom meste nikto nevenčí";
                    document.getElementById("postsUsers").innerHTML = posts;
                } else if (data == "errorWrongCity") {
                    errorElementFindByCity.innerText = "Zadané mesto neexistuje";
                    document.getElementById("postsUsers").innerHTML = posts;
                } else {
                    for (let user of data) {
                        errorElementFindByCity.style.display = "none";
                        let photo = "public/files/" + user.profile_picture;
                        let name = user.name + " " + user.last_name;
                        if (!user.profile_picture) {
                            photo = "http://ssl.gstatic.com/accounts/ui/avatar_2x.png";
                        }
                        posts += "<div class=\"col-sm-6 col-md-4 text-center forum-text\">" +
                            "<div class=\"card-content\">" +
                            "<img class=\"crop\" src=\"" + photo + "\" alt=\"profile_picture_\"" + name + ">" +
                            "<div class=\"card-desc text-center\">" +
                            "<div class='col-12 user-name'><h5>" + name + "</h5></div>" +
                            "<p>Cena: " + user.payment + "</p>" +
                            "<p>Mesto: " + user.city + "</p>" +
                            "<p>Dni: " + user.days_available + "</p>" +
                            "<form method=\"post\" action=\"?c=home&a=getProfile\" >" +
                            " <input type=\"hidden\" name=\"id\" id=\"id\" value=\"" + user.id + "\">" +
                            "<button type=\"submit\" class=\"btn btn-card\">" +
                            "  Zobraziť profil" +
                            " </button>" +
                            " </form>" +
                            "</div>" +
                            "</div>" +
                            "</div>"
                        document.getElementById("postsUsers").innerHTML = posts;
                    }

                }
            })
    }

    getAllUsers() {
        this.getUsers('?a=getAllUsers');
    }


    filterByCity() {
        let city = document.getElementById('searchByCity').value;
        if (!checkCity(city)) {
            let posts = ""
            let errorElementFindByCity = document.getElementById('errorFindByCity');
            errorElementFindByCity.classList.add('msgSearch');
            errorElementFindByCity.style.display = "block";
            errorElementFindByCity.innerText = "Zadané mesto neexistuje";
            document.getElementById("postsUsers").innerHTML = posts;
        } else {
            let action = "?a=findByCity&searchByCity=" + city;
            this.getUsers(action);
        }


    }
}


window.onload = function () {
    var user = new User();
    user.getAllUsers();
    document.getElementById('btn-send').onclick = () => user.filterByCity();

}