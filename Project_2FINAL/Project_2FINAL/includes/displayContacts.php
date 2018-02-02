<?php
function displayContacts($db_conn)
{

    $qry = "select ct_id, ct_disp_name, ad_city from contact left join contact_address on ct_id = ad_ct_id";
    if (isset($_SESSION['ct_filter'])) {
        if ((strlen($_SESSION['ct_filter']) > 0)) {
            $qry .= " where ct_disp_name like '%".$_SESSION['ct_filter']."%'";
        }
    }
    $qry .= " order by ct_disp_name;";
    if ($rs = $db_conn->query($qry)) {
        if ($rs->num_rows > 0) {
?>
            <table border="1">
            <tr><th>Select</th><th>Name</th><th>Location</th></tr>
<?php while ($row = $rs->fetch_assoc()) { ?>
            <tr>
            <td><input type="radio" name="list_select[]" value="<?php echo $row['ct_id']; ?>"></td>
            <td><?php echo $row['ct_disp_name']; ?></td>
            <td><?php echo $row['ad_city']; ?></td>
            </tr>
<?php } ?>
            </table>
<?php
        } else {
            echo "<div>\n";
            echo "<p>No contacts to display</p>\n";
            echo "</div>\n";
        }
    }
}
?>
