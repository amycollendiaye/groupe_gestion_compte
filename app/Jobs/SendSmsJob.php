<?php

// namespace App\Jobs;

// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Foundation\Bus\Dispatchable;
// use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Queue\SerializesModels;
// use Illuminate\Support\Facades\Log;
// class SendSmsJob implements ShouldQueue --> -->
// {
//     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
//      protected $message;
//      protected $phone;

//     /**
//      * Create a new job instance.
//      */
//     public function __construct($message,$phone)
//     {
//         $this->message=$message;
//         $this->phone=$phone;
//     }

//     /**
//      * Execute the job.
//      */
//     public function handle(): void
//     {
//         Log::info("SMS envoyé à {$this->phone} : {$this->message}");

//     }

// }
// 