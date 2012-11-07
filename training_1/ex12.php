<?php

// Bootstrap:

$loader = new XmlLoader();
// $renderer = new XmlRenderer();
$renderer = new JsonRenderer();

// Applikation:

$customer = $loader->loadCustomer(23);
print $renderer->render($customer);

class Customer
{
}

class HtmlRenderer
{
}

class JsonRenderer
{
}

class XmlRenderer
{
}

interface LoaderInterface
{
    public function loadCustomer($id);
}

class XmlLoader implements LoaderInterface
{
    public function loadCustomer($id)
    {
        return new Customer($id, ...);
    }
}

class MySqlLoader implements LoaderInterface
{
    public function loadCustomer($id)
}

class NoSqlLoader implements LoaderInterface
{
    public function loadCustomer($id)
}
