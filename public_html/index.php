<?php

use App\Kernel; // VERY IMPORTANT: Add this line!
use Symfony\Component\HttpFoundation\Request; // Add this if you're using Request
use Symfony\Component\ErrorHandler\Debug; // Add this if you're using Debug
use Symfony\Component\Dotenv\Dotenv; // Add this if you're using Dotenv

header('Access-Control-Allow-Origin: https://d84d-105-154-30-164.ngrok-free.app');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};