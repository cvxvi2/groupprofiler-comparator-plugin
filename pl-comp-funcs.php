<?php

function getPluginVersion() {
    return "v0.0.2";
}

function isAlgPresent() {
    if(is_file('algs/md5this.php')) {
        return true;      
    } else {
        return false;
    }
}


function modcomPresent() {
    clearstatcache();
    if(is_dir('app/modcom/lic')) {
        return true;
    } else {
        echo 'missing';
        return false;
    }

}







?>