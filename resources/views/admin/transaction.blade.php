<x-main>
    @section('title', "Lịch sử giao dịch")
    <link rel="stylesheet" href="/table_template/style.css">
    <link rel="stylesheet" href="/assets/css/transaction.css">
   
    <div class="member-title-wrap d-flex align-items-center gap-2">
        <i class="mdi mdi-format-list-bulleted d-flex align-items-center"></i> 
        <div class="member-title">
            Lịch sử giao dịch
        </div>
    </div>
    
   <div class="table" id="customers_table">
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> STT </span></th>
                        <th class="name-tag"> Mã giao dịch </span></th>
                        <th> Hội viên </span></th>
                        <th> Trạng thái </span></th>
                        <th> Thời gian </span></th>
                        <th> Tùy chọn </span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions->sortByDesc('id') as $transaction)

                        @php
                            $member = $members->where('id', $transaction->user_id)->first();
                        @endphp
                        <tr >
                            <td>{{$transaction->id}}</td>
                            <td class="name-tag sticky-name">
                                {{$transaction->code}}
                            </td>
                            <td class="">
                                <a style="text-decoration:none; color: #212529 " href="/profile/{{$member->user_id}}">{{$transaction->user_name}}</a>
                            </td>
                            <td>
                                @if ($transaction->status ==="pending")
                                    <button class="btn btn-warning status-info" style="pointer-events: none; width:140px;">Chờ xác thực</button>
                                @elseif($transaction->status ==="success")
                                    <button class="btn btn-success status-info" style="pointer-events: none;width:140px">Thành công</button>
                                @else
                                    <button class="btn btn-danger status-info" style="pointer-events: none;width:140px">Thất bại</button>
                                @endif   
                            </td>
                            <td>
                                {{\Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y H:i')}}</td>
                            <td>
                                <div class="btn-group {{$transaction->status != 'pending' ? 'active' : ''}}">
                                    <span class="accept" data-status = "success">
                                        <i class="mdi mdi-check"></i>
                                    </span>
                                    <span class="deny" data-status = "fail">
                                        <i class="mdi mdi-close"></i>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>

    <div class="pag d-flex justify-content-center align-items-center mt-3">
        {{ $transactions->links() }}
        {{-- {{ $all_members->links('pagination::default') }} --}}
    </div>

    <style>
        .pag nav {
            overflow: auto
        }
    </style>

    

</x-main>

<script>
    

    $(document).ready(function() {
        
        $('.accept').click(function() {
            var stat = this.dataset.status;
            console.log(stat);
            
            var parentRow = this.parentElement.parentElement.parentElement;
            var itemId = parentRow.querySelector("td:first-child").textContent;
            var token = $('meta[name="csrf-token"]').attr('content');

            var suc = document.querySelector(".suc-btn");
            var btnGroup = parentRow.querySelector(".btn-group");

            var info = parentRow.querySelector('.status-info').parentElement; 
            console.log(info.innerHTML);
            
            var result = confirm("Chuyển trạng thái sang thành công?");

            if (result) {
                $.ajax({
                    url: '/process-accept',
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json'
                    },
                    data: JSON.stringify({ itemId: itemId, status: stat }),
                    success: function(response) {
                        if (response.success) {
                            suc.classList.add("active");
                            btnGroup.classList.add("active");
                            suc.querySelector(".success__title").textContent = response.message;
                            setTimeout(() => {
                                suc.classList.remove("active");
                            }, 2000);
                            info.innerHTML = `<button class="btn btn-success status-info" style="pointer-events: none;width:140px">Thành công</button>`;
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Đã xảy ra lỗi khi gửi request.');
                    }
                });
            }
        });





        $('.deny').click(function() {
            var stat = this.dataset.status;
            console.log(stat);
            var parentRow = this.parentElement.parentElement.parentElement;
            var itemId = parentRow.querySelector("td:first-child").textContent;
            var token = $('meta[name="csrf-token"]').attr('content');
            var suc = document.querySelector(".suc-btn");
            var btnGroup = parentRow.querySelector(".btn-group");

            var info = parentRow.querySelector('.status-info').parentElement; 
            
            var result = confirm("Chuyển trạng thái sang thất bại?");

            if (result) {
                $.ajax({
                    url: '/process-accept',
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json'
                    },
                    data: JSON.stringify({ itemId: itemId, status: stat }),
                    success: function(response) {
                        if (response.success) {
                            suc.classList.add("active");
                            btnGroup.classList.add("active");
                            suc.querySelector(".success__title").textContent = response.message;
                            setTimeout(() => {
                                suc.classList.remove("active");
                            }, 2000);
                            info.innerHTML = `<button class="btn btn-danger status-info" style="pointer-events: none;width:140px">Thất bại</button>`;
                        } else {
                            alert('Accept không thành công: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Đã xảy ra lỗi khi gửi request.');
                    }
                });
            }
        });
    });

</script>

    

