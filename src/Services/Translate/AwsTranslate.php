<?php

declare(strict_types=1);

namespace RpWebDevelopment\LaravelUgcTranslate\Services\Translate;

use Aws\AwsClient;
use Aws\Translate\TranslateClient;
use RpWebDevelopment\LaravelUgcTranslate\Abstracts\Translate;
use RpWebDevelopment\LaravelUgcTranslate\Exceptions\LanguageNotSupportedException;
use RpWebDevelopment\LaravelUgcTranslate\Traits\AWSLanguageCodes;

class AwsTranslate extends Translate
{
    use AWSLanguageCodes;

    protected TranslateClient|AwsClient $translateClient;
    protected array $translateSettings = [];

    public function __construct()
    {
        $this->translateSettings = config('ugc-translate.providers.aws.settings');
        $this->translateClient = TranslateClient::factory([
            'region' => config('ugc-translate.providers.aws.region'),
            'credentials' => [
                'key' => config('ugc-translate.providers.aws.credentials.key'),
                'secret' => config('ugc-translate.providers.aws.credentials.secret'),
            ]
        ]);
    }

    /**
     * @throws LanguageNotSupportedException
     */
    public function translateText(
        string $text = '',
        ?string $sourceLang = null,
        ?string $targetLang = null
    ): string {
        return $this->translateClient
            ->translateText([
                'Settings' => $this->translateSettings,
                'SourceLanguageCode' => $this->formatCode($sourceLang, $this->sourceLanguageCodes),
                'TargetLanguageCode' => $this->formatCode($targetLang, $this->targetLanguageCodes),
                'Text' => $text,
            ])
            ->get('TranslatedText');
    }
}
