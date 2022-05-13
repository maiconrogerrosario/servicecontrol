<?php
namespace Source\Support;
use Dompdf\Dompdf;
use Source\Core\Connect;




/**
 * FSPHP | Class Email
 *
 * @author Maicon Roger do Rosario <maiconrogerrosario@gmail.com>
 * @package Source\Core
 */
class PDF
{
    /** @var array */
    private $dompdf;

    


    /**
     * Qrcode constructor.
     */
    public function __construct()
    {
		$this->dompdf = new DOMPDF();		
		$this->message = new Message();		
    }

    /**
     * @param string $subject
     * @param string $body
     * @param string $recipient
     * @param string $recipientName
     * @return Email
     */
    public function load(string $url)
    {
		$this->dompdf->load_html($url);
		$this->dompdf->setPaper("A4");
		$this->dompdf->render();
		$this->dompdf->stream("file.pdf",["Attachment" => false]);
        return $this;
    }
}