<?php
class Summary{
    
    var $startTime;
    var $time;
    var $totalTest;
    var $passedTest;
    var $timeUnit = 'Sec';
    var $memory;
    var $memoryUnit = 'KB';
    var $memoryUnits = array(
        "BYTE" => 1,
        "KB" => 1024,
        "MB" => 1024*1024
    );
    
    var $highestTime;
    var $highestMemory;
    
    /**
     * Constructor invoked
     */
    public function __construct()
    {
        $this->startTime = $this->getMicroTime();
        $this->memory = memory_get_peak_usage(TRUE);
    }
    
    /**
     * Used to start test
     */
    public function test()
    {
        $this->startTime = $this->getMicroTime();
        $this->memory = memory_get_peak_usage(TRUE);
    }
    
    /**
     * Collect data related memeory and time
     */
    private function collectData()
    {
        $this->time = number_format($this->getMicroTime() - $this->startTime,3,'.','');
        $this->memory = intval((memory_get_peak_usage(TRUE) - $this->memory)/$this->memoryUnits[$this->memoryUnit]);
        if($this->highestMemory < $this->memory) $this->highestMemory = $this->memory;
        if($this->highestTime < $this->time) $this->highestTime = $this->time;
    }
    
    /**
     * Used to print report
     * 
     * @param type $data
     * @param type $report
     */
    public function report($data = array(),$report = FALSE)
    {
        $this->collectData();
        $this->totalTest++;
        $testStatus = FALSE;
        if($data['expect'] === $data['output'])
        {
            $this->passedTest++;
            $testStatus = TRUE;
            echo '<br/>';
        }
        
        if($report || !$testStatus)
        {
            $output = '<table width="500" border="1" cellpadding="1" cellspacing="1">'
                    . '<thead>'
                        . '<tr><th title="'.print_r($data['input'],true).'" colspan="2" style="background:'.($testStatus?'limegreen':'red').';color:yellow;"><span style="float:left">#'.$data['id'].'</span>'.$data['msg'].'</th></tr>'
                    . '</thead>'
                    . '<tbody>'
                        . '<tr><td>Time</td><td>'.$this->time.' ('.$this->timeUnit.')</td></tr>'
                        . '<tr><td>Memory</td><td>'.$this->memory.' ('.$this->memoryUnit.')</td></tr>'
                        . '<tr><td>Expected ('.$data['expect'].')</td><td style="color:'.($testStatus?'black':'red').';">'.$data['output'].'</td></tr>'
                        . '<tr><td>Status </td><td style="color:'.($testStatus?'black':'red').';">'.($testStatus?'Passed':'Failed').'</td></tr>'
                    . '</tbody>'
                    . '</table>';
            echo $output;
        }
    }
    
    /**
     * Get current time
     * 
     * @param type $float
     * @return type
     */
    private function getMicroTime($float = TRUE)
    {
        return number_format(microtime($float),3,'.','');
    }
    
    /**
     * Used to print final summary
     */
    public function __destruct()
    {
        $progress = number_format($this->passedTest*100/$this->totalTest,2);
        $output = '<table width="500" border="1" cellpadding="1" cellspacing="1">'
                . '<thead>'
                    . '<tr><th colspan="2" style="background:coral;color:white;">Summary</th></tr>'
                . '</thead>'
                . '<tbody>'
                    . '<tr><td>Time(H)</td><td>'.$this->highestTime.' ('.$this->timeUnit.')</td></tr>'
                    . '<tr><td>Memory(H)</td><td>'.$this->highestMemory.' ('.$this->memoryUnit.')</td></tr>'
                    . '<tr><td>Test Passed ('.$this->passedTest.'/'.$this->totalTest.') </td><td><div style="text-align:center;width:'.$progress.'%;background:limegreen;color:white;">'.$progress.'%</div></td></tr>'
                    . '<tr><td>Status</td><td>'.($this->passedTest == $this->totalTest ?'Success':'Failed').'</td></tr>'
                . '</tbody>'
                . '</table>';
        echo $output;
    }
}