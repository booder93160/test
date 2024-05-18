<?php
function req_db($req, $params)
{
    $db = new SQLite3("./truc.db");
    $stmt = $db->prepare($req);

    // Liaison des paramètres
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }

    $results = $stmt->execute();
    $toret = $results->fetchArray();
    return $toret;
}

if (isset($_POST["username"]) && isset($_POST["password"]))
{
    // Récupération des valeurs des champs username et password
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    // Requête pour vérifier si l'utilisateur existe déjà
    $a = req_db("SELECT * FROM users WHERE username = :username", [
        ':username' => $username
    ]);

    if (! $a)
    {
        // Utilisation de la requête préparée pour insérer un nouvel utilisateur
        printf("Successfully created user. Redirecting...");
        req_db("INSERT INTO users(username, password, admin) VALUES(:username, :password, 1)", [
            ':username' => $username,
            ':password' => $password
        ]);
    }
    else
    {
        printf("Failed creating user. Redirecting...");
    }
}
?>
<script>
    window.onload = function() { setTimeout(function() { window.location.href = "/"; }, 2000); }
</script>
