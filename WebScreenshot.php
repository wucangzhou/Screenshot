<?php

class WebScreenshot
{

    // The command to run phantomjs
    public $phantomjsCommand = "/bin/phantomjs";

    public $webUrl ;
    //post data .it's used when you  need post data
    public $postData = '';

    public $tempFolder;

    public function run()
    {
        $screenshotFileName = $this->$tempFolder . "/" . uniqid() . ".jpg";
        $phantomjsCommand = dirname(__FILE__).$this->phantomjsCommand . " " . dirname(__FILE__) . "/js/rasterize.js " . $this->webUrl . "  '" .$this->removeSL($this->$postData) . "' " .$screenshotFileName;

        exec($phantomjsCommand);

        if (file_exists($screenshotFileName)) {
            $fileContent = file_get_contents($screenshotFileName);
            // Remove file
            unlink($screenshotFileName);
            header('Content-type: image/jpg');
            echo $fileContent;
        }else {
            echo 'file is not create';
        }
    }

    /**
     * remove special character
     * @param $string
     * @return mixed|string
     */
    public function removeSL($string){
        $tmp = '';
        $sl = ["'","#","|",">","<"];
        foreach($sl as  $k){
            $tmp = str_replace($k,'',$string);
        }
        return $tmp;
    }
}

?>