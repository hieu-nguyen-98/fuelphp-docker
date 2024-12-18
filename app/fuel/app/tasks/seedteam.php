<?php

namespace Fuel\Tasks;

class SeedTeam
{
    public static function run()
    {
        echo "Running UserSeeder task...\n";

        // Kết nối cơ sở dữ liệu
        $db = \DB::instance();
        // Thêm 100 bản ghi vào bảng `users`
        for ($i = 1; $i <= 10; $i++) {
            $name = 'team' .$i;
            $description = 'moo tar team' .$i;
            $created_at = date('Y-m-d H:i:s');            
            $updated_at = date('Y-m-d H:i:s');
    
            \DB::insert('teams')->set([
                'name' => $name,
                'description' => $description,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ])->execute();
        }

        echo "100 user records inserted successfully.\n";
    }
}
