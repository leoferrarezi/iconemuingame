<?php
$maxpage = 100;
$page = (isset($_GET['page'])) ? $_GET['page'] : 0;

$page = ($page < 0 || $page > $maxpage) ? 0 : $page;

$params = [
    'token' => 'hjTveBf7GYQQm8ckct6ySQkf3juRT7DKRjf9MVDf3jVfVH57Dkdpjderv33AuquRyEcpR37sXBDkGDRWnmw2ZvkjLLtMN2VKtaz8dRDwTC7hU6CUZUqxxgWyDYgzvtu8kkrBzBFbQ8NqxuLQk4gTQHxnf658u5JsSbvj85Ukj7yhSUQLd4U3WG35nzPms2CqRGQrZs68SezNMMseU7Qt9LxxGV49XXgTzQZemkHVsgJgGPNNd893k6DGgGJ5zsw6',
    'page' => $page
];

$defaults = array(
    CURLOPT_URL => 'http://158.69.154.84/?rankingReset',
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $params,
    CURLOPT_RETURNTRANSFER => true
);

$ch = curl_init();

curl_setopt_array($ch, $defaults);

$server_output = curl_exec($ch);

curl_close($ch);

$json = json_decode($server_output);

?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IconeMU Game Panel</title>
    <link type="text/css" rel="stylesheet" href="ingame_guide.css" />
    <script type="text/javascript" src="jquery.js"></script>
    <style>
        body {
            color:darksalmon;            
        }

        th {
            color: yellow;
        }

        .BasicOver {
            background: url('btn.png') no-repeat;
            width: 151px;
            height: 48px;
            text-align: center;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 18px;
            line-height: 40px;
        }

        a {
            color: white;
            text-decoration: none;
        }

        a:visited {
            color: white;
            text-decoration: none;
        }

        a:active {
            color: white;
            text-decoration: none;
        }

        a:hover {
            color: yellow;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="wrap_ingame wrap_main">
        <table style="position: relative; width: 490px; margin: auto; padding-top: 40px;" cellpadding="5">
            <tr>
                <th>#</th>
                <th style="text-align: left">Nome</th>
                <th>Classe</th>
                <th>Resets</th>
                <th>Nível</th>
                <th>Guild</th>
            </tr>
            <?php
            for ($i = 0; $i < 10; $i++) :
                $bg = ($i % 2 == 0) ? "#333" : "#444";
            ?>
                <tr>
                    <td style="text-align: center"><?php echo $page*10+$i+1; ?>º</td>
                    <td style="font-weight: bold; color: white;"><?php echo $json->ranking[$i]->char; ?></td>
                    <td style="text-align: center"><?php echo $json->ranking[$i]->class; ?></td>
                    <td style="text-align: center"><?php echo $json->ranking[$i]->resets; ?></td>
                    <td style="text-align: center"><?php echo $json->ranking[$i]->level; ?></td>
                    <td style="text-align: center"><?php echo $json->ranking[$i]->guild; ?></td>
                </tr>
            <?php endfor; ?> 
        </table>
        <table style="position: relative; width: 490px; margin: auto;" cellpadding="5">
            <tr>
                <td><a href="index.php">Voltar</a></td>
                <td><a href="indexRank.php?page=<?php echo $page-1; ?>"><<< Anteriores</a></td>
                <td><a href="indexRank.php?page=<?php echo $page+1; ?>">Próximos >>></a></td>
            </tr>
        </table>
    </div>
</body>

</html>