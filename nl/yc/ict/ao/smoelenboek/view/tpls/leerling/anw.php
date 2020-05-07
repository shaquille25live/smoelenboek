<?php 
include 'includes/header.php';
include 'includes/menu.php';?>
        <section id='content'>
            <form  method="post" id="gebruiker_form">
                <table >
                    <caption>Detail gegevens van  <?= $gebruiker->getGebruikersnaam();?></caption>
                    <tr>
                        <td >naam</td>
                        <td>
                            <input type="text" name="naam" placeholder="vul verplicht je voorletter in." value="<?= $gebruiker->getGebruikersnaam();?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td >tussenvoegsel</td>
                        <td>
                            <input type="text" placeholder="vul optioneel tussenvoegsels in." name="tv" value="<?= $gebruiker->getTussenvoegsel();?>">
                        </td>
                    </tr>
                    <tr>
                        <td >achternaam</td>
                        <td>
                            <input type="text" name="an" placeholder="vul verplicht je achternaam in." value="<?= $gebruiker->getAchternaam();?>" required>
                        </td>
                    </tr>
                     <tr>
                        <td >telefoon nummer</td>
                        <td>
                            <input type="text" name="telnr" placeholder="vul verplicht je telefoon nummer in." value="<?= $gebruiker->getTelnr();?>" required="false">
                        </td>
                    </tr>
                    <tr>
                        <td >email</td>
                        <td>
                            <input type="email" name="email"  placeholder="vul verplicht een emailadres in."  value="<?= $gebruiker->getEmail();?>" required>
                        </td>
                    </tr>
                </table>
                <div>
                    <input type="submit" value="verstuur" />
                    <input type="reset" value ="reset" />
                </div>
            </form>  
        <br id ="breaker">
        </section>
<?php include 'includes/footer.php';