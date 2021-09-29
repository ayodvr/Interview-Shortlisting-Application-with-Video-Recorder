<div class="w-100">
    <div class="d-flex flex-column h-100">
        <input type="button" value="Listen" id="button-speak" class="btn btn-success sm">
        <br>
        <div class="mb-4 mb-md-5">
            <div id="text">
                <h2 class="text-primary">Interview Questions</h2>
                <p class="text-muted">Answer all the questions below by clicking the camera icon then press record to answer your questions.</p>
                @foreach($questions as $data)
                <ul>
                   <h5>{{ $data->id }}.  {{ $data->question }}</h5>
                </ul>
                @endforeach
                
            </div>
        </div>
    </div> 
    <div  class="d-flex justify-content-center">
        {!! $questions->links() !!}
    </div>
</div>