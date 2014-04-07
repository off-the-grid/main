<?php

include_once 'header.php';

$group_id = $_SESSION['colony_id'];

$groupDAO = new GenericDAO("Group");
$group = $groupDAO->retrieve($group_id);

$skillDAO = new GenericDAO("Skill");
$skills = $skillDAO->findAll();

$personDAO = new PersonDAO("Person");
$persons = $personDAO->findByGroupId($group_id);

?>

<form method="post" action="../actions/skills_repartition_action.php">
    <fieldset>
        <legend>Skills Repartition</legend>
        <table>
            <tr>
                <td>
                    <label for="colony_name">Colony Name</label>:
                </td>
                <td>
                    <input id="colony_name" name="colony_name" type="text"
                           value="<?php echo $group->name ?>" disabled="disabled"/>
                </td>
            </tr>
            <?php foreach ($skills as $skill) { ?>
            <tr>
                <td>
                    <label for="<?php echo strtolower($skill->name); ?>"><?php echo $skill->name; ?></label><!-- (<?php echo $skill->cost; ?>)-->:
                </td>
                <td>
                    <select id="<?php echo strtolower($skill->name); ?>" name="<?php echo strtolower($skill->id); ?>">
                    </select>
                    <a href="javascript:move(document.getElementById('people'), document.getElementById('<?php echo strtolower($skill->name); ?>'))">&lt;</a>
                    <a href="javascript:move(document.getElementById('<?php echo strtolower($skill->name); ?>'), document.getElementById('people'))">&gt;</a>
                </td>
                <td>
                </td>
                <?php if ($i++ == 0) /* Means that the following block will be displayed only once */ { ?>
                <td rowspan="<?php echo count($skills); ?>">
                    People:
                    <br/>
                    <select id="people" name="people" multiple="multiple" size="3">
                        <?php foreach ($persons as $person) { ?>
                        <option name="<?php echo $person->id; ?>">Person <?php echo $person->number; ?></option>
                        <?php } ?>
                    </select>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </table>
        
        <input id="generator" type="submit" value="Run Simulation"/>
    </fieldset>
</form>

<script>
function move(src, dest) { // From http://viralpatel.net/blogs/listbox-select-all-move-left-right-up-down-javascript/
    for(var count=0; count < src.options.length; count++) {
 
        if(src.options[count].selected == true) {
                var option = src.options[count];
 
                var newOption = document.createElement("option");
                newOption.value = option.value;
                newOption.text = option.text;
                newOption.selected = true;
                try {
                         dest.add(newOption, null); //Standard
                         src.remove(count, null);
                 }catch(error) {
                         dest.add(newOption); // IE only
                         src.remove(count);
                 }
                count--;
        }
    }
}
</script>

<?php include_once 'footer.php'; ?>
