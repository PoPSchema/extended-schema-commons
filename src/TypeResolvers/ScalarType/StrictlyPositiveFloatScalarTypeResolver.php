<?php

declare(strict_types=1);

namespace PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType;

use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\TypeResolvers\NonCanonicalTypeNameTypeResolverTrait;
use PoP\ComponentModel\TypeResolvers\ScalarType\FloatScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\AstInterface;
use stdClass;

/**
 * GraphQL Built-in Scalar
 *
 * @see https://spec.graphql.org/draft/#sec-Scalars.Built-in-Scalars
 */
class StrictlyPositiveFloatScalarTypeResolver extends FloatScalarTypeResolver
{
    use NonCanonicalTypeNameTypeResolverTrait;

    public function getTypeName(): string
    {
        return 'StrictlyPositiveFloat';
    }

    public function getTypeDescription(): ?string
    {
        return $this->__('A positive float (> 0).', 'component-model');
    }

    public function coerceValue(
        string|int|float|bool|stdClass $inputValue,
        AstInterface $astNode,
        ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore,
    ): string|int|float|bool|object|null {
        $castInputValue = parent::coerceValue(
            $inputValue,
            $astNode,
            $objectTypeFieldResolutionFeedbackStore,
        );
        if ($castInputValue === null) {
            return null;
        }
        /** @var float $castInputValue */
        if ($castInputValue <= 0) {
            $this->addDefaultError($inputValue, $astNode, $objectTypeFieldResolutionFeedbackStore);
            return null;
        }
        return $castInputValue;
    }
}
