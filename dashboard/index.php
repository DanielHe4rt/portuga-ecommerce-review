<?php 

error_reporting(0);

require '../keyauth.php';
require '../credentials.php';

session_start();

if (!isset($_SESSION['user_data'])) 
{
    header("Location: ../");
    exit();
}

$KeyAuthApp = new KeyAuth\api($name, $ownerid);

function findSubscription($name, $list)
{
    for ($i = 0; $i < count($list); $i++) {
        if ($list[$i]->subscription == $name) {
            return true;
        }
    }
    return false;
}

$username = $_SESSION["user_data"]["username"];
$subscriptions = $_SESSION["user_data"]["subscriptions"];
$subscription = $_SESSION["user_data"]["subscriptions"][0]->subscription;
$expiry = $_SESSION["user_data"]["subscriptions"][0]->expiry;
$ip = $_SESSION["user_data"]["ip"];
$creationDate = $_SESSION["user_data"]["createdate"];
$lastLogin = $_SESSION["user_data"]["lastlogin"];

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../");
    exit();
}
?>
<html lang="pt" class="bg-[#09090d] text-white overflow-x-hidden">

<head>
    <title>Painel</title>
    <script src="https://cdn.keyauth.cc/dashboard/unixtolocal.js"></script>

    <link rel="stylesheet" href="https://cdn.keyauth.cc/v3/dist/output.css">
</head>

<body>
    <?php
        $KeyAuthApp->log("Novo login de: " . $username); 
    ?>

    <p class="text-md">Logado como <?= $username; ?></p>
    <p class="text-md">IP <?= $ip; ?></p>
    <p class="text-md">Data de Criação <?= date('Y-m-d H:i:s', $creationDate) ?></p>
    <p class="text-md">Último Login <?= date('Y-m-d H:i:s', $lastLogin) ?></p>
    <p class="text-md">A assinatura com o nome <code
            style="background-color: #1a56db;border-radius: 3px;font-family: courier, monospace;padding: 0 3px;">default</code>
        existe: <?= ((findSubscription("default", $_SESSION["user_data"]["subscriptions"]) ? 1 : 0) ? 'sim' : 'não'); ?>
    </p>
  
    <?php
    for ($i = 0; $i < count($subscriptions); $i++) {
        echo "#" . ($i + 1) . " Assinatura: " . $subscriptions[$i]->subscription . " - Assinatura Expira: " . "<script>document.write(convertTimestamp(" . $subscriptions[$i]->expiry . "));</script>";
    }
    ?>
    <div>

        <form method="post">
            <button
                class="inline-flex text-white bg-red-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200"
                name="logout">
                Sair
            </button>
        </form>

    </div>
  
</body>

</html>
