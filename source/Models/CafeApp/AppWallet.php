<?php

namespace Source\Models\CafeApp;

use Source\Core\Model;
use Source\Models\User;

/**
 * Class AppWallet
 * @package Source\Models\CafeApp
 */
class AppWallet extends Model
{
    /**
     * AppWallet constructor.
     */
    public function __construct()
    {
        parent::__construct("app_wallets", ["id"], ["user_id","application_id", "wallet"]);
    }
	
	/**
     * @param User $user
     * @return AppWallet
     */
    public function start(User $user): AppWallet
    {
        if (!$this->find("user_id = :user", "user={$user->id}")->count()) {
			$this->application_id = $user->application_id;
			$this->user_id = $user->id;
            $this->wallet = "Empresa";
            $this->free = true;
            $this->save();
        }
        return $this;
    }
	
	 public function bootstrap(
	    string $application_id,	
        string $wallet
    ): AppWallet {
		$this->application_id = $application_id;
		$this->wallet = $wallet;
        return $this;
    }
		

    public function findByName(string $application_id,string $id, string $columns = "*"): ?AppWallet
    {
        $find = $this->find("application_id = :application_id AND id = :id", "application_id={$application_id}&id={$id}", $columns);
        return $find->fetch();
    } 
	
	
	

    
	
	/**
     * @return bool
     */
    public function save(): bool
    {
		
		
		/** User Update */
        if (!empty($this->id)) {
            $workId = $this->id;

            if ($this->find("wallet = :wallet AND id != :i", "wallet={$this->wallet}&i={$workId}", "id")->fetch()) {
                $this->message->warning("Essa Carteira já esta Cadastrado");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$workId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }
       
        /** User Create */
        if (empty($this->id)) {
			
            if ($this->findByName($this->application_id,$this->wallet, "id")) {
                $this->message->warning("Essa Carteira já esta Cadastrado");
                return false;
            }

            $workId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($workId))->data();
        return true;
    }
	
	
	

    /**
     * @return object
     */
    public function balance(): object
    {
        return (new AppInvoice())->balanceWallet($this);
    }
	
	 /**
     * @return object
     */
    public function balance2(): object
    {
        return (new AppInvoice())->balanceWallet2($this);
    }
	
	
	/**
     * @return object
     */
    public function BalanceWalletPeriod(?array $filter): object
    {
		
        return (new AppInvoice())->BalanceWalletPeriod($this, ($filter ?? null));
    }
	
	
}