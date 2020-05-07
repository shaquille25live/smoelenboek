<?php   
include 'includes/header.php';
include 'includes/menu.php';
?>
        <section id='content'>
                <form  method="post" id="gebruiker_form">
                    <table >
                        <caption>
                            voeg een nieuw boek toe
                        </caption>
                        <tr>
                            <td >titel</td>
                            <td>
                                <input type="text" name="titel" required />
                            </td>
                        </tr>
                        <tr>
                            <td >omschrijving</td>
                            <td>
                                <input type="text" name="omschrijving" required /> 
                            </td>
                        </tr>
                        
                    </table>
                    <div>
                        <input type="submit" value="verstuur" />
                        <input type="reset" value ="reset" />
                    </div>
                </form>
            <br id ="breaker">



        <section id='content'>
          
            <table>
                <caption>
                    De Boeken
                </caption>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Titel</th>
                        <th>Omschrijving</th>                           
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($boeken as $boeken):?>
                    <tr>
                        <td><?=$boeken->getId();?></td>
                        <td><?=$boeken->getTitel();?></td>
                        <td><?=$boeken->getOmschrijving();?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
<?php include 'includes/footer.php';

               