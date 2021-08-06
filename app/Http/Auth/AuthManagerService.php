<?php
/**
 * Author:Robert
 *
 */

namespace App\Http\Auth;

use App\Model\Logic\AuthLogic;
use Swoft\Auth\AuthManager;
use Swoft\Auth\Contract\AuthManagerInterface;
use Swoft\Auth\AuthSession;
use Swoft\Auth\Parser\JWTTokenParser;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Author:Robert
 *
 * @Bean()
 * Class AuthManagerService
 * @package App\Http\Auth
 */
class AuthManagerService extends AuthManager implements AuthManagerInterface
{

    /**
     * @var string
     */
    protected $prefix = 'swoft.token.';

    protected $tokenParserClass = JWTTokenParser::class;


    /**
     * Author:Robert
     *
     * @param string $username
     * @param string $password
     * @return AuthSession
     */
    public function accountLogin(string $username, string $password): AuthSession
    {
        $this->setSessionDuration(config('auth.jwt.expire'));
        return $this->login(AuthLogic::class, [
            'identity' => $username,
            'credential' => $password,
        ]);
    }
}
