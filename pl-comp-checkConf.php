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
          echo '<h4>Specifics:<br>Modcom: app/modcom/<br>Licenses: app/modcom/lic</h4>';
          echo '<a href="index.php" class="btn btn-primary">OK</a>';
        } else {
          echo '<h3>Modcom (Comparator) not detected when checking app/modcom/lic.</h3>';
          echo '<a href="index.php" class="btn btn-primary">OK</a>';
        }
        echo '</div>';
      } else {
        echo '<h3>Missing Comparator plugin files</h3>';
        echo '<h4>Please reinstall the plugin, and try again.</h4>';
        echo '<a href="index.php" class="btn btn-primary">OK</a>';
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
