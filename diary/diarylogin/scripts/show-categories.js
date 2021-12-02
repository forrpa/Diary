/* Script som använder ajax för att skriva ut alla kategorier i headern utan att ladda om sidan . */

$(function () {

    //Skapar nytt XMLHttpRequest() (Ajax), öppnar med med GET-metoden och hämtar data från show-categories.php.
    //show-categories.php returnerar varje rad av kategori från databasen, både kategori-ID och kategorititel
    //onreadystatechange har en anonym funktion som har en if-sats kollar om allt gått bra, inga errors och så vidare
    //Om allt går som det ska så skrivs varje rad av kategori ut på HTML-sidan, och alla kategorier blir en egen länk i en lista.
    //responseText är alltså det som hämtats från PHP-filen och innehåller alla rader av kategorier
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'show-categories.php');
    xhr.send();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            $('#headerLi').html(xhr.responseText);
        }
    };
});
