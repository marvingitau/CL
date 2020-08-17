<?php

namespace Lib;

class App
{
    protected $printer;

    protected $registry = [];

    public $currISO = [];

    public function __construct()
    {
        $this->printer = new Display();

    }

    public function getPrinter()
    {
        return $this->printer;
    }

    public function registerCommand($name, $callable)
    {
        $this->registry[$name] = $callable;
    }

    public function getCommand($command)
    {
        return isset($this->registry[$command]) ? $this->registry[$command] : null;
    }

    public function runCommand(array $argv = [])
    {
        $command_name = "help";

        if (isset($argv[1])) {
            $command_name = $argv[1];
        }

        $command = $this->getCommand($command_name);
        if ($command === null) {
            $this->getPrinter()->display("ERROR: Command \"$command_name\" not found.");
            exit;
        }

        call_user_func($command, $argv);
    }

    public function getCSV($var)
    {
       

        $filename = $var;

        $hpath=dirname(__FILE__)."/f.csv";

        if (!copy($var, $hpath)) {
            echo "failed to copy $var...\n";
        }else{
            echo "Saved CSV";
        }

    }

    public function getIso($iso)
    {
         // Open the file for reading
         if (($h = fopen(dirname(__FILE__)."/f.csv", "r")) !== FALSE) 
         {
           // Each line in the file is converted into an individual array that we call $data
           // The items of the array are comma separated
           while (($data = fgetcsv($h, 1000, ",")) !== FALSE) 
           {
             // Each individual array is being pushed into the nested array
             $currISO[] = $data;		
           }


           foreach ($currISO as $key => $val) {
            if ($val[2] === strtoupper($iso)) {
                // echo $key;
                echo $iso." exist";
            break;
            }else{

            }
            // echo "Checking... \n";
            }
            // echo $iso." doesnt exist ";

         
           // Close the file
           fclose($h);
         }else{
             echo "no cached file";
         }

    }
}


?>