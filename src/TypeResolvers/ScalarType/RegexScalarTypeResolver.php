<?php

declare(strict_types=1);

namespace PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType;

use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\TypeResolvers\ScalarType\AbstractScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\AstInterface;
use stdClass;

/**
 * GraphQL Custom Scalar
 *
 * @see https://spec.graphql.org/draft/#sec-Scalars.Custom-Scalars
 */
class RegexScalarTypeResolver extends AbstractScalarTypeResolver
{
    public function getTypeName(): string
    {
        return 'Regex';
    }

    public function getTypeDescription(): ?string
    {
        return $this->__('Regex scalar, such as /([a-zA-Z_][0-9a-zA-Z_]*)/', 'component-model');
    }

    public function coerceValue(
        string|int|float|bool|stdClass $inputValue,
        AstInterface $astNode,
        ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore,
    ): string|int|float|bool|object|null {
        $errorCount = $objectTypeFieldResolutionFeedbackStore->getErrors();
        $this->validateIsString($inputValue, $astNode, $objectTypeFieldResolutionFeedbackStore);
        if ($objectTypeFieldResolutionFeedbackStore->getErrors() > $errorCount) {
            return null;
        }
        /** @var string $inputValue */

        $this->validateFilterVar($inputValue, $astNode, $objectTypeFieldResolutionFeedbackStore, \FILTER_VALIDATE_REGEXP);
        if ($objectTypeFieldResolutionFeedbackStore->getErrors() > $errorCount) {
            return null;
        }

        return $inputValue;
    }
}
