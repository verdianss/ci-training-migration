<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_email_confirmations extends CI_Migration {

        public function up()
        {
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE,
                    'comment' => 'PK'
                ),
                'user_id' => array(
                    'type' => 'INT',
                    'constraint' => '11',
                    'unsigned' => TRUE,
                ),
                'token' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ),
                'expired' => array(
                    'type' => 'INT',
                    'constraint' => '10',
                    'unsigned' => TRUE,
                    'comment' => 'Unix timestamp',
                ),
                'created' => array(
                    'type' => 'INT',
                    'constraint' => '10',
                    'unsigned' => TRUE,
                    'comment' => 'Unix timestamp',
                ),
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('email_confirmations');
        }

        public function down()
        {
                $this->dbforge->drop_table('email_confirmations');
        }
}