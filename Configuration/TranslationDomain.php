<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sensio\Bundle\FrameworkExtraBundle\Configuration;

/**
 * @author Abdellatif Ait boudad <a.aitboudad@gmail.com>
 * @Annotation
 */
class TranslationDomain extends ConfigurationAnnotation
{
    /**
     * The parameter name.
     *
     * @var string
     */
    protected $domain;

    public function getDomain()
    {
        return $this->domain;
    }

    public function setValue($domain)
    {
        $this->setDomain($domain);
    }

    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * Returns the annotation alias name.
     *
     * @return string
     *
     * @see ConfigurationInterface
     */
    public function getAliasName()
    {
        return 'translation_domain';
    }

    /**
     * Only one template directive is allowed.
     *
     * @return bool
     *
     * @see ConfigurationInterface
     */
    public function allowArray()
    {
        return false;
    }
}
