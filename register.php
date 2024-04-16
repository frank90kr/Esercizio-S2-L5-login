<?php
    //inclusione file connessione database e template html/bootstrap
    include_once __DIR__ . '/includes/session.php';
    include_once __DIR__ . '/includes/template.php';

//     // Avvia la sessione
// session_start();

// // Controlla se l'utente è già autenticato
// if (isset($_SESSION['user_id'])) {
//     // Utente già autenticato, reindirizzalo ad un'altra pagina
//     header("Location: /");
//     exit;
// }

    $user = [];
    $user['username'] = $_POST['username'] ?? '';
    $user['email'] = $_POST['email'] ?? '';
    $user['password'] = $_POST['password'] ?? '';
    print_r($user);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // validazioni
        // print_r($_POST); exit;

        //Prepariamo la query per inserire i dati del nuovo utente nel db
        $stmt = $pdo->prepare("
            INSERT INTO user
            (username, email, password)
            VALUES (:username, :email, :password);
        ");

        //Eseguiamo la query
        $stmt->execute([
            'username' => $_POST['username'],
            'email'    => $_POST['email'],
        //implementiamo l'hashing della password
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ]);

        header('Location: /Esercizio-S2-L5-login/login.php');
        exit;
    }

    ?>

Benvenuto <?= $user_from_db['username'] ?? 'Guest' ?> 
    <h1 class="text-center">Registrazione</h1>
    <div class="container d-flex justify-content-center py-3">
    <form action="" method="POST" novalidate>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="">
        </div>
        <button type="submit" class="btn btn-primary">Registrami</button>
    </form>
    </div>

    