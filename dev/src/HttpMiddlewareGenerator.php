<?php

namespace OUTRAGEdns\PdnsProxy\Dev;

use Brick\VarExporter\VarExporter;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\PsrPrinter;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as ServerRequest;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class HttpMiddlewareGenerator
{
    private $schema;

    private $namespaceName = 'OUTRAGEdns\PdnsProxy\Http';
    private $middlewareName = 'ApiMiddlewareAbstract';

    /**
     *  Constructor
     */
    public function __construct(array $schema)
    {
        $this->schema = $schema;
    }

    /**
     *  Build
     */
    public function build(): void
    {
        // build code
        $namespace = $this->generateNamespace();
        $class = $this->generateClass($namespace);

        // update file
        $body = '<?php' . PHP_EOL . PHP_EOL;
        $body .= (new PsrPrinter())->printNamespace($namespace);

        file_put_contents('src/Http/' . $this->middlewareName . '.php', $body);
    }

    /**
     *  Generate namespace
     */
    private function generateNamespace(): PhpNamespace
    {
        return new PhpNamespace($this->namespaceName);
    }

    /**
     *  Generate class
     */
    private function generateClass(PhpNamespace $namespace): ClassType
    {
        $class = $namespace->addClass($this->middlewareName);
        $class->setAbstract();

        // create route getter
        $method = $class->addMethod('getRoutes');
        $method->setProtected();
        $method->setFinal();
        $method->addComment('Retrieve a list of available routes - automatically generated, do not change');
        $method->setReturnType('array');
        $method->setBody('return ' . VarExporter::export($this->generateRoutes()) . ';');

        return $class;
    }

    /**
     *  Generate routes
     */
    public function generateRoutes(): array
    {
        $routes = [];
        $matchPattern = '[A-Za-z0-9\-\_\.\@]*?';

        foreach ($this->schema['paths'] as $path => $route) {
            $apiPath = $this->schema['basePath'] . $path;
            $routePath = '@^' . preg_replace('/\{(.*?)\}/', '(?<$1>' . $matchPattern . ')', $apiPath) . '/?$@';

            foreach ($route as $key => &$method) {
                if ($key === 'parameters') {
                    foreach ($method as &$parameter) {
                        unset($parameter['description']);
                        unset($parameter['summary']);
                    }
                } else {
                    unset($method['description']);
                    unset($method['responses']);
                    unset($method['summary']);

                    if (!empty($method['parameters'])) {
                        foreach ($method['parameters'] as &$parameter) {
                            unset($parameter['description']);
                            unset($parameter['summary']);
                        }
                    }
                }

                $method['apiPath'] = $apiPath;
                $method['routePath'] = $routePath;
            }

            $routes[$routePath] = $route;
        }

        return $routes;
    }
}
