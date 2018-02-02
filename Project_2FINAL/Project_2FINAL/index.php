<?php
session_start();
if (!isset($_SESSION['mode'])) {
    $_SESSION['mode'] = "Display";
}
require_once "./includes/db_operations.php";
require_once "./includes/displayContacts.php";
require_once "./includes/formContactType.php";
require_once "./includes/formContactName.php";
require_once "./includes/formContactAddress.php";
require_once "./includes/formContactPhone.php";
require_once "./includes/formContactEmail.php";
require_once "./includes/formContactWeb.php";
require_once "./includes/formContactNote.php";
require_once "./includes/formContactSave.php";
require_once "./includes/clearAddContactFromSession.php";
require_once "./includes/displayErrors.php";
require_once "./includes/formContactEdit.php";
require_once "./includes/formDisplayContacts.php"
?>
<html>
    <head>
        <title>Contact List</title>
    </head>
    <body>
<?php
if (isset($_POST['ct_b_add']) && ($_POST['ct_b_add'] == "Add New Contact")) {
    $_SESSION['mode'] = "Add";
    $_SESSION['add_part'] = 0;
} elseif (isset($_POST['ct_b_edit']) && ($_POST['ct_b_edit'] == "Edit")) {
    $_SESSION['mode'] = "Edit";
} elseif (isset($_POST['ct_b_delete']) && ($_POST['ct_b_delete'] == "Delete")) {
    $_SESSION['mode'] = "Delete";
} elseif (isset($_POST['ct_b_view_details']) && ($_POST['ct_b_view_details'] == "View Details")) {
    $_SESSION['mode'] = "View";
} elseif (isset($_POST['ct_b_cancel']) && ($_POST['ct_b_cancel'] == "Cancel")) {
    if ($_SESSION['mode'] == "Add") {
        $_SESSION['add_part'] = 0;
        clearAddContactFromSession();
    }
    $_SESSION['mode'] = "Display";
    //add stuff here for when cancelling edit
}

// echo "<pre>\n";
// print_r($_POST);
// print_r($_SESSION);
// echo "</pre>\n";

if (($_SESSION['mode'] == "Add") && ($_SERVER['REQUEST_METHOD'] == "GET")) {
    switch ($_SESSION['add_part']) {
        case 0:
        case 1:
            formContactType();
            break;
        case 2:
            formContactName();
            break;
        case 3:
            formContactAddress();
            break;
        case 4:
            formContactPhone();
            break;
        case 5:
            formContactEmail();
            break;
        default:
    }
} elseif ($_SESSION['mode'] == "Add") {
    switch ($_SESSION['add_part']) {
        case 0:
            echo "<h1> Add New Contact </h1>\n";
            $_SESSION['add_part'] = 1;
            formContactType();
            break;
        case 1:
            echo "<h1> Add New Contact </h1>\n";
            $err_msgs = validateContactType();
            if (count($err_msgs) > 0) {
                displayErrors($err_msgs);
                formContactType();
            } else {
                contactTypePostToSession();
                $_SESSION['add_part'] = 2;
                formContactName();
            }
            break;
        case 2:
            echo "<h1> Add New Contact </h1>\n";
            $err_msgs = validateContactName();
            if (count($err_msgs) > 0) {
                displayErrors($err_msgs);
                formContactName();
            } elseif ((isset($_POST['ct_b_next'])) && ($_POST['ct_b_next'] == "Next")) {
                contactNamePostToSession();
                $_SESSION['add_part'] = 3;
                formContactAddress();
            } elseif ((isset($_POST['ct_b_back'])) && ($_POST['ct_b_back'] == "Back")) {
                contactNamePostToSession();
                $_SESSION['add_part'] = 1;
                formContactType();
            }
            break;
        case 3:
            echo "<h1> Add New Contact </h1>\n";
            $err_msgs = validateContactAddress();
            if ((!isset($_POST['ct_b_skip'])) && (count($err_msgs) > 0)) {
                displayErrors($err_msgs);
                formContactAddress();
            } elseif (isset($_POST['ct_b_skip'])) {
                $_SESSION['add_part'] = 4;
                formContactPhone();
            } elseif ((isset($_POST['ct_b_next'])) && ($_POST['ct_b_next'] == "Next")) {
                contactAddressPostToSession();
                $_SESSION['add_part'] = 4;
                formContactPhone();
            } elseif ((isset($_POST['ct_b_back'])) && ($_POST['ct_b_back'] == "Back")) {
                contactAddressPostToSession();
                $_SESSION['add_part'] = 2;
                formContactName();
            }
            break;
        case 4:
            echo "<h1> Add New Contact </h1>\n";
            $err_msgs = validateContactPhone();
            if ((!isset($_POST['ct_b_skip'])) && (count($err_msgs) > 0)) {
                displayErrors($err_msgs);
                formContactPhone();
            } elseif (isset($_POST['ct_b_skip'])) {
                $_SESSION['add_part'] = 5;
                formContactEmail();
            } elseif ((isset($_POST['ct_b_next'])) && ($_POST['ct_b_next'] == "Next")) {
                contactPhonePostToSession();
                $_SESSION['add_part'] = 5;
                formContactEmail();
            } elseif ((isset($_POST['ct_b_back'])) && ($_POST['ct_b_back'] == "Back")) {
                contactPhonePostToSession();
                $_SESSION['add_part'] = 3;
                formContactAddress();
            }
            break;
        case 5:
            echo "<h1> Add New Contact </h1>\n";
            $err_msgs = validateContactEmail();
            if ((!isset($_POST['ct_b_skip'])) && (count($err_msgs) > 0)) {
                displayErrors($err_msgs);
                formContactEmail();
            } elseif (isset($_POST['ct_b_skip'])) {
                $_SESSION['add_part'] = 6;
                formContactWeb();
            } elseif ((isset($_POST['ct_b_next'])) && ($_POST['ct_b_next'] == "Next")) {
                contactEmailPostToSession();
                $_SESSION['add_part'] = 6;
                formContactWeb();
            } elseif ((isset($_POST['ct_b_back'])) && ($_POST['ct_b_back'] == "Back")) {
                contactEmailPostToSession();
                $_SESSION['add_part'] = 4;
                formContactPhone();
            }
            break;
        case 6:
            echo "<h1> Add New Contact </h1>\n";
            $err_msgs = validateContactWeb();
            if ((!isset($_POST['ct_b_skip'])) && (count($err_msgs) > 0)) {
                displayErrors($err_msgs);
                formContactWeb();
            } elseif (isset($_POST['ct_b_skip'])) {
                $_SESSION['add_part'] = 7;
                formContactNote();
            } elseif ((isset($_POST['ct_b_next'])) && ($_POST['ct_b_next'] == "Next")) {
                contactWebPostToSession();
                $_SESSION['add_part'] = 7;
                formContactNote();
            } elseif ((isset($_POST['ct_b_back'])) && ($_POST['ct_b_back'] == "Back")) {
                contactWebPostToSession();
                $_SESSION['add_part'] = 5;
                formContactEmail();
            }
            break;
        case 7:
            echo "<h1> Add New Contact </h1>\n";
            $err_msgs = validateContactNote();
            if ((!isset($_POST['ct_b_skip'])) && (count($err_msgs) > 0)) {
                displayErrors($err_msgs);
                formContactNote();
            } elseif (isset($_POST['ct_b_skip'])) {
                $_SESSION['add_part'] = 8;
                formContactSave();
            } elseif ((isset($_POST['ct_b_next'])) && ($_POST['ct_b_next'] == "Next")) {
                contactNotePostToSession();
                $_SESSION['add_part'] = 8;
                formContactSave();
            } elseif ((isset($_POST['ct_b_back'])) && ($_POST['ct_b_back'] == "Back")) {
                contactNotePostToSession();
                $_SESSION['add_part'] = 6;
                formContactWeb();
            }
            break;
        case 8:
            if ((isset($_POST['ct_b_next'])) && ($_POST['ct_b_next'] == "Save")) {
                $db_conn = dbconnect('localhost', 'week7', 'lamp1user', '!Lamp1!');
                saveContact($db_conn);
                dbdisconnect($db_conn);
                $_SESSION['add_part'] = 0;
                clearAddContactFromSession();
                $_SESSION['mode'] = "Display";
                formContactDisplay();
            } elseif ((isset($_POST['ct_b_back'])) && ($_POST['ct_b_back'] == "Back")) {
                echo "<h1> Add New Contact </h1>\n";
                $_SESSION['add_part'] = 7;
                formContactNote();
            }
            break;
        default:
    }
//if user selected Edit button on home page
} elseif ($_SESSION['mode'] == "Edit") {
    //if user didn't select a contact
    if (!isset($_POST['list_select'][0]) && !isset($_SESSION['list_select'])) {
        formContactDisplay();
        echo "<p>Please select a contact to edit</p>";
    } elseif (isset($_POST['ct_b_edit']) && ($_POST['ct_b_edit'] == "Edit")) {
        echo "<h1> Edit Contact </h1>\n";
        formContactEdit();
    } elseif (isset($_POST['btnCancelEdit'])) {
        if (isset($_SESSION['list_select'])) {
            unset($_SESSION['list_select']);
        }
        $_SESSION['mode'] = "Display";
        formContactDisplay();
    //when users are attempting to save an edited contact
    } else {
        //validate the edited data
        $err_msgs = validateEditedContact();
        if (count($err_msgs) > 0) {
            //display errors if they arise and show user the same page again
            displayErrors($err_msgs);
            formContactEdit();
        //save data to database, show user confirmation, and redisplay homepage
        } else {
            contactEditSave();
            $_SESSION['mode'] = "Display";
            formContactDisplay();
        }
    }
} elseif ($_SESSION['mode'] == "Delete") {
    //delete code
} elseif ($_SESSION['mode'] == "View") {
    if ((isset($_POST['btnBack'])) && ($_POST['btnBack'] == "Back")) {
        unset($_SESSION['list_select']);
        $_SESSION['mode'] = "Display";
        formContactDisplay();
    } elseif (!isset($_POST['list_select'][0])) {
        formContactDisplay();
        echo "<p>Please select a contact to view</p>";
    } else {
        formDisplayContacts();
    }
} elseif ($_SESSION['mode'] == "Display") {
    formContactDisplay();
}
?>
    </body>
</html>

<?php
function formContactDisplay()
{
    $db_conn = dbconnect('localhost', 'week7', 'lamp1user', '!Lamp1!');
    $fvalue = "";
    if (isset($_POST['ct_b_filter']) && isset($_POST['ct_filter'])) {
        $_SESSION['ct_filter']
            = $db_conn->real_escape_string(trim($_POST['ct_filter']));
        $fvalue = $_SESSION['ct_filter'];
    } elseif (isset($_POST['ct_b_filter_clear'])) {
        $_SESSION['ct_filter'] = "";
        $fvalue = $_SESSION['ct_filter'];
    } elseif (isset($_SESSION['ct_filter'])) {
        $fvalue = $_SESSION['ct_filter'];
    }
?>
        <h1> Contacts </h1>
        <div>
            <h2> Contacts </h2>
        </div>
        <div>
        <form method="POST">
        <table>
        <tr>
            <td><label for="ct_filter">Filter Value</label></td>
            <td><input type="text" name="ct_filter" 
                id="ct_filter" value="<?php echo $fvalue; ?>"></td>
            <td><input type="submit" name="ct_b_filter" value="Filter">
            <td><input type="submit" name="ct_b_filter_clear" value="Clear Filter">
        </tr>
        </table>
        <br>
<?php
    displayContacts($db_conn);
    dbdisconnect($db_conn);
?>
            <br>
            <table>
            <tr>
                <td><input type="submit" name ="ct_b_view_details" 
                value="View Details"></td>
                <td><input type="submit" name ="ct_b_edit" value="Edit"></td>
                <td><input type="submit" name ="ct_b_delete" value="Delete"></td>
            </tr>
            <tr></tr>
            <tr>
                <td><input type="submit" name ="ct_b_add" 
                value="Add New Contact"></td>
            </tr>
            </table>
        </form>
        </div>
<?php } ?>
