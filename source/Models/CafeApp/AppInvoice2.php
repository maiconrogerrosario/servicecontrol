<?php

namespace Source\Models\CafeApp;

use Source\Core\Model;
use Source\Core\Session;
use Source\Models\User;

/**
 * Class AppInvoice
 * @package Source\Models\CafeApp
 */
class AppInvoice extends Model
{
    /** @var null|int */
    public $wallet;

    /**
     * AppInvoice constructor.
     */
    public function __construct()
    {
        parent::__construct(
            "app_invoices", ["id"],
            ["application_id","user_id", "wallet_id", "category_id", "description", "type", "value", "due_at", "repeat_when"]
        );

        if ((new Session())->has("walletfilter")) {
            $this->wallet = "AND wallet_id = " . (new Session())->walletfilter;
			
			
        }
    }
	
	
	public function getWallet(): ?AppWallet
	{ 

		if ($this->wallet_id) {
			
            return (new AppWallet())->findById($this->wallet_id
			);
			
        }
		
        return null;

	}
	
	

    /**
     * @param User $user
     * @param array $data
     * @return AppInvoice|null
     */
    public function launch(User $user, array $data): ?AppInvoice
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (
            empty($data["wallet_id"]) || empty($data["category_id"]) || empty($data["description"])
            || empty($data["type"]) || empty($data["value"]) || empty($data["due_at"])
            || empty($data["repeat_when"]) || empty($data["period"]) || empty($data["enrollments"])
        ) {
            $this->message->error("Faltam dados para lançar essa fatura");
            return null;
        }

        $wallet = (new AppWallet())->find("application_id = :application_id AND id = :id",
            "application_id={$user->application_id}&id={$data["wallet_id"]}")->fetch();

        if (!$wallet) {
            $this->message->error("A carteira que você informou não existe");
            return null;
        }

        $category = (new AppCategory())->findById($data["category_id"]);
        if (!$category) {
            $this->message->error("A categoria que você informou não existe");
            return null;
        }

        //PREMIUM RESOURCE
         //$subscribe = (new AppSubscription())->find("application_id = :application_id  AND status != :status",
           //  "application_id={$user->application_id}&status=canceled"); //

        // if (!$wallet->free && !$subscribe->count()) {
        //    $this->message->error("É preciso assinar para lançar nesta carteira");
        //   return null;
        //}

        $typeList = ["income", "expense"];
        if (!in_array($data["type"], $typeList)) {
            $this->message->error("O tipo da fatura deve ser despesa ou receita");
            return null;
        }

        $check = \DateTime::createFromFormat("Y-m-d", $data["due_at"]);
        if (!$check || $check->format("Y-m-d") != $data["due_at"]) {
            $this->message->error("O vencimento da fatura não tem um formato válido");
            return null;
        }

        $repeatList = ["single", "enrollment", "fixed"];
        if (!in_array($data["repeat_when"], $repeatList)) {
            $this->message->error("A repetição da fatura deve ser única, parcelada ou fixa");
            return null;
        }

        $periodList = ["month", "year"];
        if (!in_array($data["period"], $periodList)) {
            $this->message->error("O período de cobrança da fatura deve ser mensal ou anual");
            return null;
        }

        if (!empty($data["enrollments"]) && ($data["enrollments"] < 1 || $data["enrollments"] > 420)) {
            $this->message->error("O número de parcelas da fatura deve estar entre 1 e 420");
            return null;
        }

        $status = (date($data["due_at"]) <= date("Y-m-d") ? "paid" : "unpaid");

        $this->user_id = $user->id;
		$this->application_id = $user->application_id;
        $this->wallet_id = $data["wallet_id"];
        $this->category_id = $data["category_id"];
        $this->invoice_of = null;
        $this->description = $data["description"];
        $this->type = ($data["repeat_when"] == "fixed" ? "fixed_{$data["type"]}" : $data["type"]);
        $this->value = $data["value"];
        $this->currency = "BRL";
        $this->due_at = $data["due_at"];
        $this->repeat_when = $data["repeat_when"];
        $this->period = $data["period"];
        $this->enrollments = $data["enrollments"];
        $this->enrollment_of = 1;
        $this->status = ($data["repeat_when"] == "fixed" ? "paid" : $status);

        if (!$this->save()) {
            return null;
        }

        if ($this->repeat_when == "enrollment") {
            $invoiceOf = $this->id;
            for ($enrollment = 1; $enrollment < $this->enrollments; $enrollment++) {
                $this->id = null;
                $this->invoice_of = $invoiceOf;
                $this->due_at = date("Y-m-d", strtotime($data["due_at"] . "+{$enrollment}month"));
                $this->status = (date($this->due_at) <= date("Y-m-d") ? "paid" : "unpaid");
                $this->enrollment_of = $enrollment + 1;
                $this->save();
            }
        }

        return $this;
    }

    /**
     * @param User $user
     * @param int $afterMonths
     * @throws \Exception
     */
    public function fixed(User $user, int $afterMonths = 1): void
    {
        $fixed = $this->find("application_id = :application_id  AND status = 'paid' AND type IN('fixed_income', 'fixed_expense') {$this->wallet}",
            "application_id={$user->application_id}")->fetch(true);

        if (!$fixed) {
            return;
        }

        foreach ($fixed as $fixedItem) {
            $invoice = $fixedItem->id;
            $start = new \DateTime($fixedItem->due_at);
            $end = new \DateTime("+{$afterMonths}month");

            if ($fixedItem->period == "month") {
                $interval = new \DateInterval("P1M");
            }

            if ($fixedItem->period == "year") {
                $interval = new \DateInterval("P1Y");
            }

            $period = new \DatePeriod($start, $interval, $end);
            foreach ($period as $item) {
                $getFixed = $this->find("application_id = :application_id  AND invoice_of = :of AND year(due_at) = :y AND month(due_at) = :m",
                    "application_id={$user->application_id}&of={$fixedItem->id}&y={$item->format("Y")}&m={$item->format("m")}",
                    "id")->fetch();

                if (!$getFixed) {
                    $newItem = $fixedItem;
                    $newItem->id = null;
                    $newItem->invoice_of = $invoice;
                    $newItem->type = str_replace("fixed_", "", $newItem->type);
                    $newItem->due_at = $item->format("Y-m-d");
                    $newItem->status = ($item->format("Y-m-d") <= date("Y-m-d") ? "paid" : "unpaid");
                    $newItem->save();
                }
            }
        }
    }

    /**
     * @param User $user
     * @param string $type
     * @param array|null $filter
     * @param int|null $limit
     * @return array|null
     */
    public function filter(User $user, string $type, ?array $filter, ?int $limit = null): ?array
    {
      	$status = (!empty($filter["status"]) && $filter["status"] == "paid" ? "AND status = 'paid'" : (!empty($filter["status"]) && $filter["status"] == "unpaid" ? "AND status = 'unpaid'" : null));
        $category = (!empty($filter["category"]) && $filter["category"] != "all" ? "AND category_id = '{$filter["category"]}'" : null);

        $due_year = (!empty($filter["date"]) ? explode("-", $filter["date"])[1] : date("Y"));
        $due_month = (!empty($filter["date"]) ? explode("-", $filter["date"])[0] : date("m"));
        $due_at = "AND (year(due_at) = '{$due_year}' AND month(due_at) = '{$due_month}')";

        $due = $this->find(
            "application_id = :application_id AND type = :type {$status} {$category} {$due_at} {$this->wallet}",
            "application_id={$user->application_id}&type={$type}"
        )->order("day(due_at) ASC");

        if ($limit) {
            $due->limit($limit);
        }

        return $due->fetch(true);

 
    }
	
	 /**
     * @param User $user
     * @param string $type
     * @param array|null $filter
     * @param int|null $limit
     * @return array|null
     */
    public function filterInvoices(User $user, ?array $filter, ?int $limit = null): ?array
    {
		
		
		$status = null;
		$type = null;
		
		
		if (!empty($filter["type"]) && $filter["type"] == "incomepaid"){
			
			$status = "AND status = 'paid'";
			$type = "AND type = 'income'";
	
		}
		else if (!empty($filter["type"]) && $filter["type"] == "incomeunpaid"){
		
			$status = "AND status = 'unpaid'";
			$type = "AND type = 'income'";
		
		}else if (!empty($filter["type"]) && $filter["type"] == "expensepaid"){
			
			$status = "AND status = 'paid'";
			$type = "AND type = 'expense'";
			
		}else if (!empty($filter["type"]) && $filter["type"] == "expenseunpaid"){
			
			$status = "AND status = 'unpaid'";
			$type = "AND type = 'expense'";
		
		}else if (!empty($filter["type"]) && $filter["type"] == "all"){
			
			$status = null;
			$type = null;
				
		}
		
	
		
		$category = (!empty($filter["category"]) && $filter["category"] != "all" ? "AND category_id = '{$filter["category"]}'" : null);

		
		$due_at = (!empty($filter["dateinitial"]) && $filter["dateinitial"] != "all" ? "AND due_at >=  '{$filter["dateinitial"]}' AND due_at <= '{$filter["datefinal"]}'" : null);
		$due = $this->find(
			"application_id = :application_id {$type}{$status} {$category} {$due_at} {$this->wallet}",
			"application_id={$user->application_id}"
		)->order("due_at desc");


	
		if ($limit) {
			$due->limit($limit);
		}

		return $due->fetch(true);
			

    }
	

	/**
     * @param User $user
     * @param string $type
     * @param array|null $filter
     * @param int|null $limit
     * @return array|null
     */
    public function filterProject(User $user, string $type, ?array $filter, ?string $projectwallet, ?int $limit = null): ?array
    {
        $status = (!empty($filter["status"]) && $filter["status"] == "paid" ? "AND status = 'paid'" : (!empty($filter["status"]) && $filter["status"] == "unpaid" ? "AND status = 'unpaid'" : null));
        $category = (!empty($filter["category"]) && $filter["category"] != "all" ? "AND category_id = '{$filter["category"]}'" : null);

       
        $due = $this->find(
            "application_id = :application_id AND type = :type {$status} {$category}  AND wallet_id = :projectwallet",
            "application_id={$user->application_id}&type={$type}&projectwallet={$projectwallet}"
        )->order("day(due_at) ASC");

        if ($limit) {
            $due->limit($limit);
        }

        return $due->fetch(true);
    }
	
	
    /**
     * @return mixed|Model|null
     */
    public function wallet()
    {
        return (new AppWallet())->findById($this->wallet_id);
    }

    /**
     * @return AppCategory
     */
    public function category(): AppCategory
    {
        return (new AppCategory())->findById($this->category_id);
    }

    /**
     * @param User $user
     * @return object
     */
    public function balance(User $user): object
    {
        $balance = new \stdClass();
        $balance->income = 0;
        $balance->expense = 0;
        $balance->wallet = 0;
		$balance->incomeunpaid = 0;
		$balance->expenseunpaid = 0;
		$balance->projectcost = 0;
        $balance->balance = "positive";


		$due_year  = date("Y");
		
        $due_at = "AND (year(due_at) = '{$due_year}')";
		
        $find = $this->find("application_id = :application_id",
            "application_id={$user->application_id}",
            "
                (SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id AND status = 'paid' AND type = 'income' {$this->wallet} {$due_at}) AS income,
                (SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id AND status = 'paid' AND type = 'expense' {$this->wallet} {$due_at}) AS expense,
				(SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id AND status = 'unpaid' AND type = 'income' {$this->wallet} {$due_at}) AS incomeunpaid,
                (SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id AND status = 'unpaid' AND type = 'expense' {$this->wallet} {$due_at}) AS expenseunpaid,
				(SELECT SUM(projectcost) FROM works WHERE application_id = :application_id  {$this->wallet}) AS projectcost
				
            ")->fetch();

			


        if ($find) {
            $balance->income = abs($find->income);
            $balance->expense = abs($find->expense);
			$balance->incomeunpaid = abs($find->incomeunpaid);
            $balance->expenseunpaid = abs($find->expenseunpaid);
			$balance->projectcost = abs($find->projectcost);
            $balance->wallet = $balance->income - $balance->expense;
            $balance->balance = ($balance->wallet >= 1 ? "positive" : "negative");
        }

        return $balance;
    }
	
	/**
     * @param User $user
     * @return object
     */
    public function BalanceWalletPeriod(AppWallet $wallet, ?array $filter): object
    {
			$balance = new \stdClass();
			$balance->incomepaid = 0;
			$balance->expensepaid = 0;
			$balance->incomeunpaid = 0;
			$balance->expenseunpaid = 0;
			$balance->wallet = 0;
			$balance->balance = "positive";
			
			
			
		$due_at = ((!empty($filter["dateinitial"]) && !empty($filter["datefinal"])) ? "AND due_at >=  '{$filter["dateinitial"]}' AND due_at <= '{$filter["datefinal"]}'" : null);
		
		
		if (!empty($due_at)){
			
			$find = $this->find("application_id = :application_id",
				"application_id={$wallet->application_id}",
				"
					(SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id AND wallet_id = {$wallet->id} AND status = 'paid' AND type = 'income' {$due_at}) AS incomepaid,
					(SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id AND wallet_id = {$wallet->id} AND status = 'paid' AND type = 'expense' {$due_at}) AS expensepaid,
					(SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id AND wallet_id = {$wallet->id} AND status = 'unpaid' AND type = 'income' {$due_at}) AS incomeunpaid,
					(SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id AND wallet_id = {$wallet->id} AND status = 'unpaid' AND type = 'expense' {$due_at}) AS expenseunpaid
				
				")->fetch();
	
			if ($find) {
				$balance->incomepaid = abs($find->incomepaid);
				$balance->expensepaid = abs($find->expensepaid);
				$balance->incomeunpaid = abs($find->incomeunpaid);
				$balance->expenseunpaid = abs($find->expenseunpaid);
				$balance->wallet = $balance->incomepaid - $balance->expensepaid;
				$balance->balance = ($balance->wallet >= 1 ? "positive" : "negative");
			}
		

			return $balance;
		
		}else{
			
			$balance->expensepaid = 0;
			$balance->incomeunpaid = 0;
			$balance->expenseunpaid = 0;
			$balance->wallet = 0;
			$balance->balance = "positive";
			
			return $balance;

		}
		
    }
	
	
	/**
     * @param User $user
     * @return object
     */
	 
	 
    public function totalBalanceByPeriod(User $user, ?array $filter): object
    {
		$balance = new \stdClass();
		$balance->incomepaid = 0;
		$balance->expensepaid = 0;
		$balance->incomeunpaid = 0;
		$balance->expenseunpaid = 0;
		$balance->wallet = 0;
		$balance->balance = "positive";
				
		list($yi, $mi) = explode("-", $filter["dateinitial"]);
		list($yf, $mf) = explode("-", $filter["datefinal"]);
		
		$calc1 = floor((12 * ($yf - $mf)) - (12 * ($yi - $mi))); 	
		$calc2 = (12 + $mi)/12; 
		$calc3 = (12 + $mf)/12;
		$totalmeses = $calc2 + $calc3;
		var_dump($calc1);
		var_dump($calc2);
		var_dump($calc3);
		var_dump($totalmeses);
	
		$due_at = ((!empty($filter["dateinitial"]) && !empty($filter["datefinal"])) ? "AND due_at >=  '{$filter["dateinitial"]}' AND due_at <= '{$filter["datefinal"]}'" : null);
		
		if (!empty($due_at)){
			$find = $this->find("application_id = :application_id",
				"application_id={$user->application_id}",
				"
					(SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id  AND status = 'paid' AND type = 'income' {$due_at}) AS incomepaid,
					(SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id  AND status = 'paid' AND type = 'expense' {$due_at}) AS expensepaid,
					(SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id  AND status = 'unpaid' AND type = 'income' {$due_at}) AS incomeunpaid,
					(SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id  AND status = 'unpaid' AND type = 'expense' {$due_at}) AS expenseunpaid
					(SELECT SUM(due_at) FROM app_invoices WHERE application_id = :application_id  AND status = 'unpaid' AND type = 'expense' {$due_at}) AS dateteste
				")->fetch();
	
			if ($find) {
				$balance->incomepaid = abs($find->incomepaid);
				$balance->expensepaid = abs($find->expensepaid);
				$balance->incomeunpaid = abs($find->incomeunpaid);
				$balance->expenseunpaid = abs($find->expenseunpaid);
				$balance->wallet = $balance->incomepaid - $balance->expensepaid;
				$balance->balance = ($balance->wallet >= 1 ? "positive" : "negative");
			}
		

			return $balance;
		
		}else{	
			$balance->expensepaid = 0;
			$balance->incomeunpaid = 0;
			$balance->expenseunpaid = 0;
			$balance->wallet = 0;
			$balance->balance = "positive";
			
			return $balance;

		}
		
    }
	
	
	

    /**
     * @param AppWallet $wallet
     * @return object
     */
    public function balanceWallet(AppWallet $wallet): object
    {
        $balance = new \stdClass();
        $balance->incomepaid = 0;
		$balance->expensepaid = 0;
		$balance->incomeunpaid = 0;
		$balance->expenseunpaid = 0;
		$balance->wallet = 0;
        $balance->balance = "positive";

        $find = $this->find("application_id = :application_id",
				"application_id={$wallet->application_id}",
				"
					(SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id AND wallet_id = {$wallet->id} AND status = 'paid' AND type = 'income') AS incomepaid,
					(SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id AND wallet_id = {$wallet->id} AND status = 'paid' AND type = 'expense') AS expensepaid,
					(SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id AND wallet_id = {$wallet->id} AND status = 'unpaid' AND type = 'income') AS incomeunpaid,
					(SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id AND wallet_id = {$wallet->id} AND status = 'unpaid' AND type = 'expense') AS expenseunpaid
				
				")->fetch();

        if ($find) {
            $balance->incomepaid = abs($find->incomepaid);
			$balance->expensepaid = abs($find->expensepaid);
			$balance->incomeunpaid = abs($find->incomeunpaid);
			$balance->expenseunpaid = abs($find->expenseunpaid);
            $balance->wallet = $balance->incomepaid - $balance->expensepaid;
            $balance->balance = ($balance->wallet >= 1 ? "positive" : "negative");
        }

        return $balance;
    }

    /**
     * @param User $user
     * @param int $year
     * @param int $month
     * @param string $type
     * @return object|null
     */
    public function balanceMonth(User $user, int $year, int $month, string $type): ?object
    {
        $onpaid = $this->find(
            "application_id = :application_id",
            "application_id={$user->application_id}&type={$type}&year={$year}&month={$month}",
            "
                (SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id AND type = :type AND year(due_at) = :year AND month(due_at) = :month AND status = 'paid' {$this->wallet}) AS paid,
                (SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id AND type = :type AND year(due_at) = :year AND month(due_at) = :month AND status = 'unpaid' {$this->wallet}) AS unpaid
            "
        )->fetch();
		
		if (!$onpaid) {
            return null;
        }

        return (object)[
            "paid" => str_price(($onpaid->paid ?? 0)),
            "unpaid" => str_price(($onpaid->unpaid ?? 0))
			
			
        ];
    }
	
	
	/**
     * @param User $user
     * @param int $year
     * @param int $month
     * @param string $type
     * @return object|null
     */
    public function balanceMonthProject(User $user, int $year, int $month, string $type, AppWallet $project): ?object
    {
       
		$teste = "AND wallet_id = " . "{$project->id}";

		$onpaid = $this->find(
            "application_id = :application_id",
            "application_id={$user->application_id}&type={$type}&year={$year}&month={$month}",
            "
                (SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id AND type = :type AND year(due_at) = :year AND month(due_at) = :month AND status = 'paid' {$teste}) AS paid,
                (SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id AND type = :type AND year(due_at) = :year AND month(due_at) = :month AND status = 'unpaid' {$teste}) AS unpaid
            "
        )->fetch();
	
		if (!$onpaid) {
            return null;
        }

        return (object)[
            "paid" => str_price(($onpaid->paid ?? 0)),
            "unpaid" => str_price(($onpaid->unpaid ?? 0))
			
			
        ];
    }
	

    /**
     * @param User $user
     * @return object
     */
    public function chartData(User $user): object
    {
        $dateChart = [];
        for ($month = -4; $month <= 0; $month++) {
			
			
            $dateChart[] = date("m/Y", strtotime("{$month}month"));
        }

        $chartData = new \stdClass();
        $chartData->categories = "'" . implode("','", $dateChart) . "'";
        $chartData->expense = "0,0,0,0,0";
        $chartData->income = "0,0,0,0,0";

	
        $chart = (new AppInvoice())
            ->find("application_id = :application_id  AND status = :status AND due_at >= DATE(now() - INTERVAL 4 MONTH) GROUP BY year(due_at) ASC, month(due_at) ASC",
                "application_id={$user->application_id}&status=paid",
                "
                    year(due_at) AS due_year,
                    month(due_at) AS due_month,
                    DATE_FORMAT(due_at, '%m/%Y') AS due_date,
                    (SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id  AND status = :status AND type = 'income' AND year(due_at) = due_year AND month(due_at) = due_month {$this->wallet}) AS income,
                    (SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id  AND status = :status AND type = 'expense' AND year(due_at) = due_year AND month(due_at) = due_month {$this->wallet}) AS expense
                "
            )->limit(5)->fetch(true);
			
        if ($chart) {
            $chartCategories = [];
            $chartExpense = [];
            $chartIncome = [];
			
            foreach ($chart as $chartItem) {
                $chartCategories[] = $chartItem->due_date;
                $chartExpense[] = $chartItem->expense;
                $chartIncome[] = $chartItem->income;
            }

				
            $chartData->categories = "'" . implode("','", $chartCategories) . "'";
            $chartData->expense = implode(",", array_map("abs", $chartExpense));
            $chartData->income = implode(",", array_map("abs", $chartIncome));

        }

        return $chartData;
    }
	  /**
     * @param User $user
     * @return object
     */
    public function chartData2(User $user, ?array $filter): object
    {
		
		
		
        $dateChart = [];
        for ($month = $filter["dateinitial"]; $month <= $filter["datefinal"]; $month++) {
            $dateChart[] = date("m/Y", strtotime("{$month}month"));
        }

        $chartData = new \stdClass();
        $chartData->categories = "'" . implode("','", $dateChart) . "'";
        $chartData->expense = "0,0,0,0,0";
        $chartData->income = "0,0,0,0,0";

	
        $chart = (new AppInvoice())
            ->find("application_id = :application_id  AND status = :status AND due_at >= DATE(now() - INTERVAL 4 MONTH) GROUP BY year(due_at) ASC, month(due_at) ASC",
                "application_id={$user->application_id}&status=paid",
                "
                    year(due_at) AS due_year,
                    month(due_at) AS due_month,
                    DATE_FORMAT(due_at, '%m/%Y') AS due_date,
                    (SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id  AND status = :status AND type = 'income' AND year(due_at) = due_year AND month(due_at) = due_month {$this->wallet}) AS income,
                    (SELECT SUM(value) FROM app_invoices WHERE application_id = :application_id  AND status = :status AND type = 'expense' AND year(due_at) = due_year AND month(due_at) = due_month {$this->wallet}) AS expense
                "
            )->limit(5)->fetch(true);
			
        if ($chart) {
            $chartCategories = [];
            $chartExpense = [];
            $chartIncome = [];
			
            foreach ($chart as $chartItem) {
                $chartCategories[] = $chartItem->due_date;
                $chartExpense[] = $chartItem->expense;
                $chartIncome[] = $chartItem->income;
            }

				
            $chartData->categories = "'" . implode("','", $chartCategories) . "'";
            $chartData->expense = implode(",", array_map("abs", $chartExpense));
            $chartData->income = implode(",", array_map("abs", $chartIncome));

        }

        return $chartData;
    }
	
	
}