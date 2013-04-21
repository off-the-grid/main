<?php include_once 'header.php'; ?>

<form method="post" action="../actions/main_action.php">
    <fieldset>
        <legend>Beginning</legend>
        <table>
            <tr>
                <td>
                    <label for="colony_name">Colony Name</label>:
                </td>
                <td>
                    <input id="colony_name" name="colony_name" type="text"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="population">Population</label>:
                </td>
                <td>
                    <select id="population" name="population">
                        <option>10</option>
                        <option>20</option>
                        <option>30</option>
                        <option>40</option>
                        <option>50</option>
                    </select>
                </td>
            </tr>
        </table>
        
        <input id="generator" type="submit" value="Generate Colony"/>
    </fieldset>
</form>

<?php include_once 'footer.php'; ?>
