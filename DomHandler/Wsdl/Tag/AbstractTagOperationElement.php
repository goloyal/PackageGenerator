<?php

namespace WsdlToPhp\PackageGenerator\DomHandler\Wsdl\Tag;

use WsdlToPhp\PackageGenerator\DomHandler\Wsdl\Wsdl as WsdlDocument;

abstract class AbstractTagOperationElement extends AbstractTag
{
    const
        ATTRIBUTE_MESSAGE  = 'message';
    /**
     * @return TagOperation|null
     */
    public function getParentOperation()
    {
        return $this->getStrictParent(WsdlDocument::TAG_OPERATION);
    }
    /**
     * @return bool
     */
    public function hasAttributeMessage()
    {
        return $this->hasAttribute(self::ATTRIBUTE_MESSAGE);
    }
    /**
     * @return string
     */
    public function getAttributeMessage()
    {
        return $this->hasAttributeMessage() === true ? $this->getAttribute(self::ATTRIBUTE_MESSAGE)->getValue() : '';
    }
    /**
     * @return string
     */
    public function getAttributeMessageNamespace()
    {
        return $this->hasAttribute(self::ATTRIBUTE_MESSAGE) === true ? $this->getAttribute(self::ATTRIBUTE_MESSAGE)->getValueNamespace() : '';
    }
    /**
     * @return \WsdlToPhp\PackageGenerator\DomHandler\Wsdl\Tag\TagMessage
     */
    public function getMessage()
    {
        $messageName = $this->getAttributeMessage();
        if (!empty($messageName)) {
            return $this->getDomDocumentHandler()->getElementByNameAndAttributes('message', array(
                'name' => $messageName,
            ));
        }
        return null;
    }
    /**
     * @return null|array[\WsdlToPhp\PackageGenerator\DomHandler\Wsdl\Tag\TagPart]
     */
    public function getParts()
    {
        $message = $this->getMessage();
        if ($message !== null) {
            return $message->getChildrenByName(WsdlDocument::TAG_PART);
        }
        return null;
    }
    /**
     * @return null|\WsdlToPhp\PackageGenerator\DomHandler\Wsdl\Tag\TagPart
     */
    public function getPart($partName)
    {
        $message = $this->getMessage();
        if ($message !== null && !empty($partName)) {
            return $message->getPart($partName);
        }
        return null;
    }
}
