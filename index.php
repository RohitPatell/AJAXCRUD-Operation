<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="text-primary text-center">AJAX CRUD OPERATION</h1>
        <div class="d-flex justify-content-end">
            <input class="form-control" style="float: right;" id="myInput" type="text" placeholder="Search..">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Add Student
            </button>
        </div>
        <h2 class="text-primary">All Records</h2>
        <div id="record_content" style="background-color:lavender">
        </div>
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">AJAX CRUD OPERATION</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname">
                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Lastname">
                        </div>
                        <div class="form-group">

                            <label for="">Email Id:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">

                            <label for="">Mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="email">Image:</label>
                            <input type="file" class="form-control" id="imageInput" placeholder="Select Your Image" name="img" required>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" id="uploadButton" class="btn btn-primary" onclick="addRecord()" data-dismiss="modal">Save</button>
                    </div>

                </div>
            </div>
        </div>

        <!-------------------- update form ---------------------------------------------------------------------------->

        <div class="modal" id="updateModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title">AJAX CRUD OPERATION</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" class="form-control ufirstname" id="ufn" name="ufirstname" placeholder="firstname">
                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control ulastname" id="uln" name="ulastnam" placeholder="Lastname">
                        </div>
                        <div class="form-group">

                            <label for="">Email Id:</label>
                            <input type="email" class="form-control uemail" id="ue" name="uemail" placeholder="Email">
                        </div>
                        <div class="form-group">

                            <label for="">Mobile</label>
                            <input type="text" class="form-control umobile" id="um" name="umobile" placeholder="Mobile">
                        </div>
                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="updateuserdetail()" data-dismiss="modal">Update</button>
                        <input type="hidden" class="hiddenidu" name="hiddenidu" id="hiddenidu">
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h2>CSV File Upload</h2>
        <form method="post" enctype="multipart/form-data">
            <label for="csvfile">Select CSV File:</label>
            <input type="file" name="csvfile" id="csvfile" accept=".csv" required>
            <button type="submit">Upload</button>
        </form>
        <br>

        <!-- //button for download table in excel formate -->

        <a  href="export.php"><button class="btn btn-primary">Export</button></a>




    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        recordrecords();
    });

    function recordrecords() {
        var recordrecord = "recordrecord";
        $.ajax({
            url: "backend.php",
            type: "POST",
            data: {
                recordrecord: recordrecord
            },
            success: function(data, status) {
                $("#record_content").html(data);
            }
        });
    }

    $(document).ready(function() {
        $('#uploadButton').on('click', function() {
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var email = $('#email').val();
            var mobile = $('#mobile').val();
            var input = $('#imageInput')[0];
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = new Image();
                    img.src = e.target.result;

                    img.onload = function() {
                        var maxWidth = 300;
                        var maxHeight = 300;

                        var width = img.width;
                        var height = img.height;

                        if (width > height) {
                            if (width > maxWidth) {
                                height *= maxWidth / width;
                                width = maxWidth;
                            }
                        } else {
                            if (height > maxHeight) {
                                width *= maxHeight / height;
                                height = maxHeight;
                            }
                        }

                        var canvas = document.createElement('canvas');
                        canvas.width = width;
                        canvas.height = height;

                        var ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0, width, height);

                        var dataURL = canvas.toDataURL('image/jpeg');
                        $.ajax({
                            type: 'POST',
                            url: 'backend.php',
                            data: {
                                fname: firstname,
                                lname: lastname,
                                emails: email,
                                mobiles: mobile,
                                image: dataURL
                            },
                            success: function(data, status) {
                        // Update the content on the page
                        recordrecords();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error("Error:", textStatus, errorThrown);
                    }

                        });
                    };
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    });

     function addRecord(){
        recordrecords();
     };

     function addRecord() {
         recordrecords();
         var firstname = $('#firstname').val();
         var lastname = $('#lastname').val();
         var email = $('#email').val();
         var mobile = $('#mobile').val();
         var input = $('#imageInput')[0];
         if (input.files && input.files[0]) {
             var reader = new FileReader();
             reader.onload = function(e) {
                 var img = new image();
                 img.src = e.target.result;
                 img.onload = function() {
                     var maxheight = 300;
                     var maxwidth = 300;
                    var height = img.height;
                    var width = img.width;
                    if (width > height) {
                         if (width > maxWidth) {
                             height *= maxWidth / width;
                             width = maxWidth;
                         }
                     } else {
                         if (height > maxHeight) {
                             width *= maxHeight / height;
                             height = maxHeight;
                         }
                     }
                     var canvas = document.createElement('canvas');
                    canvas.width = width;
                     canvas.height = height;
                     var ctx = canvas.getContext('2d');
                     ctx.drawImage(img, 0, 0, width, height);
                     var dataURL = canvas.toDataURL('image/jpeg');
                 }
             }
         }
         $.ajax({
             url: "backend.php",
             type: "POST",
             data: {
                 fname: firstname,
                 lname: lastname,
                 emails: email,
                 mobiles: mobile,
                 image: dataURL
             },
             success: function(data, status) {
                 recordrecords();
             }
         });
     }



     // Delete Student
    function Deleteuser(deleteid) {
        var canf = confirm("Are You Sure.");
        if (canf == true) {
            $.ajax({
                url: "backend.php",
                type: "POST",
                data: {
                    deleteid: deleteid
                },
                success: function(data, status) {
                    recordrecords();
                }
            });
        }


    }



    // Edit Student

    function GetUserDetails(id) {
        $('#hid').val(id);
        $.post("backend.php", {
                id: id
            }, function(data, status) {
                try {
                    var user = JSON.parse(data);
                    $('.hiddenidu   ').val(user.id);
                    $('.ufirstname').val(user.firstname);
                    $('.ulastname').val(user.lastname);
                    $('.uemail').val(user.email);
                    $('.umobile').val(user.phone);
                } catch (error) {
                    console.error("Error parsing JSON data:", error);
                }
            })
            .done(function() {
                $('#updateModal').modal("show");
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX request failed:", textStatus, errorThrown);
            });
    }

    function updateuserdetail() {
        var firstnameu = $('#ufn').val();
        var lastnameu = $('#uln').val();
        var emailu = $('#ue').val();
        var mobileu = $('#um').val();
        var hiddenidu = $('#hiddenidu').val();
        //console.log(firstnameu);
        $.post(
            "backend.php", {
                firstname: firstnameu,
                lastname: lastnameu,
                email: emailu,
                mobile: mobileu,
                hiddenid: hiddenidu,
            },

            function(data, status) {
                $('#updateModal').modal("hide");
                recordrecords();
            }

        )
    }


    //code for perform search operation on table
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('columnIndex').on('click', function() {
            console.log(columnIndex);
        });
    });
</script>
<script>
    function sortTableup(columnIndex) {
        var orderBy = '';
        switch (columnIndex) {
            case 0:
                orderBy = 'id';
                break;
            case 1:
                orderBy = 'firstname';
                break;
            case 2:
                orderBy = 'lastname';
                break;
            case 3:
                orderBy = 'email';
                break;
            case 4:
                orderBy = 'phone';
                break;
            default:
                orderBy = 'id';
        }

        var currentOrder = $('#order').val();
        var newOrder = (currentOrder === 'ASC') ? 'DESC' : 'ASC';

        $.ajax({
            url: "backend.php",
            type: "POST",
            data: {
                recordrecord: true,
                orderBy: orderBy,
                order: newOrder,
            },
            success: function(data, status) {
                $("#record_content").html(data);
                $('#order').val(newOrder); // Update the current order value
            }
        });
    }

    function sortTabledown(columnIndex) {
        var orderBy = '';
        switch (columnIndex) {
            case 0:
                orderBy = 'id';
                break;
            case 1:
                orderBy = 'firstname';
                break;
            case 2:
                orderBy = 'lastname';
                break;
            case 3:
                orderBy = 'email';
                break;
            case 4:
                orderBy = 'phone';
                break;
            default:
                orderBy = 'id';
        }
        var currentOrderdown = $('#order').val();
        var newOrderdown = (currentOrderdown === 'DESC') ? 'ASC' : 'DESC';
        $.ajax({
            url: "backend.php",
            type: "POST",
            data: {
                recordrecord: true,
                orderBy: orderBy,
                order: newOrderdown,
            },
            success: function(data, status) {
                $("#record_content").html(data);
                $('#order').val(newOrderdown); // Update the current order value
            }
        });

    }
</script>

</html>

<!-- code for fetchdata and convert into xml file -->

<?php
$conn = new mysqli("localhost", "root", "", "test");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["csvfile"])) {
    $csvFile = $_FILES["csvfile"]["tmp_name"];

    $file = fopen($csvFile, 'r');

    if ($file) {
        $headers = fgetcsv($file);
        while (($data = fgetcsv($file)) !== false) {
            $row = array_combine($headers, $data);

            $id = mysqli_real_escape_string($conn, $row['id']);
            $firstname = mysqli_real_escape_string($conn, $row['firstname']);
            $lastname = mysqli_real_escape_string($conn, $row['lastname']);
            $email = mysqli_real_escape_string($conn, $row['email']);
            $phone = mysqli_real_escape_string($conn, $row['phone']);

            $sql = "INSERT INTO students (id, firstname,lastname, email, phone) VALUES ('$id', '$firstname', '$lastname', '$email', '$phone') 
                    ON DUPLICATE KEY UPDATE firstname='$firstname',lastname='$lastname',email='$email',phone='$phone'";

            if ($conn->query($sql) === TRUE) {
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        echo "Record inserted or updated successfully<br>";

        }

        fclose($file);
    } else {
        echo "Error opening the file";
    }
}

$conn->close();

?>