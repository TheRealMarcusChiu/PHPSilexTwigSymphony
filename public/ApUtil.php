<?php

//use api\Silex\Provider\SchemaServiceProvider;
//use Shopatron\Configuration\ClientConfiguration;
//use Shopatron\Configuration\OAuthConfig;
//use Shopatron\Util\ServerUtil;
//use api\Silex\Provider\AuthorizationServiceProvider;
//use api\Silex\Serializer\JsonToStdClassHandler;
//use api\Silex\Serializer\JsonDeserializationVisitor;
//use api\Silex\Security\OAuth2ServiceProvider;
//use JDesrosiers\Silex\Provider\ContentNegotiationServiceProvider;
//use JDesrosiers\Silex\Provider\JmsSerializerServiceProvider;
//use JMS\Serializer\Handler\HandlerRegistry;
//use JMS\Serializer\JsonSerializationVisitor;
//use Silex\Application;
//use Silex\Provider\MonologServiceProvider;
//use Silex\Provider\SecurityServiceProvider;
//use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
//use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
//use Symfony\Component\HttpFoundation\HeaderBag;
//
//class APIUtil
//{
//
//    public static function setup_silex_app()
//    {
//        global $log_dir;
//        global $log_file_name;
//        global $log_level_root;
//        global $oauth_url, $oauth_configs;
//        global $resource_server_client_id, $resource_server_client_secret;
//        global $app;
//        global $vendor_path, $temp_path, $root_path;
//
//        $app = new Application();
//        $app['debug'] = !EnvironmentUtil::isProduction();
//
//        // register all these services so we can use them
//        $app->register(new ContentNegotiationServiceProvider(), array(
//            "conneg.responseFormats" => array("json"),
//            "conneg.requestFormats" => array("json"),
//            "conneg.defaultFormat" => "json",
//        ));
//
//        $jmsConfigs = array();
//        $jmsConfigs["serializer.srcDir"] = $vendor_path . "/jms/serializer/src";
//
//        if (!EnvironmentUtil::isDevelopment()) {
//            $jmsConfigs["serializer.cacheDir"] = $temp_path . "/serializerCache";
//        }
//
//        $app->register(new JmsSerializerServiceProvider(), $jmsConfigs);
//
//        $app["serializer.builder"]->configureHandlers(function (HandlerRegistry $registry) {
//            $registry->registerSubscribingHandler(new JsonToStdClassHandler());
//        });
//
//        // add json deserializer visitor that returns an assoc array
//        $app["serializer.builder"]->setDeserializationVisitor('json',
//            new JsonDeserializationVisitor(new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy()),
//                true));
//
//        $app["serializer.builder"]->setSerializationVisitor('json',
//            new JsonSerializationVisitor(new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy())));
//
//        $app->register(new AuthorizationServiceProvider(), array(
//            'security.firewalls' => array(
//                'schema' => array(
//                    'pattern' => '/schema',
//                    'security' => false,
//                ),
//                'default' => array(
//                    'oauth2' => true,
//                ),
//            ),
//        ));
//
//        //PPA-2542: Little hack to get around the fact that the new version of silex is failing
//        // with a validation error when we send it "WARN" instead of "WARNING"...
//        $monolog_level = $log_level_root;
//        if ($monolog_level === LoggerDefines::LEVEL_WARN) {
//            $monolog_level = "WARNING";
//        }
//
//        $app->register(new MonologServiceProvider(), array(
//            "monolog.logfile" => $log_dir . $log_file_name,
//            "monolog.level" => $monolog_level,
//            "monolog.name" => 'inventory'
//        ));
//
//        //register the oauth 2 provider and set the configs
//        $app->register(new OAuth2ServiceProvider(), array(
//            'security.inventoryconfigs' => array(
//                'oauth_url' => $oauth_url,
//                'oauth_curl_options' => $oauth_configs,
//                'resource_server_client_id' => $resource_server_client_id,
//                'resource_server_client_secret' => $resource_server_client_secret,
//            )
//        ));
//
//        // schema requests do not require OAuth, but all others (default) do require OAuth
//        $app->register(new SecurityServiceProvider(), array(
//            'security.firewalls' => array(
//                'schema' => array(
//                    'pattern' => '/schema/',
//                    'security' => false,
//                ),
//                'default' => array(
//                    'oauth2' => true,
//                ),
//            ),
//        ));
//
//        // Schema - loading schema map & schema store
//        global $schema_cache_on; //SET TO FALSE IN CONFIG FILES TO TURN OFF SCHEMA CACHING
//        $uriArray = explode('/', $_SERVER['REQUEST_URI']);
//        $version = $uriArray[2];
//        $section = $uriArray[3];
//        $schemaUrl = "/api/$version/$section/schema";
//        $api_path = "$root_path/api/$section/$version";
//
//        // Only attempt to load schemas for specified sections
//        if (in_array($section,
//            [SchemaUtil::SECTION_INVENTORY, SchemaUtil::SECTION_WMS, SchemaUtil::SECTION_JOB_QUEUE])) {
//            $schemas = SchemaUtil::create()->getSchemaMap($section, $version, $schemaUrl, $schema_cache_on);
//            $app->register(new SchemaServiceProvider(), array(
//                'schemaStore.schemaUrl' => $schemaUrl,
//                'schemaStore.schemas' => $schemas,
//                'schemaStore.schemaPath' => $api_path,
//                'schemaStore.useCache' => $schema_cache_on,
//            ));
//        }
//
//        return $app;
//    }
//
//}