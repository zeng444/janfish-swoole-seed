<?php declare(strict_types=1);

namespace App\Common\Db;


use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Db\Connection\Connection;
use Swoft\Db\Contract\DbSelectorInterface;
use Swoft\Log\Helper\CLog;

/**
 * Author:Robert
 *
 * Class DbSelector
 * @Bean()
 * @package App\Common\Db
 */
class DbSelector implements DbSelectorInterface
{

    /**
     * @param Connection $connection
     */
    public function select(Connection $connection): void
    {
        // 在请求中获取 ID
        $selectIndex = (int)context()->getRequest()->query('id', 0);
        $createDbName = $connection->getDb();

        if ($selectIndex == 0) {
            $selectIndex = '';
        }
        // 数据库名 + ID。例如：order_database_1，好处是会根据上下文自动切库
        $dbName = sprintf('%s_%s', $createDbName, (string)$selectIndex);
        $connection->db($dbName);
    }

}
