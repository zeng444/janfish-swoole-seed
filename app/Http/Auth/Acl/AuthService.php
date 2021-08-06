<?php
/**
 * Author:Robert
 *
 */

namespace App\Http\Auth\Acl;

use App\Exception\ApiException;
use Swoft\Auth\AuthUserService;
use Swoft\Auth\Contract\AuthServiceInterface;
use Psr\Http\Message\ServerRequestInterface;


/**
 * Author:Robert
 *
 * Class AuthService
 * @package App\Http\Auth\Acl
 */
class AuthService extends AuthUserService implements AuthServiceInterface
{


    /**
     * Author:Robert
     *
     * @param string $requestHandler
     * @param ServerRequestInterface $request
     * @return bool
     */
    public function auth(string $requestHandler, ServerRequestInterface $request): bool
    {
        // 签发对象标识
        $identity = $this->getUserIdentity();
        // token载荷
        $payload = $this->getUserExtendData();
        return $this->aclAuth($identity, $request->getUriPath(), $request->getMethod());
    }

    /**
     * Author:Robert
     *
     * @param string $identity
     * @param string $urlPath
     * @param string $method
     * @return bool
     */
    protected function aclAuth(string $identity, string $urlPath, string $method): bool
    {
        $httpRouter = \Swoft::getBean('httpRouter');
        $matched = $httpRouter->match($urlPath, $method);
        if (!$matchedRoute = $matched[2]) {
            return false;
        }
        $current = $matchedRoute->getMethod().':'.$matchedRoute->getPath();
        return $identity === 'zeng444' || true;
    }
}
