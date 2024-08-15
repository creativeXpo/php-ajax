<?php 
    include('database.php');
    $sql = "select id, name from student order by name asc";
    $res = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch JSON Data with Ajax</title>
    <!-- Pico.css -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@picocss/pico@2.0.6/css/pico.min.css"
    />
    <style>
        .table-area{
            display: none;
        }
    </style>
</head>
<body>

    <main class="container">
        <h2 style="text-align: center;">Fetch JSON data with the help of PHP and Ajax</h2>

        <div class="select-field">
            <select name="student_list" id="student_list" onchange="getData(this.options[this.selectedIndex].value)">
                <option value="">Slect Student</option>
                <?php while($row = mysqli_fetch_assoc($res)) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="table-area" id="table_show">
            <table>
                <tr>
                    <td width="10%">Name</td>
                    <td><span id="s_name"></span></td>
                </tr>
                <tr>
                    <td width="10%">City</td>
                    <td><span id="s_city"></span></td>
                </tr>
                <tr>
                    <td width="10%">Email</td>
                    <td><span id="s_email"></span></td>
                </tr>
            </table>
        </div>

    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>

    function getData(id) {
        if (id === "") {
            jQuery('#table_show').hide();
            return;
        }
        jQuery.ajax({
            url: 'getData.php',
            type: 'POST',
            data: { id: id },
            success: function(result) {
                try {
                    var json_data = jQuery.parseJSON(result);
                    jQuery('#table_show').show();
                    jQuery('#s_name').html(json_data.name);
                    jQuery('#s_city').html(json_data.city);
                    jQuery('#s_email').html(json_data.email);
                } catch (e) {
                    console.error("JSON parsing error:", e);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error:", status, error);
            }
        });
    }


    </script>
</body>
</html>