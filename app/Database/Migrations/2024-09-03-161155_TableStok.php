<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableStok extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_stok' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsignned' => true,
                'auto_increment' => true,
            ],
            'id_produk' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'stok_awal' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => true,
            ],
            'stok_akhir' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => true,
            ],
            'harga_modal' => [
                'type' => 'int',
                'constraint' => 255,
                'null' => true,
            ],
            'harga_jual' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => true,
            ],
            'keuntungan' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => true,
            ],
            'tgl_produksi' => [
                'type' => 'datetime'
            ],
            'tgl_exp' => [
                'type' => 'datetime'
            ],
            'created_at' => [
                'type' => 'datetime',
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_stok', true);
        $this->forge->createTable("table_stok");
    }

    public function down()
    {
        $this->forge->dropTable("table_stok");
    }
}
