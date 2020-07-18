@extends('layouts.app')

@section('content')

<!-- @for ($i = 0; $i < 10; $i++)
    The current value is {{ $i }}
@endfor -->

<form method="post" action="{{route('student.store')}}">
	{{ csrf_field() }}

	<div class="col-md-6 col-lg-6 col-sm-6 col-lg-offset-3">
		<h4><b>Instructions:</b></h4>
		<h4 style="color: red">**Keep in mind that Question set (next page) would be invalid after limited exam time. Try to give Answer in time.</h4>
	  	<h4 style="color: red">**Do not refresh page.**</h4>
	  	<h4 style="color: red">**Submit all questions within time and click on end exam button.**</h4>
	  	<br>
	  <div class="form-group">
	    <label class="col-form-label" for="formGroupExampleInput">BTH Reg.Id</label>
	    <input type="text" name="student_id" class="form-control " id="formGroupExampleInput" placeholder="E.g. 11122333" required>
	  </div>
	  <div class="form-group">
	    <label class="col-form-label" for="formGroupExampleInput2">Exam Code</label>
	    <input type="text" name="exam_code" class="form-control" id="formGroupExampleInput2" placeholder="E.g. A6xgP" required>
	  </div>
	  <button type="Submit" class="btn btn-success btn-block">Submit & Start Exam</button><br>
	  
	</div>

</form>

    @endsection
