
<!-- start content -->
<div id="content">
    <h1>Create An Event</h1>
    <form name="eventcreate" action="/event/create" method="post">
        <table>
            <tr>
                <td>Time: </td>
                <td>
                    <input type="text" id="createdatepicker" name="time"/>
<!--                    Year:
                    <select name="year">
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                    </select>

                    - Month:
                    <select name="month">
                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                        <option value="<?= $i ?>"><?= $i ?> </option>
                        <?php } ?>
                    </select>
                    - Day:
                    <select name="day">
                        <?php for ($i = 1; $i <= 31; $i++) { ?>
                        <option value="<?= $i ?>"><?= $i ?> </option>
                        <?php } ?>

                    </select>
-->
                </td>
            </tr>
            <tr>
                <td>Title: </td>
                <td><input type="text" name="title" size="58"/></td>
            </tr>
            <tr>
                <td>Description: </td>
                <td><textarea rows="20" cols="50" maxlength="100000" name="description" ></textarea></td>
            </tr>
            <tr>
                <td><input type="submit" name="createvent" value="Create Event"></td>
            </tr>
        </table>
    </form>
</div>
<!-- end content -->

