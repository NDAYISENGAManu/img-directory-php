<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Directory Contents</title>
  <link rel="stylesheet" href=".style.css">
  <script src=".sorttable.js"></script>
  <style>
    * {
  padding:0;
  margin:0;
}

body {
  color: #333;
  font: 14px Sans-Serif;
  padding: 50px;
  background: #eee;
}

h1 {
  text-align: center;
  padding: 20px 0 12px 0;
  margin: 0;
}

h2 {
  font-size: 16px;
  text-align: center;
  padding: 0 0 12px 0; 
}

#container {
  box-shadow: 0 5px 10px -5px rgba(0,0,0,0.5);
  position: relative;
  background: white; 
}

table {
  background-color: #F3F3F3;
  border-collapse: collapse;
  width: 100%;
  margin: 15px 0;
}

th {
  background-color: #0c4da2;
  color: #FFF;
  cursor: pointer;
  padding: 5px 10px;
}

th small {
  font-size: 9px; 
}

td, th {
  text-align: left;
}

a {
  text-decoration: none;
}

td a {
  color: #663300;
  display: block;
  padding: 5px 10px;
}

th a {
  padding-left: 0
}

td:first-of-type a {
  background: url(./.images/file.png) no-repeat 10px 50%;
  padding-left: 35px;
}

th:first-of-type {
  padding-left: 35px;
}

td:not(:first-of-type) a {
  background-image: none !important;
} 

tr:nth-of-type(odd) {
  background-color: #E6E6E6;
}

tr:hover td {
  background-color:#CACACA;
}

tr:hover td a {
  color: #000;
}

/* icons for file types (icons by famfamfam) */

/* images */
table tr td:first-of-type a[href$=".jpg"], 
table tr td:first-of-type a[href$=".png"], 
table tr td:first-of-type a[href$=".gif"], 
table tr td:first-of-type a[href$=".svg"], 
table tr td:first-of-type a[href$=".jpeg"] {
  background-image: url(./.images/image.png);
}

/* zips */
table tr td:first-of-type a[href$=".zip"] {
  background-image: url(./.images/zip.png);
}

/* css */
table tr td:first-of-type a[href$=".css"] {
  background-image: url(./.images/css.png);
}

/* docs */
table tr td:first-of-type a[href$=".doc"],
table tr td:first-of-type a[href$=".docx"],
table tr td:first-of-type a[href$=".ppt"],
table tr td:first-of-type a[href$=".pptx"],
table tr td:first-of-type a[href$=".pps"],
table tr td:first-of-type a[href$=".ppsx"],
table tr td:first-of-type a[href$=".xls"],
table tr td:first-of-type a[href$=".xlsx"] {
  background-image: url(./.images/office.png)
}

/* videos */
table tr td:first-of-type a[href$=".avi"], 
table tr td:first-of-type a[href$=".wmv"], 
table tr td:first-of-type a[href$=".mp4"], 
table tr td:first-of-type a[href$=".mov"], 
table tr td:first-of-type a[href$=".m4a"] {
  background-image: url(./.images/video.png);
}

/* audio */
table tr td:first-of-type a[href$=".mp3"], 
table tr td:first-of-type a[href$=".ogg"], 
table tr td:first-of-type a[href$=".aac"], 
table tr td:first-of-type a[href$=".wma"] {
  background-image: url(./.images/audio.png);
}

/* web pages */
table tr td:first-of-type a[href$=".html"],
table tr td:first-of-type a[href$=".htm"],
table tr td:first-of-type a[href$=".xml"] {
  background-image: url(./.images/xml.png);
}

table tr td:first-of-type a[href$=".php"] {
  background-image: url(./.images/php.png);
}

table tr td:first-of-type a[href$=".js"] {
  background-image: url(./.images/script.png);
}

/* directories */
table tr.dir td:first-of-type a {
  background-image: url(./.images/folder.png);
}
  </style>
</head>

<body>

  <div id="container">
  
    <h1>Directory Contents</h1>
    
    <table class="sortable">
      <thead>
        <tr>
          <th>Filename</th>
          <th>Size <small>(bytes)</small></th>
          <th>Date Modified</th>
          <th>Photos</th>
        </tr>
      </thead>
      <tbody>

      <?php 
/* 

list all the files with extension nn on a folder 
the first parameter of glob is a regex to match files.
you can do: 
    path_to_dir/*.html
to select all the .html files in the path_to_dir folder

*NOTE:* the regex on glob is case sensitive

*/

$images = glob("{*.jpg,*.jpeg,*.png,*.gif,*.JPG,*.JPEG,*.PNG,*.GIF}", GLOB_BRACE);

/** 
* Converts bytes into human readable file size. 
* 
* @param string $bytes 
* @return string human readable file size (2,87 Мб)
* @author Mogilev Arseny 
*/ 
function fileSizeConvert($bytes){
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1),
    );
    foreach($arBytes as $arItem){
        if($bytes >= $arItem["VALUE"]){
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}
?>
    
      <?php foreach ($images as $img): ?>
        <tr class='$class'>
            <td><?php echo ' <a href="'.$img.'">'.$img."</a>"; ?></td>
            <td><?php echo fileSizeConvert(filesize($img)); ?></td>
            <td><?php echo date("Y/m/d H:i:s", filemtime($img)) ?></td>
            <td><img src='<?php echo $img; ?>' alt='' /></td>
        </tr>
	    <?php endforeach ?>


        

          <!-- print("
          <tr class='$class'>
            <td><a href='./$namehref'>$name</a></td>
            <td><a href='./$namehref'>$extn</a></td>
            <td><a href='./$namehref'>$size</a></td>
            <td sorttable_customkey='$timekey'><a href='./$namehref'>$modtime</a></td>
          </tr>"); -->

         



      </tbody>
    </table>
  
    
  </div>
  
</body>

</html>
