<?php

namespace App\Console\Commands;

use App\Models\VotingCount;
use App\Models\SuggestProduct;
use Illuminate\Console\Command;
use App\Models\SuggestProductRecord;

class GenerateMonthlySuggestProductReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-monthly-suggest-product-reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer suggest product voted data into its record table monthly';

    /**
     * Execute the console command.
     */
    public function handle()
{
    // Reset all voting counts for all users
    VotingCount::query()->update([
        'max_vote_count' => 5,
        'remaining_vote_count' => 5,
        'suggest_count' => 1,
    ]);

    // Fetch top 10 suggest products with the highest vote count
    $suggestedProducts = SuggestProduct::orderBy('total_vote_count', 'desc')
        ->limit(10)
        ->get();

    foreach ($suggestedProducts as $suggestProduct) {
        SuggestProductRecord::create([
            'username' => $suggestProduct->user->username ?? 'Unknown', // Get username or set a default
            'verified_by' => $suggestProduct->admin->username ?? 'test', // Admin username if verified
            'suggest_name' => $suggestProduct->suggest_name,
            'suggest_description' => $suggestProduct->suggest_description,
            'suggest_image' => $suggestProduct->suggest_image,
            'total_vote_count' => $suggestProduct->total_vote_count,
            'transfer_date' => now(), // Current date for transfer
        ]);
    }


    $this->info('Top 10 monthly suggest product report generated successfully.');
}
}
