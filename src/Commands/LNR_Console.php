<?php

namespace Heymowski\LatestNewsReader\Commands;

use Exception;
use Illuminate\Console\Command;
use Heymowski\LatestNewsReader\Reader;
use Heymowski\LatestNewsReader\Models\NewsSource;

class LNR_Console extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'LNRC';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Last News Reader - Console';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Hello
        $this->info('Hello, wellcome to the Last News Reader Console.');
        $this->info('-------------------------------------------------');
        $this->info('From here you can:');
        $this->info(' - Add a new NewsSource pressing (n)');
        $this->info(' - Edit a new NewsSource pressing (e)');
        $this->info(' - Remove a new NewsSource pressing (r)');
        $this->info(' - List all NewsSources pressing (l)');
        $this->info(' - At last but not least, you can process all items from the NewsSources pressing (p)');        

        // Ask
        $action2do = $this->ask('What would you do now?');

        switch ($action2do) {
        	case 'n':
        		$this->call('LNR-Sources:AddNewsSource');
        		break;

        	case 'e':
        		$this->call('LNR-Sources:EditNewsSource');
        		break;

        	case 'r':
        		$this->call('LNR-Sources:RemoveNewsSource');
        		break;

        	case 'l':
        		$this->call('LNR-Sources:GetNewsSource');
        		break;

        	case 'p':
        		$this->call('LNR-Items:ReadAll');
        		break;
        	
        	default:
        		exit;
        		break;
        }
    }
}
