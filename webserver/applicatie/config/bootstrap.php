<?php

// Regelt basisvoorzieningen voor iedere applicatie, van tevoren.

declare(strict_types=1);

require_once 'config/db.php';
require_once 'src/utils/fouten_afhandelen.php';

set_error_handler('errorHandler');
set_exception_handler('exceptionHandler');
