<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Service;
use App\Models\News;
use Illuminate\Support\Str;

class UpdateSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cập nhật slug cho các bản ghi services và news chưa có slug';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Cập nhật slug cho services...');
        Service::whereNull('slug')->orWhere('slug', '')->get()->each(function($service) {
            $slug = Str::slug($service->name);
            $i = 1;
            $base = $slug;
            while (Service::where('slug', $slug)->where('id', '!=', $service->id)->exists()) {
                $slug = $base.'-'.$i++;
            }
            $service->slug = $slug;
            $service->save();
            $this->line("Service #{$service->id}: $slug");
        });
        $this->info('Cập nhật slug cho news...');
        News::whereNull('slug')->orWhere('slug', '')->get()->each(function($news) {
            $slug = Str::slug($news->title);
            $i = 1;
            $base = $slug;
            while (News::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
                $slug = $base.'-'.$i++;
            }
            $news->slug = $slug;
            $news->save();
            $this->line("News #{$news->id}: $slug");
        });
        $this->info('Hoàn thành cập nhật slug!');
    }
}
