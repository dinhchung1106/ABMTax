<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABM Tax Admin</title>
    {{-- Nhúng dữ liệu companyInfo vào biến JS --}}
    <script>
        window.initialCompanyInfo = @json($companyInfo);
    </script>
    @vite(['resources/css/app.css', 'resources/js/admin/main.js'])
</head>
<body>
    <div id="app"></div>
</body>
</html> 