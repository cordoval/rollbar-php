<?php namespace Rollbar\Payload;

class Body implements \JsonSerializable
{
    /**
     * @var ContentInterface
     */
    private $value;
    private $utilities;

    public function __construct(ContentInterface $value)
    {
        $this->utilities = new \Rollbar\Utilities();
        $this->setValue($value);
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue(ContentInterface $value)
    {
        $this->value = $value;
        return $this;
    }

    public function jsonSerialize()
    {
        $overrideNames = array(
            "value" => $this->value->getKey()
        );
        $obj = get_object_vars($this);
        unset($obj['utilities']);
        return $this->utilities->serializeForRollbar($obj, $overrideNames);
    }
}
