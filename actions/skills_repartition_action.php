<?php

ob_start(); // Turning on output buffering to avoid HTML characters...

session_start();

include_once '../db/GenericDAO.php';

include_once '../classes/Skill.php';

$skillDAO = new GenericDAO("Skill");
$skills = $skillDAO->findAll();

$nb_people_per_skill = array();

foreach ($skills as $skill) {
    $nb_people_per_skill[$skill->id] = count($_POST['skill_'.$skill->id]);
}

$_SESSION['nb_people_per_skill'] = $nb_people_per_skill;

ob_end_clean(); // ... (even spaces between PHP directives) before header() call

header("Location: ../html/recap.php");

?>
