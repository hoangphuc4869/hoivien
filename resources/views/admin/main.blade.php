<x-main>

    {{-- {{$all_members}} --}}
    
     @if (Gate::allows('out_of_date'))
        <div class="cookie-wrap d-flex justify-content-center" style="margin-top: 100px">
            <div class="cookie-card">
                <span class="cookie-title">🍪 OOPS!!</span>
                <p class="cookie-description">
                    Tài khoản hết hạn <br>
                    Vui lòng gia hạn để tiếp tục
                </p>
                <button class="click-btn mt-5">
                    <span>Gia hạn</span>
                </button>
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

<script>
    var btn = document.querySelector(".click-btn");
    if(btn){
        btn.addEventListener("click", () => {
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