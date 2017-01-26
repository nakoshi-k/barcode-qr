<?php
namespace BarCodeQR\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\Log\Log;
use Picqer\Barcode\BarcodeGeneratorSVG;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorJPG;
use Picqer\Barcode\BarcodeGeneratorHTML;

/**
 * Barcode helpeir
 function gen
 バーコードを生成するメソッド、第二引数でオプションを設定する。
 */

class BarcodeHelper extends Helper
{

    public $helpers = ["Html"];

    /*
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        "type" => "ean13" ,
        'height' => 100 ,
        "widthFactor" => 2,
        "color" => "black",
        "use" => "png",
        'imageType' => "image/png" 
    ];
    
    public function initialize(array $config)
    {
       $this->svg = new BarcodeGeneratorSVG();
       $this->png = new BarcodeGeneratorPNG();
       $this->jpg = new BarcodeGeneratorJPG();
       $this->html = new BarcodeGeneratorHTML();
    }
    
    public function gen($code  , $config = []){
        $config = array_merge($this->_defaultConfig,$config);

        $barcode =  $this->$config["use"]->getBarcode($code,
                                        $config['type'],
                                        $config["widthFactor"],
                                        $config['height']);
        $source = base64_encode($barcode);

        return $this->Html->image('data:' . $config['imageType'] .';base64,' .  $source);

    }



}
