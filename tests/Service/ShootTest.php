<?php
/**
 * Created by PhpStorm.
 * User: Travail
 * Date: 29/03/2019
 * Time: 14:39
 */

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\ShootService;

class ShootTest extends TestCase
{
    private $values;
    private $shootService;

    public function __construct(ShootService $shootService)
    {
        $this->values = array(0, 1, 2);
        $this->shootService = $shootService;
    }

    function testShoot()
    {
        $this->assertTrue(in_array($this->shootService->Shoot(),$this->values));
    }
}