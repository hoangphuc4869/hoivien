<x-main>
  <link rel="stylesheet" href="/table_template/style.css">

  
  @if (Gate::allows('view'))
  <div class="summary container mb-5">
      <div class="sum-item">
        <p class="statistics-title">Tổng hội viên</p>
        <h2 class="rate-percentage">{{$membersCount}}</h2> 
      </div>
      <div class="sum-item">
        <p class="statistics-title">Hoạt động</p>
        <h2 class="rate-percentage">{{$totalActiveMembers}}</h2> 
      </div>

      <div class="sum-item">
        <p class="statistics-title">Sắp hết hạn</p>
        <h2 class="rate-percentage">{{$totalAboutMembers}}</h2> 
      </div>

      <div class="sum-item">
        <p class="statistics-title">Quá hạn</p>
        <h2 class="rate-percentage">{{$totalInactiveMembers}}</h2> 
      </div>

      <div class="sum-item">
        <p class="statistics-title">Khóa</p>
        <h2 class="rate-percentage">{{$totalBLockedMembers}}</h2> 
      </div>
      <div class="sum-item">
        <p class="statistics-title">Đăng ký</p>
        <h2 class="rate-percentage">{{$re}}</h2> 
      </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div  id="members-sum">
          <div class="table mt-0" id="customers_table">
       
              <section class="table__body">
                  <table>
                      <thead>
                          <tr>
                              <th> ID </th>
                              <th class="name-tag"> Họ tên </th>
                              <th> Trạng thái </th>
                         
                              <th> Ngày kết thúc </th>
                          
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($members as $member)
                          
                              <tr class="row-user user-{{$member->status}} {{$member->about_to_date === 1 ? 'user-about-to-date' : ''}}" id="{{$member->id}}">
                                  <td>{{$member->id}}</td>
                                  <td class="name-tag sticky-name">
                                      <a class="member-name" href="/profile/{{$member->user_id}}">{{$member->name}}</a>
                                  </td>
                                  <td class="d-flex align-items-center gap-2">
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
                                  <td>{{\Carbon\Carbon::parse($member->end)->format('d-m-Y H:i')}}</td>
                               
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
                
              </section>
          </div>

        </div>

        <div class="more-wrap d-flex justify-content-between align-items-center mt-3">
          <button class="member-more">
            <span><a href="/list">Xem thêm</a></span>
          </button>
          <button class="btn btn-primary btn-lg text-white mb-0 me-0 d-flex align-items-center gap-1" type="button"><i class="mdi mdi-account-plus"></i><a style="text-decoration: none; color: #fff;" href="/registerlist">Danh sách đăng ký</a></button>
        </div>


      </div>

      <div class="col-lg-4">
        <div class="card card-rounded">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <h4 class="card-title card-title-dash">Activities</h4>
              <p class="mb-0">20 finished, 5 remaining</p>
            </div>
            <ul class="bullet-line-list">
              <li>
                <div class="d-flex justify-content-between">
                  <div><span class="text-light-green">Ben Tossell</span> assign you a task</div>
                  <p>Just now</p>
                </div>
              </li>
              <li>
                <div class="d-flex justify-content-between">
                  <div><span class="text-light-green">Oliver Noah</span> assign you a task</div>
                  <p>1h</p>
                </div>
              </li>
              <li>
                <div class="d-flex justify-content-between">
                  <div><span class="text-light-green">Jack William</span> assign you a task</div>
                  <p>1h</p>
                </div>
              </li>
              <li>
                <div class="d-flex justify-content-between">
                  <div><span class="text-light-green">Leo Lucas</span> assign you a task</div>
                  <p>1h</p>
                </div>
              </li>
              <li>
                <div class="d-flex justify-content-between">
                  <div><span class="text-light-green">Thomas Henry</span> assign you a task</div>
                  <p>1h</p>
                </div>
              </li>
              <li>
                <div class="d-flex justify-content-between">
                  <div><span class="text-light-green">Ben Tossell</span> assign you a task</div>
                  <p>1h</p>
                </div>
              </li>
              <li>
                <div class="d-flex justify-content-between">
                  <div><span class="text-light-green">Ben Tossell</span> assign you a task</div>
                  <p>1h</p>
                </div>
              </li>
            </ul>
            <div class="list align-items-center pt-3">
              <div class="wrapper w-100">
                <p class="mb-0">
                  <a href="#" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
    </div>
    @endif
    

     @if (Gate::allows('out_of_date'))
        <div class="cookie-wrap d-flex justify-content-center" style="margin-top: 100px">
            <div class="cookie-card">
                <span class="cookie-title">🍪 OOPS!!</span>
                <p class="cookie-description">
                    Tài khoản hết hạn <br>
                    Vui lòng gia hạn để tiếp tục
                </p>
                <button class="click-btn mt-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span>Gia hạn</span>
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Đóng Phí Thường Niên</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <div class="text-pay mb-3" style="line-height: 2">
                                      <p>Số tài khoản: <span>34405517</span></p> 
                                      <p>
                                          Chủ tài khoản: <span>LIEN CHI HOI Y HOC THE DUC THE THAO TP HCM</span> 
                                      </p>
                                      <p>Ngân hàng: <span>Ngân hàng TMCP Á Châu (ACB)</span> </p>
                                      <p>Chi nhánh: <span>ACB - PGD NGUYEN TRI PHUONG</span></p> 
                                      <p>Swiftcode: <span>ASCBVNVX</span></p>
                                      <p class="note font-weight-bold mt-3">
                                          Vui lòng điền nội dung giao dịch theo cú pháp: <br>
                                          
                                          <span class="text-success">GH_Họ tên_Số điện thoại <br> ( GH_NguyenVanA_0333792102 )</span>
                                      </p>
                                  </div>

                                  <style>
                                      .text-pay p {
                                          margin-bottom: 5px;
                                      }
                                      .text-pay span {
                                          color: rgb(35, 2, 146);
                                          /* font-size: 18px; */
                                          font-weight: 800;
                                          margin-left: 3px;
                                      }
                                      .img-qr {
                                          margin: 0  auto;
                                          display: block;
                                      }
                                      .modal-body {
                                          background-color: antiquewhite;
                                      } 
                                  </style>

                                  <div class="qr-wrap">
                                      <img class="img-qr" src="/images/qr.jpg" alt="Profile image">
                                  </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                          </div>
                      </div>
                  </div>
            </div>
        </div>
     @endif

     @if (Gate::allows('blocked'))
        <div class="cookie-wrap">
            <div class="cookie-card block-noti">
               
                    <span class="cookie-title">🍪 OOPS!!</span>
                    <p class="cookie-description">
                        Tài khoản tạm khóa
                    </p>
            </div>
        </div>
     @endif
    
</x-main>


  <style>
    .btn.btn-lg{
      font-size: 0.875rem;
      padding: 10px 20px;
      height: 53px;
      background: #27367f;
  }
    .summary {
      display: grid;
      grid-template-columns: repeat(6, 1fr);
      gap: 20px
    }

    .summary .sum-item {
      grid-column: span 1
    }

    div#customers_table {
        height: auto;
    }


    .member-more {
      display: inline-block;
      border-radius: 4px;
      background-color: #27367f;
      border: none;
      color: #FFFFFF;
      text-align: center;
      font-size: 17px;
      padding: 16px;
      width: 130px;
      transition: all 0.5s;
      cursor: pointer;
      margin: 5px;
      }

      .member-more a {
        color: #fff;
        text-decoration: none;
        font-size: 14px;
      }

      .member-more span {
      cursor: pointer;
      display: inline-block;
      position: relative;
      transition: 0.5s;
      }

      .member-more span:after {
      content: '»';
      position: absolute;
      opacity: 0;
      top: 0;
      right: -15px;
      transition: 0.5s;
      }

      .member-more:hover span {
      padding-right: 15px;
      }

      .member-more:hover span:after {
      opacity: 1;
      right: 0;
      }

      @media (max-width: 600px) {
        .summary {
          display: grid;
          grid-template-columns: repeat(3, 1fr);
          gap: 20px;
          
        }
      }

    

   
  </style>

<script>
    var btn = document.querySelector(".click-btn");
    if(btn){
        btn.addEventListener("click", () => {
            btn.classList.add("disabled");
            // alert("Đã đăng ký gia hạn. Vui lòng chờ xác nhận");
            
            var userId = document.querySelector("body").dataset.id;
            var token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                url: "{{route('query')}}", 
                data: JSON.stringify({ userId: userId }), 
                success: function(response) {
                    console.log(response.transaction);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        })
    }
</script>

<style>
.click-btn {
 display: inline-block;
 border-radius: 4px;
 background-color: #3d405b;
 border: none;
 color: #FFFFFF;
 text-align: center;
 font-size: 17px;
 padding: 16px;
 width: 130px;
 transition: all 0.5s;
 cursor: pointer;
 margin: 5px;
}

.click-btn.disabled {
 pointer-events: none;
 opacity: 0.3;
}

.click-btn span {
 cursor: pointer;
 display: inline-block;
 position: relative;
 transition: 0.5s;
}

.click-btn span:after {
 content: '»';
 position: absolute;
 opacity: 0;
 top: 0;
 right: -15px;
 transition: 0.5s;
}

.click-btn:hover span {
 padding-right: 15px;
}

.click-btn:hover span:after {
 opacity: 1;
 right: 0;
}

.cookie-card {
    border-radius: 15px;
    width: 320px;
    height: 200px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    display: flex;
    flex-direction: column;
    align-items: center;
}
.cookie-card.block-noti {
   
    height: 100px;
   
}

.cookie-title {
  font-size: 20px;
  position: relative;
  /* left: 90px; */
  top: 15px;
  font-weight: bold;
  color: rgb(31 41 55);
}

.cookie-wrap {
    display: flex;
    justify-content: center;
    margin-top: 100px;
}

.cookie-description {
  position: relative;
  top: 25px;
  font-size: 15px;
  text-align: center;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
  color: rgb(75 85 99);
}

.cookies-policy {
  color: rgb(31 41 55);
  text-decoration: underline;
}

.cookies-policy:hover {
  text-decoration: none;
}

.cookies-policy:active {
  color: rgba(31, 41, 55, 0.61);
  ;
}

.accept-button {
  cursor: pointer;
  font-weight: bold;
  border-radius: 5px;
  width: 85px;
  height: 35px;
  background-color: rgba(255, 255, 255, 0);
  position: relative;
  left: 115px;
  top: 45px;
}

.accept-button:hover {
  background-color: rgb(31 41 55);
  color: #fff;
  border: rgb(31 41 55);
  ;
}

.accept-button:active {
  font-weight: 100;
}


    
</style>