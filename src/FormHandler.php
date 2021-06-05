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

use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\NativeSessionTokenStorage;
use Symfony\Component\Validator\Validation;

/**
 * Add the form handler.
 */
class FormHandler implements FormHandlerInterface
{
    /** @var \Symfony\Component\Form\FormFactoryInterface The form factory. */
    private $formFactory;

    /**
     * Construct a new form handler.
     *
     * @return void Returns nothing.
     */
    public function __construct()
    {
        $validator = Validation::createValidator();
        $csrfGenerator = new UriSafeTokenGenerator();
        $csrfStorage = new NativeSessionTokenStorage();
        $csrfManager = new CsrfTokenManager($csrfGenerator, $csrfStorage);
        $this->formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new HttpFoundationExtension())
            ->addExtension(new CsrfExtension($csrfManager))
            ->addExtension(new ValidatorExtension($validator))
            ->getFormFactory();
    }

    /**
     * Get the form handler.
     *
     * @return \Symfony\Component\Form\FormFactoryInterface The form factory.
     */
    public function getFactory(): FormFactoryInterface
    {
        return $this->formFactory;
    }
}
