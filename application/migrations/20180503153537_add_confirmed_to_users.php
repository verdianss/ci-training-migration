<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_confirmed_to_users extends CI_Migration {

        public function up()
        {
            $this->dbforge->add_column('users',array(
                'confirmed' => array(
                    'type' => 'INT',
                    'constraint' => 10,
                    'null' => TRUE,
                    'comment' => 'Unix timestamp'
                )
            ));
        }

        public function down()
        {
                $this->dbforge->drop_column('users','confirmed');
        }
}