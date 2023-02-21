<?php
session_start();
echo '<!DOCTYPE HTML>';
echo '<html lang="en">';
echo '<head>';
include 'wsubs/includeBootstrapCSS.html';
include 'wsubs/includeBootstrapMeta.html';
echo '</head>';
echo '<body>';
include 'nsubs/nvbanner.php';
include 'nsubs/nvbr.php';
if(isset($_SESSION["LIN"])) {
    if($_SESSION["LIN"] === true) {
      if(is_file('pl-comp-funcs.php')) {
        include 'pl-comp-funcs.php';
        echo '<div class="container">';
        if(modcomPresent() === true) {
          echo '<h3>Modcom (Comparator) detected OK!</h3>';

        } else {
          echo '<h3>Modcom (Comparator) not detected when checking app/modcom/lic.</h3>';
        }
        echo '</div>';
      } else {
        echo '<h3>Missing Comparator plugin files</h3>';

      }
        






        
        
    } else {
      include 'wsubs/index-loutmsg.html';
    }
} else {
  include 'wsubs/index-loutmsg.html';

}
include 'wsubs/includeBootstrapScript.html';
echo '</body>';
echo '</html>';
