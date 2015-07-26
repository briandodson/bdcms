<?php 
		$dbhost = DB_SERVER;
		$dbuser = DB_SERVER_USERNAME;
		$dbpword = DB_SERVER_PASSWORD;
		$dbname = DB_DATABASE;
		
		// Configure the backup settings
		// Which directory/files to backup ( directory should have trailing slash ) 
		$configBackup = array('');
		// which directories to skip while backup 
		$configSkip   = array('../'); 
		// Put backups in which directory 
		$configBackupDir = '../backup/';
		//  Databses you wish to backup , can be many ( tables array if contains table names only those tables will be backed up ) 
		$configBackupDB[] = array('server'=>$dbhost,'username'=>$dbuser,'password'=>$dbpword,'database'=>$dbname);
		// Put in a email ID if you want the backup emailed 
		$configEmail = '';
		// Include backup functions file
		include ('includes/backup_functions.php');
		
		$backupName = "backup-".date('d-m-y').'-'.date('H-i-s').'.zip';
		$createZip = new createZip;
		if (isset($configBackup) && is_array($configBackup) && count($configBackup)>0) 
		{
			// Lets backup any files or folders if any
			foreach ($configBackup as $dir)
			{
					$basename = basename($dir);
					// dir basename
					if (is_file($dir))
					{
							$fileContents = file_get_contents($dir);
							$createZip->addFile($fileContents,$basename);
					}
					else
					{
							$createZip->addDirectory($basename."/");
							$files = directoryToArray($dir,true);
							$files = array_reverse($files);
							foreach ($files as $file)
							{
									$zipPath = explode($dir,$file);
									$zipPath = $zipPath[1];
									// skip any if required
									$skip =  false;
									foreach ($configSkip as $skipObject)
									{
											if (strpos($file,$skipObject) === 0)
											{
													$skip = true;
													break;
											}
									}
									if ($skip) {
											continue;
									}
									if (is_dir($file))
									{
											$createZip->addDirectory($basename."/".$zipPath);
									}
									else
									{
											$fileContents = file_get_contents($file);
											$createZip->addFile($fileContents,$basename."/".$zipPath);
									}
							}
					}
			}
		}
		if (isset($configBackupDB) && is_array($configBackupDB) && count($configBackupDB)>0)
		{	
				 foreach ($configBackupDB as $db)
				 {
						 $backup = new MySQL_Backup(); 
						 $backup->server   = $db['server'];
						 $backup->username = $db['username'];
						 $backup->password = $db['password'];
						 $backup->database = $db['database'];
						 #$backup->tables   = $db['tables'];			 
						 $backup->backup_dir = $configBackupDir;
						 $sqldump = $backup->Execute(MSB_STRING,"",false);
						 $createZip->addFile($sqldump,$db['database'].'-'.date('d-m-y').'-'.date('H-i-s').'.sql');
				 }
		}
		$fileName = $configBackupDir.$backupName;
		$fd = fopen ($fileName, "wb");
		$out = fwrite ($fd, $createZip -> getZippedfile());
		fclose ($fd);
		// Dump done now lets email the user 
		if (isset($configEmail) && !empty($configEmail)) 
		{
				mailAttachment($fileName,$configEmail,'noreply@gmail.com','Backup Script','noreply@gmail.com','Backup - '.$backupName,"Backup file is attached");
		}
		
	?>