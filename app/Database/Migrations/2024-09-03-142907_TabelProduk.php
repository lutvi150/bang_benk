<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TabelProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_produk' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsignned' => true,
                'auto_increment' => true,
            ],
            'nomor_registrasi_produk' => [
                'type' => 'varchar',
                'constraint' => 50,
            ],
            'stok' => [
                'type' => 'int',
                'constraint' => 11
            ],
            'nama_produk' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'detail_produk' => [
                'type' => 'text',
            ],
            'created_at' => [
                'type' => 'datetime',
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_produk', true);
        $this->forge->createTable("table_produk");
    }

    public function down()
    {

        $this->forge->dropTable("table_produk");
    }
}
