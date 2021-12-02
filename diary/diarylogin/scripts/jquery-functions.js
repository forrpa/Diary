/* Allt-i-allo script som gör olika saker på olika delar av hemsidan, främst i design-syfte */

$(function () {

    /*Skriva ut header-texten på ett snyggt sätt*/

    let header = "Jennifer's Diary";
    let i = 0;
    let headerText = $('#headerText');

    //Funktion som skriver ut bokstäverna i headern en i taget. Ett index används och charAt för att använda en bokstav i taget.
    //En timeout sätts som kallar på den egna funktionen, och tiden 80 millisekunder för varje bokstav. Det gör att en bokstav skrivs ut i taget.
    //De första 10 siffrorna (Jennifer's) görs rosa och resten gråa.
    //När i är 10 (mellanslaget) så går tiden lite långsammare eftersom man byter ord
    function writeText() {

        if (i < 10) {
            $('#pink').append(header.charAt(i));
            i++;
            setTimeout(writeText, 80);
        } else if (i === 10) {
            $('#black').append(header.charAt(i));
            i++;
            setTimeout(writeText, 200);
        } else if (i < 16) {
            $('#black').append(header.charAt(i));
            i++;
            setTimeout(writeText, 80);
        }
    }

    //Animerar header-texten och minskar letterSpacing och wordSpacing till samma värde som var innan, är den sista funktionen som används med headern
    function letterSpacing() {
        headerText.animate({letterSpacing: "-=5px", wordSpacing: "-=5px"}, 200, 'swing');
    }

    //Animerar header-texten så att genomskinligheten blir som den var innan, men ökar letter- och wordspacing för en snygg effekt, callback-funktion är funktionen som återställer det
    function opacity() {
        headerText.animate({opacity: "1", letterSpacing: "+=5px", wordSpacing: "+=5px"}, 200, 'swing', letterSpacing);
    }

    //Skriver ut texten
    writeText();

    //Animerar texten. Minskar genomskinligheten, och anropar sedan funktionen som återställer genomskinligheten samt ökar letter- och wordspacing (gör en snygg effekt)
    headerText.animate({opacity: "0.6"}, 1400, 'swing', opacity);

    /*Ta bort inlägg - home.html och categories.html*/

    //Kollar att man verkligen vill ta bort ett inlägg där man trycker på knappen för att ta bort ett inlägg (click-event finns på knappen)
    //Funktionen returnerar en confirm som frågar om man verkligen vill ta bort inlägget.
    $('#deleteBtn').on('click', function () {
        return confirm('Are you sure you want to delete this post?');
    });

    /* Ändra aside-text */

    //whatever är en del av en text i aside-fältet, som ser animerat ut på ett snyggt sätt med denna kod
    let whatever = $('#whatever');

    //Denna funktion ändrar font-tjockleken med .css lite i taget, från 300 till 700, med setTimeout. Varje timeout har högre nummer så att de löses av efter varandra.
    function click() {
        setTimeout(function () {
            whatever.css({'font-weight': 400})
        }, 100)
        setTimeout(function () {
            whatever.css({'font-weight': 500})
        }, 200)
        setTimeout(function () {
            whatever.css({'font-weight': 600})
        }, 300)
        setTimeout(function () {
            whatever.css({'font-weight': 700})
        }, 400)
    }

    //Animerar aside-texten i samma takt som click()-funktionen, .animate för att letterspacing ökar med 3px för en snygg effekt, speed är 400 (samma som tiden det tar för click())
    function animate() {
        whatever.animate({letterSpacing: "+=3px"}, 400, 'swing');
    }

    //Startar funktionerna samtidigt så att tjockleken på texten samt letterspacing utförs samtidigt för en snygg effekt
    click();
    animate();

    /* Lägga till kategori - writepost.html*/

    //När man ska skriva ett inlägg kan man välja att lägga till en kategori till databasen. Först göms det formuläret, och om man trycker på knappen så visas den igen och knappen göms.
    $('.addCategory').hide();
    $('#addCatBtn').on('click', function () {
        $('.addCategory').show();
        $('#addCatBtn').hide();
    });

    /* Bilden i empty.html */

    //Fadear in bilden i empty.html så det blir snyggare
    $('#oopsImg').hide().fadeIn(1000);

    /* Bildbyte i aside */

    //Bilden i aside-fältet kan ändras om man håller musen över den, samt tillkommer en liten bildbeskrivning
    //Först göms originalbilden och fadeas in för snygg effekt, och texten som ska visas om man håller musen över bilden göms
    //'mouseenter' event sätts på bilden. Bildens src ändras till en annan bild (en lite mer privat bild) så den bilden syns istället, och bildbeskrivningen visas
    //Om man tar bort musen från bilden ('mouseleave' event) så kommer originalbilden tillbaka och texten göms
    let asideImg = $('#asideImg');
    asideImg.hide().fadeIn();
    let asideText = $('#asideText');
    asideText.hide();
    asideImg.on('mouseenter', function () {
        this.src = 'images/goggles.png';
        asideText.show();
    }).on('mouseleave', function () {
        asideText.hide();
        this.src = 'images/asidebild.png';
    });


    /*Ändra uppgifter på profile.html*/

    //Sparar alla formulär för att byta användarnamn, lösenord och email samt gömmer dom
    let usernameForm = $('#usernameForm');
    usernameForm.hide();
    let passwordForm = $('#passwordForm');
    passwordForm.hide();
    let emailForm = $('#emailForm');
    emailForm.hide();

    //Sparar alla formulär-knappar i variabler
    let usernameBtn = $('#usernameBtn');
    let passwordBtn = $('#passwordBtn');
    let emailBtn = $('#emailBtn');

    //Sätter ett click-event på alla knappar (ändra användarnamn osv), så om man klickar på tex ändra lösenord-knappen så visas lösenords-formuläret (med fadeIn),
    //De andra två (som man inte klickat på) göms, så man bara ser det relevanta formuläret.
    //Dessutom ändras bakgrunsfärgen så man vet vilket formulär man är inne på. Trycker man på användarnamn-knappen så blir den knappen mörkare rosa, och de andra den vanliga ljusrosa färgen.
    //Trycker man sen på en annan knapp så blir användarnamn-knappen ljusrosa igen och den knapp man tryckt på blir mörkare rosa
    usernameBtn.on('click', function () {
        passwordForm.hide();
        emailForm.hide();
        usernameForm.hide().fadeIn();
        usernameBtn.css('background-color', 'pink');
        passwordBtn.css('background-color', '#ffe9ec');
        emailBtn.css('background-color', '#ffe9ec');
    });
    passwordBtn.on('click', function () {
        usernameForm.hide();
        emailForm.hide();
        passwordForm.hide().fadeIn();
        passwordBtn.css('background-color', 'pink');
        usernameBtn.css('background-color', '#ffe9ec');
        emailBtn.css('background-color', '#ffe9ec');
    });
    emailBtn.on('click', function () {
        passwordForm.hide();
        usernameForm.hide();
        emailForm.hide().fadeIn();
        emailBtn.css('background-color', 'pink');
        passwordBtn.css('background-color', '#ffe9ec');
        usernameBtn.css('background-color', '#ffe9ec');
    });

    //'submit'-event sätts på alla fomrulär så att när man skickat in formuläret får en alert om att man ändrat det man ändrat
    usernameForm.on('submit', function () {
        alert('You have changed your username!');
    });
    passwordForm.on('submit', function () {
        alert('You have changed your password!');
    });
    emailForm.on('submit', function () {
        alert('You have changed your email address!');
    });


});