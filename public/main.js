var main = {
    init: function () {
        console.log("Khởi chạy main.init()");
    },
    buyNow: function () {
        console.log("buyNow được gọi");
    },
    addToCart: function (product_id, product_name, product_image, product_price) {
        jQuery.ajax({
            url: '/cart/add', // Đường dẫn đến route xử lý thêm vào giỏ hàng (đổi thành route thực tế của bạn)
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), // Laravel CSRF token
                product_id: product_id,
                product_name: product_name,
                product_image: product_image,
                product_price: product_price,
                quantity: 1 // Hoặc cho phép người dùng chọn số lượng
            },
            success: function (response) {
                if(response.success){
                    alert('Sản phẩm đã được thêm vào giỏ hàng!')
                } else{
                    alert(response.message);
                }
                console.log('Thêm vào giỏ hàng thành công:', response);

            },
            error: function (xhr) {
                console.error('Thêm vào giỏ hàng thất bại:', xhr.responseText);
                alert('Có lỗi xảy ra khi thêm vào giỏ hàng!');
            }
        });
    }
};

console.log("Khởi chạy main");
main.init();

