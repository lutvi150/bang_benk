<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TabelFotoProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_foto_produk' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsignned' => true,
                'auto_increment' => true,
            ],
            'id_produk' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'foto_produk' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'produk_unggulan' => [
                'type' => 'varchar',
                'constraint' => 2,
            ],
            'created_at' => [
                'type' => 'datetime',
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_foto_produk', true);
        $this->forge->createTable("table_foto_produk");
    }

    public function down()
    {
        $this->forge->dropTable("table_foto_produk");
    }
}
