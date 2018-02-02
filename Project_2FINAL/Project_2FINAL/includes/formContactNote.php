<?php
function formContactNote()
{
    $note = "";
    if (isset($_SESSION['no_note'])) {
        $note = $_SESSION['no_note'];
    } elseif (isset($_POST['no_note'])) {
        $note = $_POST['no_note'];
    }

?>
    <h3>Contact Note</h3>
    <p>The note is required<br>
       Press the 'Skip' button to continue without entering a note</p>
    <br>
    <form method="POST" >
    <table>
    <tr><td><label for="no_note">Note</label></td>
        <td><textarea id="no_note" name="no_note" rows="10" cols="50" maxlength="65530" ><?php echo $note; ?></textarea></td>
    </tr>
    </table>
    <table>
    <tr>
        <td><input type="submit" name="ct_b_back" value="Back"></td>
        <td><input type="submit" name="ct_b_next" value="Next"></td>
    </tr>
    <tr>
        <td><input type="submit" name="ct_b_cancel" value="Cancel"></td>
        <td><input type="submit" name="ct_b_skip" value="Skip"></td>
    </tr>
    </table>
    </form>
<?php
}
?>

<?php
function validateContactNote()
{
    $err_msgs = array();
    if (!isset($_POST['no_note'])) {
        $err_msgs[] = "The note field must not be empty";
    } else {
        $note = trim($_POST['no_note']);
        if (strlen($note) == 0) {
            $err_msgs[] = "The note field must not be empty";
        } elseif (strlen($note) > 65530) {
            $err_msgs[] = "The note is too long";
        }
    }
    if (count($err_msgs) == 0) {
        $_POST['no_note'] = $note;
    }
    return $err_msgs;
}
?>

<?php
function contactNotePosttoSession()
{
    $_SESSION['no_note'] = $_POST['no_note'];
}
?>

