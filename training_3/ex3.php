<?php

class PriceCalculator
{
    private $session;
    private $prices = array(
        '4711' => 990,
    );

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function getPriceForSku($sku)
    {
        $price = $this->prices[$sku];

        if ($this->session->getUsername() != '') {
            $price = 0.9 * $price;
        }

        return $price;
    }
}

class PriceFormatter
{
    public function formatPrice($price)
    {
        return number_format(round(($price / 100), 2), 2) . ' CHF';
    }
}

abstract class AbstractHttpRequest
{
    private $uri;

    public function __construct(array $getData, $uri)
    {
        $this->uri = new Uri($uri);
    }

    public function hasParameter($name)
    {
    }

    public function getParameter($name)
    {
    }

    public function getUri()
    {
        return $this->uri;
    }
}

class Session
{
    private $username;

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }
}

class HttpGetRequest extends AbstractHttpRequest
{
}

class HttpPostRequest extends AbstractHttpRequest
{
}

class Uri
{
    private $uri;

    public function __construct($uri)
    {
        $this->uri = $uri;
    }

    public function __toString()
    {
        return $this->uri;
    }
}

class Factory
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function createImpressumPage()
    {
        return new ImpressumPage(new Translator(), $this->session);
    }

    public function createProductPage($sku)
    {
        return new ProductPage($sku, new PriceCalculator($this->session), new PriceFormatter());
    }
}

class Router
{
    private $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function route(AbstractHttpRequest $request)
    {
        if ((string) $request->getUri() == '/impressum') {
            return $this->factory->createImpressumPage();
        }

        if ((string) $request->getUri() == '/echt-koelnisch') {
            return $this->factory->createProductPage(4711); // woher kommt 4711 ???
        }

        return new NotFoundPage();
    }
}

class NotFoundPage
{
    public function render()
    {
        return '404';
    }
}

class Translator
{
    private $map = array(
        'Wednesday' => 'Mittwoch',
    );

    public function translateDayOfWeek($day)
    {
        return $this->map[$day];
    }

    public function getWelcomeText($username = '')
    {
        if ($username == '') {
            return 'Herzlich Willkommen';
        }

        return 'Herzlich Willkommen ' . $username;
        // Arne würde hier über Sicherheitsbedenken schimpfen
    }
}

class ProductPage
{
    private $sku;
    private $priceTable;
    private $priceFormatter;

    public function __construct($sku, PriceCalculator $priceTable, PriceFormatter $formatter)
    {
        $this->sku = $sku;
        $this->priceTable = $priceTable;
        $this->priceFormatter = $formatter;
    }

    public function render()
    {
        $html = file_get_contents(__DIR__ . '/product' . $this->sku . '.html');

        $html = str_replace(
            '%%%PREIS%%%',
            $this->priceFormatter->formatPrice($this->priceTable->getPriceForSku($this->sku)),
            $html
        );

        return $html;
    }
}

class ImpressumPage
{
    private $translator;
    private $session;

    public function __construct(Translator $translator, Session $session)
    {
        $this->translator = $translator;
        $this->session = $session;
    }

    public function render()
    {
        $html = file_get_contents(__DIR__ . '/impressum.html');

        $now = new DateTime();

        $html = str_replace(
            array(
                '%%%WOCHENTAG%%%',
                '%%%WILLKOMMEN%%%',
            ),
            array(
                $this->translator->translateDayOfWeek($now->format('l')),
                $this->translator->getWelcomeText($this->session->getUsername()),
            ),
            $html
        );

        return $html;
    }
}

class Shop
{
    public function __construct($username = '')
    {
        $this->username = $username;
    }

    public function process(AbstractHttpRequest $request)
    {
        $session = new Session();
        $session->setUsername($this->username);

        $factory = new Factory($session);
        // $request = new HttpGetRequest($_GET, $_SERVER['REQUEST_URI']);

        $router = new Router($factory);
        $page = $router->route($request);

        // hier Funktionalität

        print $page->render();
    }
}

$request = new HttpGetRequest($_GET, '/echt-koelnisch');

$shop = new Shop();
$shop->process($request);

$shop = new Shop('Stefan');
$shop->process($request);