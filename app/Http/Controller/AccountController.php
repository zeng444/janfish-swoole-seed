<?php declare(strict_types=1);


namespace App\Http\Controller;

use App\Common\Http\ApiResponse;
use App\Http\Auth\AuthManagerService;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Http\Message\Request;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Annotation\Mapping\Middlewares;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Bean\Annotation\Mapping\Inject;
use App\Http\Middleware\AuthMiddleware;

/**
 * Class HomeController
 * @Controller()
 */
class AccountController
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
     * @RequestMapping(route="/login", method={RequestMethod::POST}, name="登录")
     * @param Request $request
     * @return array
     */
    public function login(Request $request): array
    {
        $account = $request->input('account', '');
        $password = $request->input('password', '');
        $session = $this->authManager->accountLogin($account, $password);
        return $this->apiResponse->success([
            'se' => config('auth.jwt.secret'),
            'accountId' => $session->getIdentity(),
            'token' => sprintf('Bearer %s',$session->getToken()),
            'expiredAt' => date('Y-m-d H:i:s',$session->getExpirationTime()),
        ]);
    }

}
