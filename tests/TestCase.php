<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    public ?User $superAdmin;

    public ?User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->superAdmin = User::query()->where('email', '=', 'manusiakemos@gmail.com')->firstOrFail();
        $this->admin = User::query()->where('email', '=', 'hafiznugrahaindonesia@gmail.com')->firstOrFail();
        Artisan::call('cache:clear');
        Artisan::call('settings:clear-cache');
    }
}
