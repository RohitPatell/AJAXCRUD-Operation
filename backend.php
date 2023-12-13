<?php
$conn = mysqli_connect("localhost", "root", "", "test");
extract($_POST);

if (isset($_POST['recordrecord'])) {
    $data = '<table class="table table-bordered table-striped">
    <tr>
                            <th onclick="sortTable(0)">Id</th>
                            <th onclick="sortTable(1)">FirstName</th>
                            <th onclick="sortTable(2)">LastName</th>
                            <th onclick="sortTable(3)">Email</th>
                            <th onclick="sortTable(4)">Phone Number</th>
                            <th>Edit Action</th>
                            <th>Delete Action</th>
                            </tr>
                            ';

    $orderBy = isset($_POST['orderBy']) ? $_POST['orderBy'] : 'id';
    $order = isset($_POST['order']) ? $_POST['order'] : 'ASC';
    $displaydata = "SELECT * FROM `students` ORDER BY $orderBy $order";
    echo"<pre>";
    print_r($order);
    echo"</pre>";
    $result = mysqli_query($conn, $displaydata);
    if (mysqli_num_rows($result) > 0) {
        $number = 1;
        while ($row = mysqli_fetch_array($result)) {
            $data .= '<tbody id="myTable">
            <tr>
            <td>' . $number . '</td>
            <td>' . $row['firstname'] . '</td>
            <td>' . $row['lastname'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['phone'] . '</td>
            <td>    
            <button onclick="GetUserDetails(' . $row['id'] . ')" type="button" class="btn btn" data-toggle="modal" data-target="#updateModal">
            Edit
        </button>

            </td>
            <td>
            <button onclick="Deleteuser(' . $row['id'] . ')" class="btn sbtn-danger">Delete</button>
            </td>
        </tr>
        </tbody>';
            $number++;
        }
    }
    $data .= '</table>';
    echo $data;
}

if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['emails']) && isset($_POST['mobiles'])) {
    $query = "insert into `students`( `firstname`, `lastname`, `email`, `phone`) values ('$fname','$lname','$emails','$mobiles')";
    $run = mysqli_query($conn, $query);

    if ($run) {
        echo "Data Inserted SuccessFully.";
    } else {
        echo "Error.";
    }
}

if (isset($_POST['deleteid'])) {

    $userid = $_POST['deleteid'];
    //print_r($userid);
    $delete = "DELETE FROM `students` WHERE id = $userid";
    mysqli_query($conn, $delete);
}

if (isset($_POST['id']) && isset($_POST['id']) != "") {
    $userid = $_POST['id'];
    $query = "SELECT * FROM students WHERE id = '$userid'";
    if (!$result = mysqli_query($conn, $query)) {
        die("MySQL Error: " . mysqli_error($connection));
    }
    $response = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response = $row;
        }
    } else {
        $response['status'] = 200;
        $response['message'] = "DATA IS NOT FOUND!";
    }
    echo json_encode($response);
} else {
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}

// update
if (isset($_POST['hiddenid'])) {
    $hidddnid = $_POST['hiddenid'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $emails = $_POST['email'];
    $phone = $_POST['mobile'];
    $uquery = "UPDATE `students` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$emails',`phone`='$phone' WHERE id = $hidddnid";
    mysqli_query($conn, $uquery);
}



?>
