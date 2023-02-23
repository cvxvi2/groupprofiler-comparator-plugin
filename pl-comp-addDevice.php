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
                echo '<h4>The device already exists on this Comparator activation server. You should use the <a href="pl-comp-enDevice.php">Enable</a> or <a href="pl-comp-disDevice.php">Disable</a> functions instead.</h4>';  
                echo '<a href="pl-comp-addDevice.php" class="btn btn-primary">OK</a>';
              } else {
                mkdir('app/modcom/lic/'.$nwdv) or die('<h3>ERROR -- Unable to create directory for new device.</h3>');
                file_put_contents('app/modcom/lic/'.$nwdv.'/stat.txt','ACTIVE') or die("<h4>Failure updating device. Please check the PHP log.</h4>");
                echo '<h3>Add Device</h3>';
                echo '<hr>';              
                echo '<h4>If no errors are displayed, the device has been successfully enabled on this server.</h4>';  
                echo '<a href="pl-comp-addDevice.php" class="btn btn-primary">OK</a>';
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
            echo '<a href="pl-comp-addDevice.php" class="btn btn-primary">Try again</a>';
          }
        } else {
          echo '<h2>Comparator Plugin - Add Device</h2><hr>';
          echo '<h3>Enter device name to be added to this server (caSe SeNSiTiVe):</h3>';
          echo '				<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">';
          echo '											<div class="form-group'.(!empty($username_err)).'">';
          echo '												<label>Device hostname to be allowed to use Comparator (usually in CAPS):</label>';
          echo '												<input type="text" name="devnm" class="form-control" value="">';
          echo '											</div>    ';
          echo '<br>';
          echo '											<div class="form-group">';
          echo '												<input class="btn btn-primary" type="submit" value="Add Device">';
          echo '											</div>';
          echo '										</form>';
          echo '</div>';
          echo '<div class="container">';
          echo '<h3>What does this do?</h3>';
          echo '<h4>Adding a device to the Comparator license server allows Comparator to run without getting activation warnings which block the use of it. <br>You <b>cannot</b> do this on a device that is already added to the server. If your device has been disabled, use the <a href="pl-Comp-enDevice.php">enable device</a> page to re-enable it.</h4>';
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