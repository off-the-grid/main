<form>
    <fieldset>
        <legend>Beginning</legend>
        <table>
            <tr>
                <td>
                    <label for="group">Group</label>:
                </td>
                <td>
                    <input id="group" name="group" type="text"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="population">Population</label>:
                </td>
                <td>
                    <input id="population" name="population" type="text"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="men">Men</label>:
                </td>
                <td>
                    <select id="men" name="men" onchange="updateWoomen()">
                        <?php for ($i = 0; $i <= 100; $i++) { ?>
                        <option><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                    %
                </td>
            </tr>
            <tr>
                <td>
                    <label for="woomen">Woomen</label>:
                </td>
                <td>
                    <select id="woomen" name="woomen" disabled="disabled">
                        <?php for ($i = 0; $i <= 100; $i++) { ?>
                        <option><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                    %
                </td>
            </tr>
            <tr>
                <td>
                    <label for="others">Others</label>:
                </td>
                <td>
                    <input id="others" name="others" type="text"/>
                </td>
            </tr>
        </table>
        
        <input id="run_simulation" disabled="disabled" type="submit" value="Run Simulation"/>
    </fieldset>
</form>

<script>
    function updateWoomen() {
        document.getElementById("woomen").value = 100 - document.getElementById("men").value;
    }
</script>
