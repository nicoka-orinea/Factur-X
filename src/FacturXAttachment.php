<?php

namespace Tiime\FacturX;

final class FacturXAttachment
{
    public readonly string $filename;

    public function __construct(
        public readonly string $content,
        ?string $filename = null,
        public readonly string $description = '',
    ) {
        if ('' === $content) {
            throw new \Exception('Empty content is not allowed for a PDF attachment.');
        }

        if (!\is_string($filename)) {
            $this->filename = uniqid();
        } else {
            $this->filename = $filename;
        }
    }
}
