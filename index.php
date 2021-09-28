<?php
die("Oin! =)");

$conMs = mssql_connect('198.50.152.2', 'sa', 'ico26ne0@');
mssql_select_db('MuOnline', $conMs);
$qr = mssql_query("SELECT TOP 100 c.Name,c.cLevel,m.MasterLevel,c.Class "
        . "FROM MuOnline.dbo.Character c, MuOnline.dbo.MasterSkillTree m "
        . "WHERE c.Name = m.Name AND c.AccountID NOT IN "
        . "(SELECT memb___id FROM MEMB_INFO WHERE AccountLevel > 0) AND [CtlCode] < 32 ORDER BY m.MasterLevel DESC, m.MasterExperience DESC, c.cLevel DESC");

function getClass($id) {
    switch($id)
    {
        case 0:$class = "Dark Wizard";break;
        case 8:$class = "Soul Master";break;
        case 12:$class = "Grand Master";break;
        case 14:
            $class = "Soul Wizard";
            break;        
        case 16:
            $class = "Dark Knight";
            break;
        case 24:
            $class = "Blade Knight";
            break;
        case 28:
            $class = "Blade Master";
            break;
        case 30:
            $class = "Dragon Knight";
            break;        
        case 32:
            $class = "Fairy Elf";
            break;
        case 40:
            $class = "Muse Elf";
            break;
        case 44:
            $class = "High Elf";
            break;
        case 46:
            $class = "Noble Elf";
            break;
        case 48:
            $class = "Magic Gladiator";
            break;
        case 60:
            $class = "Duel Master";
            break;
        case 62:
            $class = "Magic Knight";
            break;
        case 64:
            $class = "Dark Lord";
            break;
	case 76:
            $class = "Lord Emperor";
            break;
        case 78:
            $class = "Empire Lord";
            break;
        case 80:
            $class = "Summoner";
            break;
        case 88:
            $class = "Bloody Summoner";
            break;
        case 92:
            $class = "Dimension Master";
            break;
        case 94:
            $class = "Dimension Summoner";
            break;
        case 96:
            $class = "Rage Fighter";
            break;
        case 108:
            $class = "Fist master";
            break;
        case 110:
            $class = "Fist Blazer";
            break;
        case 112:
            $class = "Grow Lancer";
            break;
        case 124:
            $class = "Mirage Lancer";
            break;
        case 126:
            $class = "Shining Lancer";
            break;
        default:
            $class = "-";
    }
    return $class;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="UTF-8">
            <title>Jurassic MU</title>

            <style>
                body {
                    background-color: #000;
                    color: #DDD;
                    font-family: Verdana;
                    font-size: 14px;
                }
                th {
                    color: #000;
                    font-weight: bold;
                }
            </style>
    </head>
    <body>
        <table width="100%" border="1">
            <tr>
                <th bgcolor="#FFF">#</th>
                <th bgcolor="#FFF">Character</th>
                <th bgcolor="#FFF">Class</th>
                <th bgcolor="#FFF">Level</th>
                <th bgcolor="#FFF">Guild</th>
            </tr>
            <?php
            for ($i = 1; $i <= mssql_num_rows($qr); $i++) :
                $bg = ($i%2==0) ? "#333" : "#444";
                $data = mssql_fetch_row($qr);
                $guildQr = mssql_query("SELECT G_Name FROM MuOnline.dbo.GuildMember WHERE Name = '$data[0]'");
                if (mssql_num_rows($guildQr) == 1)
                {
                    $guildRs = mssql_fetch_row($guildQr);
                    $guild = $guildRs[0];
                }
                else
                    $guild = "-";
                ?>
                <tr>
                    <td align="center" bgcolor="<?php echo $bg; ?>"><?php echo $i; ?>º</td>
                    <td align="center" bgcolor="<?php echo $bg; ?>"><?php echo $data[0]; ?></td>
                    <td align="center" bgcolor="<?php echo $bg; ?>"><?php echo getClass($data[3]); ?></td>
                    <td align="center" bgcolor="<?php echo $bg; ?>"><?php echo $data[1] + $data[2]; ?></td>                
                    <td align="center" bgcolor="<?php echo $bg; ?>"><?php echo $guild; ?></td>
                </tr>
<?php endfor; ?>
        </table>
    </body>
</html>