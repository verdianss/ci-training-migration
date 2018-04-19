<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_properties extends CI_Migration {

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
                    'constraint' => '10',
                    'unsigned' => TRUE,
                    'comment' => 'FK (users)id'
                ),
                'title' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                ),
                'description' => array(
                    'type' => 'TEXT',
                    'null' => TRUE,
                ),
                'slug' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                ),
                'price' => array(
                    'type' => 'INT',
                    'constraint' => '10',
                    'null' => TRUE,
                ),
                'price_text' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE,
                ),
                'created' => array(
                    'type' => 'INT',
                    'constraint' => '10',
                    'unsigned' => TRUE,
                    'comment' => 'Unix timestamp',
                ),
                'updated' => array(
                    'type' => 'INT',
                    'constraint' => '10',
                    'unsigned' => TRUE,
                    'comment' => 'Unix timestamp',
                ),
                'deleted' => array(
                    'type' => 'INT',
                    'constraint' => '10',
                    'unsigned' => TRUE,
                    'null' => TRUE,
                    'comment' => 'Unix timestamp',             
                    'default' => NULL,
                ),
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id)');
            $this->dbforge->create_table('properties');
        }

        public function down()
        {
                $this->dbforge->drop_table('properties');
        }
}