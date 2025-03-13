// document.addEventListener('DOMContentLoaded', function() {
//     const toggleButton = document.getElementById('theme-toggle');
//     const themeText = document.getElementById('theme-text');
//     const savedTheme = localStorage.getItem('theme') || 'light';

//     // Áp dụng theme khi load
//     function applyTheme(theme) {
//         document.body.classList.toggle('dark', theme === 'dark');
//         themeText.textContent = theme === 'dark' ? 'Chế độ Tối' : 'Chế độ Sáng';
//         toggleButton.innerHTML = theme === 'dark' ? '🌙 <span id="theme-text">Chế độ Tối</span>' 
//                                                     : '🌞 <span id="theme-text">Chế độ Sáng</span>';
//     }

//     applyTheme(savedTheme); // Áp dụng theme đã lưu

//     // Xử lý khi click nút
//     toggleButton.addEventListener('click', () => {
//         const newTheme = document.body.classList.contains('dark') ? 'light' : 'dark';
//         localStorage.setItem('theme', newTheme);
//         applyTheme(newTheme);
//     });
// });
