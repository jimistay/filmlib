<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiRecommendationService
{
    public function generateRecommendations(array $watchedItems): array
    {
        $prompt = <<<PROMPT
Tu es un moteur de recommandation de films et séries.

Analyse l’historique noté ci-dessous et propose exactement 5 recommandations personnalisées.

Règles :
- Ne recommande aucun contenu déjà vu
- Privilégie les contenus cohérents avec les goûts de l’utilisateur
- Retourne uniquement du JSON valide
- Le JSON doit respecter exactement cette structure :

{
  "recommendations": [
    {
      "title": "Nom du contenu",
      "media_type": "movie" ou "tv",
      "reason": "Pourquoi ce contenu est recommandé"
    }
  ]
}

Historique utilisateur :
PROMPT;

        $payloadText = $prompt . "\n" . json_encode($watchedItems, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $model = config('services.gemini.model');
        $apiKey = config('services.gemini.api_key');

        $response = Http::withoutVerifying()
    ->acceptJson()
    ->withHeaders([
        'x-goog-api-key' => $apiKey,
    ])
    ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent", [
        'systemInstruction' => [
            'parts' => [
                [
                    'text' => 'Tu réponds uniquement avec un JSON valide, sans markdown, sans texte avant ou après.',
                ],
            ],
        ],
        'contents' => [
            [
                'parts' => [
                    [
                        'text' => $payloadText,
                    ],
                ],
            ],
        ],
        'generationConfig' => [
            'temperature' => 0.8,
            'responseMimeType' => 'application/json',
        ],
    ]);

        if ($response->failed()) {
            throw new \RuntimeException('Erreur Gemini : ' . $response->body());
        }

        $text = data_get($response->json(), 'candidates.0.content.parts.0.text');

        if (!$text) {
            return [];
        }

        $decoded = json_decode($text, true);

        if (!is_array($decoded) || !isset($decoded['recommendations']) || !is_array($decoded['recommendations'])) {
            return [];
        }

        return collect($decoded['recommendations'])
            ->filter(function ($item) {
                return isset($item['title'], $item['media_type'], $item['reason'])
                    && in_array($item['media_type'], ['movie', 'tv'], true);
            })
            ->values()
            ->toArray();
    }
}