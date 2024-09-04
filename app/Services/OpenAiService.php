<?php
namespace App\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

    class OpenAiService {
        private $client;
        private $apiKey;

        public function __construct() {
            $this->client = new Client();
            $this->apiKey = env('OPEN_AI_KEY');
        }

        public function get($prompt) {
            $response = $this->client->post('https://api.openai.com/v1/chat/completions',[
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ],
                    'max_tokens' => 150,
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            return $data['choices'][0]['message']['content'];
        }
    }
?>