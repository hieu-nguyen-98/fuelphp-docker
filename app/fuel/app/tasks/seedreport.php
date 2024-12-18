<?php

namespace Fuel\Tasks;

class SeedReport
{
    public static function run()
    {
        echo "Running UserSeeder task...\n";

        // Kết nối cơ sở dữ liệu
        $db = \DB::instance();
        // Thêm 100 bản ghi vào bảng `users`
        for ($i = 1; $i <= 100; $i++) {
            $team_id = rand(1, 50);
            $user_id = rand(1, 50);
            $yesterday_tasks = 'hôm qua abxyz' .$i;
            $today_tasks = 'hôm nay abcxyz' .$i;
            $note = 'bình luận abcxyz' .$i;
            $created_at = date('Y-m-d H:i:s');            
            $updated_at = date('Y-m-d H:i:s');
    
            \DB::insert('reports')->set([
                'team_id' => $team_id,
                'user_id' => $user_id,
                'yesterday_tasks' => $yesterday_tasks,
                'yesterday_tasks' => $today_tasks,
                'note' => $note,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ])->execute();
        }

        echo "100 user records inserted successfully.\n";
    }
}
