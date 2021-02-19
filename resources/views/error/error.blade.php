<div class="container">
    <div class="row">
        <div class="col-md-12">
            <i class="fas fa-exclamation-triangle mx-auto" style="font-size: 100px; color: #c3c3c3;"></i>
        </div>
        <div class="col-md-4 err-no">
            <b>{{$code}}</b>
        </div>
        <div class="col-md-8 err-message">
            {{$slot}}
        </div>
        <div class="col-md-4">
            <button class="btn btn-secondary" type="button" onclick="history.back();">
                Back
            </button>
        </div>
    </div>
</div>