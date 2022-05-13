<?php

namespace Source\Support;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Source\Core\Connect;




/**
 * FSPHP | Class Email
 *
 * @author Maicon Roger do Rosario <maiconrogerrosario@gmail.com>
 * @package Source\Core
 */
class QRC
{
    /** @var array */
    private $options;

    /** @var Qrcode */
    private $qrcode;
	
	 /** @var Message */
    private $message;


    /**
     * Qrcode constructor.
     */
    public function __construct()
    {
        $this->options = new  QROptions([
			'version' => 5,
			'outputType' => QRCode::OUTPUT_IMAGE_JPG,
			'eccLevel' => QRCode::ECC_L,
		]);
		
		$this->qrcode = new QRCode($options);
			
		$this->message = new Message();
		
    }

    /**
     * @param string $subject
     * @param string $body
     * @param string $recipient
     * @param string $recipientName
     * @return Email
     */
    public function render(string $nome_img): QRC
    {
		
		$this->qrcode->render(CONF_QRCODE_URL, CONF_QRCODE_DIR . "/" . CONF_QRCODE_IMAGE_DIR . $nome_img);
        return $this;
    }
}