<?php

namespace App\Console\Commands;

use App\Models\Suggestion;
use Arr;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SyncProductionDataCommand extends Command
{
    protected $signature = 'sync:production-data';

    protected $description = 'Synchronize data from the production database to the local database';

    public function handle(): void
    {
        // Fetch data from the production database
        $productionData = Suggestion::on('production_mysql')->get();

        // Update the local database
        foreach ($productionData as $data) {
            Suggestion::updateOrInsert(
                ['id' => $data->id], // Assuming 'id' is the primary key
                array_merge($data->toArray(), [
                    'created_at' => Carbon::parse($data->created_at)->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::parse($data->updated_at)->format('Y-m-d H:i:s'),
                    'tags' => json_encode($data->tags),
                ])
            );
        }

        $this->info('Data synchronization complete.');
    }
}
