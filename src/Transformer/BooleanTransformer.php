<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class BooleanTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        $value = $this->getPropertyValueFromResource($resource);

        return (bool)$value;
    }

    public function untransform(ResourceInterface $resource)
    {
        $value = strtolower((string)$resource->getData());

        if (in_array($value, ['yes', 'true', 'on', '1', 1])) {
            return true;
        }

        if (in_array($value, ['no', 'false', 'off', '0', 0])) {
            return false;
        }

        return $value;
        // throw new MalformedInputException($resource->getPropertyName(), 'must be boolean');
    }

    public function getPropertyValue($data, $property)
    {
        if (empty($property)) {
            return $data;
        }

        if (is_array($data)) {
            return $data[$property] ?? null;
        }

        $is = 'is' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $property)));
        if (method_exists($data, $is)) {
            return $data->$is();
        }

        $getter = 'get' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $property)));
        if (method_exists($data, $getter)) {
            return $data->$getter();
        }


        return $data->$property ?? null;
    }
}