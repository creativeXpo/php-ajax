<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Pico.css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2.0.6/css/pico.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .err_cls {
            color: red;
        }
    </style>
</head>

<body>
    <main class="container">
        <div class="form-container">
            <form>
                <label for="name">Name: </label>
                <input type="text" id="name" name="name"><br>
                <span id="name_err" class="err_cls"></span>

                <label for="city">City: </label>
                <select name="city" id="city">
                    <option value="">Select City</option>
                    <option>Dhaka</option>
                    <option>Comilla</option>
                    <option>Chattogram</option>
                </select><br>
                <span id="city_err" class="err_cls"></span>

                <label for="marks">Marks: </label>
                <input type="text" id="marks" name="marks"><br>
                <span id="marks_err" class="err_cls"></span>

                <input type="button" name="submit" value="Submit" id="submit" onclick="submit_data()">

            </form>
        </div>
        <div id="result"></div>
    </main>

    <script>

        function submit_data() {
            // Get values from input fields
            var name = $('#name').val().trim();
            var city = $('#city').val();
            var marks = $('#marks').val().trim();

            // Clear previous error messages
            $('.err_cls').html('');
            var hasError = false;

            // Validate the name field
            if (name === '') {
                $('#name_err').html('Please enter your name.');
                hasError = true;
            }

            // Validate the city field
            if (city === '') {
                $('#city_err').html('Please select a city.');
                hasError = true;
            }

            // Validate the marks field
            if (marks === '' || isNaN(marks)) {
                $('#marks_err').html('Please enter valid marks.');
                hasError = true;
            }

            // If no errors, proceed with AJAX submission
            if (!hasError) {
                var data = {
                    name: name,
                    city: city,
                    marks: marks
                };

                $('#result').html('Please wait...');

                $.ajax({
                    url: 'submit.php',
                    type: 'POST',
                    data: data,
                    success: function (response) {

                        $('#result').html(response);

                        // Clear the form fields after successful submission
                        $('#name').val('');
                        $('#city').val('');
                        $('#marks').val('');

                        // Hide the #result div after 3 seconds
                        setTimeout(function () {
                            $('#result').fadeOut('slow');
                        }, 3000);
                    },
                    error: function (xhr, status, error) {
                        $('#result').html('An error occurred: ' + error);

                        // Hide the #result div after 3 seconds
                        setTimeout(function () {
                            $('#result').fadeOut('slow');
                        }, 3000);
                    }
                });
            }
        }

    </script>
</body>

</html>