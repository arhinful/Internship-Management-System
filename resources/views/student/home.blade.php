@extends('student.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-3">
                @if($can_send_report == true)
                    <form enctype="multipart/form-data" method="POST" action="{{route('student.submit_report')}}">
                        @csrf
                        <span class="h3">Submit Your Attachment Report</span><br>
                        <span class="text-info">
                            The file must be pdf
                        </span>
                        @if(Auth::guard('student')->user()->report != null)
                            <input name="report" type="file" accept="application/pdf" class="form-control form-control-file mt-3">
                            <span class="text-danger">You have already submitted your report, you can update it</span> <br>
                            <button class="btn btn-success mt-3" type="submit">Update Report</button>
                            <a href="{{url('storage/reports/'.$student->report) }}" class="btn btn-warning border mt-3 ml-5 border-dark">View Report</a>
                            @else
                                <input name="report" type="file" accept="application/pdf" class="form-control form-control-file mt-3">
                                <button type="submit" class="col-6 btn btn-success mt-3">Submit</button>
                        @endif

                    </form>
                    @else
                        <span>
                            Attachment period is not over yet <br>
                        </span>
                        <span class="small text-info">
                            You can only send report after attachment period is over <br>
                        </span>
                        <span class="font-italic text-info">
                            Attachment period ends on: {{ date('l, dS F, Y', strtotime(Auth::guard('student')->user()->attachment_end))  }}
                        </span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
