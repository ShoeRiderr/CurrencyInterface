# PL

## Instrukcja instalacji dla systemu Linux

Należy pobrać projekt za pomocą polecenia 

### git clone https://github.com/ShoeRiderr/CurrencyInterface.git 

następnie przejść do pobranego pliku za pomocą 

### cd CurrencyInterface

Następnie należy zainstalować wszystkie niezbędne paczki z pliku composer.json oraz package.json za pomocą poleceń:

### composer install && npm install

Kolejnym krokiem jest skopiowanie pliku .env.example do .env za pomocą polecenia:

### cp .env.example .env

następnie należy wygenerować unikalny klucz dla aplikacji niezbędnego do szyfrowania danych (np. sesje, Tokeny CSRF, ciasteczka) za pomocą polecenia: 

### php artisan key:generate

Na koniec pozostaje stworzyć nową bazę danych, a jej nazwę przypisać w pliku .env do zmiennej: DB_DATABASE.

Zmienne DB_USERNAME i DB_PASSWORD należy ustawić według danych, które używasz do logowania się do bazy danych.

Kiedy wszystko jest już ustawione prawidłowo należy zapełnić bazę danych tabelami, puszczając tzw. migracje za pomocą polecenia:

### php artisan migrate

Następnie pozostaje załadować zmiany do pliku public poleceniem:

### npm run prod

A następnie uruchomić serwer:

### php artisan serve

Aplikacja domyślnie będzie dostępna pod adresem http://127.0.0.1:8000

# EN

## Install instruction for Linux

You can download project by typing 

### git clone https://github.com/ShoeRiderr/CurrencyInterface.git 

in terminal and next change directory via terminal with command 

### cd CurrencyInterface

Then you have to install all necessary packages from composer.json and package.json files with commands: 

### composer install && npm install

The next step is copying .env.example file to .env with command:

### cp .env.example .env

Further you have to generate unique app key for encrypt data in application (e.g. Sessions, CSRF tokens, Cookies) with command"

### php artisan key:generate

All that remains is to create new database and assign it's name to DB_DATABASE variable.

You have to set DB_USERNAME and DB_PASSWORD variables with login data to your database.

When everything is set correctly you have to fill your database with tables. You can make it with command:

### php artisan migrate

Then start the project with commands:

### npm run prod

and

### php artisan serve

The app by default will be available on http://127.0.0.1:8000 url.

## Pobieranie walut / Fetch currencies

### php artisan currency:fetch

