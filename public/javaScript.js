function tooLongInput(e, word, errorElementText, errorMsg) {

    if (word.length > 255) {
        e.preventDefault();
        errorElementText.style.display = "block";
        errorElementText.classList.add('errorMessage');
        errorElementText.innerText = errorMsg;
    } else {
        errorElementText.style.display = "none";
    }

}

function checkDays(e) {
    let errorElementDays = document.getElementById('errorDays')
    if ($('input:checkbox').filter(':checked').length < 1) {

        e.preventDefault();
        errorElementDays.classList.add('errorMessage');
        errorElementDays.style.display = "block";
        errorElementDays.innerText = "Treba zadať aspoň 1 deň!";
    } else {
        errorElementDays.style.display = "none";
    }

}

function checkBirthdate(e) {

    let bday = document.getElementById('bday').value;
    let today = new Date();
    let birthdate = new Date(bday);

    let age = Math.abs(today.getFullYear() - birthdate.getFullYear());

    if (birthdate.getMonth() < today.getMonth()) {
        age--;
    } else if (birthdate.getMonth() == today.getMonth()) {
        if (birthdate.getDay() < today.getDay()) {
            age--;
        }
    }

    let errorElementBday = document.getElementById('errorBirthdate')
    if (age < 15) {
        e.preventDefault();
        errorElementBday.classList.add('errorMessage');
        errorElementBday.style.display = "block";
        errorElementBday.innerText = "Užívateľ musí byť starší ako 15 rokov!";
    } else if (age > 150) {
        e.preventDefault();
        errorElementBday.classList.add('errorMessage');
        errorElementBday.style.display = "block";
        errorElementBday.innerText = "Nesprávne zadaný dátum narodenia!";
    } else {
        errorElementBday.style.display = "none";
    }


}

function checkCities(e) {

    let city = document.getElementById('city').value;
    let errorElementCity = document.getElementById('errorCity');
    if (!checkCity(city)) {
        e.preventDefault();
        errorElementCity.classList.add('errorMessage');
        errorElementCity.style.display = "block";
        errorElementCity.innerText = "Zadané mesto neexistuje!";
    } else {
        errorElementCity.style.display = "none";
    }

}


function checkCity(city) {

    let cities = ['Bratislava', 'Košice', 'Prešov', 'Žilina', 'Banská Bystrica', 'Nitra', 'Trnava', 'Trenčín', 'Martin', 'Poprad', 'Prievidza',
        'Zvolen', 'Považská Bystrica', 'Michalovce', 'Nové Zámky', 'Spišská Nová Ves', 'Komárno', 'Humenné', 'Levice', 'Bardejov', 'Liptovský Mikuláš',
        'Lučenec', 'Piešťany', 'Ružomberok', 'Topoľčany', 'Trebišov', 'Čadca', 'Dubnica nad Váhom', 'Rimavská Sobota', 'Pezinok', 'Partizánske', 'Dunajská Streda',
        'Vranov nad Topľou', 'Šaľa', 'Hlohovec', 'Brezno', 'Senica', 'Nové Mesto nad Váhom', 'Snina', 'Senec', 'Rožňava', 'Žiar nad Hronom', 'Dolný Kubín', 'Bánovce nad Bebravou',
        'Púchov', 'Malacky', 'Handlová', 'Kežmarok', 'Stará Ľubovňa', 'Sereď', 'Kysucké Nové Mesto', 'Galanta', 'Skalica', 'Levoča', 'Detva', 'Šamorín', 'Sabinov',
        'Revúca', 'Veľký Krtíš', 'Myjava', 'Zlaté Moravce', 'Stupava', 'Bytča', 'Moldava nad Bodvou', 'Holíč', 'Nová Dubnica', 'Svidník', 'Stropkov', 'Fiľakovo',
        'Kolárovo', 'Štúrovo', 'Banská Štiavnica', 'Šurany', 'Tvrdošín', 'Veľké Kapušany', 'Modra', 'Stará Turá', 'Krompachy', 'Vráble', 'Veľký Meder', 'Sečovce', 'Krupina',
        'Námestovo', 'Svit', 'Vrútky', 'Turzovka', 'Hriňová', 'Liptovský Hrádok', 'Kráľovský Chlmec', 'Hnúšťa', 'Hurbanovo', 'Trstená', 'Nová Baňa', 'Šahy', 'Tornaľa',
        'Želiezovce', 'Krásno nad Kysucou', 'Spišská Belá', 'Medzilaborce', 'Lipany', 'Turčianske Teplice', 'Nemšová', 'Sobrance', 'Žarnovica', 'Veľký Šariš', 'Gelnica',
        'Vrbové', 'Rajec', 'Poltár', 'Dobšiná', 'Svätý Jur', 'Ilava', 'Gabčíkovo', 'Kremnica', 'Sládkovičovo', 'Gbely', 'Nesvady', 'Šaštín-Stráže', 'Sliač', 'Bojnice',
        'Brezová pod Bradlom', 'Medzev', 'Strážske', 'Turany', 'Nováky', 'Trenčianske Teplice', 'Tisovec', 'Leopoldov', 'Giraltovce', 'Vysoké Tatry', 'Spišské Podhradie',
        'Hanušovce nad Topľou', 'Čierna nad Tisou', 'Tlmače', 'Spišsk Vlachy', 'Jelšava', 'Podolínec', 'Rajecké Teplice', 'Spišská Stará Ves', 'Modrý Kameň', 'Dudince'
    ];

    let exists = false;

    cities.forEach((attrName) => {
        if (city === attrName) {
            exists = true
        }
    })
    return exists;

}




window.onload = function () {
    let editProfileForm = document.getElementById("editUserDataForm");
    if (editProfileForm != null) {
        editProfileForm.addEventListener("submit", (e) => {
            checkCities(e);
            checkBirthdate(e);
            checkDays(e);
            let word = document.getElementById('name').value;
            let errorElement = document.getElementById('errorName');
            tooLongInput(e, word, errorElement, 'Zle zadané meno');
            word = document.getElementById('last_name').value;
            errorElement = document.getElementById('errorLastName');
            tooLongInput(e, word, errorElement, 'Zle zadané priezisko');
        })

    }

};


window.onload = function () {
    let addQuestionForm = document.getElementById("addQuestion");
    if (addQuestionForm != null) {
        addQuestionForm.addEventListener("submit", (e) => {
            let word = document.getElementById('title').value;
            let errorElementCity = document.getElementById('errorTitle');
            tooLongInput(e,word, errorElementCity, 'Zadaný nadspis je príliš dlhý!');
        })
    }

};

