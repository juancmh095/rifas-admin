<?php
    require __DIR__ . '/vendor/autoload.php'; #Cargar todas las dependencias
    use Phroute\Phroute\RouteCollector;
    use Phroute\Phroute\Dispatcher;
    use Phroute\Phroute\Exception\HttpRouteNotFoundException;
    use Phroute\Phroute\Exception\HttpMethodNotAllowedException;

    $collector = new RouteCollector();

    require('./rutas.php');


    $despachador = new Dispatcher($collector->getData());
    echo $rutaCompleta = $_SERVER["REQUEST_URI"];


    echo $metodo = $_SERVER['REQUEST_METHOD'];
    $rutaLimpia = processInput($rutaCompleta);
    $rutaLimpia;
    try {   
        return $despachador->dispatch($metodo, $rutaLimpia); # Mandar sólo el método y la ruta limpia
    } catch (HttpRouteNotFoundException $e) {
        echo $e;
        return "./views/404.php";
    } catch (HttpMethodNotAllowedException $e) {
        echo $e;
        return "./views/404.php";
    }


    /**
     * Gracias a https://www.sitepoint.com/fast-php-routing-phroute/
     */
    function processInput($uri)
    {
        return implode('/',
            array_slice(
                explode('/', $uri), 2));
    }
?>