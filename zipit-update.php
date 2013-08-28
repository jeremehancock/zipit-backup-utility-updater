<?php
###############################################################
# Zipit Backup Utility
###############################################################
# Developed by Jereme Hancock for Cloud Sites
# Visit http://zipitbackup.com for updates
###############################################################

// get name of progress file. This will keep on demand backuups from colliding with auto backups
   $progress_hash = $argv[1];
   $progress_file = $progress_hash. "-progress.php";

// Set the default timezone
   date_default_timezone_set('America/Chicago');
   $date = date("M-d-Y-h:i:s");

chdir("../");
// check for previous installation and back it up
   if (is_dir("zipit")) {
      $previous_install = "zipit_backed_up_$date";
      shell_exec("mv zipit $previous_install");
// update progress file
   file_put_contents($progress_file,"<link href='../$previous_install/css/style.css' rel='stylesheet' type='text/css'><br/><center>Backing up current install...<br/><img src='../$previous_install/images/progress.gif'/></center>");

// sleep for 3 seconds. This helps make the progress more aesthetic for smaller sites where the process would run so fast you couldn't see what happened.
   sleep(3);

   }

// update progress file
   file_put_contents($progress_file,"<link href='../$previous_install/css/style.css' rel='stylesheet' type='text/css'><br/><center>Getting latest version...<br/><img src='../$previous_install/images/progress.gif'/></center>");

// sleep for 3 seconds. This helps make the progress more aesthetic for smaller sites where the process would run so fast you couldn't see what happened.
   sleep(3);

// grab the latest version of zipit from github
shell_exec('wget https://github.com/jeremehancock/zipit-backup-utility/archive/master.zip --no-check-certificate -O zipit.zip; unzip zipit.zip; mv zipit-backup-utility-master* zipit; rm zipit.zip');

// update progress file
   file_put_contents($progress_file,"<link href='../$previous_install/css/style.css' rel='stylesheet' type='text/css'><br/><center>Setting up configuration...<br/><img src='../$previous_install/images/progress.gif'/></center>");

// sleep for 3 seconds. This helps make the progress more aesthetic for smaller sites where the process would run so fast you couldn't see what happened.
   sleep(3);
// get config from previous install
shell_exec("cp $previous_install/zipit-config.php zipit/zipit-config.php");


// update progress file
   file_put_contents($progress_file,"<link href='../$previous_install/css/style.css' rel='stylesheet' type='text/css'><br/><center>Setting up db configs...<br/><img src='../$previous_install/images/progress.gif'/></center>");

// sleep for 3 seconds. This helps make the progress more aesthetic for smaller sites where the process would run so fast you couldn't see what happened.
   sleep(3);
// get any previously created db configs from previous install
shell_exec("cp $previous_install/dbs/* zipit/dbs");


// remove zipit install file
shell_exec("rm ./zipit-update.php");

file_put_contents($progress_file,"<link href='../$previous_install/css/style.css' rel='stylesheet' type='text/css'><br/><center><button type='button' name='btnClose' value='OK' class='css3button' onclick='parent.location='index.php';'>Zipit Updated! Click to Close</button></center>");  
      sleep(3);
// remove progress file
shell_exec("rm $progress_file");
?>
