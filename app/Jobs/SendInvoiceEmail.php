<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Log;

class SendInvoiceEmail implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $path;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, $filename)
    {
        $this->user = $user;
        $this->path = $filename;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if(!Storage::disk('public')->exists($this->path)){
            Log::error("pdf not found for user {$this->user->id}");
            return;
        }
        $pdf = Storage::disk('public')->get($this->path);

        Mail::to($this->user->email)->send(new InvoiceMail($this->user, $pdf));

    }
}
