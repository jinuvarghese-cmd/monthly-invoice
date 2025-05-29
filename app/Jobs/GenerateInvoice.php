<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Jobs\SendInvoiceEmail;
use Illuminate\Bus\Batchable;


class GenerateInvoice implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(): void
    {
        Storage::disk('public')->makeDirectory('invoices');
        $pdf = Pdf::loadView('invoices.template', ['user' => $this->user]);
        $filename = "invoices/{$this->user->id}.pdf";
        Storage::disk('public')->put($filename, $pdf->output());
        SendInvoiceEmail::dispatch($this->user, $filename)->onQueue('emails');
    }
}
