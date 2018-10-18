<?php
///////////////////////////////////////////////////////////////////////////
//  Product: Daddy's Link Protector                 
//  Version: 1.X                             
//                              
// by DaddyScripts.com                      
//                                      
///////////////////////////////////////////////////////////////////////////

include('header.php');
if ($_POST['submit'] == "") {
} else {
    $title      = $_POST['title'];
    $postedinfo = $_POST['information'];
    if (!strpos($postedinfo, "://"))
        $postedinfo = "http://" . $postedinfo;
    $postedtitle = $_POST['title'];
    $postedtitle = str_replace("'", '', "$postedtitle");
    $postedtitle = str_replace("&", '', "$postedtitle");
    $postedtitle = str_replace("|", '%20', "$postedtitle");
    $postedtitle = stripslashes("$postedtitle");
    $radiotop20  = $_POST['R1'];
    $radiopass   = $_POST['R2'];
    $userip      = $_SERVER['REMOTE_ADDR'];
    $todaydate   = getdate();
    if ($postedinfo == "" or $postedtitle == "") {
        echo "<div class=\"error\"><img src=\"./img/error.png\">Please fill in all the fields below:</div>";
    } else {
        $fancyurl = rand(0, 999) . $title;
        $rand2    = ("$fancyurl");
        $filename = "./files/" . $rand2 . ".dlp";
        if (file_exists($filename)) {
            die("An unusual error occured. Please navigate BACK using your browser and re-submit your links again.");
        } else {
            $filelist   = fopen("./files/" . $rand2 . ".dlp", "w");
            $fileconfig = fopen("./config/" . $rand2 . ".dlp", "w");
            
            if ($radiopass == "V3") {
                $radiopass = "Yes";
            } else {
                $radiopass = "No";
            }
            $time = time();
            fwrite($filelist, $postedinfo . "\n");
            fwrite($fileconfig, $time . "|" . $radiopass . "|" . md5($_POST['pass']) . "|" . $userip . "|0");
            $me = $shorturl;
            if ($me == true)
                $short = "";
            else
                $short = "index.php?ID=";
            
?>
<div class="success"><img src="./img/success.png">Your new URL is <?
            echo $scripturl . $short . $rand2;
?></div>
<?
        }
    }
}
if ($_GET['ID'] == "") {
    if (isset($_POST['submit'])) {
    } else {
?>
<center><div class="notice"><img src="./img/note.png"><?php
        echo $sitetitle;
?> is a free service, that allows you to protect your link(s).</div></center>
<?php
    }
?>
<FORM ACTION="<?= $PHP_SELF ?>" METHOD="POST" NAME="newsentry">
<fieldset> 
<p align="center">
<b>Title:</b>
<input type="title" name="title" size="20">
</p>
<p align="center">
<b>Links</b><br>
<TEXTAREA NAME="information" COLS="40" ROWS="5"></TEXTAREA><br>
<div id="email">
      <p align="center"><label><b>Password</b><br>
        </label>
      <input name="pass" type="password" size="20" />
    </div>
<p align="center">
<BR>Password Protected?* Yes <input onclick="javascript: $('#email').show('slow');" type="radio" name="R2" value="V3" />  No
<input onclick="javascript: $('#email').hide('slow');" type="radio" name="R2" value="V4" checked /><br>
<br>
<p align="center">
<INPUT TYPE="submit" NAME="submit" VALUE="Create Protected Links!"><BR>
</p>
</fieldset> 

</p>
<?
} else {
?>
<?
    $IDFile = "./files/" . $_GET["ID"] . ".dlp";
    if (file_exists($IDFile)) {
        $fop     = fopen("./config/" . $_GET["ID"] . ".dlp", "r");
        $content = fread($fop, '999');
        fclose($fop);
        $content = explode("|", $content);
        if (isset($_POST['Submit0'])) {
            if (in_array(md5($_POST['Pass1']), $content)) {
                $passplus = "allow";
            }
        }
        if ($content[1] == "Yes" && $passplus == "") {
            if (isset($_POST['Submit0'])) {
?>
<div class="error"><img src="./img/error.png">You have entered an incorrect password. Please make sure you are authorized to view these links and try again later.</div>
<?
            } else {
            }
?>
</FORM><p align="center">Password Protected Link(s):<BR>
    &nbsp;</p>
<form method="POST" action="<?php
            echo $_SERVER['php_SELF'];
?>">
    <p align="center"><input type="password" name="Pass1" size="20"></p>
    <p align="center"><input type="submit" value="Submit" name="Submit0"></p>
</form>
<p align="center"><BR><BR>
    </p>
<?
        } elseif ($content[1] == "No") {
?>

<?
            if (isset($_POST['submit1']) && $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code']) || isset($_SESSION['bypass']) && $_SESSION['bypass']) {
                $_SESSION['bypass'] = TRUE;
                // Insert you code for processing the form here, e.g emailing the submission, entering it into a database. 
                if (isset($_SESSION['views']) && $_SESSION['views'] == $_GET['ID']) {
                } else {
                    $fileconfig = fopen("./config/" . $_GET['ID'] . ".dlp", "w");
                    fwrite($fileconfig, $content[0] . "|" . $content[1] . "|" . $content[2] . "|" . $content[3] . "|" . ($content[4] + 1));
                    fclose($fileconfig);
                    $_SESSION['views'] = $_GET['ID'];
                    $views             = $content[4] + 1;
                }
?>
<center>
<p>Hidden Links:<BR>
   <?php
                $fop   = fopen('./files/' . $_GET['ID'] . '.dlp', 'r');
                $links = fread($fop, filesize('./files/' . $_GET['ID'] . '.dlp'));
                fclose($fop);
                $links   = explode("\n", $links);
                $arrayNo = count($links);
                $i       = 0;
                while ($links[$arrayNo] <> $links[$i]) {
?>
<p><a href="<?php
                    echo $links[$i];
?>"><?php
                    echo $links[$i];
?></a></p>
<?php
                    $i++;
                }
?>
</center></p>
<?php
                if (isset($views)) {
?>
<p align="center">Views: <?php
                    echo $views;
?></p>
<?php
                } else {
?>
<p align="center">Views: <?php
                    echo $content[4];
?></p>
<?
                }
                unset($_SESSION['security_code']);
            } else {
                if (isset($_POST['submit1'])) {
                    // Insert your code for showing an error message here
                    echo "<div class=\"error\"><img src=\"./img/error.png\">Sorry, you have provided an invalid security code</div>";
                }
?>
<form method="POST" action="<?php
                echo $_SERVER['php_SELF'];
?>">
        
        <p align="center">
        <img src="CaptchaSecurityImages.php?width=100&height=40&characters=5" /><br />
        <label for="security_code">Security Code: </label><input id="security_code" name="security_code" type="text" /><br />
        <input type="submit" name="submit1" value="Submit" />
</p>
</form>
<?
            }
        } elseif ($passplus == "allow") {
            if (isset($_SESSION['views']) && $_SESSION['views'] == $_GET['ID']) {
            } else {
                $fileconfig = fopen("./config/" . $_GET['ID'] . ".dlp", "w");
                fwrite($fileconfig, $content[0] . "|" . $content[1] . "|" . $content[2] . "|" . $content[3] . "|" . ($content[4] + 1));
                fclose($fileconfig);
                $_SESSION['views'] = $_GET['ID'];
                $views             = $content[4] + 1;
            }
?>
<center>
<p>Hidden Links:<BR>
   <?php
            $fop   = fopen('./files/' . $_GET['ID'] . '.dlp', 'r');
            $links = fread($fop, filesize('./files/' . $_GET['ID'] . '.dlp'));
            fclose($fop);
            $links   = explode("\n", $links);
            $arrayNo = count($links);
            $i       = 0;
            while ($links[$arrayNo] <> $links[$i]) {
?>
<p><a href="<?php
                echo $links[$i];
?>"><?php
                echo $links[$i];
?></a></p>
<?php
                $i++;
            }
?>
</center></p>
<?php
            if (isset($views)) {
?>
<p align="center">Views: <?php
                echo $views;
?></p>
<?php
            } else {
?>
<p align="center">Views: <?php
                echo $content[4];
?></p>
<?
            }
        }
    } else {
        echo "<div class=\"error\"><img src=\"./img/error.png\">The ID was not found.</div>";
?>

    
<?
    }
}
include('footer.php');
?>