<?php
function formContactSave(){
?>
    <h3>Save Contact </h3>
    <form method="POST" >
    <table>
    <tr><td>Contact Type</d><td><?php echo $_SESSION['ct_type']; ?></td></tr>
    <tr><td>Display/Business Name</d><td><?php echo $_SESSION['ct_disp_name']; ?></td></tr>
    <tr><td>First Name</td><td><?php echo $_SESSION['ct_first_name']; ?></td></tr>
    <tr><td>Last Name</td><td><?php echo $_SESSION['ct_last_name']; ?></td></tr>
<?php if (isset($_SESSION['ad_type'])){ ?>
    <tr><td><br></td><td></td></tr>
    <tr><td>Address Type</td><td><?php echo $_SESSION['ad_type']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ad_line_1'])){ ?>
    <tr><td>Address Line 1</td><td><?php echo $_SESSION['ad_line_1']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ad_line_2'])){ ?>
    <tr><td>Address Line 2</td><td><?php echo $_SESSION['ad_line_2']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ad_line_3'])){ ?>
    <tr><td>Address Line 3</td><td><?php echo $_SESSION['ad_line_3']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ad_city'])){ ?>
    <tr><td>City</td><td><?php echo $_SESSION['ad_city']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ad_province'])){ ?>
    <tr><td>Province</td><td><?php echo $_SESSION['ad_province']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ad_post_code'])){ ?>
    <tr><td>Post Code</td><td><?php echo $_SESSION['ad_post_code']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ad_country'])){ ?>
    <tr><td>Country</td><td><?php echo $_SESSION['ad_country']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ph_type'])){ ?>
    <tr><td><br></td><td></td></tr>
    <tr><td>Phone Type</td><td><?php echo $_SESSION['ph_type']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['ph_number'])){ ?>
    <tr><td>Phone Number</td><td><?php echo $_SESSION['ph_number']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['em_type'])){ ?>
    <tr><td><br></td><td></td></tr>
    <tr><td>Email Type</td><td><?php echo $_SESSION['em_type']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['em_email'])){ ?>
    <tr><td>Email Address</td><td><?php echo $_SESSION['em_email']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['we_type'])){ ?>
    <tr><td><br></td><td></td></tr>
    <tr><td>Web Site Type</td><td><?php echo $_SESSION['we_type']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['we_url'])){ ?>
    <tr><td>Web Site URL</td><td><?php echo $_SESSION['we_url']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['no_note'])){ ?>
    <tr><td><br></td><td></td></tr>
    <tr><td>Note</td><td><?php echo $_SESSION['no_note']; ?></td></tr>
<?php } ?>
    </table>
    <table>
    <tr>
        <td><input type="submit" name="ct_b_back" value="Back"></td>
        <td><input type="submit" name="ct_b_next" value="Save"></td>
    </tr>
    <tr>
        <td><input type="submit" name="ct_b_cancel" value="Cancel"></td>
    </tr>
    </table>
    </form>
<?php
}
?>
<?php
function saveContact($db_conn){
    $qry_ct = "insert into contact set ct_type='".$_SESSION['ct_type']."'";
    if (isset($_SESSION['ct_first_name'])){
	$input = addslashes($_SESSION['ct_first_name']);
        $qry_ct .= ", ct_first_name='".$input."'";
    } else {
        $qry_ct .= ", ct_first_name=''";
    }
    if (isset($_SESSION['ct_last_name'])){
	$input = addslashes($_SESSION['ct_last_name']);
        $qry_ct .= ", ct_last_name='".$input."'";
    } else {
        $qry_ct .= ", ct_last_name=''";
    }
    if (isset($_SESSION['ct_disp_name'])){
	$input = addslashes($_SESSION['ct_disp_name']);
        $qry_ct .= ", ct_disp_name='".$input."'";
    } else {
        $qry_ct .= ", ct_disp_name=''";
    }
    $qry_ct .= ", ct_deleted='N';";
    $db_conn->query($qry_ct);
    $id = $db_conn->insert_id;

    if (isset($_SESSION['ad_type'])){
	$inputId = addslashes($id);
        $qry_ad = "insert into contact_address set ad_ct_id='".$inputId."'";
	$input = addslashes($_SESSION['ad_type']);
        $qry_ad .= ", ad_type='".$input."'";
        if (isset($_SESSION['ad_line_1'])){
	    $input = addslashes($_SESSION['ad_line_1']);
            $qry_ad .= ", ad_line_1='".$input."'";
        } else {
            $qry_ad .= ", ad_line_1=''";
        }
        if (isset($_SESSION['ad_line_2'])){
	    $input = addslashes($_SESSION['ad_line_2']);
            $qry_ad .= ", ad_line_2='".$input."'";
        } else {
            $qry_ad .= ", ad_line_2=''";
        }
        if (isset($_SESSION['ad_line_3'])){
	    $input = addslashes($_SESSION['ad_line_3']);
            $qry_ad .= ", ad_line_3='".$input."'";
        } else {
            $qry_ad .= ", ad_line_3=''";
        }
        if (isset($_SESSION['ad_city'])){
	    $input = addslashes($_SESSION['ad_city']);
            $qry_ad .= ", ad_city='".$input."'";
        } else {
            $qry_ad .= ", ad_city=''";
        }
        if (isset($_SESSION['ad_province'])){
	    $input = addslashes($_SESSION['ad_provinces']);
            $qry_ad .= ", ad_province='".$input."'";
        } else {
            $qry_ad .= ", ad_province=''";
        }
        if (isset($_SESSION['ad_post_code'])){
	    $input = addslashes($_SESSION['ad_post_code']);
            $qry_ad .= ", ad_post_code='".$input."'";
        } else {
            $qry_ad .= ", ad_post_code=''";
        }
        if (isset($_SESSION['ad_contry'])){
	    $input = addslashes($_SESSION['ad_country']);
            $qry_ad .= ", ad_country='".$_SESSION['ad_country']."'";
        } else {
            $qry_ad .= ", ad_country=''";
        }
        $qry_ad .= ", ad_active='Y';";
        $db_conn->query($qry_ad);
    }
    if (isset($_SESSION['ph_type'])){
	$inputId = addslashes($id);
        $qry_ph = "insert into contact_phone  set ph_ct_id='".$inputId."'";
	$input = addslashes($_SESSION['ph_type']);
        $qry_ph .= ", ph_type='".$input."'";
        if (isset($_SESSION['ph_number'])){
	    $input = addslashes($_SESSION['ph_number']);
            $qry_ph .= ", ph_number='".$input."'";
        } else {
            $qry_ph .= ", ph_number=''";
        }
        $qry_ph .= ", ph_active='Y';";
        $db_conn->query($qry_ph);
    }
    if (isset($_SESSION['em_type'])){
	$inputId = addslashes($id);
        $qry_em = "insert into contact_email  set em_ct_id='".$inputId."'";
	$input = addslashes($_SESSION['em_type']);
        $qry_em .= ", em_type='".$input."'";
        if (isset($_SESSION['em_email'])){
	    $input = addslashes($_SESSION['em_email']);
            $qry_em .= ", em_email='".$input."'";
        } else {
            $qry_em .= ", em_email=''";
        }
        $qry_em .= ", em_active='Y';";

        $db_conn->query($qry_em);
    }
    if (isset($_SESSION['we_type'])){
	$inputId = addslashes($id);
        $qry_we = "insert into contact_web  set we_ct_id='".$inputId."'";
	$input = addslashes($_SESSION['we_type']);
        $qry_we .= ", we_type='".$input."'";
        if (isset($_SESSION['we_url'])){
	    $input = addslashes($_SESSION['we_url']);
            $qry_we .= ", we_url='".$input."'";
        } else {
            $qry_we .= ", we_url=''";
        }
        $qry_we .= ", we_active='Y';";
        $db_conn->query($qry_we);
    }
    if (isset($_SESSION['no_note'])){
	$inputId = addslashes($id);
        $qry_no = "insert into contact_note  set no_ct_id='".$inputId."'";
        $qry_no .= ", no_type=''";
	$input = addslashes($_SESSION['no_note']);
        $qry_no .= ", no_note='".$input."';";
        $db_conn->query($qry_no);
    }
}
?>
