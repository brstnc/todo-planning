<?php

namespace App\Console\Commands;

use App\Models\TaskCard;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class TaskCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Task Datas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new Client();

        // Get Business Task Datas
        $businessUrl = 'http://www.mocky.io/v2/5d47f235330000623fa3ebf7';
        $response = $client->get($businessUrl);
        $businessName = 'Business Task ';
        $clientBusinessTasks = json_decode($response->getBody(), true);
        foreach ($clientBusinessTasks as $key => $clientBusinessTask) {
            // Update or Create
            $businessTask = TaskCard::where('name', $businessName . $key)->first();
            if (!isset($businessTask)) {
                $businessTask = new TaskCard();
                $businessTask->name = $businessName . $key;
            }
            $businessTask->task_id = 1;
            $businessTask->level = $clientBusinessTask[$businessName . $key]['level'];
            $businessTask->time = $clientBusinessTask[$businessName . $key]['estimated_duration'];
            $businessTask->save();
        }
        // Deleting data by checking
        $businessTasks = TaskCard::where('task_id', 1)->get();
        foreach ($businessTasks as $businessTask) {
            $valueControl = false;
            foreach ($clientBusinessTasks as $clientBusinessTask) {
                if (isset($clientBusinessTask[$businessTask->name])) {
                    $valueControl = true;
                }
            }
            if (!$valueControl) {
                $businessTask->delete();
            }
        }

        // Get It Task Datas
        $itUrl = 'http://www.mocky.io/v2/5d47f24c330000623fa3ebfa';
        $response = $client->get($itUrl);
        $clientItTasks = json_decode($response->getBody(), true);
        foreach ($clientItTasks as $clientItTask) {
            // Update or Create
            $ItTask = TaskCard::where('name', $clientItTask['id'])->first();
            if (!isset($ItTask)) {
                $ItTask = new TaskCard();
                $ItTask->name = $clientItTask['id'];
            }
            $ItTask->task_id = 2;
            $ItTask->level = $clientItTask['zorluk'];
            $ItTask->time = $clientItTask['sure'];
            $ItTask->save();
        }

        // Deleting data by checking
        $ItTasks = TaskCard::where('task_id', 2)->get();
        foreach ($ItTasks as $ItTask) {
            $valueControl = false;
            foreach ($clientItTasks as $clientItTask) {
                if ($clientItTask['id'] == $ItTask->name) {
                    $valueControl = true;
                }
            }
            if (!$valueControl) {
                $ItTask->delete();
            }
        }
    }
}
