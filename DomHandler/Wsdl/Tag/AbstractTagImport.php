<?php

namespace WsdlToPhp\PackageGenerator\DomHandler\Wsdl\Tag;

abstract class AbstractTagImport extends AbstractTag
{
    /**
     * Return the correct location attribute value
     * @return string
     */
    public function getLocationAttribute()
    {
        $location = '';
        if ($this->hasAttribute('location')) {
            $location = $this->getAttribute('location')->getValue();
        } elseif ($this->hasAttribute('schemaLocation')) {
            $location = $this->getAttribute('schemaLocation')->getValue();
        } elseif ($this->hasAttribute('schemalocation')) {
            $location = $this->getAttribute('schemaLocation')->getValue();
        }
        if (!empty($location) && substr($location, 0, 2) === './') {
            $location = substr($location, 2);
        }
        return $location;
    }
}
