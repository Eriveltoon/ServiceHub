<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Models\Ticket;
use Illuminate\Support\Facades\Storage;

class ProcessTicketJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Ticket $ticket
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (!$this->ticket->attachment_path) {
            return;
        }

        $content = Storage::get($this->ticket->attachment_path);

        $data = json_decode($content, true);

        // fallback se não for JSON
        if (json_last_error() !== JSON_ERROR_NONE) {
            $data = [
                'raw' => $content
            ];
        }

        $this->ticket->detail()->create([
            'technical_data' => $data
        ]);
    }
}
