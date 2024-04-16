<?php

include_once __DIR__ . '/includes/template.php';
include_once __DIR__ . '/includes/session.php';



 // Controlla se l'utente è già autenticato
 if (isset($_SESSION['user_id'])) {
     // Utente già autenticato, reindirizzalo ad un'altra pagina
     header("Location: /Esercizio-S2-L5-login/pannello-utente.php");
     exit;
     
 }


$user = [];
$user['username'] = $_POST['username'] ?? '';
$user['password'] = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {   
    $stmt = $pdo->prepare("
        SELECT * FROM user
        WHERE username = :username;
    ");

    $stmt->execute([
        'username' => $_POST['username'],
    ]);

    $user_from_db = $stmt->fetch();

    // verificare che c'è una riga risultante
    if ($user_from_db) {
        // confrontare gli hash
        if (password_verify($_POST['password'], $user_from_db["password"])) {
            // se gli hash coincidono => utente loggato, altrimenti errore
            $_SESSION['user_id'] = $user_from_db['id'];
            echo ('Benvenuto ' . $user_from_db["username"]);

            // header("Location: /Esercizio-S2-L5-login/pannello-utente.php");
            // exit;
            

}
    }
}
?>

<h1 class="text-center ">Login</h1>
<div class="container d-flex justify-content-center">
    <form action="" method="POST" novalidate>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    </div>

