<?php

namespace DutchCodingCompany\LivewireRecaptcha\Tests;

use DutchCodingCompany\LivewireRecaptcha\LivewireRecaptcha;
use Orchestra\Testbench\TestCase;

class LivewireRecaptchaTest extends TestCase
{
    public function test_it_renders_the_v3_directive_by_default(): void
    {
        config()->set('services.google.recaptcha.site_key', 'test-site-key');

        $html = LivewireRecaptcha::directive();

        $this->assertStringContainsString('grecaptcha.execute("test-site-key"', $html);
        $this->assertStringContainsString('api.js?render=test-site-key', $html);
    }

    public function test_it_renders_the_v2_directive(): void
    {
        config()->set('services.google.recaptcha.site_key', 'test-site-key');

        $html = LivewireRecaptcha::directive(version: 'v2');

        $this->assertStringContainsString('grecaptcha.render', $html);
        $this->assertStringContainsString('api.js?onload=googleRecaptchaOnloadCallback', $html);
    }

    public function test_it_renders_the_v3_enterprise_directive(): void
    {
        config()->set('services.google.recaptcha.site_key', 'test-site-key');

        $html = LivewireRecaptcha::directive(version: 'v3-enterprise');

        $this->assertStringContainsString('grecaptcha.enterprise.execute', $html);
        $this->assertStringContainsString('enterprise.js?render=test-site-key', $html);
    }
}
