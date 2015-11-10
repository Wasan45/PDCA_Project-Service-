<?php

class GraphController{
    
    private $image;

    public function GraphController(){
        
    }
    
    public function drawPieChart($height= 450, $width= 640, $data_array = array('Score A' =>  50 ,'Score B' => 90)){
        $font = '../Controller/GeosansLight.ttf'; /** set front */
        $this->image = imagecreate($width,$height);
        $piewidth = $width * 0.7;/* pie area */
        $x = round($piewidth/2);
        $y = round($height/2);
        $total = array_sum($data_array);
        $angle_start = 0;
        $ylegend = 2;
        imagefilledrectangle($this->image, 0, 0, $width, $piewidth, imagecolorallocate($this->image, 255, 255, 255));
        foreach($data_array as $label=>$value) {
            $angle_done    = ($value/$total) * 360; /** angle calculated for 360 degrees */
            $perc          = round(($value/$total) * 100, 1); /** percentage calculated */
            $color         = imagecolorallocate($this->image, rand(100, 255), rand(100, 255), rand(100, 255));
            imagefilledarc($this->image, $x, $y, $piewidth, $height, $angle_start, $angle_done+= $angle_start, $color, IMG_ARC_PIE);
            $xtext = $x + (cos(deg2rad(($angle_start+$angle_done)/2))*($piewidth/4));
            $ytext = $y + (sin(deg2rad(($angle_start+$angle_done)/2))*($height/4));
            imagettftext($this->image, 16, 0, $xtext, $ytext, imagecolorallocate($this->image, 0, 0, 0), $font, "$perc %");
            imagefilledrectangle($this->image, $piewidth+2, $ylegend, $piewidth+20, $ylegend+=20, $color);
            imagettftext($this->image, 18, 0, $piewidth+22, $ylegend, imagecolorallocate($this->image, 0, 0, 0), $font, $label);
            $ylegend += 4;
            $angle_start = $angle_done;
        }  
    }
    
    public function render(){
        $this->drawPieChart();
        ob_start();
        imagepng($this->image);
        $imageData = ob_get_contents();
        ob_clean();
        $image_response["image"] = base64_encode($imageData);
        echo json_encode($image_response);
    }

}
?>

