<?php

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\GravatarModule\Twig\Extension;

/**
 * Gravatar Twig Extension
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class GravatarExtension extends \Twig_Extension
{
    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return [
            'gravatar' => new \Twig_Filter_Method($this, 'gravatarFilter'),
        ];
    }

    /**
     * Gravatar filter, generates url for gravatar image
     *
     * @param string  $email An email address
     * @param integer $size  Pixel size
     *
     * @return string The image string
     */
    public function gravatarFilter($email, $size = null)
    {
        $hash = md5(strtolower(trim($email)));

        if ($size) {
            $size = "?s={$size}";
        }

        $url = "//secure.gravatar.com/avatar/{$hash}{$size}";

        return $url;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'gravatar_extension';
    }
}
