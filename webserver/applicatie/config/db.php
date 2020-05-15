<?php

declare (strict_types = 1);

namespace fletnix\config;

error_reporting(E_ALL);

class Db
{
    public const rdbmsHost = "tcp:rdbms,1433";
    # TODO: use
    public const rdbmsDb = 'master';
    public const rdbmsLogin = 'sa';
    # TODO: (infosec)
    public const rdbmsPassword = 'test-password-0nly';
}
