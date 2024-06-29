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

        <div class="d-flex gap-2 align-items-center box-filter">
            <div class="loader loader2">
                <li class="ball"></li>
                <li class="ball"></li>
                <li class="ball"></li>
            </div>
            <div class="radio-inputs">
                <label class="radio">
                    <input type="radio" checked name="radio" >
                    <span class="name filter-all text-primary">Tất cả</span>
                </label>
                <label class="radio">
                    <input type="radio" name="radio">
                    <span class="name filter-success text-success">Thành công</span>
                </label>
                <label class="radio">
                    <input type="radio" name="radio">
                    <span class="name filter-pending text-warning">Đang chờ</span>
                </label>
                <label class="radio">
                    <input type="radio" name="radio">
                    <span class="name filter-fail text-danger">Thất bại</span>
                </label>
                
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
                        <th> STT </span></th>
                        <th class="name-tag"> Mã giao dịch </span></th>
                        <th> Hội viên </span></th>
                        <th> Trạng thái </span></th>
                        <th> Thời gian </span></th>
                        <th> Tùy chọn </span></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($transactions->count() > 0)
                        @foreach ($transactions->sortByDesc('id') as $transaction)

                            @php
                                $member = $members->where('id', $transaction->user_id)->first();
                            @endphp
                            <tr class="tran-{{$transaction->status}} tran" id="{{$member->id}}-{{$transaction->id}}">
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


    var searchBtn = document.querySelector('.search-btn');
    var searchResults = document.querySelector('.search-result');
    
    if (searchBtn) {
        searchBtn.addEventListener("click", () => {

            var token = $('meta[name="csrf-token"]').attr('content');
            var suc = document.querySelector(".suc-btn");
            var loader = document.querySelector(".loader");
            var searchInput = document.querySelector('.search-bar input').value;

            $.ajax({
                url: "{{ route('search_transaction') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify({ searchInput: searchInput }),
                success: function(response) {

                    if(response.success){

                        loader.classList.add("active");
                        setTimeout(() => {
                            loader.classList.remove("active");
                            document.querySelector('#customers_table').classList.add("active")
                            searchResults.innerHTML = `<span class="text-success">${response.member.length} kết quả</span>`;
                            console.log(response.mem);
                            response.member.forEach(mem => {
                                document.getElementById(`${mem.user_id}-${mem.id}`).classList.add("queried");
                            })
                            
                        }, 1500);
                        
                    }
                },
                error: function(xhr, status, error) {
                    console.error('There was a problem with the request.');
                }
            });
            
        });
    }

    document.addEventListener("click", (e)=> {
        if(!searchBtn.contains(e.target) && !document.querySelector("#customers_table").contains(e.target) && !document.querySelector(".radio-inputs").contains(e.target)){
            document.querySelector("#customers_table").classList.remove('active');
            document.querySelectorAll(".tran.hide").forEach(item=>{
                item.classList.remove("hide")
            });
            document.querySelector("#customers_table").classList.remove('active');
            document.querySelectorAll("tr.queried").forEach(i => {
                i.classList.remove('queried');
            });
            searchResults.innerHTML = ''
        }
    })



    var all = document.querySelector(".filter-all");
    var success = document.querySelector(".filter-success");
    var fail = document.querySelector(".filter-fail");
    var pending = document.querySelector(".filter-pending");
  
    var loader2 = document.querySelector(".loader2");
    
    var all = document.querySelector(".filter-all");
    all.addEventListener("click", (e) => {
        document.querySelector('.box-filter .loader').classList.add("active");

        setTimeout(() => {
            document.querySelector('.box-filter .loader.active').classList.remove("active");
            document.querySelectorAll(".tran.hide").forEach(item=>{
                item.classList.remove("hide")
            });
        }, 1500);
        

    })

    success.addEventListener("click", () => {
        document.querySelector('.box-filter .loader').classList.add("active");

        setTimeout(() => {
            document.querySelector('.box-filter .loader.active').classList.remove("active");
            document.querySelectorAll(".tran.hide").forEach(item=>{
                item.classList.remove("hide")
            });
            document.querySelectorAll(".tran:not(.tran-success)").forEach(item=>{
                item.classList.add("hide")
            });
        }, 1500);
        

    })

    fail.addEventListener("click", () => {
        document.querySelector('.box-filter .loader').classList.add("active");

        setTimeout(() => {
            document.querySelector('.box-filter .loader.active').classList.remove("active");
            document.querySelectorAll(".tran.hide").forEach(item=>{
                item.classList.remove("hide")
            });
            document.querySelectorAll(".tran:not(.tran-fail)").forEach(item=>{
                item.classList.add("hide")
            });
        }, 1500);
        

    })

    pending.addEventListener("click", () => {
        document.querySelector('.box-filter .loader').classList.add("active");

        setTimeout(() => {
            document.querySelector('.box-filter .loader.active').classList.remove("active");
            document.querySelectorAll(".tran.hide").forEach(item=>{
                item.classList.remove("hide")
            });
            document.querySelectorAll(".tran:not(.tran-pending)").forEach(item=>{
                item.classList.add("hide")
            });
        }, 1500);
        

    })
    

</script>

    

