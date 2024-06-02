<?php
    if (isset($_GET['hal'])) {
        if ($_GET['hal']=='ini_index') {
          include "style/style_tabel.php";
        }
        elseif ($_GET['hal']=='form_quiz') {
          include "style/style2.php";
        }
        elseif ($_GET['hal']=='update') {
          include "style/style2.php";
        }
        else
        {
          include "style/style1.php";
        }
    }else{
    include "style/style1.php";
    }
?>