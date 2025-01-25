<?php

namespace App\Console\Commands;

use App\Models\Suggestion;
use Arr;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Str;

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

            // Generate the slug
            $baseSlug = Str::slug($data->title);
            $slug = $baseSlug;
            $count = 1;

            while (Suggestion::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }

            // Merge the slug with the other data
            $mergedData = array_merge($data->toArray(), [
                'slug' => $slug,
                'show_roadmap' => $data->show_roadmap ? $data->show_roadmap : false,
                'is_featured' => $data->is_featured ? $data->is_featured : false,
                'created_at' => Carbon::parse($data->created_at)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::parse($data->updated_at)->format('Y-m-d H:i:s'),
                'tags' => json_encode($data->tags),
            ]);

            Suggestion::updateOrInsert(
                ['id' => $data->id], // Assuming 'id' is the primary key
                $mergedData
            );
        }

        $this->info('Data synchronization complete.');
    }
}
