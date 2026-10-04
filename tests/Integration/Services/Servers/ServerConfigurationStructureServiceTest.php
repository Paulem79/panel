<?php

namespace App\Tests\Integration\Services\Servers;

use App\Services\Servers\ServerConfigurationStructureService;
use App\Tests\Integration\IntegrationTestCase;

class ServerConfigurationStructureServiceTest extends IntegrationTestCase
{
    public function test_gpu_is_null_when_not_configured(): void
    {
        $server = $this->createServerModel();

        $data = app(ServerConfigurationStructureService::class)->handle($server);

        $this->assertArrayHasKey('gpu', $data['build']);
        $this->assertNull($data['build']['gpu']);
    }

    public function test_gpu_devices_are_sent_as_a_list(): void
    {
        $server = $this->createServerModel(['gpu_driver' => 'dri', 'gpu_devices' => 'renderD129,card1']);

        $data = app(ServerConfigurationStructureService::class)->handle($server);

        $this->assertSame(['driver' => 'dri', 'devices' => ['renderD129', 'card1']], $data['build']['gpu']);
    }

    public function test_empty_devices_means_all_gpus(): void
    {
        $server = $this->createServerModel(['gpu_driver' => 'nvidia', 'gpu_devices' => null]);

        $data = app(ServerConfigurationStructureService::class)->handle($server);

        $this->assertSame(['driver' => 'nvidia', 'devices' => []], $data['build']['gpu']);
    }
}
