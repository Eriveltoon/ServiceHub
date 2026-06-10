<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Models\Ticket;
use Illuminate\Support\Facades\Storage;
use App\Notifications\TicketProcessedNotification;

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

        if (json_last_error() !== JSON_ERROR_NONE) {
            $data = [
                'raw' => $content
            ];
        }

        if ($this->ticket->detail) {
            $this->ticket->detail->update([
                'technical_data' => $data
            ]);

        } else {
            $this->ticket->detail()->create([
                'technical_data' => $data
            ]);

        }

        $this->ticket->refresh();

        $this->ticket->user->notify(
            new TicketProcessedNotification($this->ticket)
        );
    }
}
