<?php declare(strict_types=1);


namespace App\Http\Controller;

use App\Common\Http\ApiResponse;
use App\Http\Auth\AuthManagerService;
use Swoft;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\Middlewares;
use App\Http\Middleware\AuthMiddleware as AuthMiddleware;
use Swoft\Http\Message\Request;
use Swoft\Http\Message\Response;
use Throwable;

/**
 * Class HomeController
 * @Controller("home")
 * @Middlewares({
 *     @Middleware(AuthMiddleware::class)
 * })
 */
class HomeController
{

    /**
     * @Inject()
     * @var ApiResponse
     */
    protected $apiResponse;

    /**
     * @Inject()
     * @var AuthManagerService
     */
    protected $authManager;

    /**
     * Author:Robert
     * @RequestMapping(route="index", method={RequestMethod::POST}, name="登录")
     * @return array
     * @throws \Exception
     */
    public function index(): array
    {
        return $this->apiResponse->success([
            'id' => $this->authManager->getSession()->getIdentity(),
            'ext' => $this->authManager->getSession()->getExtendedData(),
        ]);
    }

}
