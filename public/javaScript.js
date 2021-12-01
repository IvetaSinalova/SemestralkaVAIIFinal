let registerForm = document.getElementById("registerForm");
let editProfileForm = document.getElementById("editProfileForm");

function checkForm(){
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
            errorElement= document.getElementById('errorBirthdate')
            e.preventDefault();
            errorElement.classList.add('errorMessage');
            errorElement.innerText = "Užívateľ musí byť starší ako 15 rokov!";
        }

    })
}

function checkCities(){
    editProfileForm.addEventListener("submit", (e) => {
        let citiesInput = document.getElementById('cities').value;
        let citiesArray = citiesInput.split(", ");

        citiesArray.forEach((city)=>{
            if (!checkCity(city)) {
                errorElementCity = document.getElementById('errorCities');
                e.preventDefault();
                errorElementCity.classList.add('errorMessage');
                errorElementCity.innerText = "Mestá nie sú zadané správne!";
            }
        })
    });

}


function checkCity(city){

    let cities= ['Bratislava','Košice','Prešov','Žilina','Banská Bystrica','Nitra','Trnava','Trenčín','Martin','Poprad','Prievidza',
        'Zvolen','Považská Bystrica','Michalovce','Nové Zámky','Spišská Nová Ves','Komárno','Humenné','Levice','Bardejov','Liptovský Mikuláš',
        'Lučenec','Piešťany','Ružomberok','Topoľčany','Trebišov','Čadca','Dubnica nad Váhom','Rimavská Sobota','Pezinok','Partizánske','Dunajská Streda',
        'Vranov nad Topľou','Šaľa','Hlohovec','Brezno','Senica','Nové Mesto nad Váhom','Snina','Senec','Rožňava','Žiar nad Hronom','Dolný Kubín','Bánovce nad Bebravou',
        'Púchov','Malacky','Handlová','Kežmarok','Stará Ľubovňa','Sereď','Kysucké Nové Mesto','Galanta','Skalica','Levoča','Detva','Šamorín','Sabinov',
        'Revúca','Veľký Krtíš', 'Myjava', 'Zlaté Moravce', 'Stupava', 'Bytča', 'Moldava nad Bodvou','Holíč','Nová Dubnica','Svidník','Stropkov', 'Fiľakovo',
        'Kolárovo','Štúrovo','Banská Štiavnica','Šurany','Tvrdošín','Veľké Kapušany','Modra','Stará Turá','Krompachy','Vráble','Veľký Meder','Sečovce','Krupina',
        'Námestovo','Svit','Vrútky','Turzovka','Hriňová','Liptovský Hrádok','Kráľovský Chlmec','Hnúšťa','Hurbanovo','Trstená','Nová Baňa','Šahy','Tornaľa',
        'Želiezovce','Krásno nad Kysucou','Spišská Belá','Medzilaborce','Lipany','Turčianske Teplice','Nemšová','Sobrance','Žarnovica','Veľký Šariš','Gelnica',
        'Vrbové','Rajec','Poltár','Dobšiná','Svätý Jur','Ilava','Gabčíkovo','Kremnica','Sládkovičovo','Gbely','Nesvady','Šaštín-Stráže','Sliač','Bojnice',
        'Brezová pod Bradlom','Medzev','Strážske','Turany','Nováky','Trenčianske Teplice','Tisovec','Leopoldov','Giraltovce','Vysoké Tatry','Spišské Podhradie',
        'Hanušovce nad Topľou', 'Čierna nad Tisou','Tlmače','Spišsk Vlachy','Jelšava','Podolínec','Rajecké Teplice','Spišská Stará Ves','Modrý Kameň','Dudince'
    ];

    let exists=false;

    cities.forEach((attrName)=>{
        if(city===attrName)
        {
            exists= true
        }
    })
    return exists;

}

if(editProfileForm != null)
{
    window.onload = function (){
        checkCities();
    };
}


if(registerForm != null)
{
    window.onload = function (){
        checkForm();
    };
}



