<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Truncate the table.
        DB::table('banks')->truncate();
        Bank::create(['name'=>'PERFECT MONEY','avatar'=>'perfect_money.png','account_number'=>'CONTACT SUPPORT FOR DETAILS']);
        Bank::create(['name'=>'SKRILL','avatar'=>'skrill.png','account_number'=>'CONTACT SUPPORT FOR DETAILS']);
        Bank::create(['name'=>'NETELLER','avatar'=>'neteller.png','account_number'=>'CONTACT SUPPORT FOR DETAILS']);
        Bank::create(['name'=>'BITCOIN','avatar'=>'bitcoin.png','account_number'=>'bc1qp9fc2hvpuatnw7fxgjn6alh62rgyhp7scnfgfe']); 
        Bank::create(['name'=>'TRON','avatar'=>'tron.png','account_number'=>'TPxwoQEzKZC2n7p5UTipUbK9ybHEoiTMAN']);
        Bank::create(['name'=>'ETHERIUM','avatar'=>'etherium.png','account_number'=>'0xae55cB3D1F19c91753207A11146a0c5662E52D69']);
        Bank::create(['name'=>'BITCOIN CASH','avatar'=>'bitcoincash.png','account_number'=>'qzgkmnnhwg4j6tutvy79yfs66vmf9hg5ru0mnxld9y']);
        Bank::create(['name'=>'LITECOIN','avatar'=>'litecoin.png','account_number'=>'ltc1qkq6gy5ulw6cfqu0zju8mn48ukldxm87tjgqs8u']);
        Bank::create(['name'=>'RIPPLE','avatar'=>'ripple.png','account_number'=>'rht8M8RErUox8fK8QYKjJudpbks6d8AT9D']);
        Bank::create(['name'=>'BNB','avatar'=>'bnb.png','account_number'=>'bnb14v6lpdpqs7snh8hmqlhdhnlp304a0z9qr7th5w']);
        Bank::create(['name'=>'DOGECOIN','avatar'=>'dogecoin.png','account_number'=>'D7B7HwGZhWgFJtziksh8WoDvvhdn1Px2tk']);
        //Bank::create(['name'=>'EWALLET/CELLPHONE BANKING','avatar'=>'mobile_banking.png']);
        //Bank::create(['name'=>'BANK TRANSFER','avatar'=>'fnb.png']);
       
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
