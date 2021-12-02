/* Detta script är till för att hantera formuläret i index.html, sidan för login, med Ajax $.post, (HTTP POST) som uppdaterar data på servern. En del av sidan uppdateras då utan att ladda om hela sidan.
* Den förhindrar att formuläret skickas som vanligt, eftersom annars ser man felmeddelandena på PHP-sidan istället (authenticate.php)
* Om inloggningen lyckas så omdirigeras man istället till hem-sidan, nu som inloggad användare */

$(function () {

    //'submit'-event på formuläret med en anonym funktion som skickar med ett event-objekt e
    $('#loginForm').on('submit', function (e) {

        //Förhindrar att formuläret skickas
        //.serialize() samlar informationen från formuläret i en sträng och sparar i variabeln details
        //Ajax-metoden $.post används för att skicka formuläret (POST-metoden). 'authenticate.php' är url-en som den ska skickas till (form-valideringen), den skickar med 'details'-informationen samt har en callback-funktion
        //Funktionen är en anonym funktion som används när data kommer tillbaka från servern, som använder data som är informationen som returneras från URLen, i detta fall felmeddelande eller success
        //Om data är "success" så visar det på att valideringen lyckades (PHP-filen skriver ut det om lösenord och användarnamn stämmer) och då omdirigeras man till hem-sidan
        //Om valideringen inte lyckas skrivs ett felmeddelande ut (data) beroende på om man skrivit fel användarnamn eller lösenord. Meddelandet göms och skrivs ut med fadeIn() för snygg effekt.
        e.preventDefault();
        let details = $('#loginForm').serialize();
        $.post('authenticate.php', details, function (data) {
            if (data === "success") {
                window.location.replace("home.php");
            } else {
                $('#loginMsg').html(data).hide().fadeIn();
            }
        });
    });
});