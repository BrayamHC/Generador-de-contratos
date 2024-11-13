<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    protected $connection;
    protected $channel;

    public function __construct()
    {
        // Establecer conexión con RabbitMQ
        $this->connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST', '127.0.0.1'), 
            env('RABBITMQ_PORT', 5672),
            env('RABBITMQ_USERNAME', 'user'),
            env('RABBITMQ_PASSWORD', 'password'),
            env('RABBITMQ_VHOST', '/')
        );
        
        // Crear un canal
        $this->channel = $this->connection->channel();
    }

    public function sendMessage($exchange, $messageData, $routingKey = '')
    {
        // Asegúrate de que el exchange esté declarado
        $this->channel->exchange_declare($exchange, 'direct', false, true, false);

        // Crear el mensaje
        $msg = new AMQPMessage(
            json_encode($messageData),
            ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT] // Asegura que el mensaje persista
        );

        // Enviar el mensaje al exchange
        $this->channel->basic_publish($msg, $exchange, $routingKey);
    }

    // Cerrar la conexión y canal
    public function close()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
