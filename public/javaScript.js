let registerForm = document.getElementById("registerForm");
let editProfileForm = document.getElementById("editProfileForm");
let lostDogForm = document.getElementById("addPostLostDog");

if (editProfileForm != null) {
    window.onload = function () {
        let citiesInput = document.getElementById('city').value;
        checkCities(editProfileForm,citiesInput);

    };
}

if (registerForm != null) {
    window.onload = function () {
        checkForm();
    };
}


if (lostDogForm != null) {
    window.onload = function () {
        let citiesInput = document.getElementById('location').value;
        checkCities(lostDogForm,citiesInput);
        //checkForm();

    };
}

function checkDate() {
    registerForm.addEventListener("submit", (e) => {
        let bday = document.getElementById('bday').value;
        let today = new Date();
        let birthdate = new Date(bday);

        let age = today.getFullYear() - birthdate.getFullYear();

        if (birthdate.getMonth() < today.getMonth()) {
            age--;
        } else if (birthdate.getMonth() == today.getMonth()) {
            if (birthdate.getDay() < today.getDay()) {
                age--;
            }
        }

        if (age < 15) {
            errorElement = document.getElementById('errorBirthdate')
            e.preventDefault();
            errorElement.classList.add('errorMessage');
            errorElement.innerText = "Užívateľ musí byť starší ako 15 rokov!";
        }

    })


    lostDogForm.addEventListener("submit", (e) => {
        let lost = document.getElementById('lost_date').value;
        let today = new Date();
        let lostDate = new Date(lost);
        alert("HALO");
        if (today < lostDate) {
            errorElement = document.getElementById('errorBirthdate')
            e.preventDefault();
            errorElement.classList.add('errorDate');
            errorElement.innerText = "Zadaný dátum ešte nenastal!";
        }

    })
}

function checkCities(element, city) {
    element.addEventListener("submit", (e) => {
            if (!checkCity(city)) {
                errorElementCity = document.getElementById('city');
                e.preventDefault();
                errorElementCity.classList.add('errorCity');
                errorElementCity.innerText = "Zadané mesto neexistuje!";
            }
    });
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

function removeWhiteSpacesAtTheEndAndBeggining(string){
    let index= 0;
    toString(string);
    while (string.charAt(index)==' ')
    {
        console.log("mazem whitespace na zaciatku");
        index++;
    }
    let begginIndex=index;

    index=string.length;
    while (string.charAt(index)==' ')
    {
        console.log("mazem whitespace na konci");
        index--;
    }
    let endIndex=index;
    let subString=string.substring(begginIndex,endIndex);
    console.log(subString);
    return subString;
}

