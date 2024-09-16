<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableBuktiBayar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bukti_bayar' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsignned' => true,
                'auto_increment' => true,
            ],
            'id_transaksi' => [
                'type' => 'int',
                'constraint' => 5,
            ],
            'bukti_bayar' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'keterangan' => [
                'type' => 'text',
            ],
            'type' => [
                'type' => 'varchar',
                'constraint' => 20,
            ],
            'created_at' => [
                'type' => 'datetime',
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_bukti_bayar', true);
        $this->forge->createTable("table_bukti_bayar");
    }

    public function down()
    {
        $this->forge->dropTable("table_bukti_bayar");
    }
}
