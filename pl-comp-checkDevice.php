<?php
function legacySTRContains (string $haystack, string $needle)
{
    return empty($needle) || strpos($haystack, $needle) !== false;
}
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
                if(is_file('app/modcom/lic/'.$nwdv.'/stat.txt')) {
                  $ttm = file_get_contents('app/modcom/lic/'.$nwdv.'/stat.txt');
                  echo '<h3>Poll Result</h3>';
                  echo '<hr>';
                  if (!function_exists('str_contains')) {
                    if(legacySTRContains($ttm,'ACTIVE')) {
                      echo '<h4>The device '.$_POST["devnm"].' is currently ACTIVE</h4>';  
                    } else {
                      echo '<h4>The device '.$_POST["devnm"].' is currently DISABLED</h4>';  
                    }
                  } else {
                    if(str_contains($ttm,'ACTIVE')) {
                    echo '<h4>The device '.$_POST["devnm"].' is currently ACTIVE</h4>';  
                  } else {
                    echo '<h4>The device '.$_POST["devnm"].' is currently DISABLED</h4>';  
                  }
                  }          
                  echo '<a href="pl-comp-checkDevice.php" class="btn btn-primary">OK</a>';
                } else {
                  echo '<h3>Poll Result</h3>';
                  echo '<hr>';
                  echo '<h4>The device you requested exists, but has not been enabled or disabled yet.<br>It will currently refuse any requests.</h4>';  
                  echo '<a href="pl-comp-checkDevice.php" class="btn btn-primary">OK</a>';
                }
              } else {
                echo '<h3>Poll Result</h3>';
                echo '<hr>';
                echo '<h4>The requested device is not present on this activation server.</h4>';  
                echo '<a href="pl-comp-checkDevice.php" class="btn btn-primary">OK</a>';
              }
            } else {
              echo '<h3>Error - Missing Files</h3>';
              echo '<hr>';
              echo '<h4>The required module MD5This for Algs cannot be found.</h4>';
            }
          } else {
            echo '<h3>Error</h3>';
            echo '<hr>';
            echo '<h4>You must specify a device to be polled.</h4>';
            echo '<a href="pl-comp-checkDevice.php" class="btn btn-primary">Try again</a>';
          }
        } else {
          echo '<h2>Comparator Plugin - Poll Device</h2><hr>';
          echo '<h3>Enter device name to be polled (caSe SeNSiTiVe):</h3>';
          echo '				<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">';
          echo '											<div class="form-group'.(!empty($username_err)).'">';
          echo '												<label>Device hostname to poll (usually in CAPS):</label>';
          echo '												<input type="text" name="devnm" class="form-control" value="">';
          echo '											</div>    ';
          echo '<br>';
          echo '											<div class="form-group">';
          echo '												<input class="btn btn-primary" type="submit" value="Poll">';
          echo '											</div>';
          echo '										</form>';
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