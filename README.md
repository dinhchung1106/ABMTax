# ABM Tax - Hệ thống quản lý dịch vụ kế toán và thuế

<p align="center">
<img src="/logo.png" width="200" alt="ABM Tax Logo">
</p>

## Giới thiệu

ABM Tax là hệ thống quản lý dịch vụ kế toán và thuế, được phát triển với Laravel và Vue.js. Hệ thống cung cấp các tính năng quản lý người dùng, dịch vụ, tin tức, khóa học và liên hệ.

## Tính năng chính

- **Quản lý người dùng**
  - Phân quyền theo vai trò (Super Admin, Admin, Editor)
  - Quản lý thông tin người dùng
  - Upload và quản lý ảnh đại diện

- **Quản lý dịch vụ**
  - Thêm/sửa/xóa dịch vụ
  - Upload ảnh đại diện và banner
  - Mô tả chi tiết dịch vụ

- **Quản lý tin tức**
  - Đăng bài viết mới
  - Upload hình ảnh
  - Phân loại tin tức

- **Quản lý khóa học**
  - Thêm/sửa/xóa khóa học
  - Quản lý nội dung khóa học

- **Quản lý liên hệ**
  - Xem và phản hồi liên hệ từ khách hàng

## Yêu cầu hệ thống

- PHP >= 8.1
- MySQL >= 5.7
- Node.js >= 16
- Composer
- NPM

## Cài đặt

1. Clone repository:
```bash
git clone [repository-url]
cd ABMTax
```

2. Cài đặt dependencies:
```bash
composer install
npm install
```

3. Cấu hình môi trường:
```bash
cp .env.example .env
php artisan key:generate
```

4. Cấu hình database trong file .env:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=abmtax
DB_USERNAME=root
DB_PASSWORD=
```

5. Chạy migrations và seeders:
```bash
php artisan migrate --seed
```

6. Build assets:
```bash
npm run build
```

7. Khởi động server:
```bash
php artisan serve
```

## Tài khoản mặc định

- **Super Admin**
  - Email: admin@abmtax.com
  - Password: admin123

- **Admin**
  - Email: admin2@abmtax.com
  - Password: admin123

- **Editor**
  - Email: editor@abmtax.com
  - Password: editor123

## Công nghệ sử dụng

- **Backend**
  - Laravel 10.x
  - MySQL
  - Laravel Sanctum (Authentication)

- **Frontend**
  - Vue.js 3
  - Element Plus
  - Axios

## Bảo mật

Nếu bạn phát hiện lỗ hổng bảo mật, vui lòng gửi email đến [email-bảo-mật]. Tất cả các lỗ hổng bảo mật sẽ được xử lý kịp thời.

## Giấy phép

Dự án này được cấp phép theo [MIT License](https://opensource.org/licenses/MIT).
