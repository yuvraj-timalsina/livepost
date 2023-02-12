<?php

    namespace App\Websockets\SocketHandler;

    use BeyondCode\LaravelWebSockets\Apps\App;
    use BeyondCode\LaravelWebSockets\QueryParameters;
    use BeyondCode\LaravelWebSockets\WebSockets\Exceptions\UnknownAppKey;
    use Ratchet\ConnectionInterface;
    use Ratchet\WebSocket\MessageComponentInterface;

    abstract class BaseSocketHandler implements MessageComponentInterface
    {
        /**
         * @param \Ratchet\ConnectionInterface $conn
         *
         * @return void
         * @throws \Exception
         */
        function onOpen(ConnectionInterface $conn)
        {
            dump('on opened');

//        auth logic here

            $this->verifyAppKey($conn)->generateSocketId($conn);
        }

        /**
         * @param \Ratchet\ConnectionInterface $connection
         *
         * @return $this
         * @throws \Exception
         */
        protected function generateSocketId(ConnectionInterface $connection)
        {
            $socketId = sprintf('%d.%d', random_int(1, 1000000000), random_int(1, 1000000000));

            $connection->socketId = $socketId;

            return $this;
        }

        /**
         * @param \Ratchet\ConnectionInterface $connection
         *
         * @return $this
         */
        protected function verifyAppKey(ConnectionInterface $connection)
        {
            $appKey = QueryParameters::create($connection->httpRequest)->get('appKey');

            if (!$app = App::findByKey($appKey)) {
                throw new UnknownAppKey($appKey);
            }

            $connection->app = $app;

            return $this;
        }

        /**
         * @param \Ratchet\ConnectionInterface $conn
         *
         * @return void
         */
        function onClose(ConnectionInterface $conn)
        {
            dump('closed');
        }

        /**
         * @param \Ratchet\ConnectionInterface $conn
         * @param \Exception $e
         *
         * @return void
         */
        function onError(ConnectionInterface $conn, \Exception $e)
        {
            dump($e);
            dump('onerror');
        }
    }
