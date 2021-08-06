<?php declare(strict_types=1);

namespace App\Console\Command;

use Swlib\Http\ContentType;
use Swlib\Saber;
use Swoft\Console\Annotation\Mapping\Command;
use Swoft\Console\Annotation\Mapping\CommandMapping;
use Swoft\Console\Exception\ConsoleErrorException;
use Swoft\Console\Helper\Show;
use Swoft\Http\Server\Router\Route;
use function input;
use function output;
use function sprintf;

/**
 * Class SrmCommand
 *
 * @Command(name="srm",coroutine=true,desc="我不知道")
 */
class SrmCommand
{
    /**
     * @CommandMapping(name="test")
     */
    public function test()
    {
        $saber = Saber::create([
            'base_uri' => 'http://www.163.com',
            'headers' => [
                'Accept-Language' => 'en,zh-CN;q=0.9,zh;q=0.8',
            ]
        ]);
        $content = $saber->get('/get');
        output()->writeln('执行结果:' . $content);
    }
}
