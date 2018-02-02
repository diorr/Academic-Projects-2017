<?php
function formContactEdit()
{
    //POST['list_select'][0] should be the id
    //set up database connection
    $db_conn = new mysqli('localhost', 'lamp1user', '!Lamp1!', 'week7');
    if ($db_conn->connect_errno) {
        die("Could not connect to database server".$db_host."\n Error: ".$db_conn->connect_errno ."\n 
        Report: ".$db_conn->connect_error."\n");
    }
    //get id of selected contact
    $id = $_POST['list_select'][0];
    $_SESSION['list_select'] = $_POST['list_select'][0];
    
    //set up queries to extract data
    $qry = "select * from contact where ct_id = {$id};";
    $qry2 = "select * from contact_address where ad_ct_id = {$id};";
    $qry3 = "select * from contact_phone where ph_ct_id = {$id};";
    $qry4 = "select * from contact_email where em_ct_id = {$id};";
    $qry5 = "select * from contact_web where we_ct_id = {$id};";
    $qry6 = "select * from contact_note where no_ct_id = {$id};";

    //run queries
    $rs = $db_conn->query($qry);
    $rs2 = $db_conn->query($qry2);
    $rs3 = $db_conn->query($qry3);
    $rs4 = $db_conn->query($qry4);
    $rs5 = $db_conn->query($qry5);
    $rs6 = $db_conn->query($qry6);

    //obtain data from queries
    $contact = $rs->fetch_assoc();
    $contact2 = $rs2->fetch_assoc();
    $contact3 = $rs3->fetch_assoc();
    $contact4 = $rs4->fetch_assoc();
    $contact5 = $rs5->fetch_assoc();
    $contact6 = $rs6->fetch_assoc();
/*    ?> <pre> <?php
     print_r($contact);
    print_r($contact2);
    print_r($contact3);
    print_r($contact4);
    print_r($contact5);
    print_r($contact6); 
    ?> </pre> <?php*/

    //end database connection
    $db_conn->close();

    //Print out edit page form - may add in table tags here
    echo "<p>Edit the chosen contact below</p>";
    echo "<form method=\"POST\">";
    echo "<label>Contact Type: </label>";
    if ($contact['ct_type'] == "Choice") {
        echo "<select id=\"ct_type\" name=\"ct_type\" size=\"1\">
            <option selected=\"selected\" value=\"Choice\">
            Select type</option>
            <option value=\"Family\">Family</option>
            <option value=\"Friend\">Friend</option>
            <option value=\"Business\">Business</option>
            <option value=\"Other\">Other</option>
            </select></br>";
    } elseif ($contact['ct_type'] == "Family") {
        echo "<select id=\"ct_type\" name=\"ct_type\" size=\"1\">
            <option value=\"Choice\">
            Select type</option>
            <option selected=\"selected\" value=\"Family\">Family</option>
            <option value=\"Friend\">Friend</option>
            <option value=\"Business\">Business</option>
            <option value=\"Other\">Other</option>
            </select></br>";
    } elseif ($contact['ct_type'] == "Friend") {
        echo "<select id=\"ct_type\" name=\"ct_type\" size=\"1\">
            <option value=\"Choice\">
            Select type</option>
            <option value=\"Family\">Family</option>
            <option selected=\"selected\" value=\"Friend\">Friend</option>
            <option value=\"Business\">Business</option>
            <option value=\"Other\">Other</option>
            </select></br>";
    } elseif ($contact['ct_type'] == "Business") {
        echo "<select id=\"ct_type\" name=\"ct_type\" size=\"1\">
            <option value=\"Choice\">
            Select type</option>
            <option value=\"Family\">Family</option>
            <option value=\"Friend\">Friend</option>
            <option selected=\"selected\" value=\"Business\">Business</option>
            <option value=\"Other\">Other</option>
            </select></br>";
    } elseif ($contact['ct_type'] == "Other") {
        echo "<select id=\"ct_type\" name=\"ct_type\" size=\"1\">
            <option value=\"Choice\">Select type</option>
            <option value=\"Family\">Family</option>
            <option value=\"Friend\">Friend</option>
            <option value=\"Business\">Business</option>
            <option selected=\"selected\" value=\"Other\">Other</option>
            </select></br>";
    } else {
        echo "<select id=\"ct_type\" name=\"ct_type\" size=\"1\">
            <option  value=\"Choice\">Select type</option>
            <option value=\"Family\">Family</option>
            <option value=\"Friend\">Friend</option>
            <option value=\"Business\">Business</option>
            <option selected=\"selected\" value=\"Other\">Other</option>
            </select></br>";
    }

    echo "<label> First Name: </label>";
    echo "<input type=\"text\" id = \"ct_first_name\" name = \"ct_first_name\" value=\"{$contact['ct_first_name']}\"/></br>";

    echo "<label> Last Name: </label>";
    echo "<input type=\"text\" id = \"ct_last_name\" name = \"ct_last_name\" value=\"{$contact['ct_last_name']}\"/></br>";

    echo "<label> Display Name: </label>";
    echo "<input type=\"text\" id = \"ct_disp_name\" name = \"ct_disp_name\" value=\"{$contact['ct_disp_name']}\"/></br>";

    echo "<label> Address Type: </label>";
    if ($contact2['ad_type'] == "Choice") {
        echo "<select id=\"ad_type\" name=\"ad_type\" size=\"1\">
        <option selected=\"selected\" value=\"Choice\">Choose type</option>
        <option value=\"Home\">Home</option>
        <option value=\"Work\">Work</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    } elseif ($contact2['ad_type'] == "Home") {
        echo "<select id=\"ad_type\" name=\"ad_type\" size=\"1\">
        <option value=\"Choice\">Choose type</option>
        <option selected=\"selected\" value=\"Home\">Home</option>
        <option value=\"Work\">Work</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    } elseif ($contact2['ad_type'] == "Work") {
        echo "<select id=\"ad_type\" name=\"ad_type\" size=\"1\">
        <option value=\"Choice\">Choose type</option>
        <option value=\"Home\">Home</option>
        <option selected=\"selected\" value=\"Work\">Work</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    } elseif ($contact2['ad_type'] == "Other") {
        echo "<select id=\"ad_type\" name=\"ad_type\" size=\"1\">
        <option value=\"Choice\">Choose type</option>
        <option value=\"Home\">Home</option>
        <option value=\"Work\">Work</option>
        <option selected=\"selected\" value=\"Other\">Other</option>
        </select></br>";
    } else {
        echo "<select id=\"ad_type\" name=\"ad_type\" size=\"1\">
        <option selected=\"selected\" value=\"Choice\">Choose type</option>
        <option value=\"Home\">Home</option>
        <option value=\"Work\">Work</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    }

    echo "<label> Address Line 1: </label>";
    echo "<input type=\"text\" id = \"ad_line_1\" name = \"ad_line_1\" value=\"{$contact2['ad_line_1']}\"/></br>";

    echo "<label> Address Line 2: </label>";
    echo "<input type=\"text\" id = \"ad_line_2\" name = \"ad_line_2\" value=\"{$contact2['ad_line_2']}\"/></br>";

    echo "<label> Address Line 3: </label>";
    echo "<input type=\"text\" id = \"ad_line_3\" name = \"ad_line_3\" value=\"{$contact2['ad_line_3']}\"/></br>";

    echo "<label> City: </label>";
    echo "<input type=\"text\" id = \"ad_city\" name = \"ad_city\" value=\"{$contact2['ad_city']}\"/></br>";

    echo "<label> Province: </label>";
    echo "<input type=\"text\" id = \"ad_province\" name = \"ad_province\" value=\"{$contact2['ad_province']}\"/></br>";

    echo "<label>Postal Code: </label>";
    echo "<input type=\"text\" id = \"ad_post_code\" name = \"ad_post_code\" value=\"{$contact2['ad_post_code']}\"/></br>";

    echo "<label>Country: </label>";
    echo "<input type=\"text\" id = \"ad_country\" name = \"ad_country\" value=\"{$contact2['ad_country']}\"/></br>";
    
    echo "<label>Phone Type: </label>";
    if ($contact3['ph_type'] == "Home") {
        echo "<select id=\"ph_type\" name=\"ph_type\" size=\"1\">
        <option value=\"Choice\">Choose type</option>
        <option selected=\"selected\" value=\"Home\">Home</option>
        <option value=\"Work\">Work</option>
        <option value=\"Mobile\">Mobile</option>
        <option value=\"Fax\">Fax</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    } elseif ($contact3['ph_type'] == "Work") {
        echo "<select id=\"ph_type\" name=\"ph_type\" size=\"1\">
        <option value=\"Choice\">Choose type</option>
        <option value=\"Home\">Home</option>
        <option selected=\"selected\" value=\"Work\">Work</option>
        <option value=\"Mobile\">Mobile</option>
        <option value=\"Fax\">Fax</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    } elseif ($contact3['ph_type'] == "Mobile") {
        echo "<select id=\"ph_type\" name=\"ph_type\" size=\"1\">
        <option value=\"Choice\">Choose type</option>
        <option value=\"Home\">Home</option>
        <option value=\"Work\">Work</option>
        <option selected=\"selected\" value=\"Mobile\">Mobile</option>
        <option value=\"Fax\">Fax</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    } elseif ($contact3['ph_type'] == "Fax") {
        echo "<select id=\"ph_type\" name=\"ph_type\" size=\"1\">
        <option value=\"Choice\">Choose type</option>
        <option value=\"Home\">Home</option>
        <option value=\"Work\">Work</option>
        <option value=\"Mobile\">Mobile</option>
        <option selected=\"selected\" value=\"Fax\">Fax</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    } elseif ($contact3['ph_type'] == "Other") {
        echo "<select id=\"ph_type\" name=\"ph_type\" size=\"1\">
        <option value=\"Choice\">Choose type</option>
        <option value=\"Home\">Home</option>
        <option value=\"Work\">Work</option>
        <option value=\"Mobile\">Mobile</option>
        <option value=\"Fax\">Fax</option>
        <option selected=\"selected\" value=\"Other\">Other</option>
        </select></br>";
    } elseif ($contact3['ph_type'] == "Choice") {
        echo "<select id=\"ph_type\" name=\"ph_type\" size=\"1\">
        <option selected=\"selected\" value=\"Choice\">Choose type</option>
        <option value=\"Home\">Home</option>
        <option value=\"Work\">Work</option>
        <option value=\"Mobile\">Mobile</option>
        <option value=\"Fax\">Fax</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    } else {
        echo "<select id=\"ph_type\" name=\"ph_type\" size=\"1\">
        <option selected=\"selected\" value=\"Choice\">Choose type</option>
        <option value=\"Home\">Home</option>
        <option value=\"Work\">Work</option>
        <option value=\"Mobile\">Mobile</option>
        <option value=\"Fax\">Fax</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    }
    
    echo "<label>Phone Number: </label>";
    echo "<input type=\"text\" id = \"ph_number\" name = \"ph_number\" value=\"{$contact3['ph_number']}\"/></br>";
    
    echo "<label>Email Type: </label>";
    if ($contact4['em_type'] == "Choice") {
        echo "<select id=\"em_type\" name=\"em_type\" size=\"1\">
        <option selected=\"selected\" value=\"Choice\">Choose type</option>
        <option value=\"Home\">Home</option>
        <option value=\"Work\">Work</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    } elseif ($contact4['em_type'] == "Home") {
        echo "<select id=\"em_type\" name=\"em_type\" size=\"1\">
        <option value=\"Choice\">Choose type</option>
        <option selected=\"selected\" value=\"Home\">Home</option>
        <option value=\"Work\">Work</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    } elseif ($contact4['em_type'] == "Work") {
        echo "<select id=\"em_type\" name=\"em_type\" size=\"1\">
        <option value=\"Choice\">Choose type</option>
        <option value=\"Home\">Home</option>
        <option selected=\"selected\" value=\"Work\">Work</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    } elseif ($contact4['em_type'] == "Other") {
        echo "<select id=\"em_type\" name=\"em_type\" size=\"1\">
        <option value=\"Choice\">Choose type</option>
        <option value=\"Home\">Home</option>
        <option value=\"Work\">Work</option>
        <option selected=\"selected\" value=\"Other\">Other</option>
        </select></br>";
    } else {
        echo "<select id=\"em_type\" name=\"em_type\" size=\"1\">
        <option selected=\"selected\" value=\"Choice\">Choose type</option>
        <option value=\"Home\">Home</option>
        <option value=\"Work\">Work</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    }

    echo "<label>Email Address: </label>";
    echo "<input type=\"text\" id = \"em_email\" name = \"em_email\" value=\"{$contact4['em_email']}\"/></br>";

    echo "<label>Web Type: </label>";
    if ($contact5['we_type'] == "Choice") {
        echo "<select id=\"we_type\" name=\"we_type\" size=\"1\">
        <option selected=\"selected\" value=\"Choice\">Choose type</option>
        <option value=\"Personal\">Personal</option>
        <option value=\"Work\">Work</option>
        <option value=\"LinkedIn\">LinkedIn</option>
        <option value=\"Facebook\">Facebook</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    } elseif ($contact5['we_type'] == "Personal") {
        echo "<select id=\"we_type\" name=\"we_type\" size=\"1\">
        <option value=\"Choice\">Choose type</option>
        <option selected=\"selected\" value=\"Personal\">Personal</option>
        <option value=\"Work\">Work</option>
        <option value=\"LinkedIn\">LinkedIn</option>
        <option value=\"Facebook\">Facebook</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    } elseif ($contact5['we_type'] == "Work") {
        echo "<select id=\"we_type\" name=\"we_type\" size=\"1\">
        <option value=\"Choice\">Choose type</option>
        <option value=\"Personal\">Personal</option>
        <option selected=\"selected\" value=\"Work\">Work</option>
        <option value=\"LinkedIn\">LinkedIn</option>
        <option value=\"Facebook\">Facebook</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    } elseif ($contact5['we_type'] == "LinkedIn") {
        echo "<select id=\"we_type\" name=\"we_type\" size=\"1\">
        <option value=\"Choice\">Choose type</option>
        <option value=\"Personal\">Personal</option>
        <option value=\"Work\">Work</option>
        <option selected=\"selected\" value=\"LinkedIn\">LinkedIn</option>
        <option value=\"Facebook\">Facebook</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    } elseif ($contact5['we_type'] == "Facebook") {
        echo "<select id=\"we_type\" name=\"we_type\" size=\"1\">
        <option value=\"Choice\">Choose type</option>
        <option value=\"Personal\">Personal</option>
        <option value=\"Work\">Work</option>
        <option value=\"LinkedIn\">LinkedIn</option>
        <option selected=\"selected\" value=\"Facebook\">Facebook</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    } elseif ($contact5['we_type'] == "Other") {
        echo "<select id=\"we_type\" name=\"we_type\" size=\"1\">
        <option value=\"Choice\">Choose type</option>
        <option value=\"Personal\">Personal</option>
        <option value=\"Work\">Work</option>
        <option value=\"LinkedIn\">LinkedIn</option>
        <option value=\"Facebook\">Facebook</option>
        <option selected=\"selected\" value=\"Other\">Other</option>
        </select></br>";
    } else {
        echo "<select id=\"we_type\" name=\"we_type\" size=\"1\">
        <option selected=\"selected\" value=\"Choice\">Choose type</option>
        <option value=\"Personal\">Personal</option>
        <option value=\"Work\">Work</option>
        <option value=\"LinkedIn\">LinkedIn</option>
        <option value=\"Facebook\">Facebook</option>
        <option value=\"Other\">Other</option>
        </select></br>";
    }

    echo "<label>Web URL: </label>";
    echo "<input type=\"text\" id = \"we_url\" name = \"we_url\" value=\"{$contact5['we_url']}\"/></br>";

    echo "<label> Note: </label>";
    echo "<input type=\"text\" id = \"no_note\" name = \"no_note\" value=\"{$contact6['no_note']}\"/></br>";

    echo "<input type=\"submit\" id = \"btnSaveEdit\" name = \"btnSaveEdit\" value=\"Save\">";
    echo "<input type=\"submit\" id = \"btnCancelEdit\" name = \"btnCancelEdit\" value=\"Cancel\">";
    echo "</form>";
}
//function for validating new data
function validateEditedContact()
{
    //set up error messages array
    $err_msgs = array();
    //validate Contact Type
    if (!isset($_POST['ct_type'])) {
        $err_msgs[] = "No contact type specified";
    } else {
        $ct_type = trim($_POST['ct_type']);
        if (!(($ct_type == "Friend")
              || ($ct_type == "Family")
              || ($ct_type == "Business")
              || ($ct_type == "Other"))) {
            $err_msgs[] = "A valid contact type must be chosen.";
        }
    }
    //Validate Name
    if ($_POST['ct_type'] == "Business") {
        if (!isset($_POST['ct_disp_name'])) {
            $err_msgs[] = "A business name nust be specified";
        } else {
            $dname = trim($_POST['ct_disp_name']);
            if (strlen($dname) == 0) {
                $err_msgs[] = "A business name nust be specified";
            } elseif (strlen($dname) > 200) {
                $err_msgs[] = "The business name nust be no longer than 200 characters in length.";
            }
        }
    } else {
        if (!isset($_POST['ct_first_name'])) {
            $err_msgs[] = "A first name numbe be specified";
        } else {
            $fname = trim($_POST['ct_first_name']);
            if (strlen($fname) == 0) {
                $err_msgs[] = "A first name numbe be specified";
            } elseif (strlen($fname) > 100) {
                $err_msgs[] = "The first name nust be no longer than 100 characters in length.";
            }
        }
        if (!isset($_POST['ct_last_name'])) {
            $err_msgs[] = "A last name numbe be specified";
        } else {
            $lname = trim($_POST['ct_last_name']);
            if (strlen($lname) == 0) {
                $err_msgs[] = "A last name numbe be specified";
            } elseif (strlen($lname) > 100) {
                $err_msgs[] = "The last name nust be no longer than 100 characters in length.";
            }
        }
        if (isset($_POST['ct_disp_name'])) {
            $dname = trim($_POST['ct_disp_name']);
            if (strlen($dname) > 200) {
                $err_msgs[] = "The display name nust be no longer than 200 characters in length.";
            }
        }
        if (count($err_msgs) == 0) {
            $_POST['ct_first_name'] = $fname;
            $_POST['ct_last_name'] = $lname;
            if ((!isset($_POST['ct_disp_name'])) && (strlen($dname) > 0)) {
                $_POST['ct_disp_name'] = $dname;
            } else {
                if ((strlen($fname) > 0) && (strlen($lname) > 0)) {
                    $_POST['ct_disp_name'] = $lname.", ".$fname;
                } elseif (strlen($lname) > 0) {
                    $_POST['ct_disp_name'] = $lname;
                } else {
                    $_POST['ct_disp_name'] = $fname;
                }
            }
        }
    }

    //Validate Address
    if (!isset($_POST['ad_type'])) {
        $err_msgs[] = "An address type must be selected";
    } elseif (isset($_POST['ad_type'])) {
        $type = trim($_POST['ad_type']);
        if (!(($type == "Home") || ($type == "Work") || ($type == "Other"))) {
            $err_msgs[] = "A valid address type must be select5ed";
        }
    } else {
        $_POST['ad_type'] = $type;
    }
    if (!isset($_POST['ad_line_1'])) {
        $err_msgs[] = "The first address line must not be empty";
    } else {
        $line1 = trim($_POST['ad_line_1']);
        if (strlen($line1) == 0) {
            $err_msgs[] = "The first address line must not be empty";
        } elseif (strlen($line1) > 100) {
            $err_msgs[] = "The first address line is too long";
        } else {
            $_POST['ad_line_1'] = $line1;
        }
    }
    if (isset($_POST['ad_line_2'])) {
        $line2 = trim($_POST['ad_line_2']);
        if (strlen($line2) > 100) {
            $err_msgs[] = "The second address line is too long";
        }
    }
    if (isset($_POST['ad_line_3'])) {
        $line3 = trim($_POST['ad_line_3']);
        if (strlen($line3) > 100) {
            $err_msgs[] = "The third address line is too long";
        }
    }
    if (!isset($_POST['ad_city'])) {
        $err_msgs[] = "A city name must be entered";
    } else {
        $city = trim($_POST['ad_city']);
        if (strlen($city) == 0) {
            $err_msgs[] = "A city name must be entered";
        } elseif (strlen($city) > 50) {
            $err_msgs[] = "The city name is too long";
        } else {
            $_POST['ad_city'] = $city;
        }
    }
    if (isset($_POST['ad_province'])) {
        $prov = trim($_POST['ad_province']);
        if (strlen($prov) > 50) {
            $err_msgs[] = "The province field is too long";
        }
    }
    if (isset($_POST['ad_post_code'])) {
        $post = trim($_POST['ad_post_code']);
        if (strlen($post) > 15) {
            $err_msgs[] = "The post code field is too long";
        }
    }
    if (isset($_POST['ad_country'])) {
        $country = trim($_POST['ad_country']);
        if (strlen($country) > 50) {
            $err_msgs[] = "The country field is too long";
        }
    }
    //Validate Phone
    if (!isset($_POST['ph_type'])) {
        $err_msgs[] = "An phone number type must be selected";
    } elseif (isset($_POST['ph_type'])) {
        $type = trim($_POST['ph_type']);
        if (!(($type == "Home") || ($type == "Work") || ($type == "Mobile")
                || ($type == "Fax")|| ($type == "Other"))) {
            $err_msgs[] = "An phone number type must be selected";
        } else {
            $_POST['ph_type'] = $type;
        }
    }
    if (!isset($_POST['ph_number'])) {
        $err_msgs[] = "The phone number field must not sbe empty";
    } else {
        $number = trim($_POST['ph_number']);
        if (strlen($number) == 0) {
            $err_msgs[] = "The phone number field must not sbe empty";
        } elseif (strlen($number) > 50) {
            $err_msgs[] = "The phone number is too long";
        } else {
            $_POST['ph_number'] = $number;
        }
    }

    //Validate Email
    if (!isset($_POST['em_type'])) {
        $err_msgs[] = "An email type must be selected";
    } elseif (isset($_POST['em_type'])) {
        $type = trim($_POST['em_type']);
        if (!(($type == "Home") || ($type == "Work")
                || ($type == "Other"))) {
            $err_msgs[] = "An email type must be selected";
        }
    } else {
        $_POST['em_type'] = $type;
    }
    if (!isset($_POST['em_email'])) {
        $err_msgs[] = "The email address field must not be empty";
    } else {
        $email = trim($_POST['em_email']);
        if (strlen($email) == 0) {
            $err_msgs[] = "The email address field must not be empty";
        } elseif (strlen($email) > 50) {
            $err_msgs[] = "The email address is too long";
        } else {
            $_POST['em_email'] = $email;
        }
    }
    //Validate Web
    if (!isset($_POST['we_type'])) {
        $err_msgs[] = "A web site type must be selected";
    } elseif (isset($_POST['we_type'])) {
        $type = trim($_POST['we_type']);
        if (!(($type == "Personal") || ($type == "Work")
                || ($type == "LinedIn")
                || ($type == "Facebook")|| ($type == "Other"))) {
            $err_msgs[] = "A web site type must be selected";
        } else {
            $_POST['we_type'] = $type;
        }
    }
    if (!isset($_POST['we_url'])) {
        $err_msgs[] = "The URL field must not be empty";
    } else {
        $url = trim($_POST['we_url']);
        if (strlen($url) == 0) {
            $err_msgs[] = "The URL field must not be empty";
        } elseif (strlen($url) > 255) {
            $err_msgs[] = "The URL is too long";
        } else {
            $_POST['we_url'] = $url;
        }
    }

    //Validate Note
    if (!isset($_POST['no_note'])) {
        $err_msgs[] = "The note field must not be empty";
    } else {
        $note = trim($_POST['no_note']);
        if (strlen($note) == 0) {
            $err_msgs[] = "The note field must not be empty";
        } elseif (strlen($note) > 65530) {
            $err_msgs[] = "The note is too long";
        } else {
            $_POST['no_note'] = $note;
        }
    }
}
//function for saving new data to database
function contactEditSave()
{
    //get data from POST variable
    $conType = $_POST['ct_type'];
    $firstName = $_POST['ct_first_name'];
    $lastName = $_POST['ct_last_name'];
    $dispName = $_POST['ct_disp_name'];
    $addType = $_POST['ad_type'];
    $address1 = $_POST['ad_line_1'];
    $address2 = $_POST['ad_line_2'];
    $address3 = $_POST['ad_line_3'];
    $city  = $_POST['ad_city'];
    $province = $_POST['ad_province'];
    $postalCode = $_POST['ad_post_code'];
    $country = $_POST['ad_country'];
    $phoneType = $_POST['ph_type'];
    $phoneNumber = $_POST['ph_number'];
    $emailType = $_POST['em_type'];
    $emailAddress = $_POST['em_email'];
    $webType = $_POST['we_type'];
    $webAddress = $_POST['we_url'];
    $note  = $_POST['no_note'];

    //id of selected contact
    $id = $_SESSION['list_select'];

    //set up database connection
    $db_conn = new mysqli('localhost', 'lamp1user', '!Lamp1!', 'week7');
    if ($db_conn->connect_errno) {
        die("Could not connect to database server".$db_host."\n Error: ".$db_conn->connect_errno ."\n 
        Report: ".$db_conn->connect_error."\n");
    }
    //set up query strings
    $qry = "update contact set 
        ct_type = \"{$conType}\",  
        ct_first_name = \"{$firstName}\", 
        ct_last_name = \"{$lastName}\", 
        ct_disp_name = \"{$dispName}\" 
        where ct_id = {$id};";
    $qry2 = "update contact_address set 
        ad_type = \"{$addType}\", 
        ad_line_1 = \"{$address1}\", 
        ad_line_2 = \"{$address2}\", 
        ad_line_3 = \"{$address3}\", 
        ad_city = \"{$city}\", 
        ad_province = \"{$province}\", 
        ad_post_code = \"{$postalCode}\", 
        ad_country = \"{$country}\" 
        where ad_ct_id = {$id};";
    $qry3 = "update contact_phone set 
        ph_type = \"{$phoneType}\",
        ph_number = \"{$phoneNumber}\"
        where ph_ct_id = {$id};";
    $qry4 = "update contact_email set 
        em_type = \"{$emailType}\",
        em_email = \"{$emailAddress}\"        
        where em_ct_id = {$id};";
    $qry5 = "update contact_web set 
        we_type = \"{$webType}\",
        we_url = \"{$webAddress}\"        
        where we_ct_id = {$id};";
    $qry6 = "update contact_note set 
        no_note = \"{$note}\"
        where no_ct_id = {$id};";

    //run queries and close database connection
    $db_conn->query($qry);
    $db_conn->query($qry2);
    $db_conn->query($qry3);
    $db_conn->query($qry4);
    $db_conn->query($qry5);
    $db_conn->query($qry6);
    $db_conn->close();
    echo "Data stored";
    if (isset($_SESSION['list_select'])) {
        unset($_SESSION['list_select']);
    }
}
