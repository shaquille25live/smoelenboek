<?php include 'includes/header.php';
include 'includes/menu.php';?>
    <section id='content'>
        <table id="contacten">
            <caption></caption>
            <thead>
                <tr>
                    <td>foto</td>
                    <td>naam</td>
                    <td>email</td>
                    <td>recht</td>
                    <td>klas</td>
                   
                </tr>
            </thead>
            <tbody>
                <?php foreach($contacten as $contact):?>
                <tr>
                    <td>
                        <figure>
                            <img src="img/personen/<?= $contact->getFoto();?>" width="120" height="120" alt="de foto van <?= $contact->getNaam();?>" />
                        </figure>
                    </td>
                    <td><?= $contact->getNaam();?></td>
                    <td><?= $contact->getEmail();?></td>
                    <td><?= $contact->getRecht();?></td>
                    <td><?= $contact->getKlas_id();?></td>
                   
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <br id ="breaker" />
    </section>
<?php include 'includes/footer.php';