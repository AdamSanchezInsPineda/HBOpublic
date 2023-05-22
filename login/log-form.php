<?php
session_start();

include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate user input
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

    // Prepare and execute the database query to fetch the user record
    $stmt = $db->prepare("SELECT * FROM tusers WHERE username = ?");
    $stmt->bind_param("s", $username);

    if (!$stmt->execute()) {
        die("Error: " . $stmt->error);
    }

    // Get the user record from the query result
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verify the password
    if ($user && password_verify($password, $user['password'])) {
        // Set session variables and redirect to home page
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: ../home/home.php');
        exit;
    } else {
        // Display error message
        $error_message = "Invalid username or password.";
    }

    $stmt->close();
}

$db->close();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicia sessió - HBO Badalona</title>
        <link rel="icon" href="resources/icon/hbo.png">
        <link href="https://fonts.cdnfonts.com/css/gilroy-bold" rel="stylesheet">
        <link href="https://vjs.zencdn.net/8.0.4/video-js.css" rel="stylesheet" />
        <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">
        <link href="./bootstrap.min.css" rel="stylesheet">

        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
        </style>

        
        <!-- Custom styles for this template -->
        <link href="./log-style.css" rel="stylesheet">
    </head>
  <body class="bg-light">
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <a href="../index.html"><img class="d-block mx-auto mb-4" src="../resources/icon/hbo.png" alt="" width="72" height="65"></a>
      <h2>Iniciar Sessió</h2>
    </div>

    <div class="row g-5">
      <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
      <?php } ?>
      <div class="col-md-7 col-lg-8">
        <form method="post" action="" class="needs-validation" id="form" novalidate>
          <div class="row g-3">

            <div class="col-12">
              <label for="username" class="form-label">Usuari</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" pattern="[a-zA-Z0-9]+" placeholder="Usuari" name="username" required>
              <div class="invalid-feedback">
                  Nom d'usuari requerit
                </div>
              </div>
            </div>

            <div class="col-12">
              <label for="password" class="form-label">Password</label>
              <div class="input-group has-validation">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
              <div class="invalid-feedback">
                  Password requerit.
                </div>
              </div>
            </div>

            <br><br>

          <button class="w-100 btn btn-primary btn-lg" type="submit" value="tusers">Log In</button>
        </form>
      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2023 HBO badalona</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacitat</a></li>
      <li class="list-inline-item"><a href="#">Termins</a></li>
      <li class="list-inline-item"><a href="#">Suport</a></li>
    </ul>
  </footer>
</div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="./log-js.js"></script>
  </body>
</html>
