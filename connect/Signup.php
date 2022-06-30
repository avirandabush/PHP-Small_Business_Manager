<?php include '../config/Database.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBM - Sign Up</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
</head>
<body>
    <h1>Small Business Manager</h1>

    <?php
        $businessName = $id = $email = $password = $repassword = '';
        $businessNameErr = $idErr = $emailErr = $passwordErr = $repasswordErr = '';
        
        // Form submit
        if(isset($_POST['submit']))
        {
            // Validate name
            if(empty($_POST['businessName']))
            {
                $businessNameErr = 'Business name is required';
            }
            else
            {
                $businessName = filter_var($_POST['businessName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
            // Validate id
            if(empty($_POST['id']))
            {
                $idErr = 'ID is required';
            }
            else
            {
                $id = filter_var($_POST['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
            // Validate email
            if(empty($_POST['email']))
            {
                $emailErr = 'Email is required';
            }
            else
            {
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            }
            // Validate password
            if(empty($_POST['password']))
            {
                $passwordErr = 'Password is required';
            }
            else
            {
                $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Hash the password
                $hashPass = password_hash($password, PASSWORD_DEFAULT);
            }
            // Validate re password
            if(empty($_POST['repassword']))
            {
                $repasswordErr = 'Re enter your Password';
            }
            elseif($_POST['password'] != $_POST['repassword'])
            {
                $repasswordErr = 'Passwords not match';
            }
            else
            {
                $repassword = filter_var($_POST['repassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }

            // No errors, Create user and redirect
            if(empty($businessNameErr) && empty($idErr) && empty($emailErr) 
                && empty($passwordErr) && empty($repasswordErr))
            {
                // Check if ID already exsist
                $sql = "SELECT id FROM users";
                $result = $conn->query($sql);
                $idExsist = 0;

                if($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        if(strcmp($id, $row['id']))
                        {
                            echo "id is alredy exsist";
                            $idExsist = 0;
                        }
                    }
                }
                
                if(!($idExsist))
                {
                    // Sign user into users's table
                    $sql = "INSERT INTO `users` (`id`, `name`, `email`, `password`) 
                    VALUES ('$id', '$businessName', '$email', '$hashPass')";

                    if($conn->query($sql) === TRUE)
                    {
                        echo "New record created successfully";
                    }
                    else
                    {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                    // Create data table for user
                    $sql = "CREATE TABLE $aa (id INT(5), firstname VARCHAR(30))";
                    if (mysqli_query($conn, $sql)) {
                        echo "Table MyGuests created successfully";
                      } else {
                        echo "Error creating table: " . mysqli_error($conn);
                      }


                    // Reloacte to wellcome page
                    //header('Location: UserCreated.php');
                }
            }
        }

        
    ?>
 
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] ); ?>" autocomplete="off">
        <h2>Sign Up</h2>

        <div>
            <label for="businessName">Business Name</label>
            <input type="text" id="businessName" name="businessName" 
            class="form-input <?php echo $businessNameErr ? 'invalid' : null ?>" placeholder="Enter your business's name" required>
        </div>
        <div class="invalid-filed">
            <?php echo $businessNameErr; ?>
        </div>

        <div>
            <label for="id">Business ID</label>
            <input type="text" id="id" name="id" 
            class="form-input <?php echo $idErr ? 'invalid' : null ?>" placeholder="Enter your business's ID" required>
        </div>
        <div class="invalid-filed">
            <?php echo $idErr; ?>
        </div>
        
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" 
            class="form-input <?php echo $emailErr ? 'invalid' : null ?>" placeholder="Enter your Email" required>
        </div>
        <div class="invalid-filed">
            <?php echo $emailErr; ?>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" 
            class="form-input <?php echo $passwordErr ? 'invalid' : null ?>" placeholder="Choose Password" required>
        </div>
        <div class="invalid-filed">
            <?php echo $passwordErr; ?>
        </div>

        <div>
            <label for="repassword">Re enter Password</label>
            <input type="password" id="repassword" name="repassword" 
            class="form-input <?php echo $repasswordErr ? 'invalid' : null ?>" placeholder="Enter Password again" required>
        </div>
        <div class="invalid-filed">
            <?php echo $repasswordErr; ?>
        </div>

        <div>
            <input type="submit" name="submit" value="Send" class="form-input">
        </div>
    </form>
</body>
</html>