<form method="POST">
    {{method_field('PUT')}}
    @csrf 
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="Enter Group Name">
        </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <input type="submit" class="form-control btn btn-primary" value="Update">
            </div>
        </div>
    </div>
</form>