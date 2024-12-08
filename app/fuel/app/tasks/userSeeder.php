<?php

namespace Fuel\Tasks;

class UserSeeder
{
    public static function run()
    {
        echo "Running UserSeeder task...\n";

        // Kết nối cơ sở dữ liệu
        $db = \DB::instance();
        // Thêm 100 bản ghi vào bảng `users`
        for ($i = 1; $i <= 100; $i++) {
            $username = 'User' . $i;
            $email = 'user' . $i . '@example.com';
            $password = password_hash('password', PASSWORD_DEFAULT);
            $salt = bin2hex(random_bytes(8)); // Tạo chuỗi salt ngẫu nhiên
            $group = rand(1, 3);
            $last_login = '8-12-2024'; // Người dùng chưa đăng nhập
            $login_hash = '8-12-2024'; // Không có login hash ban đầu
            $profile_fields = json_encode(['bio' => 'This is user ' . $i]); // JSON để lưu trữ thông tin hồ sơ
            $created_at = time(); // Dùng timestamp hiện tại
            $updated_at = time();
    
            \DB::insert('users')->set([
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'salt' => $salt,
                'group' => $group,
                'last_login' => 0,
                'login_hash' => 0,
                'profile_fields' => $profile_fields,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ])->execute();
        }

        echo "100 user records inserted successfully.\n";
    }
}
