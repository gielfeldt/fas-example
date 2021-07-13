<?php

// files required for actual application in order to be fully preloaded

require_once('/app/vendor/laminas/laminas-diactoros/src/ServerRequestFactory.php');
require_once('/app/vendor/laminas/laminas-diactoros/src/ServerRequest.php');
require_once('/app/vendor/laminas/laminas-diactoros/src/Uri.php');
require_once('/app/vendor/laminas/laminas-diactoros/src/PhpInputStream.php');
require_once('/app/vendor/laminas/laminas-diactoros/src/Stream.php');
require_once('/app/vendor/laminas/laminas-diactoros/src/HeaderSecurity.php');
require_once('/app/vendor/laminas/laminas-diactoros/src/ResponseFactory.php');
require_once('/app/vendor/laminas/laminas-diactoros/src/Response.php');
require_once('/app/vendor/laminas/laminas-httphandlerrunner/src/Emitter/SapiEmitter.php');

require_once('/app/vendor/filp/whoops/src/Whoops/Run.php');
require_once('/app/vendor/filp/whoops/src/Whoops/Util/SystemFacade.php');
require_once('/app/vendor/filp/whoops/src/Whoops/Handler/PrettyPageHandler.php');
require_once('/app/vendor/filp/whoops/src/Whoops/Util/TemplateHelper.php');
require_once('/app/vendor/filp/whoops/src/Whoops/Exception/Inspector.php');
require_once('/app/vendor/fas/routing/src/WhoopsMiddleware.php');
