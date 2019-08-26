<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                margin: 0;
            }

            

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

        </style>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <style type="text/css">
            body{
                background-color: #041b4f;
                color: #fff;
            }
            .club-logo{
                width: 35px; padding: 5px;
            }
            .group-btn{
                border-radius: 0;
    border-bottom: 5px solid #a6abdf;
    background: #5c8de7;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="container">
                <!-- Vue.js Insatance to Show Dynamic Listing From API -->
                <div class="club-group">
                    <div class="row" v-for="section, index in groupList" >
                        <div class="col-md-12 m-b-md text-center mb-3 mt-2" v-show="index == 0">
                            <img :src="imgUrl+'/u.jpg'" width="100" />
                        </div>
                        <div class="col-md-12  m-b-md text-center mb-3 mt-2" v-show="index == 1">
                            <img :src="imgUrl+'/bitacora.jpg'" width="175" />
                        </div>
                        <div class="col-md-3 pr-4" v-for="group in section"> 
                            <div class="col-md-12">
                                <div class="col-md-12 text-center mb-2"> <button class="btn btn-primary group-btn"> @{{group.name}}</button></div>
                                <div class="row" v-for="member in group.members">
                                    <div class="col-md-3 text-right"><img :src="imgUrl+'/'+member.logo" :alt="member.club_name" class="club-logo"></div>
                                    <div class="col-md-9 text-right">@{{member.club_name}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="{{asset('js/vue.js')}}"></script>
    <script type="text/javascript"> 
        var baseUrl = "{{url('/')}}"
        var clubInstance  = new Vue({
            el:  '.club-group', 
            data: {
                groupList: {}, 
                imgUrl: "{{asset('/logos/')}}",
            }, 
            created(){
                $.ajax({
                    url: baseUrl+'/api/v1/group-list', 
                    method: "GET", 
                    success: function(response){
                        clubInstance.groupList = response.groups;
                    }, error: function (response){
                    }
                })
            }
        });
    </script>

</html>
