<?php   
include 'includes/header.php';
include 'includes/menu.php';?>
        <section id='content'>
            <figure id="details">
                <div> 
                    <table id="details_table">
                        <caption>
                            Detail gegevens van  <?= $contact->getAchternaam();?>
                        </caption>
                        <tr>
                            <th >email</th><td><a href="mailto:<?= $contact->getEmail();?>" title="klik om te mailen"><?= $contact->getEmail();?></a></td>
                        </tr>
                        <tr>
                            <th>naam</th><td>  Gert-Jan</td>
                        </tr>
                        <tr>
                            <th>Telefoon nummer</th><td> 06 12000325</td>
                        </tr>
                    </table>
                </div> 
                <img src="img/personen/<?= $contact->getFoto();?>" alt="mijn foto:  <?= $contact->getAchternaam();?>" />
                <figcaption>
                    de huidige foto van dhr <?= $contact->getAchternaam();?>
                </figcaption>
            </figure>
        <br id ="breaker" />
        </section>
<?php include 'includes/footer.php';
