<?php
$realpath = "resume/jdpriest.pdf";
$mtime = ($mtime = filemtime($realpath)) ? $mtime : gmtime();
$size = intval(sprintf("%u", filesize($realpath)));
// Maybe the problem is we are running into PHPs own memory limit, so:
if (intval($size + 1) > return_bytes(ini_get('memory_limit')) && intval($size * 1.5) <= 1073741824) { //Not higher than 1GB
  ini_set('memory_limit', intval($size * 1.5));
}
// Maybe the problem is Apache is trying to compress the output, so:
@apache_setenv('no-gzip', 1);
@ini_set('zlib.output_compression', 0);
// Maybe the client doesn't know what to do with the output so send a bunch of these headers:
header("Content-type: application/force-download");
header('Content-Type: application/octet-stream');
if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE") != false) {
  header("Content-Disposition: attachment; filename=" . urlencode(basename($F['FILE']['file_path'])) . '; modification-date="' . date('r', $mtime) . '";');
} else {
  header("Content-Disposition: attachment; filename=\"" . basename($F['FILE']['file_path']) . '"; modification-date="' . date('r', $mtime) . '";');
}
// Set the length so the browser can set the download timers
header("Content-Length: " . $size);
// If it's a large file we don't want the script to timeout, so:
set_time_limit(300);
// If it's a large file, readfile might not be able to do it in one go, so:
$chunksize = 1 * (1024 * 1024); // how many bytes per chunk
if ($size > $chunksize) {
  $handle = fopen($realpath, 'rb');
  $buffer = '';
  while (!feof($handle)) {
    $buffer = fread($handle, $chunksize);
    echo $buffer;
    ob_flush();
    flush();
  }
  fclose($handle);
} else {
  readfile($realpath);
}
// Exit successfully. We could just let the script exit
// normally at the bottom of the page, but then blank lines
// after the close of the script code would potentially cause
// problems after the file download.
exit;
?> 


<?php

$file = 'resume/jdpriest.pdf';

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
}


exit();
header('Content-Description: File Transfer');
header('Content-Type: application/pdf');
header('Content-Length: ' . strlen($pdfString));
header('Content-Disposition: attachment; filename=' . 'pdf_dynamic.pdf');
ob_clean();
flush();
readfile("resume/jdpriest.pdf");
//print $pdfString;

exit;
//another way

function servePDF( $filename ) {
if ( $fp = @fopen($filename, 'rb') ) {
header( 'Content-Type: application/pdf' );
header( 'Content-Location: me.pdf');
@fpassthru( $fp );
}
else {
print 'Unable to open file '.$filename;
}
}

servePDF("resume/jdpriest.pdf");

?>