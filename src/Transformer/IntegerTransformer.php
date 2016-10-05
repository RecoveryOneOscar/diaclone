<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class IntegerTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        return (int)$this->getPropertyValueFromResource($resource);
    }

    public function untransform(ResourceInterface $resource)
    {
        return $resource->getData();
    }
}