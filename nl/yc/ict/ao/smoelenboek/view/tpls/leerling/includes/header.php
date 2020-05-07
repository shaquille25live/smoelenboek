<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Telefoonlijst</title>
        <link rel="STYLESHEET" href="css/telefoonlijst.css" type="text/css">
        <link rel="STYLESHEET" href="css/secretaresse.css" type="text/css">
    </head>
    <body>
        <header>
            <figure>
                <img src="img/cld-logo.png" width="5" height="110" alt="ons logo">
            </figure>
            <div>
                <p>Dit is de administratie applicatie voor de school voor ICT.</p>
                <p>Momenteel is ingelogd: <em><?=$gebruiker->getAchternaam();?></em></p>
                <p>Je hebt de rechten van: <em><?=$gebruiker->getRecht();?></em></p>

            </div>
            <figure>
                <a href="?control=leerling&action=foto" title='klik om je foto te wijzigen'> 
                    <img src="img/personen/<?=$gebruiker->getFoto()?>">
                </a>
            </figure>
        </header>
        <section>
    
