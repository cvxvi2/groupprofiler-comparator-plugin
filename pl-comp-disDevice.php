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
        if($_SERVER["REQUEST_METHOD"] == "POST") {
          if(isset($_POST["devnm"])) {
            if(is_file('algs/md5this.php')) {
              include 'algs/md5this.php';
              $nwdv = MD5This($_POST["devnm"]);
              if(is_dir('app/modcom/lic/'.$nwdv)) {
                echo '<h3>Poll Result</h3>';
                echo '<hr>';
                file_put_contents('app/modcom/lic/'.$nwdv.'/stat.txt','DISABLED') or die("<h4>Failure updating device. Please check the PHP log.</h4>");
                echo '<h4>The device has been set to disabled. If an error shows, please re-poll the device.</h4>';  
                echo '<a href="pl-comp-disDevice.php" class="btn btn-primary">OK</a>';
              } else {
                echo '<h3>Poll Result</h3>';
                echo '<hr>';
                echo '<h4>The requested device is not present on this activation server. Nothing has been changed.</h4>';  
                echo '<a href="pl-comp-disDevice.php" class="btn btn-primary">OK</a>';
              }


            } else {
              echo '<h3>Error - Missing Files</h3>';
              echo '<hr>';
              echo '<h4>The required module MD5This for Algs cannot be found.</h4>';
              echo '<a href="index.php" class="btn btn-primary">OK</a>';
            }

          } else {
            echo '<h3>Error</h3>';
            echo '<hr>';
            echo '<h4>You must specify a device to be polled.</h4>';
            echo '<a href="pl-comp-disDevice.php" class="btn btn-primary">Try again</a>';
          }



        } else {
          echo '<h2>Comparator Plugin - Disable Device</h2><hr>';
          echo '<h3>Enter device name to be DISABLED (caSe SeNSiTiVe):</h3>';
          echo '				<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">';
          echo '											<div class="form-group'.(!empty($username_err)).'">';
          echo '												<label>Device hostname to be disabled (usually in CAPS):</label>';
          echo '												<input type="text" name="devnm" class="form-control" value="">';
          echo '											</div>    ';
          echo '<br>';
          echo '											<div class="form-group">';
          echo '												<input class="btn btn-primary" type="submit" value="Disable Device">';
          echo '											</div>';
          echo '										</form>';
          echo '</div>';
          echo '<div class="container">';
          echo '<h3>What does this do?</h3>';
          echo '<h4>Disabling a device should be used when you want to block a device from running Comparator, this is useful if you no longer have control of the device you had the client installed on.</h4>';
          echo '</div>';
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
