@extends('layouts.app')

@section('script')

<!-- script for time limitation of exam -->
<script type="text/javascript">
var timeoutHandle;
function countdown(minutes) {
    var seconds = 60;
    var mins = minutes
    function tick() {
        var counter = document.getElementById("timer");
        var current_minutes = mins-1
        seconds--;
        counter.innerHTML =
        current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
        if( seconds > 0 ) {
            timeoutHandle=setTimeout(tick, 1000);
        } else {

            if(mins > 1){

               // countdown(mins-1);   never reach “00″ issue solved:Contributed by Victor Streithorst
               setTimeout(function () { countdown(mins - 1); }, 1000);

            }
        }
    }
    tick();
}

countdown('<?php echo $time; ?>');

</script>

<!-- script for disable url -->
<script type="text/javascript">
    var time= '<?php echo $time; ?>';
    var realtime = time*60000;
    setTimeout(function () {
        alert('Time Out');
        window.location.href= '/';
    },
   realtime);

    
    function end(){
        if(confirm("Are you sure?")){
            window.location.href="/";
            return true;
        }else{
            return false;
        }
    }

    // Warning before leaving the page (back button, or outgoinglink)
    window.onbeforeunload = function() {
       return "Do you really want to leave or end this exam?";
       //if we return nothing here (just calling return;) then there will be no pop-up question at all
       //return;
    };
</script>

@endsection




@section('content')
<body style="background-color: darkseagreen">
    <div>
        <center><h1 style="color: red; background-color: seagreen; color: white; padding: 20px;">  Examination on {{$course}}  </b> </h1>
            <h1 style="color: #fff;"><b>Timer <span id="timer" style="color: red">0.00</span></b>
            </h1>
        </center>

        <div class="col-md-6 col-lg-6 col-sm-6 col-lg-offset-3" style="background-color: white">
            
        @foreach($questions as $question)
            <div class="col-md-12 col-sm-12">
                <form method="post" action="{{route('answer.store')}}" class="ansform">
                	{{ csrf_field() }}

                    <h4>{{ $loop->iteration }}.) {{$question->question}}</h4>
                    <div class="col-lg-offset-1">
                        <input type="hidden" name="question" value="{{$question->question}}">
                        <input type="hidden" name="qid" value="{{$question->id}}">
                        <input type="hidden" name="student_id" value="{{$student_id}}">
                        <input type="hidden" name="true_answer" value="{{$question->answer}}">
                        <input name="answer" value="{{$question->choice1}}" type="radio" id="{{ $question->id }}{{ $loop->iteration }}1"> <label for="{{ $question->id }}{{ $loop->iteration }}1"> {{$question->choice1}}</label> <br>
                        <input name="answer" value="{{$question->choice2}}" type="radio" id="{{ $question->id }}{{ $loop->iteration }}2"> <label for="{{ $question->id }}{{ $loop->iteration }}2">{{$question->choice2}}</label><br>
                        <input name="answer" value="{{$question->choice3}}" type="radio" id="{{ $question->id }}{{ $loop->iteration }}3"> <label for="{{ $question->id }}{{ $loop->iteration }}3">{{$question->choice3}}</label><br>
                        <input name="answer" value="{{$question->choice4}}" type="radio" id="{{ $question->id }}{{ $loop->iteration }}4"> <label for="{{ $question->id }}{{ $loop->iteration }}4">{{$question->choice4}}</label><br><br>
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary" id="submitbtn">
                    </div>
                    <br>
                    <br>
                 </form>
            </div>
         @endforeach
    <br><br>
                   <a href="#" class="btn btn-danger pull-right" onclick="return end();">End Exam</a>
        </div>
        
    </div>
   
</body>




@endsection

	 
