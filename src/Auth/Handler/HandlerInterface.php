<?php

declare(strict_types=1);
/**
 * The adless and forever free 4 player chess server.
 *
 * @license <https://github.com/4waychess/web-server/blob/master/license>.
 *
 * @link    <https://github.com/4waychess/web-server>.
 */

namespace FourWayChess\Auth\Handler;

use Symfony\Component\HttpFoundation\Response;

/**
 * The handler interface.
 */
interface HandlerInterface
{
    public function process(array $data): Response;
}
