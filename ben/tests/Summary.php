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
    
    public function __construct()
    {
        $this->startTime = $this->getMicroTime();
        $this->memory = memory_get_peak_usage(TRUE);
    }
    
    private function endProfile()
    {
        $this->time = number_format($this->getMicroTime() - $this->startTime,3,'.','');
        $this->memory = intval((memory_get_peak_usage(TRUE) - $this->memory)/$this->memoryUnits[$this->memoryUnit]);
    }
    
    public function report($data = array(),$report = FALSE)
    {
        $this->endProfile();
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
                        . '<tr><th colspan="2" style="background:red;color:yellow;">'.$data['msg'].'</th></tr>'
                    . '</thead>'
                    . '<tbody>'
                        . '<tr><td>Id</td><td>'.$data['id'].'</td></tr>'
                        . '<tr><td>Time</td><td>'.$this->time.' ('.$this->timeUnit.')</td></tr>'
                        . '<tr><td>Memory</td><td>'.$this->memory.' ('.$this->memoryUnit.')</td></tr>'
                        . '<tr><td>Expected ('.$data['expect'].')</td><td style="color:'.($testStatus?'black':'red').';">'.$data['output'].'</td></tr>'
                        . '<tr><td>Status </td><td style="color:'.($testStatus?'black':'red').';">'.($testStatus?'Passed':'Failed').'</td></tr>'
                    . '</tbody>'
                    . '</table>';
            echo $output;
        }
    }
    
    private function getMicroTime($float = TRUE)
    {
        
        return number_format(microtime($float),3,'.','');
    }
    
    public function __destruct()
    {
        $progress = number_format($this->passedTest*100/$this->totalTest,2);
        $output = '<table width="500" border="1" cellpadding="1" cellspacing="1">'
                . '<thead>'
                    . '<tr><th colspan="2" style="background:coral;color:white;">Summary</th></tr>'
                . '</thead>'
                . '<tbody>'
                    . '<tr><td>Test Passed ('.$this->passedTest.'/'.$this->totalTest.') </td><td><div style="text-align:center;width:'.$progress.'%;background:limegreen;color:white;">'.$progress.'%</div></td></tr>'
                    . '<tr><td>Status</td><td>'.($this->passedTest == $this->totalTest ?'Success':'Failed').'</td></tr>'
                . '</tbody>'
                . '</table>';
        echo $output;
    }
}