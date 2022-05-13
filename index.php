<?php
ob_start();

require __DIR__ . "/vendor/autoload.php";

/**
 * BOOTSTRAP
 */

use CoffeeCode\Router\Router;
use Source\Core\Session;

$session = new Session();
$route = new Router(url(), ":");
$route->namespace("Source\App");


/**
 * WEB ROUTES
 */
$route->group(null);
$route->get("/", "Web:home");
$route->get("/sobre", "Web:about");

$route->get("/sobre", "Web:about");
$route->get("/recursos", "Web:resources");
$route->get("/preços", "Web:prices");
$route->get("/contato", "Web:contact");
$route->post("/contato", "Web:contact");
$route->get("/suporte", "Web:support");
$route->post("/suporte", "Web:support");
$route->get("/sucesso", "Web:message");
$route->get("/faq", "Web:faq");



//blog
$route->group("/blog");
$route->get("/", "Web:blog");
$route->get("/p/{page}", "Web:blog");
$route->get("/{uri}", "Web:blogPost");
$route->post("/buscar", "Web:blogSearch");
$route->get("/buscar/{search}/{page}", "Web:blogSearch");
$route->get("/em/{category}", "Web:blogCategory");
$route->get("/em/{category}/{page}", "Web:blogCategory");

//auth
$route->group(null);
$route->get("/entrar", "Web:login");
$route->post("/entrar", "Web:login");
$route->get("/cadastrar", "Web:register");
$route->post("/cadastrar", "Web:register");
$route->get("/recuperar", "Web:forget");
$route->post("/recuperar", "Web:forget");
$route->get("/recuperar/{code}", "Web:reset");
$route->post("/recuperar/resetar", "Web:reset");


//auth-worl
$route->group(null);
$route->get("/work-entrar", "Web:workLogin");
$route->post("/work-entrar", "Web:workLogin");
$route->get("/work-cadastrar", "Web:workRegister");
$route->post("/work-cadastrar", "Web:workRegister");
$route->get("/work-recuperar", "Web:workForget");
$route->post("/work-recuperar", "Web:workForget");
$route->get("/work-recuperar/{code}", "Web:workReset");
$route->post("/work-recuperar/resetar", "Web:workReset");



//optin
$route->group(null);
$route->get("/confirma", "Web:confirm");
$route->get("/obrigado/{email}", "Web:success");

//services
$route->group(null);
$route->get("/termos", "Web:terms");


/**
 * Email Chamado
 */
$route->group("/teste");
$route->get("/", "Teste:home");



/**
 * QR Code
 */
$route->group("/qrcode");
$route->get("/", "Qrcode:home");


$route->get("/equipment/{application_id}/{equipment_id}/{equipment_name}", "Qrcode:equipment");
$route->post("/equipment/{application_id}/{equipment_id}/{equipment_name}", "Qrcode:equipment");


$route->get("/equipment-home/{application_id}/{equipment_id}/{equipment_name}", "Qrcode:equipmentHome");
$route->post("/equipment-home/{application_id}/{equipment_id}/{equipment_name}", "Qrcode:equipmentHome");


 



//**----------------------------------------------------------------------**//
//**-----------Software Gerenciamento de Obras e Serviços-----------------**//








/**
 * APP
 */
$route->group("/app");
$route->get("/", "App:home");
$route->get("/receber", "App:income");
$route->get("/receber/{status}/{category}/{date}", "App:income");
$route->get("/pagar", "App:expense");
$route->get("/pagar/{status}/{category}/{date}", "App:expense");
$route->get("/fixas", "App:fixed");
$route->get("/carteiras", "App:wallets");
$route->get("/fatura/{invoice}", "App:invoice");
$route->get("/perfil", "App:profile");
$route->get("/assinatura", "App:signature");
$route->get("/sair", "App:logout");

$route->post("/dash", "App:dash");
$route->post("/launch", "App:launch");
$route->post("/invoice/{invoice}", "App:invoice");
$route->post("/remove/{invoice}", "App:remove");
$route->post("/support", "App:support");
$route->post("/onpaid", "App:onpaid");
$route->post("/filter", "App:filter");
$route->post("/profile", "App:profile");
$route->post("/wallets/{wallet}", "App:wallets");


//users
$route->get("/user", "App:user");
$route->post("/user", "App:user");
$route->get("/user/all/{page}", "App:user");
$route->get("/user-add", "App:userAdd");
$route->post("/user-add", "App:userAdd");
$route->get("/user-edit/{id}", "App:userEdit");
$route->post("/user-edit/{id}", "App:userEdit");

/**
 * App Occupation categories
 */
$route->get("/occupation-category", "App:occupationCategory");
$route->post("/occupation-category", "App:occupationCategory");
$route->get("/occupation-category-delete/{id}", "App:occupationCategory");
$route->post("/occupation-category-delete/{id}", "App:occupationCategory");
$route->get("/occupation-category-add", "App:occupationCategoryAdd");
$route->post("/occupation-category-add", "App:occupationCategoryAdd");


/**
 * App Service Category
 */
$route->get("/service-category", "App:serviceCategory");
$route->post("/service-category", "App:serviceCategory");
$route->get("/service-category-add", "App:serviceCategoryAdd");
$route->post("/service-category-add", "App:serviceCategoryAdd");
$route->get("/service-category-delete/{id}", "App:serviceCategory");
$route->post("/service-category-delete/{id}", "App:serviceCategory");

/**
 * App Equipments Category
 */
$route->get("/equipment-category", "App:equipmentCategory");
$route->post("/equipment-category", "App:equipmentCategory");
$route->get("/equipment-category-delete/{id}", "App:equipmentCategory");
$route->post("/equipment-category-delete/{id}", "App:equipmentCategory");
$route->get("/equipment-category-add", "App:equipmentCategoryAdd");
$route->post("/equipment-category-add", "App:equipmentCategoryAdd");


/**
 * App Maintenance
 */
 
 
$route->get("/maintenance", "App:maintenance");
$route->post("/maintenancesearch", "App:maintenanceSearch");
$route->get("/maintenance/{service_id}/{equipment_id}/{date}/{page}", "App:maintenance");
$route->get("/maintenance-add", "App:maintenanceAdd");
$route->post("/maintenance-add", "App:maintenanceAdd");
$route->get("/maintenance-edit/{id}", "App:maintenanceEdit");
$route->post("/maintenance-edit/{id}", "App:maintenanceEdit");
$route->get("/maintenance-delete/{id}", "App:maintenance");
$route->post("/maintenance-delete/{id}", "App:maintenance");



/**
 * App equipments
 */
$route->get("/equipment", "App:equipment");
$route->post("/equipment", "App:equipment");
$route->get("/equipment/{search}/{page}", "App:equipment");
$route->get("/equipment-add", "App:equipmentAdd");
$route->post("/equipment-add", "App:equipmentAdd");
$route->get("/equipment-edit/{id}", "App:equipmentEdit");
$route->post("/equipment-edit/{id}", "App:equipmentEdit");



$route->get("/equipment/{name}", "App:equipmentHome");
$route->post("/equipment/{name}", "App:equipmentHome");

$route->get("/equipment-home/{equipment_id}/{equipment_name}", "App:equipmentHome");
$route->post("/equipment-home/{equipment_id}/{equipment_name}", "App:equipmentHome");


$route->get("/equipment-qrcode", "App:equipmentQrcode");
$route->post("/equipment-qrcode", "App:equipmentQrcode");
$route->get("/equipment-qrcode/all/{page}", "App:equipmentQrcode");
$route->get("/equipment-qrcode-add", "App:equipmentQrcodeAdd");
$route->post("/equipment-qrcode-add", "App:equipmentQrcodeAdd");
$route->get("/equipment-qrcode-delete/{id}", "App:equipmentQrcode");
$route->post("/equipment-qrcode-delete/{id}", "App:equipmentQrcode");
$route->get("/equipment-qrcode-edit/{id}", "App:equipmentQrcodeEdit");
$route->post("/equipment-qrcode-edit/{id}", "App:equipmentQrcodeEdit");

$route->get("/equipment-file", "App:equipmentFile");
$route->post("/equipment-file", "App:equipmentFile");
$route->get("/equipment-file/all/{page}", "App:equipmentFile");
$route->get("/equipment-file-add", "App:equipmentFileAdd");
$route->post("/equipment-file-add", "App:equipmentFileAdd");
$route->get("/equipment-file-delete/{id}", "App:equipmentFile");
$route->post("/equipment-file-delete/{id}", "App:equipmentFile");

$route->get("/equipment-worker", "App:equipmentWorker");
$route->post("/equipment-worker", "App:equipmentWorker");
$route->get("/equipment-worker/all/{page}", "App:equipmentWorker");
$route->get("/equipment-worker-add", "App:equipmentWorkerAdd");
$route->post("/equipment-worker-add", "App:equipmentWorkerAdd");
$route->get("/equipment-worker-delete/{id}", "App:equipmentWorker");
$route->post("/equipment-worker-delete/{id}", "App:equipmentWorker");

$route->get("/equipment-worker-edit/{id}", "App:equipmentWorkerEdit");
$route->post("/equipment-worker-edit/{id}", "App:equipmentWorkerEdit");


/**
 * App Employees
 */
$route->get("/employee", "App:employee");
$route->post("/employee", "App:employee");
$route->get("/employee/all/{page}", "App:employee");

$route->get("/employee-add", "App:employeeAdd");
$route->post("/employee-add", "App:employeeAdd");

$route->get("/employee-edit/{id}", "App:employeeEdit");
$route->post("/employee-edit/{id}", "App:employeeEdit");


/**
 * App Suppliers
 */
$route->get("/supplier", "App:supplier");
$route->post("/supplier", "App:supplier");
$route->get("/supplier/all/{page}", "App:supplier");
$route->get("/supplier-add", "App:supplierAdd");
$route->post("/supplier-add", "App:supplierAdd");
$route->get("/supplier-edit/{id}", "App:supplierEdit");
$route->post("/supplier-edit/{id}", "App:supplierEdit");


/**
 * App homeview
 */
$route->get("/homeview", "App:homeview");
$route->post("/homeview", "App:homeview");


/**
 * ADMIN ROUTES
 */
$route->namespace("Source\App\Admin");
$route->group("/admin");

//login
$route->get("/", "Login:root");
$route->get("/login", "Login:login");
$route->post("/login", "Login:login");

//dash
$route->get("/dash", "Dash:dash");
$route->get("/dash/home", "Dash:home");
$route->post("/dash/home", "Dash:home");
$route->get("/logoff", "Dash:logoff");

//control
$route->get("/control/home", "Control:home");
$route->get("/control/subscriptions", "Control:subscriptions");
$route->post("/control/subscriptions", "Control:subscriptions");
$route->get("/control/subscriptions/{search}/{page}", "Control:subscriptions");
$route->get("/control/subscription/{id}", "Control:subscription");
$route->post("/control/subscription/{id}", "Control:subscription");
$route->get("/control/plans", "Control:plans");
$route->get("/control/plans/{page}", "Control:plans");
$route->get("/control/plan", "Control:plan");
$route->post("/control/plan", "Control:plan");
$route->get("/control/plan/{plan_id}", "Control:plan");
$route->post("/control/plan/{plan_id}", "Control:plan");

//blog
$route->get("/blog/home", "Blog:home");
$route->post("/blog/home", "Blog:home");
$route->get("/blog/home/{search}/{page}", "Blog:home");
$route->get("/blog/post", "Blog:post");
$route->post("/blog/post", "Blog:post");
$route->get("/blog/post/{post_id}", "Blog:post");
$route->post("/blog/post/{post_id}", "Blog:post");
$route->get("/blog/categories", "Blog:categories");
$route->get("/blog/categories/{page}", "Blog:categories");
$route->get("/blog/category", "Blog:category");
$route->post("/blog/category", "Blog:category");
$route->get("/blog/category/{category_id}", "Blog:category");
$route->post("/blog/category/{category_id}", "Blog:category");

//faqs
$route->get("/faq/home", "Faq:home");
$route->get("/faq/home/{page}", "Faq:home");
$route->get("/faq/channel", "Faq:channel");
$route->post("/faq/channel", "Faq:channel");
$route->get("/faq/channel/{channel_id}", "Faq:channel");
$route->post("/faq/channel/{channel_id}", "Faq:channel");
$route->get("/faq/question/{channel_id}", "Faq:question");
$route->post("/faq/question/{channel_id}", "Faq:question");
$route->get("/faq/question/{channel_id}/{question_id}", "Faq:question");
$route->post("/faq/question/{channel_id}/{question_id}", "Faq:question");

//users
$route->get("/users/home", "Users:home");
$route->post("/users/home", "Users:home");
$route->get("/users/home/{search}/{page}", "Users:home");
$route->get("/users/user", "Users:user");
$route->post("/users/user", "Users:user");
$route->get("/users/user/{user_id}", "Users:user");
$route->post("/users/user/{user_id}", "Users:user");

//notification center
$route->post("/notifications/count", "Notifications:count");
$route->post("/notifications/list", "Notifications:list");

//END ADMIN
$route->namespace("Source\App");







/**
 * PAY ROUTES
 */
$route->group("/pay");
$route->post("/create", "Pay:create");
$route->post("/update", "Pay:update");

/**
 * ERROR ROUTES
 */
$route->group("/ops");
$route->get("/{errcode}", "Web:error");

/**
 * ROUTE
 */
$route->dispatch();

/**
 * ERROR REDIRECT
 */
if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();



