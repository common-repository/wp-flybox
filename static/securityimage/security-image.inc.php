<?php
   // code from www.sitepoint.com
   class SecurityImage {
      var $oImage;
      var $iWidth;
      var $iHeight;
      var $iNumChars;
      var $iNumLines;
      var $iSpacing;
      var $sCode;
      var $code;
      function SecurityImage($iWidth = 150, $iHeight = 30, $code, $iNumChars = 5, $iNumLines = 30) {
         // get parameters
         $this->iWidth = $iWidth;
         $this->code = $code;
         $this->iHeight = $iHeight;
         $this->iNumChars = $iNumChars;
         $this->iNumLines = $iNumLines;
         // create new image
         $this->oImage = imagecreate($iWidth, $iHeight);
         // allocate white background colour
         imagecolorallocate($this->oImage, 255, 255, 255);
         // calculate spacing between characters based on width of image
         $this->iSpacing = (int)($this->iWidth / $this->iNumChars);
      }
      function DrawLines() {
         for ($i = 0; $i < $this->iNumLines; $i++) {
            $iRandColour = rand(150, 200);
            $iLineColour = imagecolorallocate($this->oImage, $iRandColour, $iRandColour, $iRandColour);
            imageline($this->oImage, rand(0, $this->iWidth), rand(0, $this->iHeight), rand(0, $this->iWidth), rand(0, $this->iHeight), $iLineColour);
         }
      }
      function GenerateCode() {
         // reset code
         $this->sCode = '';
            $code = (54213+$this->code)*2;
            $this->sCode = substr($code, 0, 5);
      }
      function DrawCharacters() {
         // loop through and write out selected number of characters
         //for ($i = 0; $i < strlen($this->sCode); $i++) {
            // select random font
            $iCurrentFont = rand(3, 5);
            // select random greyscale colour
            $iRandColour = rand(0, 75);
            $iTextColour = imagecolorallocate($this->oImage, $iRandColour, $iRandColour, $iRandColour);
            // write text to image
            imagestring($this->oImage, $iCurrentFont, 75, ($this->iHeight - imagefontheight($iCurrentFont)) / 2, $this->sCode, $iTextColour);
         //}
      }
      function Create($sFilename = '') {
         // check for existance of GD GIF library
         if (!function_exists('imagegif')) {
            return false;
         }
         $this->DrawLines();
         $this->GenerateCode();
         $this->DrawCharacters();
         // write out image to file or browser
         if ($sFilename != '') {
            // write stream to file
            imagegif($this->oImage, $sFilename);
         } else {
            // tell browser that data is gif
            header('Content-type: image/gif');
            // write stream to browser
            imagegif($this->oImage);
         }
         // free memory used in creating image
         imagedestroy($this->oImage);
         return true;
      }
      function GetCode() {
         return $this->sCode;
      }
   }
?>