<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Core\View;
use Source\Models\Auth;
use Source\Models\Category;
use Source\Models\Faq\Question;
use Source\Models\Post;
use Source\Models\Report\Access;
use Source\Models\Report\Online;
use Source\Models\User;
use Source\Models\Application;
use Source\Models\EquipmentCategory;
use Source\Models\ServiceCategory;
use Source\Models\OccupationCategory;
use Source\Models\StageCategory;
use Source\Models\Messages;
use Source\Support\Email;
use Source\Support\Pager;

/**
 * Web Controller
 * @package Source\App
 */
class Web extends Controller
{
    /**
     * Web constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_THEME . "/");

        (new Access())->report();
        (new Online())->report();
    }

    /**
     * SITE HOME
     */
    public function home(): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("home", [
            "head" => $head,
            "video" => "lDZGl9Wdc7Y",
            "blog" => (new Post())
                ->findPost()
                ->order("post_at DESC")
                ->limit(6)
                ->fetch(true)
        ]);
    }

    /**
     * SITE ABOUT
     */
    public function about(): void
    {
        $head = $this->seo->render(
            "Saiba como Funciona nossa plataforma de criaçao de Sites e Sistemas ",
            CONF_SITE_DESC,
            url("/sobre"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("about", [
            "head" => $head,
            "video" => "lDZGl9Wdc7Y",
            "faq" => (new Question())
                ->find("channel_id = :id", "id=1", "question, response")
                ->order("order_by")
                ->fetch(true)
        ]);
    }

    /**
     * SITE BLOG
     * @param array|null $data
     */
    public function blog(?array $data): void
    {
        $head = $this->seo->render(
            "Blog - " . CONF_SITE_NAME,
            "Confira em nosso blog dicas e sacadas de como controlar melhorar suas contas. Vamos tomar um café?",
            url("/blog"),
            theme("/assets/images/favicon-32x32.png")
        );

        $blog = (new Post())->findPost();
        $pager = new Pager(url("/blog/p/"));
        $pager->pager($blog->count(), 9, ($data['page'] ?? 1));

        echo $this->view->render("blog", [
            "head" => $head,
            "blog" => $blog->order("post_at DESC")->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "paginator" => $pager->render()
        ]);
    }
	
	
	 public function pontes(?array $data): void
    {
        
		//create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
			
			
				
				$pontes = new Pontes();			
				$pontes->name = $data["name"];
				$pontes->fimdecurso = $data["fimdecurso"];
				$pontes->anticolisao1 = $data["anticolisao1"];		
				$pontes->anticolisao2 = $data["anticolisao2"];
				$pontes->observacao = $data["observacao"];					
				if (!$pontes->save()) {
				
					var_dump($pontes); exit;

					$json["message"] = $pontes->message()->render();
					echo json_encode($json);
					return;
				}
				

				$json["message"] = $this->message->success("Ponte {$pontes->first_name} salva com sucess")->render();
				echo json_encode($json);
				return; 	
           
        }



        $head = $this->seo->render(
            "Meu perfil - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon-32x32.png"),
            false
        );

        echo $this->view->render("pontes", [
            "head" => $head

        ]);
		
    }
		
		
    
	

    /**
     * SITE BLOG CATEGORY
     * @param array $data
     */
    public function blogCategory(array $data): void
    {
        $categoryUri = filter_var($data["category"], FILTER_SANITIZE_STRIPPED);
        $category = (new Category())->findByUri($categoryUri);

        if (!$category) {
            redirect("/blog");
        }

        $blogCategory = (new Post())->findPost("category = :c", "c={$category->id}");
        $page = (!empty($data['page']) && filter_var($data['page'], FILTER_VALIDATE_INT) >= 1 ? $data['page'] : 1);
        $pager = new Pager(url("/blog/em/{$category->uri}/"));
        $pager->pager($blogCategory->count(), 9, $page);

        $head = $this->seo->render(
            "Artigos em {$category->title} - " . CONF_SITE_NAME,
            $category->description,
            url("/blog/em/{$category->uri}/{$page}"),
            ($category->cover ? image($category->cover, 1200, 628) : theme("/assets/images/favicon-32x32.png"))
        );

        echo $this->view->render("blog", [
            "head" => $head,
            "title" => "Artigos em {$category->title}",
            "desc" => $category->description,
            "blog" => $blogCategory
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("post_at DESC")
                ->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    /**
     * SITE BLOG SEARCH
     * @param array $data
     */
    public function blogSearch(array $data): void
    {
        if (!empty($data['s'])) {
            $search = str_search($data['s']);
            echo json_encode(["redirect" => url("/blog/buscar/{$search}/1")]);
            return;
        }

        $search = str_search($data['search']);
        $page = (filter_var($data['page'], FILTER_VALIDATE_INT) >= 1 ? $data['page'] : 1);

        if ($search == "all") {
            redirect("/blog");
        }

        $head = $this->seo->render(
            "Pesquisa por {$search} - " . CONF_SITE_NAME,
            "Confira os resultados de sua pesquisa para {$search}",
            url("/blog/buscar/{$search}/{$page}"),
            theme("/assets/images/favicon-32x32.png")
        );

        $blogSearch = (new Post())->findPost("MATCH(title, subtitle) AGAINST(:s)", "s={$search}");

        if (!$blogSearch->count()) {
            echo $this->view->render("blog", [
                "head" => $head,
                "title" => "PESQUISA POR:",
                "search" => $search
            ]);
            return;
        }

        $pager = new Pager(url("/blog/buscar/{$search}/"));
        $pager->pager($blogSearch->count(), 9, $page);

        echo $this->view->render("blog", [
            "head" => $head,
            "title" => "PESQUISA POR:",
            "search" => $search,
            "blog" => $blogSearch->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    /**
     * SITE BLOG POST
     * @param array $data
     */
    public function blogPost(array $data): void
    {
        $post = (new Post())->findByUri($data['uri']);
        if (!$post) {
            redirect("/404");
        }

        $user = Auth::user();
        if (!$user || $user->level < 5) {
            $post->views += 1;
            $post->save();
        }

        $head = $this->seo->render(
            "{$post->title} - " . CONF_SITE_NAME,
            $post->subtitle,
            url("/blog/{$post->uri}"),
            ($post->cover ? image($post->cover, 1200, 628) : theme("/assets/images/favicon-32x32.png"))
        );

        echo $this->view->render("blog-post", [
            "head" => $head,
            "post" => $post,
            "related" => (new Post())
                ->findPost("category = :c AND id != :i", "c={$post->category}&i={$post->id}")
                ->order("rand()")
                ->limit(3)
                ->fetch(true)
        ]);
    }

    /**
     * SITE LOGIN
     * @param null|array $data
     */
    public function login(?array $data): void
    {
        if (Auth::user()) {
            redirect("/app");
        }

        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }

            if (request_limit("weblogin", 3, 60 * 5)) {
                $json['message'] = $this->message->error("Você já efetuou 3 tentativas, esse é o limite. Por favor, aguarde 5 minutos para tentar novamente!")->render();
                echo json_encode($json);
                return;
            }

            if (empty($data['email']) || empty($data['password'])) {
                $json['message'] = $this->message->warning("Informe seu email e senha para entrar")->render();
                echo json_encode($json);
                return;
            }

            $save = (!empty($data['save']) ? true : false);
            $auth = new Auth();
            $login = $auth->login($data['email'], $data['password'], $save);

            if ($login) {
                $this->message->success("Seja bem-vindo(a) de volta " . Auth::user()->first_name . "!")->flash();
                $json['redirect'] = url("/app");
            } else {
                $json['message'] = $auth->message()->before("Ooops! ")->render();
            }

            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            "Entrar - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/entrar"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("auth-login", [
            "head" => $head,
            "cookie" => filter_input(INPUT_COOKIE, "authEmail")
        ]);
    }

    /**
     * SITE PASSWORD FORGET
     * @param null|array $data
     */
    public function forget(?array $data)
    {
        if (Auth::user()) {
            redirect("/app");
        }

        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }

            if (empty($data["email"])) {
                $json['message'] = $this->message->info("Informe seu e-mail para continuar")->render();
                echo json_encode($json);
                return;
            }

            if (request_repeat("webforget", $data["email"])) {
                $json['message'] = $this->message->error("Ooops! Você já tentou este e-mail antes")->render();
                echo json_encode($json);
                return;
            }

            $auth = new Auth();
            if ($auth->forget($data["email"])) {
                $json["message"] = $this->message->success("Acesse seu e-mail para recuperar a senha")->render();
            } else {
                $json["message"] = $auth->message()->before("Ooops! ")->render();
            }

            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            "Recuperar Senha - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/recuperar"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("auth-forget", [
            "head" => $head
        ]);
    }

    /**
     * SITE FORGET RESET
     * @param array $data
     */
    public function reset(array $data): void
    {
        if (Auth::user()) {
            redirect("/app");
        }

        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }

            if (empty($data["password"]) || empty($data["password_re"])) {
                $json["message"] = $this->message->info("Informe e repita a senha para continuar")->render();
                echo json_encode($json);
                return;
            }

            list($email, $code) = explode("|", $data["code"]);
            $auth = new Auth();

            if ($auth->reset($email, $code, $data["password"], $data["password_re"])) {
                $this->message->success("Senha alterada com sucesso. Vamos controlar?")->flash();
                $json["redirect"] = url("/entrar");
            } else {
                $json["message"] = $auth->message()->before("Ooops! ")->render();
            }

            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            "Crie sua nova senha no " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/recuperar"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("auth-reset", [
            "head" => $head,
            "code" => $data["code"]
        ]);
    }

    /**
     * SITE REGISTER
     * @param null|array $data
     */
	 public function register(?array $data): void
    {
        if (Auth::user()) {
            redirect("/app");
        }

        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }

            if (in_array("", $data)) {
                $json['message'] = $this->message->info("Informe seus dados para criar sua conta.")->render();
                echo json_encode($json);
                return;
            }
			
            $auth = new Auth();
			$application = new Application();
			
			$applicationName ="{$data["first_name"]} {$data["last_name"]}";
			
			$application->bootstrap(
                $applicationName,
				$applicationName,
                $data["email"],
            );
            $user = new User();
			
           
			if ($auth->appRegister($application)){
				
				
				$appId = $application->find("aplication_name = :aplication_name AND admin_name = :admin_name  AND email = :email","aplication_name={$applicationName}&admin_name={$applicationName}&email={$data["email"]}");
						
			
				$services = new ServiceCategory();
				$occupation = new OccupationCategory();
				$user->bootstrap(
					$appId->id,
					$data["first_name"],
					$data["last_name"],
					$data["email"],
					$data["password"]
				);
				
				
				if($auth->register($user)) {
					$userId = $user->find("application_id = :application_id  AND email = :email","email={$data["email"]}&application_id={$appId->id}");
					$equipmentsArray = ["Motor", 
						"Quadro de Energia"
					];
					
					$serviceArray = ["Elétrica", 
					"Mecânica"
					];
					
					$occupationArray = ["Diretor", 
						"Gerente",
						"Técnico",
					];
							
					foreach ($equipmentsArray as $value) {
						(new EquipmentCategory())->bootstrap(
							$userId->id,
							$appId->id,
							$value,
						)->save();
					}
						
					foreach ($equipmentsArray as $value) {
						(new EquipmentCategory())->bootstrap(
							$userId->id,
							$appId->id,
							$value,
						)->save();
					}
					
					foreach ($serviceArray as $value) {
						(new ServiceCategory())->bootstrap(
							$userId->id,
							$appId->id,
							$value,
						)->save();
					}
					
					foreach ($occupationArray as $value) {
						(new OccupationCategory())->bootstrap(
							$userId->id,
							$appId->id,
							$value,
						)->save();
					}
					
					
					
					$json['redirect'] = url("/confirma");
					
				} else {
					
				$json['message'] = $auth->message()->before("Ooops! ")->render();
				
				}
			
			}else{
				$json['message'] = $auth->message()->before("Ooops! ")->render();
				
			}
			
            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            "Criar Conta - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/cadastrar"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("auth-register", [
            "head" => $head
        ]);
    }
	
	/**
     * SITE LOGIN
     * @param null|array $data
     */
    public function workLogin(?array $data): void
    {
        if (Auth::user()) {
            redirect("/work");
        }

        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }

            if (request_limit("weblogin", 3, 60 * 5)) {
                $json['message'] = $this->message->error("Você já efetuou 3 tentativas, esse é o limite. Por favor, aguarde 5 minutos para tentar novamente!")->render();
                echo json_encode($json);
                return;
            }

            if (empty($data['email']) || empty($data['password'])) {
                $json['message'] = $this->message->warning("Informe seu email e senha para entrar")->render();
                echo json_encode($json);
                return;
            }

            $save = (!empty($data['save']) ? true : false);
            $auth = new Auth();
            $login = $auth->login($data['email'], $data['password'], $save);

            if ($login) {
                $this->message->success("Seja bem-vindo(a) de volta " . Auth::user()->first_name . "!")->flash();
                $json['redirect'] = url("/work");
            } else {
                $json['message'] = $auth->message()->before("Ooops! ")->render();
            }

            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            "Entrar - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/work-entrar"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("work-auth-login", [
            "head" => $head,
            "cookie" => filter_input(INPUT_COOKIE, "authEmail")
        ]);
    }

    /**
     * SITE PASSWORD FORGET
     * @param null|array $data
     */
    public function workForget(?array $data)
    {
        if (Auth::user()) {
            redirect("/work");
        }

        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }

            if (empty($data["email"])) {
                $json['message'] = $this->message->info("Informe seu e-mail para continuar")->render();
                echo json_encode($json);
                return;
            }

            if (request_repeat("webforget", $data["email"])) {
                $json['message'] = $this->message->error("Ooops! Você já tentou este e-mail antes")->render();
                echo json_encode($json);
                return;
            }

            $auth = new Auth();
            if ($auth->forget($data["email"])) {
				
                $json["message"] = $this->message->success("Acesse seu e-mail para recuperar a senha")->render();
            } else {
                $json["message"] = $auth->message()->before("Ooops! ")->render();
            }

            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            "Recuperar Senha - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/work-recuperar"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("work-auth-forget", [
            "head" => $head
        ]);
    }

    /**
     * SITE FORGET RESET
     * @param array $data
     */
    public function workReset(array $data): void
    {
        if (Auth::user()) {
            redirect("/work");
        }

        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }

            if (empty($data["password"]) || empty($data["password_re"])) {
                $json["message"] = $this->message->info("Informe e repita a senha para continuar")->render();
                echo json_encode($json);
                return;
            }

            list($email, $code) = explode("|", $data["code"]);
            $auth = new Auth();

            if ($auth->reset($email, $code, $data["password"], $data["password_re"])) {
                $this->message->success("Senha alterada com sucesso. Vamos controlar?")->flash();
                $json["redirect"] = url("/work-entrar");
            } else {
                $json["message"] = $auth->message()->before("Ooops! ")->render();
            }

            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            "Crie sua nova senha no " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/work-recuperar"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("work-auth-reset", [
            "head" => $head,
            "code" => $data["code"]
        ]);
    }

    /**
     * SITE REGISTER
     * @param null|array $data
     */
	 public function workRegister(?array $data): void
    {
        if (Auth::user()) {
            redirect("/work");
        }

        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }
			
			
			$password = $data['password'];
		

            if (in_array("", $data)) {
                $json['message'] = $this->message->info("Informe seus dados para criar sua conta.")->render();
                echo json_encode($json);
                return;
            }
			
			 if (!is_passwd($password)) {
				$min = CONF_PASSWD_MIN_LEN;
				$max = CONF_PASSWD_MAX_LEN;
                $json['message'] = $this->message->warning("A senha deve ter entre {$min} e {$max} caracteres")->render();
                echo json_encode($json);
                return;
            }

            $auth = new Auth();
			$application = new Application();
			$applicationName ="{$data["first_name"]} {$data["last_name"]}";
			$application->bootstrap(
                $applicationName,
				$applicationName,
                $data["email"],
				$data["password"]
            );
			
            $user = new User();
			
			if ($auth->appRegister($application)){
				$appId = $application->find("aplication_name = :aplication_name AND admin_name = :admin_name  AND email = :email","aplication_name={$applicationName}&admin_name={$applicationName}&email={$data["email"]}");
						
				$user->bootstrap(
					$appId->id,
					$data["first_name"],
					$data["last_name"],
					$data["email"],
					$data["password"]
				);
					
				if($auth->register($user)) {
					$userId = $user->find("application_id = :application_id  AND email = :email","email={$data["email"]}&application_id={$appId->id}");	
					$json['redirect'] = url("/confirma");
					
				} else {	
					$json['message'] = $auth->message()->before("Ooops! ")->render();
				
				}
			}else{
				$json['message'] = $auth->message()->before("Ooops! ")->render();
				
			}
			
            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            "Criar Conta - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/work-cadastrar"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("work-auth-register", [
            "head" => $head
        ]);
    }
	
	
	
	

    /**
     * SITE MESSAGE
     * @param null|array $data
     */
    public function prices(): void
    {

            $head = $this->seo->render(
                "Confira os nosssos planos e Soluções",
                CONF_SITE_DESC,
                url("/preços"),
                theme("/assets/images/favicon-32x32.png")
            );

            echo $this->view->render("prices", [
                "head" => $head
            ]);

    }


    public function support(array $data): void
    {

        if (!empty($data["action"]) && $data["action"] == "create") {



            if (empty( $data["subject"]) && empty( $data["message"])) {
                $json['message'] = $this->message->info("Informe o nome do seu site e como podemos te ajudar")->render();
                echo json_encode($json);
                return;
            }


            if (empty( $data["subject"])) {
                $json['message'] = $this->message->info("Informe qual nome do seu site")->render();
                echo json_encode($json);
                return;
            }

            if (empty( $data["message"])) {
                $json['message'] = $this->message->info("Informe como podemos te ajudar")->render();
                echo json_encode($json);
                return;
            }


            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $messages = new Messages();
            $messages->messageSupport($data["subject"],$data["message"]);


            if ($messages-> messagecontactSend() ){
                $json['redirect'] = url("/sucesso");
            }else{
                $json['message'] = $this->message->info("erro")->render();
            }


            echo json_encode($json);
            return;

        }


        $head = $this->seo->render(
            "Entre em contato com nossa equipe de support",
            CONF_SITE_DESC,
            url("/suporte"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("support", [
            "head" => $head
        ]);


    }




    public function contact(array $data): void
	{

    if (!empty($data["action"]) && $data["action"] == "create") {



        if (empty( $data["subject"]) && empty( $data["message"]) && empty( $data["emil"] )) {
            $json['message'] = $this->message->info("Informe o seu site e como podemos te ajudar")->render();
            echo json_encode($json);
            return;
        }


        if (empty( $data["email"])) {
            $json['message'] = $this->message->info("Informe qual nome do seu email")->render();
            echo json_encode($json);
            return;
        }


        if (empty( $data["subject"])) {
            $json['message'] = $this->message->info("Informe qual nome do seu site")->render();
            echo json_encode($json);
            return;
        }

        if (empty( $data["message"])) {
            $json['message'] = $this->message->info("Informe como podemos te ajudar")->render();
            echo json_encode($json);
            return;
        }


        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $messages = new Messages();
        $messages->messageContact($data["subject"],$data["message"],$data["email"])->messagecontactSend();

        if ($messages-> messagecontactSend() ){
            $json['redirect'] = url("/sucesso");
        }else{
            $json['message'] = $this->message->info("erro")->render();
        }


        echo json_encode($json);
        return;

    }


    $head = $this->seo->render(
        "Entre em contato conosco",
        CONF_SITE_DESC,
        url("/contato"),
        theme("/assets/images/favicon-32x32.png")
    );

    echo $this->view->render("contact", [
        "head" => $head
    ]);


	}

    public function marketing(array $data): void
    {

        if (!empty($data["action"]) && $data["action"] == "create") {

            if (empty( $data["name"]) && empty( $data["email"]) && empty( $data["phone"] )) {
                $json['message'] = $this->message->info("Informe os dados para realizar download")->render();
                echo json_encode($json);
                return;
            }


            if (empty( $data["name"])) {
                $json['message'] = $this->message->info("Informe qual seu nome")->render();
                echo json_encode($json);
                return;
            }


            if (empty( $data["email"])) {
                $json['message'] = $this->message->info("Informe qual nome do seu email")->render();
                echo json_encode($json);
                return;
            }


            if (empty( $data["phone"])) {
                $json['message'] = $this->message->info("Informe seu numero de celular")->render();
                echo json_encode($json);
                return;
            }

            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $messages = new Messages();
            $messages->messageMarketingSolar($data["name"],$data["email"],$data["phone"]);

            if ($messages->messageMarketingSolarSend() ){
                $json['redirect'] = url("/ebook-de-marketing-digital-para-energia-solar");
            }else{
                $json['message'] = $this->message->info("erro")->render();
            }




            echo json_encode($json);
            return;

        }


        $head = $this->seo->render(
            "Faça Donwload do Nosso Ebook",
            CONF_SITE_DESC,
            url("/ebook-de-marketing-digital-para-energia-solar"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("marketing", [
            "head" => $head
        ]);


    }


    public function send(array $data): void
    {

        if (!empty($data["action"]) && $data["action"] == "create") {

            if (empty( $data["name"]) && empty( $data["email"])) {
                $json['message'] = $this->message->info("Informe os dados para realizar download")->render();
                echo json_encode($json);
                return;
            }

            if (empty( $data["email"])) {
                $json['message'] = $this->message->info("Informe o email")->render();
                echo json_encode($json);
                return;
            }


            if (empty( $data["name"])) {
                $json['message'] = $this->message->info("Nome do Cliente ou empresa")->render();
                echo json_encode($json);
                return;
            }

            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $messages = new Messages();
            $messages->messageEmail($data["email"], $data["name"]);

            if ($messages->messageEmailSend()){
                $json['redirect'] = url("/sucesso");
            }else{
                $json['message'] = $this->message->info("erro")->render();
            }

            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            "Envio de Email Para Clientes",
            CONF_SITE_DESC,
            url("/emailsend"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("emailsend", [
            "head" => $head
        ]);

    }





    public function faq(): void
    {




        $head = $this->seo->render(
            "Principais dúvidas de nossos clientes",
            CONF_SITE_DESC,
            url("/faq"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("faq", [
            "head" => $head
        ]);


    }



    /**
     * SITE OPT-IN CONFIRM
     */
    public function confirm(): void
    {
        $head = $this->seo->render(
            "Confirme Seu Cadastro - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/confirma"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("optin", [
            "head" => $head,
            "data" => (object)[
                "title" => "Falta pouco! Confirme seu cadastro.",
                "desc" => "Enviamos um link de confirmação para seu e-mail. Acesse e siga as instruções para concluir seu cadastro e comece a gereciar sua empresa",
                "image" => theme("/assets/images/optin-confirm.jpg")
            ]
        ]);
    }

    public function message(): void
{
    $head = $this->seo->render(
        "Confirme Seu Cadastro - " . CONF_SITE_NAME,
        CONF_SITE_DESC,
        url("/sucesso"),
        theme("/assets/images/favicon-32x32.png")
    );

    echo $this->view->render("message", [
        "head" => $head,
        "data" => (object)[
            "title" => "Mensagem Enviada Com Sucesso",
            "desc" => "Entraremos em Contato com você",
            "image" => theme("/assets/images/optin-success.jpg"),
        ]
    ]);
}


    public function ebook_solar_marketing_strategies(): void
    {
        $head = $this->seo->render(
            "Ebook Dicas de Marketing Digital Para Empresas de Energia Solar - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/ebook-download"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("ebook-download", [
            "head" => $head,
            "data" => (object)[
                "title" => "Dicas de Marketing Digital Para Empresas De Energia Solar",
                "image" => theme("/assets/images/ebook.png"),
				"link" => url("shared/ebooks/dicas_de_marketing.pdf"),
            ]
        ]);
		
	}
	
	 public function qrcode(): void
    {
        $head = $this->seo->render(
            "Sistema de QR-CODE para industrias",
            CONF_SITE_DESC,
            url("/qrcode"),
            theme("/assets/images/favicon-32x32.png")
        );
		
		
		if (!empty($data["action"]) && $data["action"] == "aviso") {

           
        }
		

        echo $this->view->render("qrcode", [
            "head" => $head
        ]);
		
	}
	
	
	 public function aviso(): void
    {
        $head = $this->seo->render(
            "Sistema de QR-CODE para industrias",
            CONF_SITE_DESC,
            url("/aviso"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("aviso", [
            "head" => $head
        ]);
		
	}
	
	


    /**
     * SITE OPT-IN SUCCESS
     * @param array $data
     */
    public function success(array $data): void
    {
        $email = base64_decode($data["email"]);
        $user = (new User())->findByEmail($email);
		$app = (new Application())->findByEmail($email);

        if (($user && $user->status != "confirmed") && ($app && $app->status != "confirmed")) {
            $user->status = "confirmed";
            $user->save();
			$app->status = "confirmed";
            $app->save();	
        }

        $head = $this->seo->render(
            "Bem-vindo(a) ao " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/obrigado"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("optin", [
            "head" => $head,
            "data" => (object)[
                "title" => "Tudo pronto. Você já pode controlar :)",
                "desc" => "Bem-vindo(a) ao seu Sistema de Gestão de Manutenção da 3wstecnologia",
                "image" => theme("/assets/images/optin-success.jpg"),
                "link" => url("/entrar"),
                "linkTitle" => "Fazer Login"
            ],
            "track" => (object)[
                "fb" => "Lead",
                "aw" => "AW-953362805/yAFTCKuakIwBEPXSzMYD"
            ]
        ]);
    }


    /**
     * SITE TERMS
     */
    public function terms(): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - Termos de uso",
            CONF_SITE_DESC,
            url("/termos"),
            theme("/assets/images/favicon-32x32.png")
        );

        echo $this->view->render("terms", [
            "head" => $head
        ]);
    }

    /**
     * SITE NAV ERROR
     * @param array $data
     */
    public function error(array $data): void
    {
        $error = new \stdClass();

        switch ($data['errcode']) {
            case "problemas":
                $error->code = "OPS";
                $error->title = "Estamos enfrentando problemas!";
                $error->message = "Parece que nosso serviço não está diponível no momento. Já estamos vendo isso mas caso precise, envie um e-mail :)";
                $error->linkTitle = "ENVIAR E-MAIL";
                $error->link = "mailto:" . CONF_MAIL_SUPPORT;
                break;

            case "manutencao":
                $error->code = "OPS";
                $error->title = "Desculpe. Estamos em manutenção!";
                $error->message = "Voltamos logo! Por hora estamos trabalhando para melhorar nosso conteúdo para você controlar melhor as suas contas :P";
                $error->linkTitle = null;
                $error->link = null;
                break;

            default:
                $error->code = $data['errcode'];
                $error->title = "Ooops. Conteúdo indispinível :/";
                $error->message = "Sentimos muito, mas o conteúdo que você tentou acessar não existe, está indisponível no momento ou foi removido :/";
                $error->linkTitle = "Continue navegando!";
                $error->link = url_back();
                break;
        }

        $head = $this->seo->render(
            "{$error->code} | {$error->title}",
            $error->message,
            url("/ops/{$error->code}"),
            theme("/assets/images/favicon-32x32.png"),
            false
        );

        echo $this->view->render("error", [
            "head" => $head,
            "error" => $error
        ]);
    }
}