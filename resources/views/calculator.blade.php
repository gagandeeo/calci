<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo asset('styles.css')?>" type="text/css">
        <title>Calculator</title>
    </head>
    <body>
        <h1>Calculator</h1>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form method="POST" id='contactForm'>
            <div id='master'class="master__view">
                <div id='view' class="viewed">
                </div>
                <input type='text' onChange='handleInputChange(event)' id='demo2' class='master__viewinput' />
            </div>
            
            <div class="number__pad">
                <div class="nrow__pad">
                    <h1 onClick="handleClearall()">C</h1>
                    <h1 onClick="handleClear()">B</h1>
                    <h1 onClick="handleClick('y')">y</h1>
                    <h1 onClick="handleClick('/')">%</h1>
                </div>
                <div class="nrow__pad">
                    <h1 onClick="handleClick(7)">7</h1>
                    <h1 onClick="handleClick(8)">8</h1>
                    <h1 onClick="handleClick(9)">9</h1>
                    <h1 onClick="handleClick('*')">X</h1>
                </div>
                <div class="nrow__pad">
                    <h1 onClick="handleClick(4)">4</h1>
                    <h1 onClick="handleClick(5)">5</h1>
                    <h1 onClick="handleClick(6)">6</h1>
                    <h1 onClick="handleClick('-')">-</h1>
                </div>
                <div class="nrow__pad">
                    <h1 onClick="handleClick(1)">1</h1>
                    <h1 onClick="handleClick(2)" >2</h1>
                    <h1 onClick="handleClick(3)">3</h1>
                    <h1 onClick="handleClick('+')">+</h1>
                </div>
                <div class="nrow__pad">
                    <h1 onClick="handleReset()">R</h1>
                    <h1 onClick="handleClick(0)">0</h1>
                    <h1 onClick="handleClick('.')">.</h1>
                    <h1 onClick="submit()">=</h1> <!-- Submit -->
                </div>
            </div>
        </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script type="text/javascript">
        var arr = []
        var result = []
        function handleClick(params) {
            arr.push(params);
            displayOp()
        }
        function displayOp(){
            document.getElementById("demo2").value = arr.join('')
        } function handleInputChange(event){
            arr = Array.from(event.target.value)
        }
        function handleClear(){
            arr.pop();
            result.pop()
            displayOp()
        }
        function handleClearall(){
            arr = [];
            displayOp()
        }
        function handleReset() {
            result = []
            a = []
            arr = []
            var list = document.getElementById("view")
            while (list.firstChild) {
                list.removeChild(list.firstChild);
            }
            document.getElementById("demo2").value = ''
        }     
        function submit(){
            event.preventDefault();
            var a = document.getElementById('demo2').value
            $.ajax({
            url: "/calculator",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                a:a,
            },
            success:function(response){
                console.log(response.result);
                result.push(response.result);
                var new_div = document.createElement("h1");
                new_div.className = 'hello'
                var list = document.getElementById("view")
                list.insertBefore(new_div, list.childNodes[0]).innerHTML =  result[result.length-1]                
            },
            });
        }
      </script>
    </body>
</html>