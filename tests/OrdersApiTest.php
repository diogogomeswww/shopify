<?php

namespace Dan\Shopify\Test;

use Dan\Shopify\Helpers\Testing\ModelFactory\OrderFactory;
use Dan\Shopify\Helpers\Testing\TransactionMock;
use PHPUnit\Framework\TestCase;

class OrdersApiTest extends TestCase
{
    /**
     * GET /admin/orders.json
     * Retrieves a list of products.
     *
     * @test
     * @throws \Dan\Shopify\Exceptions\InvalidOrMissingEndpointException
     * @throws \ReflectionException
     */
    public function it_gets_a_list_of_orders()
    {
        $api = \Dan\Shopify\Shopify::fake([
            TransactionMock::create(OrderFactory::create(2))
        ]);

        $response = $api->orders->get();

        $this->assertEquals(200, $api->lastResponseStatusCode());
        $this->assertTrue(is_array($response));
        $this->assertEquals('GET', $api->lastRequestMethod());
        $this->assertEquals('/admin/orders.json', $api->lastRequestUri());
        $this->assertCount(2, $response);
    }

}