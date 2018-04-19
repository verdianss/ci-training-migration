<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {
        
        /**
         * index
         * 
         * @return void
         */
        public function index(){
                $this->load->library('migration');
		echo "Migrating...";
                if ($this->migration->latest() === false) 
                {        
                        show_error($this->migration->error_string());
                }
                echo "Done  ".PHP_EOL;
        }
        
        /**
         * version
         *
         * @param [int] $version
         * @return void
         */
        public function version($version){
                $this->load->library("migration");
		echo "Migrating...";
                if(!$this->migration->version($version)){
                        show_error($this->migration->error_string());
                }   
                echo "Done  ".PHP_EOL;
        }
}