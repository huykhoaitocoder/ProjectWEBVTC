<div class="modal fade" id="editReviewModal" tabindex="-1" aria-labelledby="editReviewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editReviewForm" method="POST" action="{{ route('reviews.update', $userReview->id) }}">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title" id="editReviewModalLabel">Chỉnh sửa đánh giá - {{ $app->name }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="editRating" class="form-label">Đánh giá (1-5 sao)</label>
            <select name="rating" id="editRating" class="form-select" required>
              @for ($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}" {{ $userReview->rating == $i ? 'selected' : '' }}>{{ $i }} ⭐</option>
              @endfor
            </select>
          </div>

          <div class="mb-3">
            <label for="editComment" class="form-label">Bình luận</label>
            <textarea name="comment" id="editComment" class="form-control" rows="3" placeholder="Nhập bình luận..." required>{{ $userReview->comment }}</textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-success">Cập nhật đánh giá</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    document.getElementById('editReviewForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch(this.action, {
        method: 'POST', // Vì Laravel yêu cầu POST + _method='PUT'
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) throw new Error('Lỗi máy chủ!');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('✅ Đánh giá đã được cập nhật!');
            const modal = bootstrap.Modal.getInstance(document.getElementById('editReviewModal'));
            modal.hide();
            location.reload();  // Làm mới để hiển thị đánh giá mới
        } else {
            alert('❌ Có lỗi xảy ra.');
        }
    })
    .catch(error => {
        console.error(error);
        alert('🚫 Không thể cập nhật đánh giá!');
    });
});
</script>