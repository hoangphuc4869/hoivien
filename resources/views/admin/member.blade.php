
<x-main>
    @section('title', "Danh sách hội viên")
    <link rel="stylesheet" href="/table_template/style.css">
    <div class="member-title-wrap d-flex align-items-center gap-2">
        <i class="mdi mdi-format-list-bulleted d-flex align-items-center"></i> 
        <div class="member-title">
            Danh sách hội viên
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
                    <span class="name filter-active text-success">Hoạt động</span>
                </label>
                <label class="radio">
                    <input type="radio" name="radio">
                    <span class="name filter-about text-warning">Sắp hết hạn</span>
                </label>
                <label class="radio">
                    <input type="radio" name="radio">
                    <span class="name filter-inactive text-danger">Quá hạn</span>
                </label>
                <label class="radio">
                    <input type="radio" name="radio">
                    <span class="name filter-blocked text-danger">Khóa</span>
                </label>
            </div>
        </div>
        
    </div>

    <div class="search-result mt-3">
                
    </div>

    

   <div class="table mt-3" id="customers_table">
       
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> ID </th>
                        <th class="name-tag"> Họ tên </th>
                        <th> Trạng thái </th>
                        <th> Email </th>
                        <th> Ngày bắt đầu </th>
                        <th> Ngày kết thúc </th>
                        <th>  </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_members as $member)
                    
                        <tr class="row-user user-{{$member->status}} {{$member->about_to_date === 1 ? 'user-about-to-date' : ''}}" id="{{$member->id}}">
                            <td>{{$member->id}}</td>
                            <td class="name-tag sticky-name">
                                <a class="member-name" href="/profile/{{$member->user_id}}">{{$member->name}}</a>
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
                            <td>{{$member->email}}</td>
                            <td>{{\Carbon\Carbon::parse($member->start)->format('d-m-Y H:i')}}</td>
                            <td>{{\Carbon\Carbon::parse($member->end)->format('d-m-Y H:i')}}</td>
                            <td>
                                <button class="bin-button">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 39 7"
                                        class="bin-top"
                                    >
                                        <line stroke-width="4" stroke="white" y2="5" x2="39" y1="5"></line>
                                        <line
                                        stroke-width="3"
                                        stroke="white"
                                        y2="1.5"
                                        x2="26.0357"
                                        y1="1.5"
                                        x1="12"
                                        ></line>
                                    </svg>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 33 39"
                                        class="bin-bottom"
                                    >
                                        <mask fill="white" id="path-1-inside-1_8_19">
                                        <path
                                            d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z"
                                        ></path>
                                        </mask>
                                        <path
                                        mask="url(#path-1-inside-1_8_19)"
                                        fill="white"
                                        d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z"
                                        ></path>
                                        <path stroke-width="4" stroke="white" d="M12 6L12 29"></path>
                                        <path stroke-width="4" stroke="white" d="M21 6V29"></path>
                                    </svg>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 89 80"
                                        class="garbage"
                                    >
                                        <path
                                        fill="white"
                                        d="M20.5 10.5L37.5 15.5L42.5 11.5L51.5 12.5L68.75 0L72 11.5L79.5 12.5H88.5L87 22L68.75 31.5L75.5066 25L86 26L87 35.5L77.5 48L70.5 49.5L80 50L77.5 71.5L63.5 58.5L53.5 68.5L65.5 70.5L45.5 73L35.5 79.5L28 67L16 63L12 51.5L0 48L16 25L22.5 17L20.5 10.5Z"
                                        ></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
           
        </section>
    </div>
    {{-- <div class="pag d-flex justify-content-center align-items-center mt-3">
        {{ $all_members->links() }}
        
    </div>

    <style>
        .pag nav {
            overflow: auto
        }
    </style> --}}

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


    <script>
        var deletes = document.querySelectorAll('.bin-button');

        if (deletes) {
            deletes.forEach((s, index) => {
                s.addEventListener("click", (e) => {
                    var parentRow = s.parentElement.parentElement;
                    var userId = parentRow.querySelector("td:first-child").textContent.trim();
                  
                    var token = $('meta[name="csrf-token"]').attr('content');
                    var suc = document.querySelector(".suc-btn");
                    var result = confirm("Xác nhận xóa?");

                    if (result) {
                        $.ajax({
                            url: "{{ route('delete') }}",
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'Content-Type': 'application/json'
                            },
                            data: JSON.stringify({ userId: userId }),
                            success: function(response) {

                                suc.classList.add("active");
                                suc.querySelector(".success__title").textContent = response.message;
                                parentRow.remove();
                                setTimeout(() => {
                                    suc.classList.remove("active");
                                }, 2000);
                                
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


    <script>

        var searchBtn = document.querySelector('.search-btn');
        var searchResults = document.querySelector('.search-result');
     
        if (searchBtn) {
            searchBtn.addEventListener("click", () => {

                var token = $('meta[name="csrf-token"]').attr('content');
                var suc = document.querySelector(".suc-btn");
                var loader = document.querySelector(".loader");
                var searchInput = document.querySelector('.search-bar input').value;

                $.ajax({
                    url: "{{ route('search') }}",
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
                                response.member.forEach(mem => {
                                    document.getElementById(`${mem}`).classList.add("queried");
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
                document.querySelectorAll(".row-user.hide").forEach(item=>{
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
        var active = document.querySelector(".filter-active");
        var inactive = document.querySelector(".filter-inactive");
        var blocked = document.querySelector(".filter-blocked");
        var about = document.querySelector(".filter-about");
        var loader2 = document.querySelector(".loader2");
        
        var all = document.querySelector(".filter-all");
        all.addEventListener("click", (e) => {
            document.querySelector('.box-filter .loader').classList.add("active");

            setTimeout(() => {
                document.querySelector('.box-filter .loader.active').classList.remove("active");
                document.querySelectorAll(".row-user.hide").forEach(item=>{
                    item.classList.remove("hide")
                });
            }, 1500);
            

        })

        active.addEventListener("click", () => {
            document.querySelector('.box-filter .loader').classList.add("active");

            setTimeout(() => {
                document.querySelector('.box-filter .loader.active').classList.remove("active");
                document.querySelectorAll(".row-user.hide").forEach(item=>{
                    item.classList.remove("hide")
                });
                document.querySelectorAll(".row-user:not(.user-active)").forEach(item=>{
                    item.classList.add("hide")
                });
            }, 1500);
            

        })

        inactive.addEventListener("click", () => {
            document.querySelector('.box-filter .loader').classList.add("active");

            setTimeout(() => {
                document.querySelector('.box-filter .loader.active').classList.remove("active");
                document.querySelectorAll(".row-user.hide").forEach(item=>{
                    item.classList.remove("hide")
                });
                document.querySelectorAll(".row-user:not(.user-inactive)").forEach(item=>{
                    item.classList.add("hide")
                });
            }, 1500);
            

        })

        blocked.addEventListener("click", () => {
            document.querySelector('.box-filter .loader').classList.add("active");

            setTimeout(() => {
                document.querySelector('.box-filter .loader.active').classList.remove("active");
                document.querySelectorAll(".row-user.hide").forEach(item=>{
                    item.classList.remove("hide")
                });
                document.querySelectorAll(".row-user:not(.user-blocked)").forEach(item=>{
                    item.classList.add("hide")
                });
            }, 1500);
            

        })

        about.addEventListener("click", () => {
            document.querySelector('.box-filter .loader').classList.add("active");

            setTimeout(() => {
                document.querySelector('.box-filter .loader.active').classList.remove("active");
                document.querySelectorAll(".row-user.hide").forEach(item=>{
                    item.classList.remove("hide");
                });
                document.querySelectorAll(".row-user:not(.user-about-to-date)").forEach(item=>{
                    item.classList.add("hide");
                });
            }, 1500);
            
        })
        

    </script>


</x-main>



