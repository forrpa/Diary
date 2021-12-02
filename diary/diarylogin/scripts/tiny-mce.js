/* Pluginet tiny mce - textarea för att kunna skriva inlägg snyggt i dagboken utan att behöva använda HTML-kod.
* Pluginet hämtas i ett annat script och detta är inställningarna för pluginet.
* Textarean som används har id content och finns i writepost.html samt editpost.html.
* Bredd och höjd sätts, vilka plugins som ska finnas, vad som ska finnas i toolbaren och i menubaren samt vad som ska finnas under mina favoriter */

tinymce.init({
    selector: 'textarea#content',
    width: '100%',
    height: 500,
    plugins: [
        'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
        'table emoticons template paste help'
    ],
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
        'bullist numlist outdent indent | link image | print preview media fullpage | ' +
        'forecolor backcolor emoticons | help',
    menu: {
        favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | spellchecker | emoticons'}
    },
    menubar: 'favs file edit view insert format tools table help'
});
