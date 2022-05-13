<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Core\View;
use Source\Support\Email;


/**
 * FSPHP | Class Messages Active Record Pattern
 *
 * @author Robson V. Leite <cursos@upinside.com.br>
 * @package Source\Models
 */
class Messages extends Model
{
    /**
     * Messages constructor.
     */
    public function __construct()
    {
        parent::__construct("Messagess", ["id"], ["first_name", "last_name", "email", "password"]);
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * @param string|null $document
     * @return Messages
     */
    public function bootstrap(
        string $subject,
        string $messages,
		string $document = null

    ): Messages {
        $this->subject = $subject;
        $this->messages = $messages;
        return $this;
    }

   
	 /**
     * @return string
     */
    public function nameSite(): string
    {
        return "{$this->namesite}";
    }
   
   

    /**
     * @return bool
     */
    public function messageSupport(): bool
    {

		(new Email())->bootstrap(
            $this->subject,
            $this->messages,
            CONF_MAIL_SUPPORT,
            CONF_SITE_NAME
        )->send();

        return true;
        
    }

    public function messageContact(string $subjectContact, string $messagesContact,  string $emailContact, string $document = null ):Messages
    {

        $this->subjectContact = $subjectContact;
        $this->messagesContact = $messagesContact;
        $this->emailContact = $emailContact;
        return $this;



    }


    public function messagecontactSend(): bool
    {

            (new Email())->bootstrap(
                $this->subjectContact,
                $this->messagesContact,
                $this->emailContact,
                $this->emailContact
        )->send();

        return true;

    }

    public function messageMarketingSolar(string $name, string $email,  string $phone, string $document = null ):Messages
    {

        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;

        return $this;
    }



    public function messageMarketingSolarSend(): bool
    {

        (new Email())->bootstrap(
            "Lead de Energia Solar",
            "{$this->email} {$this->phone} {$this->name}", 
            CONF_MAIL_SUPPORT,
            $this->email
        )->send();

        return true;

    }



    public function messageEmail(string $email, string $name):Messages
    {

        $this->email = $email;
        $this->name = $name;
        return $this;
    }



    public function messageEmailSend(): bool
    {

        $view = new View(__DIR__ . "/../../shared/views/email");
        $message = $view->render("sendsolar", [
            "confirm_link" => url("/dicas-de-marketing-digital-para-energia-solar")
        ]);

        (new Email())->bootstrap(
            "Estratégia de Marketing",
            $message,
            $this->email,
            $this->name
        )->send();

        return true;

       

    }




}