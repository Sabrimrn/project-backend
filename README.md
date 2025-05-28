README.md - Gaminghub Project
Projectbeschrijving
Dit project is een Gaminghub webapplicatie gebouwd met Laravel 12. Het platform is bedoeld om gamers, fans en content creators samen te brengen. Via deze hub kunnen gebruikers gamen gerelateerde content ontdekken, zoals nieuws, FAQ’s, profielen van gamers en community-updates. Admins beheren nieuwsartikelen, FAQ-categorieën en -items, en gebruikersprofielen.

Functionaliteiten
Nieuwsplatform: Admins kunnen gaming-gerelateerd nieuws plaatsen, beheren en publiceren.

FAQ sectie: Veelgestelde vragen over het platform, games, events en meer, georganiseerd in categorieën.

Gamerprofielen: Gebruikers kunnen profielen aanmaken en beheren.

Contactformulier: Voor vragen en supportaanvragen door gebruikers.

Admin dashboard: Beheer van gebruikers, nieuws, FAQ en contactberichten.

Authenticatie: Gebruikersregistratie en inloggen met verschillende rollen (admin, gebruiker).

Responsive design: Geschikt voor desktop en mobiel.

Implementatie technische vereisten:


| Vereiste                       | Implementatie (Bestand & lijnnummer)                                                         |
| ------------------------------ | -------------------------------------------------------------------------------------------- |
| Laravel 12 Framework           | `composer.json` en `vendor/laravel/framework`                                                |
| Admin Controller & Middleware  | `app/Http/Controllers/Admin/AdminController.php` (lijn 10)                                   |
| Nieuwsbeheer routes            | `routes/web.php`, regels 51-55                                                               |
| FAQ Controller met relatie     | `app/Http/Controllers/Admin/FaqController.php`, lijnen 10-70                                 |
| Blade views Admin FAQ          | `resources/views/admin/faq/index.blade.php`, hele bestand                                    |                                  
| Route Middleware admin         | `routes/web.php` middlewaregroep admin (regel 44)                                            |
| Cache en Config clear command  | `php artisan view:clear`, `php artisan cache:clear` (README.md installatie)                  |
| Validatie FAQ item toevoegen   | `FaqController@storeItem`, validatie in lijnen 70-85                                         |
| Gamerprofielen & profielbeheer | `app/Http/Controllers/GamerProfileController.php`, views in `resources/views/gamer-profile/` |


Installatiehandleiding:

Clone de repository:
git clone https://github.com/jouwgebruikersnaam/jouwproject.git
cd jouwproject

Installeer PHP dependencies:
composer install

Installeer npm dependencies & compileer assets:
npm install
npm run dev

Maak een .env bestand aan:
Kopieer .env.example naar .env en configureer je databasegegevens:
cp .env.example .env

Pas .env aan, bijvoorbeeld:
DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_DATABASE=project-backend

Genereer app key:
php artisan key:generate

Voer migraties en seeders uit:
php artisan migrate --seed

Cache legen (voor zekerheid):
php artisan view:clear
php artisan cache:clear
php artisan route:clear

Start de ontwikkelserver:
php artisan serve

Screenshots applicatie:

![Screenshot 2025-05-28 043306](https://github.com/user-attachments/assets/664bfea6-9b03-4783-89c2-a583dc52bf46)
![Screenshot 2025-05-28 043249](https://github.com/user-attachments/assets/10890db9-a84e-45c0-a65d-9b0ea63961f5)
![Screenshot 2025-05-28 043238](https://github.com/user-attachments/assets/58f703f1-5522-4501-bd7e-d9fc0cead2b0)
![Screenshot 2025-05-28 043222](https://github.com/user-attachments/assets/1cfdee5d-ea1b-4cfc-b873-a6db3431a9d9)
![Screenshot 2025-05-28 043155](https://github.com/user-attachments/assets/5cb903ef-2e52-4eaf-98cd-fb1fca4d2322)
![Screenshot 2025-05-28 043136](https://github.com/user-attachments/assets/071a0bce-b21e-4a5c-9905-a1606001ac30)
![Screenshot 2025-05-28 043110](https://github.com/user-attachments/assets/4b507ce6-83f9-42cc-a0f7-8c772a7294c7)
![Screenshot 2025-05-28 043020](https://github.com/user-attachments/assets/a855611a-adbd-4f7e-a342-82459f3e1b60)


Gebruikte bronnen
Laravel documentatie: https://laravel.com/docs/12.x

Laracasts tutorials: https://laracasts.com

AI chatlog via OpenAI ChatGPT (GPT-4 model)

Diverse StackOverflow posts over Laravel best practices


AI Chatlog
Tijdens het ontwikkelen heb ik gebruikgemaakt van OpenAI’s ChatGPT voor ondersteuning bij:

Het debuggen van foutmeldingen

Correcte implementatie van Eloquent relaties en Blade syntax

Het structureren van routes en controllers

Het oplossen van problemen met knoppen die niet reageren

Html

