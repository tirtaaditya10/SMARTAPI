<?php

namespace App\Database;

use Illuminate\Support\Str;
use Illuminate\Database\Connectors\SqlServerConnector as LaravelSqlServerConnector;

class SqlServerConnector extends LaravelSqlServerConnector
{
    /**
 *      * Establish a database connection.
 *           *
 *                * @param  array  $config
 *                     * @return \PDO
 *                          */
    public function connect(array $config)
    {
        if (! isset($config['dsn'])) {
            return parent::connect($config);
        }

        $options = $this->getOptions($config);

        [$dsn, $uid, $pwd] = $this->parseDsnForPdoArguments($config['dsn']);
        $config['username'] = $uid;
        $config['password'] = $pwd;

        return $this->createConnection($dsn, $config, $options);
    }

    protected function parseDsnForPdoArguments($dsn)
    {
        $parts = collect(explode(';', trim($dsn, ';')))->mapWithKeys(function ($pair) {
            [$key, $value] = explode('=', $pair);
            return [strtolower(trim($key)) => "$key=$value"];
        });

        $dsn = $parts->except('uid', 'pwd')->implode(';');

        return [
            strpos($dsn, 'sqlsrv:') === 0 ? $dsn : "sqlsrv:$dsn",
            preg_replace('/^uid=/i', '', $parts->get('uid')),
            preg_replace('/^pwd=/i', '', $parts->get('pwd')),
        ];
    }
}

