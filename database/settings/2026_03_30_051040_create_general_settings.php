<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'My Website');
        $this->migrator->add('general.site_url', 'http://localhost');
        $this->migrator->add('general.site_email', 'admin@example.com');
        $this->migrator->add('general.site_phone', '0123456789');
        $this->migrator->add('general.site_address', '123 Main St, Anytown, USA');
        $this->migrator->add('general.site_logo', '');
        $this->migrator->add('general.site_favicon', '');
        $this->migrator->add('general.site_description', 'My Website Description');
        $this->migrator->add('general.site_keywords', 'website, blog, news');
        $this->migrator->add('general.site_author', 'Admin');
        $this->migrator->add('general.site_copyright', '© 2026 My Website');
        $this->migrator->add('general.site_currency', 'USD');
        $this->migrator->add('general.site_timezone', 'UTC');
        $this->migrator->add('general.site_language', 'en');
    }
};
