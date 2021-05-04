<?php

declare(strict_types=1);

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bmatovu\LaravelXml\Support;

class XmlElement extends \SimpleXMLElement
{
    /**
     * Provides access to element's children.
     *
     * With chance for default value.
     *
     * @param string $attr    Attribute
     * @param mixed  $default Default Value
     *
     * @return mixed
     */
    public function get($attr, $default = null)
    {
        if (empty($this->{$attr})) {
            return $default;
        }

        return $this->{$attr};
    }
}
