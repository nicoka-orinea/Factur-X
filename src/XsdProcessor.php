<?php

namespace Tiime\FacturX;

class XsdProcessor
{
    private const XSD_FILENAMES = [
        'minimum'  => 'minimum' . \DIRECTORY_SEPARATOR . 'Factur-X_1.07.3_MINIMUM.xsd',
        'basicwl'  => 'basic-wl' . \DIRECTORY_SEPARATOR . 'Factur-X_1.07.3_BASICWL.xsd',
        'basic'    => 'basic' . \DIRECTORY_SEPARATOR . 'Factur-X_1.07.3_BASIC.xsd',
        'en16931'  => 'en16931' . \DIRECTORY_SEPARATOR . 'Factur-X_1.07.3_EN16931.xsd',
        'extended' => 'extended' . \DIRECTORY_SEPARATOR . 'Factur-X_1.07.3_EXTENDED.xsd',
    ];

    private const XSD_PATH = __DIR__ . \DIRECTORY_SEPARATOR . '..' . \DIRECTORY_SEPARATOR . 'xsd' . \DIRECTORY_SEPARATOR;

    private string $xsdFilePath;

    public function __construct(
        private readonly Profile $profile,
    ) {
        $this->xsdFilePath = self::XSD_PATH . self::XSD_FILENAMES[$this->profile->value];
    }

    /**
     * @throws XsdValidationException
     */
    public function validate(string $xml): bool
    {
        $document = new \DOMDocument();
        $document->loadXML($xml);

        libxml_use_internal_errors(true);

        if (!$document->schemaValidate($this->xsdFilePath)) {
            $xmlErrors = libxml_get_errors();

            libxml_clear_errors();
            libxml_use_internal_errors(false);

            throw new XsdValidationException($xmlErrors);
        }

        return true;
    }
}
