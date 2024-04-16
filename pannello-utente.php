<?php

include_once __DIR__ . '/includes/template.php';
include_once __DIR__ . '/includes/session.php';




// Elimina tutte le variabili di sessione
$_SESSION = array();

// Distrugge la sessione
session_destroy();

// elimina il cookie della sessione
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}


// header("Location: /Esercizio-S2-L5-login/pannello-");
// exit;
?>




<h1 class="text-center">Benvenuto nel tuo pannello utente</h1>

<div class="d-flex justify-content-center mt-3">
<a href="./index.php" class="btn btn-info">Logout</a>
</div>