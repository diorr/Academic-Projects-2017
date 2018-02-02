<?php
function formDisplayContacts()
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

    //end database connection
    $db_conn->close();

    //Print out edit page form - may add in table tags here
    echo "<p>Edit the chosen contact below</p>";
    echo "<form method=\"POST\">";
    echo "<label>Contact Type: </label>";
    echo $contact['ct_type']."</br><p>";

    echo "First Name: ";
    echo $contact['ct_first_name']."</br>";

    echo "Last Name: ";
    echo $contact['ct_last_name']."</br>";

    echo "<label> Display Name: </label>";
    echo $contact['ct_disp_name']."</br>";

    echo "<label> Address Type: </label>";
    echo $contact2['ad_type']."</br>";

    echo "<label> Address Line 1: </label>";
    echo $contact2['ad_line_1']."</br>";

    echo "<label> Address Line 2: </label>";
    echo $contact2['ad_line_2']."</br>";

    echo "<label> Address Line 3: </label>";
    echo $contact2['ad_line_3']."</br>";

    echo "<label> City: </label>";
    echo $contact2['ad_city']."</br>";

    echo "<label> Province: </label>";
    echo $contact2['ad_province']."</br>";

    echo "<label>Postal Code: </label>";
    echo $contact2['ad_post_code']."</br>";

    echo "<label>Country: </label>";
    echo $contact2['ad_country']."</br>";
    
    echo "<label>Phone Type: </label>";
    echo $contact3['ph_type']."</br>";
    
    echo "<label>Phone Number: </label>";
    echo $contact3['ph_number']."</br>";
    
    echo "<label>Email Type: </label>";
    echo $contact4['em_type']."</br>";

    echo "<label>Email Address: </label>";
    echo $contact4['em_email']."</br>";

    echo "<label>Web Type: </label>";
    echo $contact5['we_type']."</br>";

    echo "<label>Web URL: </label>";
    echo $contact5['we_url']."</br>";

    echo "<label> Note: </label>";
    echo $contact6['no_note']."</br>";

    echo "<input type=\"submit\" id = \"btnBack\" name = \"btnBack\" value=\"Back\">";
    echo "</form>";
    if (isset($_SESSION['list_select'])) {
        unset($_SESSION['list_select']);
    }
}
