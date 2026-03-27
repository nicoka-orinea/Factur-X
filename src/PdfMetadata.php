<?php

namespace Tiime\FacturX;

final class PdfMetadata
{
    public function __construct(
        public readonly ?string $author,
        public readonly ?string $keywords,
        public readonly ?string $title,
        public readonly ?string $subject,
        public readonly ?string $createdDate,
        public readonly ?string $modifiedDate,
    ) {
    }
}
