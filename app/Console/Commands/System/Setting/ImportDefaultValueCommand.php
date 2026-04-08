<?php

namespace App\Console\Commands\System\Setting;

use App\Models\System\Setting;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('system:setting:import-default-value-command')]
#[Description('Command description')]
class ImportDefaultValueCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (__('settings') as $key => $setting) {
            foreach (__('settings.'.$key.'.options') as $option_key => $option) {
                Setting::create([
                    'group' => $key,
                    'name' => $option['name'],
                    'type' => $option['type'],
                    'value' => $option['value'],
                    'default' => $option['default'],
                    'meta' => $option['meta'],
                    'translate' => $option['translate'],
                ]);
            }
        }
        $this->info('Settings Created Successfully');
    }
}
