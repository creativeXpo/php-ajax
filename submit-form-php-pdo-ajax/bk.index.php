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
        .err_cls{
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
            var name = $('#name').val();
            var city = $('#city').val();
            var marks = $('#marks').val();
            $('.err_cls').html('');
            var is_error='';
            
            if(name == '') {
                $('#name_err').html('Please enter name.');
                is_error = 'yes';
            }
            if(city == '') {
                $('#city_err').html('Please select city.');
                is_error = 'yes';
            }
            if(marks == '') {
                $('#marks_err').html('Please enter marks.');
                is_error = 'yes';
            }
            if(is_error == '') {
                var datastring = 'name='+name+'&city='+city+'&marks='+marks;
                $('#result').html('Please wait...');
                
                jQuery.ajax({
                    url: 'submit.php',
                    type: 'post',
                    data: datastring,
                    success: function(data){
                        $('#result').html(data);
                    }
                });
            }
        }

    </script>
</body>
</html>