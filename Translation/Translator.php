<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sensio\Bundle\FrameworkExtraBundle\Translation;

use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Translation\TranslatorBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @author Abdellatif Ait boudad <a.aitboudad@gmail.com>
 */
class Translator implements TranslatorInterface, TranslatorBagInterface
{
    /**
     * @var TranslatorInterface|TranslatorBagInterface
     */
    private $translator;

    /**
     * @var RequestStack
     */
    private $requestStack;

    public function __construct(TranslatorInterface $translator, RequestStack $requestStack)
    {
        if (!$translator instanceof TranslatorBagInterface) {
            throw new \InvalidArgumentException(sprintf('The Translator "%s" must implement TranslatorInterface and TranslatorBagInterface.', get_class($translator)));
        }

        $this->translator = $translator;
        $this->requestStack = $requestStack;
    }

    /**
     * {@inheritdoc}
     */
    public function trans($id, array $parameters = array(), $domain = null, $locale = null)
    {
        if (null === $domain) {
            $domain = $this->getDefaultDomain();
        }

        return $this->translator->trans($id, $parameters, $domain, $locale);
    }

    /**
     * {@inheritdoc}
     */
    public function transChoice($id, $number, array $parameters = array(), $domain = null, $locale = null)
    {
        if (null === $domain) {
            $domain = $this->getDefaultDomain();
        }

        return $this->translator->transChoice($id, $number, $parameters, $domain, $locale);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function setLocale($locale)
    {
        $this->translator->setLocale($locale);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function getLocale()
    {
        return $this->translator->getLocale();
    }

    /**
     * {@inheritdoc}
     */
    public function getCatalogue($locale = null)
    {
        return $this->translator->getCatalogue($locale);
    }

    /**
     * Passes through all unknown calls onto the translator object.
     */
    public function __call($method, $args)
    {
        return call_user_func_array(array($this->translator, $method), $args);
    }

    private function getDefaultDomain()
    {
        if (!$request = $this->requestStack->getCurrentRequest()) {
            return;
        }

        return $request->attributes->get('_translation_domain', null);
    }
}
