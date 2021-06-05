<?php

declare(strict_types=1);
/**
 * The adless and forever free 4 player chess server.
 *
 * @license <https://github.com/4waychess/web-server/blob/master/license>.
 *
 * @link    <https://github.com/4waychess/web-server>.
 */

namespace FourWayChess;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Add the form handler interface.
 */
interface FormHandlerInterface
{
    /**
     * Construct a new form handler.
     *
     * @param \Symfony\Component\HttpFoundation\Session\SessionInterface The session handler.
     *
     * @return void Returns nothing.
     */
    public function __construct(SessionInterface $session);

    /**
     * Get the form handler.
     *
     * @return \Symfony\Component\Form\FormFactoryInterface The form factory.
     */
    public function getFactory(): FormFactoryInterface;
}
