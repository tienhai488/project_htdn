<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Website quản lý doanh nghiệp theo Repository Design Pattern (Laravel)

## Ngôn ngữ và Kỹ năng

Dưới đây là một số ngôn ngữ lập trình và kỹ năng mà chúng tôi đã dùng để phát triển dự án:
- **Back-end:**
  - Laravel
 
- **Front-end:**
  - HTML
  - CSS
  - SCSS
  - Bootstrap
  - Javascript
  - JQuery
    
- **Cơ sở dữ liệu:**
  - MySQL

- **Công cụ và thư viện:**
  - Git
  - Datatable (server-side)
  - Spatie Media Library
  - Spatie Laravel Permission
  - Qilljs

## Tính Năng Chính
  - **Admin:**
    - Admin có thể xem, tìm kiếm, tìm kiếm nâng cao, và sắp xếp, lọc các sản phẩm, nhà cung cấp...
    - Thêm/ xoá/ sửa thông tin sản phẩm.
    - Admin có thể tạo và xem các báo cáo theo thời gian
    - Admin quản lý user (quản lý quyền và phân quyền cho user)

  - **Quản lý nhân sự:**
    - Thêm/ xoá nhân sự trong doanh nghiệp.
    - Thay đổi chức vụ của nhân sự, khi thay đổi chức vụ phải có thời điểm cụ thể và lương sẽ thay đổi theo.
    - Chấm công cho nhân sự
    - Tuyển dụng và quản lý ứng viên

  - **Quản lý kho:**
    - Quản lý thông tin về sản phẩm doanh nghiệp đang kinh doanh, giá cả, chi tiết số lượng tồn của mỗi sản phẩm, giá nhập vào.
    - Thêm/ xoá/ sửa thông tin sản phẩm.
    - Lập phiếu nhập sản phẩm vào doanh nghiệp.
    - Thêm, sửa, xoá, tìm kiếm thông tin nhà cung cấp
    - In báo cáo thống kê theo tháng, năm về sản phẩm.

  - **Quản lý kinh doanh:**
    - Lập được phiếu xuất sản phẩm cho hoạt động kinh doanh: số lượng bán, giá bán.
    - Thống kê số lượng sản phẩm đã xuất theo tháng, quý, năm.
    - Thống kê được lợi nhuận của doanh nghiệp theo tháng, quý, năm..


## Hướng Dẫn Cài Đặt
1. Clone repository: `git clone https://github.com/tienhai488/project_htdn` 
2. composer install
3. npm install
4. Cài đặt thư viện Laravel Permission (https://spatie.be/docs/laravel-permission/v6/installation-laravel)
4. php artisan migration (Cài đặt DB trong .env và chỉnh APP_URL=http://localhost:8000)
5. php artisan db:seed (Chạy dữ liệu db, xem thông tin đăng nhập tại database/seeders/UserSeeder.php)
6. Chạy chương trình (php artisan serve && npm run dev)

