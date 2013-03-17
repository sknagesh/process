<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Process',$cxn) or die("error opening db: ".mysql_error());
$opid=$_GET['opid'];

$query="SELECT * FROM Operation WHERE Operation_ID='$opid';";

//print($query);

$res=mysql_query($query) or die(mysql_error());
$row=mysql_fetch_assoc($res);
$opdesc=$row["Operation_Desc"];
$progno=$row['Program_NO'];
$cltime=hms2mins($row['Clamping_Time']);
$mtime=hms2mins($row['Machining_Time']);
$fxtno=$row['Fixture_NO'];
$opimg=$row['Operation_Image'];
$opdwg=$row['Operation_Drawing'];
$opnotes=$row['Operation_Notes'];
$ppath=$row['P_Path'];

print("<label for=\"opdesc\">Operation Description</label>
     <input id=\"opdesc\" name=\"opdesc\" size=\"25\" class=\"required\" value=\"$opdesc\"/>
  </p>");
print("<p>
     <label for=\"ctime\">Clamping Time in Mins.</label>
     <input id=\"ctime\" name=\"ctime\" size=\"25\"  class=\"number\" value=\"$cltime\"/>
  </p>");

print("<p>
     <label for=\"mtime\">Machining Time in Mins.</label>
     <input id=\"mtime\" name=\"mtime\" size=\"25\"  class=\"number\" value=\"$mtime\" />
  </p>");

print("<p>
     <label for=\"fno\">Fixture Numbers</label>
     <input id=\"fixtno\" name=\"fixtno\" size=\"25\" value=\"$fxtno\"  />
  </p>");

print("<p>
     <label for=\"prno\">Program No</label>
     <input id=\"progno\" name=\"progno\" size=\"25\" value=\"$progno\"  />
  </p>");

print("<p>
     <label for=\"ppath\">Path To Program No</label>
     <input id=\"ppath\" name=\"ppath\" size=\"25\" value=\"$ppath\"  />
   </p>");


print("<p>
     <label for=\"prno\">Operation Notes</label>
     <textarea name=\"onote\" rows=\"4\" cols=\"50\" id=\"onote\" value=\"$opnotes\"> </textarea>
      </p>");

print("<p>
     <label for=\"drg\">Select Setup Image </label>
     <input id=\"oimg\" name=\"oimg\" type=\"file\" /> $opimg
  </p>");

print("<p>
     <label for=\"drg\">Select Operation Drawing </label>
     <input id=\"odwg\" name=\"odwg\" type=\"file\" /> $opdwg
  </p>");

?>