<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableKeranjang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_keranjang' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsignned' => true,
                'auto_increment' => true,
            ],
            'id_produk' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'id_user' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'id_stok' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'id_transaksi' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'qty' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'harga' =>
            [
                'type' => 'int',
                'constraint' => 11,
            ],
            'jenis_transaksi' => [
                'type' => 'varchar',
                'constraint' => 50
            ],
            'total_harga' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'created_at' => [
                'type' => 'datetime',
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_keranjang', true);
        $this->forge->createTable("table_keranjang");
    }

    public function down()
    {
        $this->forge->dropTable("table_keranjang");
    }
}
