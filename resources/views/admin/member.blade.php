<x-main>
    <link rel="stylesheet" href="/table_template/style.css">
    <div class="member-title-wrap d-flex align-items-center gap-2">
        <i class="mdi mdi-format-list-bulleted d-flex align-items-center"></i> 
        <div class="member-title">
            Danh sách hội viên
        </div>
    </div>

   <div class="table" id="customers_table">
       
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> ID </span></th>
                        <th class="name-tag"> Họ tên </span></th>
                        <th> Trạng thái </span></th>
                        <th> Ngày bắt đầu </span></th>
                        <th> Ngày kết thúc </span></th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_members as $member)
                    
                        <tr class="row-user user-{{$member->status}} {{$member->about_to_date === 1 ? 'user-about-to-date' : ''}} ">
                            <td>{{$member->id}}</td>
                            <td class="name-tag sticky-name">
                                <a class="member-name" href="/profile/{{$member->id}}">{{$member->name}}</a>
                            </td>
                            <td class="d-flex align-items-center gap-2">
                                <label class="switch {{$member->status === "active" ? "active" : ""}}">
                                    {{-- <input checked="" type="checkbox"> --}}
                                    <div class="slider">
                                        <div class="circle">
                                            <svg class="cross" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 365.696 365.696" y="0" x="0" height="6" width="6" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <path data-original="#000000" fill="currentColor" d="M243.188 182.86 356.32 69.726c12.5-12.5 12.5-32.766 0-45.247L341.238 9.398c-12.504-12.503-32.77-12.503-45.25 0L182.86 122.528 69.727 9.374c-12.5-12.5-32.766-12.5-45.247 0L9.375 24.457c-12.5 12.504-12.5 32.77 0 45.25l113.152 113.152L9.398 295.99c-12.503 12.503-12.503 32.769 0 45.25L24.48 356.32c12.5 12.5 32.766 12.5 45.247 0l113.132-113.132L295.99 356.32c12.503 12.5 32.769 12.5 45.25 0l15.081-15.082c12.5-12.504 12.5-32.77 0-45.25zm0 0"></path>
                                                </g>
                                            </svg>
                                            <svg class="checkmark" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 24 24" y="0" x="0" height="10" width="10" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <path class="" data-original="#000000" fill="currentColor" d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"></path>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                </label>
                                <div class="status">
                                    @if ($member->about_to_date === 1)
                                        @if ($member->status === "blocked")
                                            <span class="text-warning" style="font-size: 12px">Sắp hết hạn</span>, 
                                            <span class="text-danger" style="font-size: 12px">Khóa</span>
                                        @else
                                            <span class="text-warning" style="font-size: 12px">Sắp hết hạn</span>
                                        @endif
                                    @else
                                        @if ($member->status === "inactive")
                                            <span class="text-danger" style="font-size: 12px">Quá hạn</span>
                                        @elseif ($member->status === "blocked")
                                            <span class="text-danger" style="font-size: 12px">Khóa</span>
                                        @else
                                            <span class="text-success" style="font-size: 12px">Hoạt động</span>
                                        @endif
                                    @endif
                                </div>
                            </td>
                            <td>{{\Carbon\Carbon::parse($member->start)->format('d-m-Y H:i')}}</td>
                            <td>{{\Carbon\Carbon::parse($member->end)->format('d-m-Y H:i')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>

    <script>
        var switches = document.querySelectorAll('.switch');
var stat_texts = document.querySelectorAll('.switch + .status');

if (switches) {
    switches.forEach((s, index) => {
        s.addEventListener("click", (e) => {
            var parentRow = s.parentElement.parentElement;
            var userId = parentRow.querySelector("td:first-child").textContent.trim();
            var token = $('meta[name="csrf-token"]').attr('content');
            var suc = document.querySelector(".suc-btn");

            var result = confirm("Thay đổi trạng thái người dùng này?");

            if (result) {
                $.ajax({
                    url: "{{ route('change.user.status') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json'
                    },
                    data: JSON.stringify({ userId: userId }),
                    success: function(response) {
                        if (response.success) {
                            if (s.classList.contains("active")) {
                                if(parentRow.classList.contains('user-about-to-date')) {
                                    stat_texts[index].innerHTML = `<span class="text-warning" style="font-size: 12px">Sắp hết hạn</span>, <span class="text-danger" style="font-size: 12px">Khóa</span>`;
                                }
                                else {
                                    stat_texts[index].innerHTML = `<span class="text-danger" style="font-size: 12px">Khóa</span>`;
                                }
                            } else {
                                if(parentRow.classList.contains('user-about-to-date')) {
                                    stat_texts[index].innerHTML = `<span class="text-warning" style="font-size: 12px">Sắp hết hạn</span>`;
                                }
                                else {
                                    stat_texts[index].innerHTML = `<span class="text-success" style="font-size: 12px">Hoạt động</span>`;
                                }
                            }
                            s.classList.toggle("active");
                            suc.classList.add("active");
                            suc.querySelector(".success__title").textContent = response.message;
                            setTimeout(() => {
                                suc.classList.remove("active");
                            }, 2000);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('There was a problem with the request.');
                    }
                });
            }
        });
    });
}



    </script>

</x-main>



