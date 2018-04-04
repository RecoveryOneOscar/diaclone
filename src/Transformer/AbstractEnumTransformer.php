<?php
declare(strict_types=1);

namespace Diaclone\Transformer;

use Diaclone\Exception\TransformException;
use Diaclone\Resource\ResourceInterface;
use MabeEnum\Enum;

abstract class AbstractEnumTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        /** @var Enum $enum */
        $enum = $this->getPropertyValueFromResource($resource);

        return $enum ? $enum->getValue() : null;
    }

    public function untransform(ResourceInterface $resource)
    {
        if (!$data = $resource->getData()) {
            return null;
        }

        /** @var Enum $enumClass */
        $enumClass = $this->getEnumClass();
        if (!$enumClass::has($data)) {
            throw new TransformException(sprintf('"%s" is not a valid value in the enum %s', $data, $enumClass));
        }

        return $enumClass::byValue($data);
    }

    public function allowTransform(ResourceInterface $resource): bool
    {
        return $this->getPropertyValueFromResource($resource) ? true : false;
    }
    
    public function allowUntransform(ResourceInterface $resource): bool
    {
        return $resource->getData() ? true : false;
    }

    abstract public function getEnumClass(): string;
}
