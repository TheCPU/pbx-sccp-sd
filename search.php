<?php
require_once 'init.php';

header ("content-type: text/xml");

$per_page = '32';

$NAME=$_GET["sn"];
$page = $_GET['page'];

if ( ($page=='') ) 
{ 
   //check to see how many 
   $result= mysqli_query($mysql_conn, "SELECT count(users.name) as total 
                         FROM users 
                         WHERE users.name LIKE '%$NAME%' " );
   $howmany = mysqli_fetch_row($result);
   if ($howmany[0] > $per_page) 
   { 
      $start = 0; 
      $index = 0; 
      $total = $howmany[0]; 
      $remain = $per_page; 
      print("\n"); 
      print("<CiscoIPPhoneDirectory>\n");
      print("<Title>Morgenstern Directory</Title>\n"); 
      print("<Prompt>Morgenstern Directory</Prompt>\n");
      print("<DirectoryEntry>\n");
      print("<Name>Num.coincidences > 32 </Name>\n");
      print("</DirectoryEntry>\n");
      while ($start < ($total + 1)) 
      { 
         print("<SoftKeyItem>\n"); 
         print("\t<Name>"); 
         print($index); 
         print("</Name>\n"); 
         print("\t<URL>"); 
         print($url."search.php?page=".$index."&amp;sn=".$NAME);
         print("</URL>\n"); 
         print("<Position>");
         print($index+1);
         print("</Position>");
         print("</SoftKeyItem>\n");
         $start = $start + $per_page; 
         $index = $index+1;
      } 
      print("</CiscoIPPhoneDirectory>\n"); 
   } else {
      $result = mysqli_query($mysql_conn, "SELECT name,primaryphone,secondaryphone,mobilephone
                             FROM users 
                             WHERE users.name LIKE '%$NAME%' 
                             ORDER BY name ");
      print("\n"); 
      print("<CiscoIPPhoneDirectory>\n");
      print("<Title>Morgenstern Directory</Title>\n"); 
      print("<Prompt>Morgenstern Directory</Prompt>\n");	
      while($row = mysqli_fetch_row($result))
      { 
        print("<DirectoryEntry>\n"); 
        print("\t<Name>"); 
        print($row[0]); 
        print("</Name>\n"); 
        print("\t<Primary>"); 
        print($row[1]); 
        print("</Primary>\n");
        print("\t<Secondary>"); 
        print($row[2]); 
        print("</Secondary>\n");
         print("\t<Mobile>"); 
        print($row[3]); 
        print("</Mobile>\n"); 
        print("</DirectoryEntry>\n"); 
      } 
      print("</CiscoIPPhoneDirectory>\n"); 
   }
} else {
   $OFFSET = $page * $per_page;
   $sql = "SELECT name,primaryphone,secondaryphone,mobilephone 
           FROM users 
           WHERE name LIKE '%$NAME%' 
           ORDER BY name
           LIMIT $OFFSET, $per_page";
   $result = mysqli_query($mysql_conn , $sql);
   print("\n"); 
   print("<CiscoIPPhoneDirectory>\n"); 
   print("<Title>Morgenstern Directory</Title>\n"); 
   print("<Prompt>Morgenstern Directory</Prompt>\n");
   while($row = mysqli_fetch_row($result))
   { 
      print("<DirectoryEntry>\n"); 
      print("\t<Name>"); 
      print($row[0]); 
      print("</Name>\n"); 
      print("\t<Primary>"); 
      print($row[1]); 
      print("</Primary>\n");
      print("\t<Secondary>"); 
      print($row[2]); 
      print("</Secondary>\n");
      print("\t<Mobile>"); 
      print($row[3]); 
      print("</Mobile>\n"); 
      print("</DirectoryEntry>\n"); 
   } 
   print("</CiscoIPPhoneDirectory>\n"); 
}
?>