<?php

namespace App;

use App\Models\User;
use DateTime;

class Auth
{

    public static function checkDate($day)
    {
        if (Auth::isLogged()) {
            $user = User::getOne(Auth::getId());
            $days = explode(" ", $user->getDaysAvailable());

            foreach ($days as $d) {
                if ($d == $day) {
                    return true;
                }
            }
        }

        return false;

    }

    public static function checkCity($city)
    {
        $cities = ['Bratislava', 'Košice', 'Prešov', 'Žilina', 'Banská Bystrica', 'Nitra', 'Trnava', 'Trenčín', 'Martin', 'Poprad', 'Prievidza',
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
        foreach ($cities as &$c) {
            if ($c == $city) {
                return true;
            }
        }

        return false;
    }


    public static function dateAlreadyHappend($stringDate, $stringTime): bool
    {
        $date = new DateTime($stringDate . " " . $stringTime);
        $now = new DateTime();

        if ($date < $now) {
            return true;
        }

        return false;
    }

    public static function getYearsSinceDate($stringDate): int
    {
        $date = strtotime($stringDate);
        $years = abs(date('Y', $date) - date('Y'));
        if ($years > 0) {
            if (date('m') > date('m', $date)) {
                $years--;
            } else if (date('m') < date('m', $date)) {
                if (date('d') < date('d', $date)) {
                    $years--;
                }
            }
        }
        return $years;
    }


    public static function correctLengthOfInput($name)
    {
        if (strlen($name) <= 255) {
            return true;
        }
        return false;
    }


    public static function correctPassword($password)
    {
        if (strlen($password) < 6) {
            return false;
        }
        return true;
    }

    public static function login($email, $password)
    {
        $user = self::getUserByEmail($email);
        if ($email == $user->getEmail() && password_verify($password, $user->getPassword())) {
            $_SESSION['id'] = $user->getId();
            return true;
        }
        return false;
    }

    public static function getUserByEmail($email)
    {
        foreach (User::getAll('email = ?', [$email]) as $existingUser) {
            return $existingUser;

        }
        return NULL;
    }

    public static function isLogged()
    {
        return isset($_SESSION['id']);
    }

    public static function getId()
    {
        return (Auth::isLogged() ? $_SESSION['id'] : null);
    }


    public static function logout()
    {
        unset($_SESSION['id']);
        session_destroy();
    }

}