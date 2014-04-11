<?php

include_once 'header.php';

$nb_people_per_skill = $_SESSION['nb_people_per_skill'];

$skillDAO = new GenericDAO("Skill");
$skills = $skillDAO->findAll();

?>
<fieldset>
    <legend>Recap</legend>
    <table>
        <?php foreach ($skills as $skill) { ?>
        <tr>
            <td>
                <?php echo $skill->name.': '; ?>
            </td>
            <td>
                <?php echo $nb_people_per_skill[$skill->id]; ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</fieldset>

<?php include_once 'footer.php'; ?>
