<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;

$app = new Application();
$app['debug'] = true;

/**
 * This before middleware validates whether the application will be able to respond in a format that the client
 * understands.
 *
 * @param Request $request
 * @throws NotAcceptableHttpException
 */
function setRequestFormat(Request $request)
{
    global $app;

    // If there is no Accept header, do nothing
    if (!$request->headers->get("Accept")) {
        return;
    }

    // Check the Accept header for acceptable formats
    $contentTypes = $request->getAcceptableContentTypes();
    foreach ($contentTypes as $contentType) {
        // If any format is acceptable, do nothing
        if ($contentType === "*/*") {
            return;
        }

        $format = $request->getFormat($contentType);
        $app_conneg_responseFormats = $app["conneg.responseFormats"];
        if (in_array($format, $app_conneg_responseFormats)) {
            // An acceptable format was found.  Set it as the requestFormat where it can be referenced later.
            $request->setRequestFormat($format);
            return;
        }
    }

    // No acceptable formats were found
    throw new NotAcceptableHttpException();
}
$app->before("setRequestFormat", Application::EARLY_EVENT);

$app->run();