<?php

return [
    /*
    |--------------------------------------------------------------------------
    | OpenAI configuration
    |--------------------------------------------------------------------------
    |
    | Default model to use for OpenAI API calls. Set via environment variable
    | OPENAI_DEFAULT_MODEL. Update this to change the model globally.
    |
    */

    'default_model' => env('OPENAI_DEFAULT_MODEL', 'gpt-5-mini'),
];
