<?php

namespace App\Model\Logic;

use App\Common\Http\ApiResponse;
use App\Exception\ApiException;
use App\Model\Entity\Account;
use Swoft\Auth\AuthResult;
use Swoft\Auth\Contract\AccountTypeInterface;
use Swoft\Bean\Annotation\Mapping\Bean;
use Exception;
use Swoft\Log\Helper\CLog;

/**
 * Author:Robert
 *
 * @Bean()
 * Class AuthLogic
 * @package App\Model\Logic
 */
class AuthLogic implements AccountTypeInterface
{

    /**
     * Author:Robert
     *
     * @param array $data
     * @return AuthResult
     * @throws Exception
     */
    public function login(array $data): AuthResult
    {
        $account = $data['identity'];
        $password = $data['credential'];
        $authResult = new AuthResult();
        // 用户验证成功则签发token
        $account = Account::where('account', $account)->first();
        if (!$account) {
            throw new ApiException("账户或用户名错误");
        }
        // authResult 主标识 对应 jwt 中的 sub 字段
        $authResult->setIdentity($account->getId());
        // authResult 附加数据 jwt 的 payload
        $authResult->setExtendedData([
            'nickname' => $account->getNickname(),
            'tenantId' => $account->getTenantId(),
            'groupId' => $account->getGroupId(),
        ]);
        return $authResult;
    }

    /**
     * Author:Robert
     *
     * @param string $identity
     * @return bool
     */
    public function authenticate(string $identity): bool
    {
        return true;
//        return Account::where('id', $identity)->exists();
    }
}
