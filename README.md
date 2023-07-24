# Lession2

## Hướng dẫn chạy source code

1. Sao chép thư mục "lampart" vào thư mục "htdocs" trong thư mục cài đặt XAMPP.

2. Khởi động XAMPP và mở localhost của MySQL bằng cách truy cập vào trình duyệt và gõ địa chỉ http://localhost/phpmyadmin/.

3. Trong trang phpMyAdmin, tạo một cơ sở dữ liệu mới và gán cho nó tên "product_category".

4. Có thể sửa lại port của MySql trong file config/database.php dựa theo cấu hình trên máy tính. Port đang dùng cho MySql hiện tại là 3306

4. Trong cơ sở dữ liệu mới vừa tạo, chọn tab "Import" và nhập đường dẫn đến tệp SQL đã được đính kèm trong thư mục. Nhấn nút "Go" để import cơ sở dữ liệu.

5. Tiếp theo, hãy mở trình duyệt web và nhập địa chỉ http://localhost:8080/lampart/, với 8080 là số cổng Apache và "lampart" là tên thư mục trong htdocs. Có thể thay đổi số cổng 8080 dựa vào cấu hình trên máy sau đó sửa lại cấu hình URL trong file config/app.php

6. Bạn sẽ được chuyển đến trang web Lampart và có thể tương tác với ứng dụng.

## Yêu cầu

- XAMPP đã được cài đặt và hoạt động trên máy tính của bạn.

- File SQL đã được đính kèm và sẵn có để import vào cơ sở dữ liệu MySQL.

- Trình duyệt web để truy cập ứng dụng thông qua localhost.

**Lưu ý**: Đảm bảo rằng các cổng (Apache, MySQL) được cấu hình chính xác và không bị xung đột với các dịch vụ khác trên máy tính của bạn.

