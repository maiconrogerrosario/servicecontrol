<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Core\Session;
use Source\Core\View;
use Source\Support\Email;

/**
 * Class Auth
 * @package Source\Models
 */
class RequestEquipmentSupport extends Model
{
    /**
     * Auth constructor.
     */
    public function __construct()
    {
        parent::__construct("users", ["id"], ["email", "password"]);
    }
	
	
	
	public function bootstrap(
		string $application_id,
        string $equipment_id,
        string $equipment,
        string $email,
        string $name,

    ): RequestEquipmentSupport {
		$this->application_id = $application_id;
        $this->equipment_id = $firstName;
        $this->equipment = $lastName;
        $this->email = $email;
        $this->name
    }

    
    public function request(): bool
    {
        if (!$user->save()) {
            $this->message = $user->message;
            return false;
        }

        $view = new View(__DIR__ . "/../../shared/views/email");
        $message = $view->render("confirm", [
            "first_name" => $user->first_name,
            "confirm_link" => url("/obrigado/" . base64_encode($user->email))
        ]);

        (new Email())->bootstrap(
            "Solicitar Manutenção",
            $message,
            $user->email,
            "{$user->first_name} {$user->last_name}"
        )->send();

        return true;
    }

    
}