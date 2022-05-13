<?php

namespace Source\Support;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;




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
    private $qrcodeSupport;
	
	private $qrcodeInfo;
	
	 /** @var Message */
    private $message;


    /**
     * Qrcode constructor.
     */
    public function __construct()
    {
        
		
	$optionsSupport = new QROptions([
	'versão' => 10,
	'outputType' => QRCode::OUTPUT_IMAGE_PNG,
	'eccLevel' => QRCode::ECC_H,
	'escala' => 5,
	'imageBase64' => false,
	'moduleValues' => [
		// localizador
		1536 => [ 0 , 180 , 90 ], // escuro (verdadeiro)
		6     => [ 255 , 255 , 255 ], // claro (falso), branco é a cor da transparência e está habilitado por padrão
		5632 => [ 0 , 180 , 90 ], // ponto do localizador, escuro (verdadeiro)
		// alinhamento
		2560 => [ 0 , 180 , 90 ],
		10    => [ 255 , 255 , 255 ],
		// tempo
		3072 => [ 0 , 180 , 90 ],
		12    => [ 255 , 255 , 255 ],
		// formato
		3584 => [ 0 , 180 , 90 ],
		14    => [ 255 , 255 , 255 ],
		// versão
		4096 => [ 0 , 180 , 90 ],
		16    => [ 255 , 255 , 255 ],
		// dados
		1024 => [ 0 , 180 , 90 ],
		4     => [ 255 , 255 , 255 ],
		// darkmodule
		512   => [ 0 , 0 , 0 ],
		// separador
		8     => [ 255 , 255 , 255 ],
		// Zona quieta
		18    => [ 255 , 255 , 255 ],
		// logo (requer uma chamada para QRMatrix :: setLogoSpace ())
		20     => [ 255 , 255 , 255 ],
	],
]);
		
		
	$optionsInfo  = new QROptions([
	'versão' => 10,
	'outputType' => QRCode::OUTPUT_IMAGE_PNG,
	'eccLevel' => QRCode::ECC_H,
	'escala' => 5,
	'imageBase64' => false,
	'moduleValues' => [
		// localizador
		1536 => [ 0 , 0 , 0 ], // escuro (verdadeiro)
		6     => [ 255 , 255 , 255 ], // claro (falso), branco é a cor da transparência e está habilitado por padrão
		5632 => [ 0 , 0 , 0 ], // ponto do localizador, escuro (verdadeiro)
		// alinhamento
		2560 => [ 0 , 0 , 0 ],
		10    => [ 255 , 255 , 255 ],
		// tempo
		3072 => [ 0 , 0 , 0 ],
		12    => [ 255 , 255 , 255 ],
		// formato
		3584 => [ 0 , 0 , 0 ],
		14    => [ 255 , 255 , 255 ],
		// versão
		4096 => [ 0 , 0 , 0 ],
		16    => [ 255 , 255 , 255 ],
		// dados
		1024 => [ 0 , 0 , 0 ],
		4     => [ 255 , 255 , 255 ],
		// darkmodule
		512   => [ 0 , 0 , 0 ],
		// separador
		8     => [ 255 , 255 , 255 ],
		// Zona quieta
		18    => [ 255 , 255 , 255 ],
		// logo (requer uma chamada para QRMatrix :: setLogoSpace ())
		20     => [ 255 , 255 , 255 ],
	],
	]);
		
		$this->qrcodeSupport = new QRCode($optionsSupport);
		
		$this->qrcodeInfo = new QRCode($optionsInfo);
		
    }

    /**
     * @param string $subject
     * @param string $body
     * @param string $recipient
     * @param string $recipientName
     * @return Email
     */
    public function qrcodeSupport(string $url,string $application_id, string $equipment_id, string $equipment_name): QRC
    {		
		$this->qrcodeSupport->render($url, CONF_QRCODE_DIR . "/" . CONF_QRCODE_SUPPORT_DIR . "/" . "support_" . $application_id ."_" . $equipment_id ."_" . $equipment_name . ".jpg");
		
        return $this;
    }
	
	public function qrcodeInfo(string $url,string $application_id, string $equipment_id, string $equipment_name): QRC
    {		
		$this->qrcodeInfo->render($url, CONF_QRCODE_DIR . "/" . CONF_QRCODE_INFO_DIR . "/" . "info_" . $application_id ."_" . $equipment_id ."_" . $equipment_name . ".jpg");
        return $this;
    }
	
}