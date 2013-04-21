<?php
$group_id = $_SESSION['colony_id'];

$groupDAO = new GenericDAO("Group");
$colony = $groupDAO->retrieve($group_id);

$personDAO = new GenericDAO("Person");
$persons = $personDAO->findAll();

$ressourceDAO = new GenericDAO("Ressource");
$ressources = $ressourceDAO->findAll();

$equipementDAO = new GenericDAO("Equipement");
$equipements = $equipementDAO->findAll();

$evenementDAO = new GenericDAO("Evenement");
$evenements = $evenementDAO->findAll();

$consequenceDAO = new GenericDAO("Consequence");
$consequences = $consequenceDAO->findAll();

$nbtour=0;
/*$nomcolony="Nom de la colonie";

//skill (id,nom)

$skill1= array(1,"agriculture");
$skill2= array(2,"medecine");
$skill3= array(3,"electronique");
$skill4= array(4,"mecanique");

// colon (numéro, santé, skill1, skill2)

$colon1= array(1,100,$skill1,$skill2);
$colon2= array(2,100,$skill2,$skill3);
$colon3= array(3,100,$skill1,$skill2);
$colon4= array(4,100,$skill2,$skill3);
$colon5= array(5,100,$skill1,$skill2);
$colon6= array(6,100,$skill2,$skill3);

$groupecolon = array($colon1,$colon2,$colon3,$colon4,$colon5,$colon6);

$nbcolons= count($groupecolon);

// colonie (nom, tab['colon'))
$colony = array("Nom de la colonie", $groupecolon);

// ressources (nro,nom,niveau)
$eau = array(1,"eau",10);
$faune= array(2,"faune",10);
$flore= array(3,"flore",10);
$mineraux= array(4,"mineraux",10);

$ressources = array($eau,$faune,$flore,$mineraux);


//equipement (nro,nom,niveau)
$info= array(1,"informatique",10);
$energie=array(2,"energie",10);
$medecine=array(3,"medecine",10);

$equipements=array($info,$energie,$medecine);

//evenement (nro,nom,proba,tourmin,tourmax,colonnro,equipementnro,ressource,texte,conséquence(ID1,ID2,ID3),resolutions possibles)

//exemple : innondation 50% chance proba entre le tour 1 et 5, conséquence sur le colon 3,l'équipement energie, les ressources en eau. Résol possible : 1,2,3
$inondation= array(1,"innondation",50,1,5,3,2,1,"Une innondation survient.<Br/>",array(1,2,3),array(1,2,3));

//conséquence (id,type,IDcible,skill,effet,"ok","non ok")
$consequence1 = array(1,1,0,2,-20,"Un colon est blessé. Les compétences de medecin de vos colons permettent d'éviter une blessure trop grave","Un colon s'est blessé. Malheureusement les compétences en medecine de la colonie ne sont pas suffisamment avancées.Cela va laisser des séquelles.");
$consequence2 = array(2,2,0,4,-50,"Un equipement est endommagé. Les compétences de mécanique de la colonie permettent d'éviter des dégats trop important","Un équipement est endommagé. Malheureusement, les compétences en mécanique de la colonie ne permettent pas de limiter les dégats");
$consequence3 = array(3,3,0,1,-50,"Les ressources naturelles sont touchés. Les compt d'agriculture de votre colony permet de limiter les dégats","Les ressources naturelles sont touchées. Les compétences d'agricultures de la colonie ne permettent pas de limiter les dégats");

$consequences = array($consequence1,$consequence2,$consequence3);
//resolution (nro,colonnro,equipement,ressource,effet(colonnro,equipement,ressource),description)



//Ex : bateau, pas de colon, csq energie, csq eau
$bateau = array(1,0,2,1,array(0,-5,+10),"Vous construisez un bateau");
$moulin = array(2,0,2,0,array(0,0,+20),"Moulin");
$peche = array(3,0,0,2,array(0,0,+50),"peche");*/


//début de partie
echo $colony->name;
echo "<br>";
echo "tour :".$nbtour;
echo "<br>";
if ($nbtour==0){
	echo "Texte d'intro";
}
echo "<br>";

//On requete les evenements ou $nbtour est compris entre leur TOURMIN et TOURMAX
//"SELECT * WHERE TOURMIN >".$nbtour."AND TOURMAX <".$nbtour;

//On tire au sort 3 évenement dans cette liste (un random compris entre 0 et le nbtotal d'évenement remontés)

$evtId = rand(0, count($evenements));
$evenementselect = $evenements[$evtId];


//On display le texte de l'évenement, on applique les conséquences

echo $evenementselect->texte;


//On regarde si la colonie possède les skills pour éviter les conséquences de l'évenement

for ($i = 0; $i < 3; $i++){
    $compt = "KO";
	foreach($consequences as &$consek){
		if ($consek[0] == $consequences[$i]){
			$cons=$consek;
		}
	}

$constype= $cons->type;

	foreach($persons as &$colons){
		$skill1= $colons->id_skill;
		$skill2= $colons->id_skill2;

		if($skill1 == $cons->skill or $skill2 == $cons->skill){
			$compt = "OK";
		}
	}
	
	if ($constype==1){
		$colmax = count($persons);
		$numerovict = (rand(0,$colmax-1));
		echo "Un colon est blessé";
		echo "<br>";
		if($compt == "OK"){
			$persons[$numerovict]->pv -= 5; 
			echo "Les compétences en medecine de la colonie permettent d'éviter une blessure trop grave";
			echo "<br>";
		}
		else{
			$persons[$numerovict]->pv -= $cons->effet;
			echo "La blessure est grave. Le manque de compétence médicale de la colonie n'arrange pas les choses";
			echo "<br>";
		}
	}
	elseif ($constype==2){
		$colmax = count($equipements);
		$numerovict = (rand(0,$colmax-1));
		echo "Un équipement est endommagé";
		echo "<br>";
		
		if($compt == "OK"){
			$equipements[$numerovict]->niveau -= 5; 
			echo "Les compétences en mécanique de la colonie permettent de limiter les dégats";
			echo "<br>";
		}
		else{
			$equipements[$numerovict]->niveau -= $cons->effet;
			echo "Le manque de compétence de la colonie en mécanique se fait ressentir";
			echo "<br>";
		}
	}
	else {
		$colmax = count($ressources);
		$numerovict = rand(0,$colmax-1);
		echo "Les ressources de la colonie sont touchées";
		echo "<br>";
		
		if($compt == "OK"){
			$ressources[$numerovict]->niveau -= 5; 
			echo "Les compétences agricole de la colonie permettent de limiter les degats";
			echo "<br>";
		}
		else{
			
			$ressources[$numerovict]->niveau -= $cons->effet;
			echo "Les connaissances agricoles de la colonie ne sont pas suffisantes. Les ressouces naturelles sont sévèrement impactées";
			echo "<br>";
		}
	}
}



//On propose les 3 solution possible.

//On passe un tour
$nbtour+=1;

//On vérifie les ressources

foreach ($ressources as &$res){
	if($res->niveau <= 10) echo "Attention, le niveau de ".$res->nom." est critique<br/>";
	if($res->niveau <= 0) {
		echo "La ressource :".$res->nom." est épuisée. La colonie à échouée<br/>";
		$nbtour = -1;
	}
}
foreach ($equipements as &$equi){
	if($equi->niveau <= 10) echo "Attention, le niveau de ".$equi->nom." est critique<br/>";
	if($equi->niveau <= 0) {
		echo "L'équipement :".$equi->nom." est KO. La colonie à échouée<br/>";
		$nbtour = -1;
	}
}

if ($nbcolons == 0){
	echo "Tout les colons sont morts. La colonie à échouée<br/>";
	$nbtour = -1;
	}


?>
