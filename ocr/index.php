<?php

require_once './vendor/autoload.php';

use thiagoalessio\TesseractOCR\TesseractOCR;
$file = 'handtest.jpg';
$obj = new TesseractOCR($file);
$obj->executable('C:\Program Files (x86)\Tesseract-OCR\tesseract.exe');
$obj->lang('eng');
$output = $obj->run();
var_dump($output);

//$file = 'pdf.pdf';
////$status = exec("C:\Program Files (x86)\ImageMagick-6.8.0-Q16\convert.exe -density 300 -trim $file -quality 100 out.png");
////echo '<pre>'; var_dump($status); die('</pre>');
//
//$row = exec("convert.exe 'pdf.pdf' 2>&1",$output,$error);
//echo '<pre>'; var_dump($output,$error); die('</pre>');
