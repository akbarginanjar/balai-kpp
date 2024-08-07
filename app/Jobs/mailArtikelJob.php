<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Models\Tb_subscribe;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailComment;
use App\Mail\MailArtikel;

class mailArtikelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $subscribe = Tb_subscribe::all();
        foreach($subscribe as $item) {
             Mail::to($item->email)->send(new MailArtikel($this->$details));
        };
    }
}
