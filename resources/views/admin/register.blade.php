<x-main>
    @section('title', "Đăng ký hội viên")
    <link rel="stylesheet" href="/table_template/style.css">
    <link rel="stylesheet" href="/assets/css/transaction.css">

   
    <div class="member-title-wrap d-flex align-items-center gap-2">
        <i class="mdi mdi-format-list-bulleted d-flex align-items-center"></i> 
        <div class="member-title">
            Đăng ký hội viên
        </div>
    </div>

    <div class="search-bar mt-4 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <div class="group">
                <svg viewBox="0 0 24 24" aria-hidden="true" class="icon">
                    <g>
                    <path
                        d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"
                    ></path>
                    </g>
                </svg>
                <input class="input" type="search" placeholder="Tìm kiếm" />
            </div>
            <div class="search-btn">
                <button class="button">
                    <span>
                        <svg viewBox="0 0 24 24" height="15" width="15" xmlns="http://www.w3.org/2000/svg"><path d="M9.145 18.29c-5.042 0-9.145-4.102-9.145-9.145s4.103-9.145 9.145-9.145 9.145 4.103 9.145 9.145-4.102 9.145-9.145 9.145zm0-15.167c-3.321 0-6.022 2.702-6.022 6.022s2.702 6.022 6.022 6.022 6.023-2.702 6.023-6.022-2.702-6.022-6.023-6.022zm9.263 12.443c-.817 1.176-1.852 2.188-3.046 2.981l5.452 5.453 3.014-3.013-5.42-5.421z"></path></svg>
                    </span>
                </button>
            </div>
            <div class="loader">
                <li class="ball"></li>
                <li class="ball"></li>
                <li class="ball"></li>
            </div>
            
        </div>
        
    </div>

    <div class="search-result mt-3">
                
    </div>
    
   <div class="table" id="customers_table">
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> ID </span></th>
                        <th class="name-tag"> Họ tên </span></th>
                        <th> Email </span></th>
                        <th> Trạng thái </span></th>
                        <th> Thời gian </span></th>
                        <th> Tùy chọn </span></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($all_members->count() > 0)
                          @foreach ($all_members->sortByDesc('id') as $member)
                            <tr class="tran-{{$member->status}} tran" id="{{$member->id}}">
                                <td>{{$member->id}}</td>
                                <td class="name-tag sticky-name">
                                    {{$member->name}}
                                </td>
                                <td class="">
                                {{$member->email}}
                                </td>
                                <td>
                                    @if ($member->status ==="pending")
                                        <button class="btn btn-warning status-info" style="pointer-events: none; width:140px;">Chờ xác thực</button>
                                    @elseif($member->status ==="verified")
                                        <button class="btn btn-success status-info" style="pointer-events: none;width:140px">Đã xác thực</button>
                                    @else
                                        <button class="btn btn-danger status-info" style="pointer-events: none;width:140px">Thất bại</button>
                                    @endif   
                                </td>
                                <td>
                                    {{\Carbon\Carbon::parse($member->created_at)->format('d-m-Y H:i')}}</td>
                                <td>
                                    <div class="btn-group {{$member->status != 'pending' ? 'active' : ''}}">
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
                    
                    @else
                        <tr>
                            <td>Chưa có đăng ký mới</td>
                        </tr>
                    @endif
                  
                </tbody>
            </table>
        </section>
    </div>

    

        
    
  
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
                    url: '/user-confirm',
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
                    url: '/user-confirm',
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
    
