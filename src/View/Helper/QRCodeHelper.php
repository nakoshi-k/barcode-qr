<?php
namespace BarCodeQR\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Endroid\QrCode\QrCode;
use Cake\Network\Response;
use Cake\Log\Log;

/**
 * Qrcode helper
function gen
QRコードを生成するメソッド第一引数にテキスト、オプションは第二引数に入れる。
出力デフォルトはPNG
 */
class QRcodeHelper extends Helper
{

    public $helpers = ["Html"];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        "size" => 150,
        "padding" => 10,
        "errorCorrection" => "high" ,//エラー訂正レベル
        "foregroundColor" => ['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0],//前景色
        "backgroundColor" => ['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0], //背景色
        "label" => "",
        "labelFontSize" => 0,
        "imageType" => QrCode::IMAGE_TYPE_PNG
    ];

    public function initialize(array $config)
    {
      $this->qr = new QrCode();
    }

    public function gen($text , $config = [] ){
        $config = array_merge($this->_defaultConfig , $config);

        $this->qr
        ->setText($text)
        ->setSize($config['size'])
        ->setPadding($config['padding'])
        ->setErrorCorrection($config['errorCorrection'])
        ->setForegroundColor($config['foregroundColor'])
        ->setBackgroundColor($config['backgroundColor'])
        ->setLabel($config['label'])
        ->setLabelFontSize($config["labelFontSize"])
        ->setImageType($config['imageType']);
        $source = base64_encode($this->qr->get());
        return $this->Html->image('data:' . $config['imageType'] .';base64,' .  $source);

    }

}
